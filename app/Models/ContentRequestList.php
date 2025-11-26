<?php

namespace App\Livewire\User;

use App\Models\ContentRequest;
use App\Models\ContentRequestVote;
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
    
    \Log::info('Vote attempt', [
        'user_id' => auth()->id(),
        'request_id' => $requestId,
        'has_voted' => $request->hasVotedBy(auth()->user())
    ]);
    
    if ($request->hasVotedBy(auth()->user())) {
        session()->flash('error', '❌ Anda sudah memberikan vote untuk request ini!');
        return;
    }

    ContentRequestVote::create([
        'user_id' => auth()->id(),
        'content_request_id' => $requestId,
    ]);

    $request->incrementVotes();

    session()->flash('success', '✅ Vote berhasil! Terima kasih atas dukungannya.');
}

    public function unvote($requestId)
    {
        $request = ContentRequest::findOrFail($requestId);
        
        if (!$request->hasVotedBy(auth()->user())) {
            session()->flash('error', '❌ Anda belum memberikan vote untuk request ini!');
            return;
        }

        ContentRequestVote::where('user_id', auth()->id())
            ->where('content_request_id', $requestId)
            ->delete();

        $request->decrementVotes();

        session()->flash('success', '✅ Vote berhasil dibatalkan!');
    }

    public function render()
    {
        $requests = ContentRequest::when($this->statusFilter !== 'all', function($query) {
                $query->where('status', $this->statusFilter);
            })
            ->with(['user', 'votedBy'])
            ->byPriority()
            ->latest()
            ->get();

        return view('livewire.user.content-request-list', compact('requests'));
    }
}