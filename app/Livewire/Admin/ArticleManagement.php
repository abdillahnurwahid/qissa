<?php

namespace App\Livewire\Admin;

use App\Models\Artikel;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('layouts.admin')]
#[Title('Article Management - Qissa+')]
class ArticleManagement extends Component
{
    public $statusFilter = 'all';

    public function approve($artikelId)
    {
        $artikel = Artikel::findOrFail($artikelId);
        $artikel->update(['status' => 'approved']);
        session()->flash('success', 'Artikel berhasil disetujui!');
    }

    public function reject($artikelId)
    {
        $artikel = Artikel::findOrFail($artikelId);
        $artikel->update(['status' => 'rejected']);
        session()->flash('success', 'Artikel ditolak!');
    }

    public function delete($artikelId)
    {
        Artikel::findOrFail($artikelId)->delete();
        session()->flash('success', 'Artikel berhasil dihapus!');
    }

    public function render()
    {
        $artikels = Artikel::when($this->statusFilter !== 'all', function($query) {
                $query->where('status', $this->statusFilter);
            })
            ->with(['user', 'category'])
            ->latest()
            ->get();

        return view('livewire.admin.article-management', compact('artikels'));
    }
}