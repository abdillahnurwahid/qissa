<?php

namespace App\Livewire\Admin;

use App\Models\ContentRequest;
use App\Models\Artikel;
use App\Models\Video;
use App\Helpers\YouTubeHelper;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Illuminate\Support\Str;

#[Layout('layouts.admin')]
#[Title('Request Management - Qissa+')]
class RequestManagement extends Component
{
    public $statusFilter = 'pending';

    public function approve($requestId)
    {
        $request = ContentRequest::with('user')->findOrFail($requestId);
        
        $request->update(['status' => 'approved']);
        
        if ($request->type === 'artikel' && !empty($request->content)) {
            // Create Artikel
            $artikel = Artikel::create([
                'category_id' => $request->category_id ?? 1,
                'user_id' => $request->user_id,
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'excerpt' => Str::limit($request->description, 200),
                'content' => $request->content,
                'status' => 'approved',
                'views' => 0,
                'votes' => 0,
            ]);
            
            $request->update(['created_content_id' => $artikel->id]);
            
            session()->flash('success', "Request disetujui! Artikel '{$artikel->title}' berhasil dibuat.");
            
        } elseif ($request->type === 'video' && !empty($request->video_url)) {
            // Extract YouTube ID
            $videoId = YouTubeHelper::extractVideoId($request->video_url);
            
            if ($videoId) {
                // Create Video
                $video = Video::create([
                    'category_id' => $request->category_id ?? 1,
                    'title' => $request->title,
                    'slug' => Str::slug($request->title),
                    'description' => $request->description,
                    'thumbnail' => YouTubeHelper::getThumbnailUrl($videoId),
                    'video_url' => YouTubeHelper::getWatchUrl($videoId),
                    'duration' => $request->duration,
                    'status' => 'approved',
                    'views' => 0,
                ]);
                
                $request->update(['created_content_id' => $video->id]);
                
                session()->flash('success', "Request disetujui! Video '{$video->title}' berhasil dibuat.");
            } else {
                session()->flash('error', 'Gagal extract YouTube ID. Periksa URL video.');
            }
            
        } else {
            session()->flash('success', 'Request disetujui!');
        }
    }

    public function reject($requestId)
    {
        $request = ContentRequest::findOrFail($requestId);
        $request->update(['status' => 'rejected']);
        session()->flash('success', 'Request ditolak!');
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