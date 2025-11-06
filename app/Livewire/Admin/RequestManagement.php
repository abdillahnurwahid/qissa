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
    public $statusFilter = 'pending';

    public function approve($requestId)
    {
        $request = ContentRequest::findOrFail($requestId);
        $request->update(['status' => 'approved']);
        
        session()->flash('success', 'Request disetujui! Sekarang bisa mulai dibuat kontennya.');
    }

    public function reject($requestId)
    {
        $request = ContentRequest::findOrFail($requestId);
        $request->update(['status' => 'rejected']);
        
        session()->flash('success', 'Request ditolak.');
    }

    public function delete($requestId)
    {
        ContentRequest::findOrFail($requestId)->delete();
        session()->flash('success', 'Request berhasil dihapus!');
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

        return view('livewire.admin.request-management', compact('requests'));
    }
}