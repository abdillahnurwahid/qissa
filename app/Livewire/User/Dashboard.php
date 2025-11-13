<?php

namespace App\Livewire\User;

use App\Models\Artikel;
use App\Models\Category;
use App\Models\User;
use App\Models\Video;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

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

    public function toggleFavoriteVideo($videoId)
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

    public function toggleFavoriteArtikel($artikelId)
    {
        $artikel = Artikel::findOrFail($artikelId);

        if (auth()->user()->hasFavorited($artikel)) {
            auth()->user()->favorites()
                ->where('favoritable_type', Artikel::class)
                ->where('favoritable_id', $artikelId)
                ->delete();
        } else {
            auth()->user()->favorites()->create([
                'favoritable_type' => Artikel::class,
                'favoritable_id' => $artikelId,
            ]);
        }
    }
}
