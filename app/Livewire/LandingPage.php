<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Video;
use App\Models\Artikel;
use App\Models\Category;

class LandingPage extends Component
{
    public function render()
    {
        $popularVideos = Video::approved()
            ->orderBy('views', 'desc')
            ->limit(6)
            ->with('category')
            ->get();

        $popularArtikels = Artikel::approved()
            ->orderBy('views', 'desc')
            ->limit(6)
            ->with(['category', 'user'])
            ->get();

        $categories = Category::withCount(['videos', 'artikels'])->get();

        $stats = [
            'total_videos' => Video::approved()->count(),
            'total_articles' => Artikel::approved()->count(),
            'total_categories' => Category::count(),
        ];

        return view('livewire.landing-page', compact('popularVideos', 'popularArtikels', 'categories', 'stats'))
            ->layout('layouts.app'); 
    }
}