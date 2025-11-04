<?php

namespace App\Livewire\Admin;

use App\Models\Video;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('layouts.admin')]
#[Title('Video Management - Qissa+')]
class VideoManagement extends Component
{
    public $statusFilter = 'all';

    public function approve($videoId)
    {
        $video = Video::findOrFail($videoId);
        $video->update(['status' => 'approved']);
        session()->flash('success', 'Video berhasil disetujui!');
    }

    public function reject($videoId)
    {
        $video = Video::findOrFail($videoId);
        $video->update(['status' => 'rejected']);
        session()->flash('success', 'Video ditolak!');
    }

    public function delete($videoId)
    {
        Video::findOrFail($videoId)->delete();
        session()->flash('success', 'Video berhasil dihapus!');
    }

    public function render()
    {
        $videos = Video::when($this->statusFilter !== 'all', function($query) {
                $query->where('status', $this->statusFilter);
            })
            ->with('category')
            ->latest()
            ->get();

        return view('livewire.admin.video-management', compact('videos'));
    }
}
