<?php

namespace App\Livewire\Admin;

use App\Models\ContentRequest;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('layouts.admin')]
#[Title('Request Management - Qissa+')]
class RequestManagement extends Component
{
    public function approve($requestId)
    {
        $request = ContentRequest::findOrFail($requestId);
        $request->update(['status' => 'approved']);
        session()->flash('success', 'Request berhasil disetujui!');
    }

    public function reject($requestId)
    {
        $request = ContentRequest::findOrFail($requestId);
        $request->update(['status' => 'rejected']);
        session()->flash('success', 'Request ditolak!');
    }

    public function render()
    {
        $requests = ContentRequest::pending()
            ->with('user')
            ->byPriority()
            ->latest()
            ->get();

        return view('livewire.admin.request-management', compact('requests'));
    }
}