<?php

namespace App\Livewire\User;

use App\Models\ContentRequest;
use App\Models\Category;
use App\Helpers\YouTubeHelper;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Video;
use Illuminate\Support\Str;

#[Layout('layouts.user')]
#[Title('Request Konten - Qissa+')]
class ContentRequestForm extends Component
{
    public $title = '';
    public $description = '';
    public $content = '';
    public $video_url = '';     // NEW
    public $duration = '';      // NEW
    public $category_id = '';
    public $type = 'video';
    public $priority = 'medium';

    protected function rules()
    {
        $rules = [
            'title' => 'required|min:10|max:255',
            'description' => 'nullable|max:1000',
            'type' => 'required|in:video,artikel',
            'priority' => 'required|in:low,medium,high',
            'category_id' => 'required|exists:categories,id',
        ];

        if ($this->type === 'artikel') {
            $rules['content'] = 'required|min:100|max:50000';
        } else {
            // Video rules
            $rules['video_url'] = 'required|url';
            $rules['duration'] = 'required|integer|min:1|max:300'; // 1-300 minutes
        }

        return $rules;
    }

    protected $messages = [
        'title.required' => 'Judul request wajib diisi.',
        'content.required' => 'Konten artikel wajib diisi.',
        'video_url.required' => 'URL YouTube wajib diisi.',
        'video_url.url' => 'Format URL tidak valid.',
        'duration.required' => 'Durasi video wajib diisi.',
        'duration.integer' => 'Durasi harus berupa angka.',
        'category_id.required' => 'Kategori wajib dipilih.',
    ];

public function submit()
{
    $this->validate();

    $data = [
        'user_id' => auth()->id(),
        'title' => $this->title,
        'description' => $this->description,
        'category_id' => $this->category_id,
        'type' => $this->type,
        'priority' => $this->priority,
        'votes' => 1,
        'status' => 'pending',
    ];

    if ($this->type === 'artikel') {
        $data['content'] = $this->content;
    } else {
        $data['video_url'] = $this->video_url;
        $data['duration'] = $this->duration;
    }

    ContentRequest::create($data);

    session()->flash('success', '🎉 Request berhasil dikirim! Admin akan review segera.');

    return redirect()->route('user.request.list'); 
}
    public function render()
    {
        $categories = Category::all();
        return view('livewire.user.content-request-form', compact('categories'));
    }
}
