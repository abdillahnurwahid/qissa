<?php

namespace App\Livewire\User;

use App\Models\Artikel;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('layouts.user')]
class ArtikelDetail extends Component
{
    public Artikel $artikel;

    public function mount($id)
    {
        $this->artikel = Artikel::with(['user', 'category'])->findOrFail($id);
    }

    public function toggleFavorite()
    {
        if (auth()->user()->hasFavorited($this->artikel)) {
            auth()->user()->favorites()
                ->where('favoritable_type', Artikel::class)
                ->where('favoritable_id', $this->artikel->id)
                ->delete();
        } else {
            auth()->user()->favorites()->create([
                'favoritable_type' => Artikel::class,
                'favoritable_id' => $this->artikel->id,
            ]);
        }
    }

    public function getTitle(): string
    {
        return $this->artikel->title . ' - Qissa+';
    }

    public function render()
    {
        return view('livewire.user.artikel-detail')
            ->title($this->getTitle());
    }
}