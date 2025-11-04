<?php

namespace App\Livewire\User;

use App\Models\Video;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('layouts.user')]
#[Title('Video - Qissa+')]
class VideoList extends Component
{
    public $search = '';
    public $selectedCategory = null;

    public function watchVideo($videoId)
    {
        $video = Video::findOrFail($videoId);
        
        // Increment views
        $video->incrementViews();
        
        // Redirect ke YouTube
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
        $videos = Video::approved()
            ->when($this->search, function($query) {
                $query->where('title', 'like', '%' . $this->search . '%');
            })
            ->when($this->selectedCategory, function($query) {
                $query->where('category_id', $this->selectedCategory);
            })
            ->with('category')
            ->latest()
            ->get();

        return view('livewire.user.video-list', compact('videos'));
    }
}