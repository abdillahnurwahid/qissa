<?php

namespace App\Livewire\Admin;

use App\Models\User;
use App\Models\Video;
use App\Models\Artikel;
use App\Models\ContentRequest;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('layouts.admin')]
#[Title('Admin Dashboard - Qissa+')]
class Dashboard extends Component
{
    public function render()
    {
        $stats = [
            'total_users' => User::count(),
            'total_videos' => Video::count(),
            'total_articles' => Artikel::count(),
            'pending_requests' => ContentRequest::pending()->count(),
        ];

        return view('livewire.admin.dashboard', compact('stats'));
    }
}