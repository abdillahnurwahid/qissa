<?php

namespace App\Livewire\User;

use App\Models\Video;
use App\Models\Category;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;

#[Layout('layouts.user')]
#[Title('Video - Qissa+')]
class VideoList extends Component
{
    public $search = '';
    
    #[Url(as: 'category')]
    public $selectedCategory = null;

    public function mount()
    {
        // Get category from URL query parameter
        $this->selectedCategory = request()->query('category');
    }

    public function filterByCategory($categoryId)
    {
        $this->selectedCategory = $categoryId;
    }

    public function clearFilter()
    {
        $this->selectedCategory = null;
    }

    public function watchVideo($videoId)
    {
        $video = Video::findOrFail($videoId);
        
        // Anti-spam view tracking
        $this->trackView($video, 'video');
        
        // Redirect ke YouTube
        return redirect()->away($video->video_url);
    }

    private function trackView($content, $type)
    {
        $contentId = $content->id;
        $ipAddress = request()->ip();
        
        // Create unique key: IP + Type + ID
        $viewKey = "view_{$type}_{$contentId}_{$ipAddress}";
        $cookieKey = "viewed_{$type}_{$contentId}";
        
        // Check session (per browser)
        if (session()->has($viewKey)) {
            return; // Already viewed in this session
        }
        
        // Check cookie (2 hours window)
        if (request()->cookie($cookieKey)) {
            return; // Already viewed in last 2 hours
        }
        
        // Increment view
        $content->incrementViews();
        
        // Mark as viewed in session (until browser close)
        session()->put($viewKey, true);
        
        // Set cookie (2 hours)
        cookie()->queue($cookieKey, true, 120); // 120 minutes = 2 hours
    }

    public function toggleFavorite($videoId)
    {
        $video = Video::findOrFail($videoId);
        
        if (auth()->user()->hasFavorited($video)) {
            auth()->user()->favorites()
                ->where('favoritable_type', Video::class)
                ->where('favoritable_id', $videoId)
                ->delete();
        } else {
            auth()->user()->favorites()->create([
                'favoritable_type' => Video::class,
                'favoritable_id' => $videoId,
            ]);
        }
    }

    public function render()
{
    $categories = Category::withCount('videos')->get();
    
    $videos = Video::approved() // ← SUDAH FILTER APPROVED!
        ->when($this->search, function($query) {
            $query->where('title', 'like', '%' . $this->search . '%')
                  ->orWhere('description', 'like', '%' . $this->search . '%');
        })
        ->when($this->selectedCategory, function($query) {
            $query->where('category_id', $this->selectedCategory);
        })
        ->with('category')
        ->latest()
        ->get();

    $currentCategory = $this->selectedCategory 
        ? Category::find($this->selectedCategory) 
        : null;

    return view('livewire.user.video-list', compact('videos', 'categories', 'currentCategory'));
    }
}
