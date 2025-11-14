<?php

namespace App\Livewire\User;

use App\Models\Category;
use App\Models\Video;
use App\Models\Artikel;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('layouts.user')]
class CategoryShow extends Component
{
    public Category $category;
    public $activeTab = 'videos'; 

    public function mount($id)
    {
        $this->category = Category::with(['videos' => function($query) {
            $query->approved()->latest();
        }, 'artikels' => function($query) {
            $query->approved()->with('user')->latest();
        }])->findOrFail($id);
    }

    public function switchTab($tab)
    {
        $this->activeTab = $tab;
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

    public function watchVideo($videoId)
    {
        $video = Video::findOrFail($videoId);
        $this->trackView($video, 'video');
        return redirect()->away($video->video_url);
    }

    public function readArtikel($artikelId)
    {
        $artikel = Artikel::findOrFail($artikelId);
        $this->trackView($artikel, 'artikel');
        return redirect()->route('user.artikel.show', $artikel->id);
    }

    private function trackView($content, $type)
    {
        $contentId = $content->id;
        $ipAddress = request()->ip();
        
        $viewKey = "view_{$type}_{$contentId}_{$ipAddress}";
        $cookieKey = "viewed_{$type}_{$contentId}";
        
        if (session()->has($viewKey) || request()->cookie($cookieKey)) {
            return;
        }
        
        $content->incrementViews();
        session()->put($viewKey, true);
        cookie()->queue($cookieKey, true, 120);
    }

    public function getTitle(): string
    {
        return $this->category->name . ' - Qissa+';
    }

    public function render()
    {
        return view('livewire.user.category-show')
            ->title($this->getTitle());
    }
}
