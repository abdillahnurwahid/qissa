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
    public function render()
    {
        $stats = [
            'total_videos' => Video::approved()->count(),
            'total_articles' => Artikel::approved()->count(),
            'total_users' => User::count(),
            'platform_rating' => 4.8,
        ];

        $categories = Category::take(5)->get();

        return view('livewire.user.dashboard', compact('stats', 'categories'));
    }
}
