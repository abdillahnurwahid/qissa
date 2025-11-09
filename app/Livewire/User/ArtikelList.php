<?php

namespace App\Livewire\User;

use App\Models\Artikel;
use App\Models\Category;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;

#[Layout('layouts.user')]
#[Title('Artikel - Qissa+')]
class ArtikelList extends Component
{
    public $search = '';
    
    #[Url(as: 'category')]
    public $selectedCategory = null;

    public function mount()
    {
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

     public function readArtikel($artikelId)
    {
        $artikel = Artikel::findOrFail($artikelId);
        
        // Anti-spam view tracking
        $this->trackView($artikel, 'artikel');
        
        // Redirect ke detail artikel
        return redirect()->route('user.artikel.show', $artikel->id);
    }

    private function trackView($content, $type)
    {
        $contentId = $content->id;
        $ipAddress = request()->ip();
        
        $viewKey = "view_{$type}_{$contentId}_{$ipAddress}";
        $cookieKey = "viewed_{$type}_{$contentId}";
        
        if (session()->has($viewKey)) {
            return;
        }
        
        if (request()->cookie($cookieKey)) {
            return;
        }
        
        $content->incrementViews();
        
        session()->put($viewKey, true);
        cookie()->queue($cookieKey, true, 120);
    }

    public function toggleFavorite($artikelId)
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

    public function render()
{
    $categories = Category::withCount('artikels')->get();
    
    $artikels = Artikel::approved() // ← SUDAH FILTER APPROVED!
        ->when($this->search, function($query) {
            $query->where('title', 'like', '%' . $this->search . '%')
                  ->orWhere('content', 'like', '%' . $this->search . '%');
        })
        ->when($this->selectedCategory, function($query) {
            $query->where('category_id', $this->selectedCategory);
        })
        ->with(['user', 'category'])
        ->latest()
        ->get();

    $currentCategory = $this->selectedCategory 
        ? Category::find($this->selectedCategory) 
        : null;

    return view('livewire.user.artikel-list', compact('artikels', 'categories', 'currentCategory'));
    }

}