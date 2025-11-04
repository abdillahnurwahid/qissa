<?php

namespace App\Livewire\User;

use App\Models\Artikel;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('layouts.user')]
#[Title('Artikel - Qissa+')]
class ArtikelList extends Component
{
    public $search = '';
    public $selectedCategory = null;

    public function readArtikel($artikelId)
    {
        $artikel = Artikel::findOrFail($artikelId);
        
        // Increment views
        $artikel->incrementViews();
        
        // Redirect ke detail artikel
        return redirect()->route('user.artikel.show', $artikel->id);
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
        $artikels = Artikel::approved()
            ->when($this->search, function($query) {
                $query->where('title', 'like', '%' . $this->search . '%');
            })
            ->when($this->selectedCategory, function($query) {
                $query->where('category_id', $this->selectedCategory);
            })
            ->with(['user', 'category'])
            ->latest()
            ->get();

        return view('livewire.user.artikel-list', compact('artikels'));
    }
}

