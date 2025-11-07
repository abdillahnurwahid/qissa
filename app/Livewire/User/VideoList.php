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
        $video->incrementViews();
        return redirect()->away($video->video_url);
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
        
        $videos = Video::approved()
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
