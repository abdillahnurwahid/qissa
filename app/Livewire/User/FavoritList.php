<?php

namespace App\Livewire\User;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('layouts.user')]
#[Title('Favorit - Qissa+')]
class FavoritList extends Component
{
    public function removeFavorite($favoriteId)
    {
        auth()->user()->favorites()->where('id', $favoriteId)->delete();
    }

    public function render()
    {
        $favorites = auth()->user()->favorites()->with('favoritable')->latest()->get();

        return view('livewire.user.favorit-list', compact('favorites'));
    }
}