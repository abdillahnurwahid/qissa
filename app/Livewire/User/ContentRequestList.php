<?php

namespace App\Livewire\User;

use App\Models\ContentRequest;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('layouts.user')]
#[Title('Request Konten - Qissa+')]
class ContentRequestList extends Component
{
    public $statusFilter = 'all';

    public function vote($requestId)
    {
        $request = ContentRequest::findOrFail($requestId);
        
        // Check if user already voted (simple check for now)
        // Nanti bisa diperbaiki dengan pivot table
        $request->incrementVotes();

        session()->flash('success', 'Vote berhasil! Terima kasih atas dukungannya.');
    }

    public function render()
    {
        $requests = ContentRequest::when($this->statusFilter !== 'all', function($query) {
                $query->where('status', $this->statusFilter);
            })
            ->with('user')
            ->byPriority()
            ->latest()
            ->get();

        return view('livewire.user.content-request-list', compact('requests'));
    }
}