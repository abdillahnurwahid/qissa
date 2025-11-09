<?php

namespace App\Livewire\User;

use App\Models\Video;
use App\Models\Artikel;
use App\Models\Category;
use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('layouts.user')]
#[Title('Dashboard - Qissa+')]
class Dashboard extends Component
{
    public function filterByCategory($categoryId, $type = 'both')
    {
        // Redirect ke category page (tampil video + artikel)
        return redirect()->route('user.category.show', $categoryId);
    }

    public function render()
    {
        $stats = [
            'total_videos' => Video::approved()->count(),
            'total_articles' => Artikel::approved()->count(),
            'total_users' => User::count(),
            'platform_rating' => 4.8,
        ];

        $categories = Category::withCount(['videos', 'artikels'])->get();
        
        // Popular videos (top 6 most viewed)
        $popularVideos = Video::approved()
            ->orderBy('views', 'desc')
            ->limit(6)
            ->with('category')
            ->get();

        return view('livewire.user.dashboard', compact('stats', 'categories', 'popularVideos'));
    }
}

