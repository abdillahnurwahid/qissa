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
    public function filterByCategory($categoryId, $type = 'video')
    {
        // Redirect ke halaman video/artikel dengan filter kategori
        if ($type === 'video') {
            return redirect()->route('user.video', ['category' => $categoryId]);
        } else {
            return redirect()->route('user.artikel', ['category' => $categoryId]);
        }
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

        return view('livewire.user.dashboard', compact('stats', 'categories'));
    }
}
