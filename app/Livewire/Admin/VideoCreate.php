<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Video;
use App\Models\Category;
use App\Helpers\YouTubeHelper;
use Illuminate\Support\Str;

#[Layout('layouts.admin')]
class VideoCreate extends Component
{
    public $title = '';
    public $description = '';
    public $category_id = '';
    public $video_url = '';
    public $duration = '';
    public $status = 'approved';

    protected function rules()
    {
        return [
            'title' => 'required|min:5|max:255',
            'description' => 'nullable|max:1000',
            'category_id' => 'required|exists:categories,id',
            'video_url' => 'required|url',
            'duration' => 'required|integer|min:1|max:300',
            'status' => 'required|in:pending,approved,rejected',
        ];
    }

    protected $messages = [
        'title.required' => 'Judul video wajib diisi.',
        'title.min' => 'Judul minimal 5 karakter.',
        'category_id.required' => 'Kategori wajib dipilih.',
        'video_url.required' => 'URL YouTube wajib diisi.',
        'video_url.url' => 'Format URL tidak valid.',
        'duration.required' => 'Durasi wajib diisi.',
        'duration.integer' => 'Durasi harus berupa angka.',
        'duration.min' => 'Durasi minimal 1 menit.',
        'duration.max' => 'Durasi maksimal 300 menit (5 jam).',
    ];

    public function save()
    {
        $this->validate();

        $videoId = YouTubeHelper::extractVideoId($this->video_url);
        
        if (!$videoId) {
            $this->addError('video_url', 'Gagal mengekstrak ID YouTube. Pastikan URL valid.');
            return;
        }

        Video::create([
            'category_id' => $this->category_id,
            'title' => $this->title,
            'slug' => Str::slug($this->title),
            'description' => $this->description,
            'thumbnail' => YouTubeHelper::getThumbnailUrl($videoId),
            'video_url' => YouTubeHelper::getWatchUrl($videoId),
            'duration' => $this->duration,
            'status' => $this->status,
            'views' => 0,
        ]);

        session()->flash('success', 'Video berhasil ditambahkan!');
        
        return redirect()->route('admin.videos');
    }

    public function render()
    {
        $categories = Category::all();
        return view('livewire.admin.video-create', compact('categories'));
    }
}