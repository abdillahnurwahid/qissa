<?php

namespace App\Livewire\User;

use App\Models\ContentRequest;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('layouts.user')]
#[Title('Request Konten - Qissa+')]
class ContentRequestForm extends Component
{
    public $title = '';
    public $description = '';
    public $type = 'video';
    public $priority = 'medium';

    protected $rules = [
        'title' => 'required|min:10|max:255',
        'description' => 'nullable|max:1000',
        'type' => 'required|in:video,artikel',
        'priority' => 'required|in:low,medium,high',
    ];

    protected $messages = [
        'title.required' => 'Judul request wajib diisi.',
        'title.min' => 'Judul minimal 10 karakter.',
        'title.max' => 'Judul maksimal 255 karakter.',
        'description.max' => 'Deskripsi maksimal 1000 karakter.',
        'type.required' => 'Tipe konten wajib dipilih.',
        'priority.required' => 'Prioritas wajib dipilih.',
    ];

    public function submit()
    {
        $this->validate();

        ContentRequest::create([
            'user_id' => auth()->id(),
            'title' => $this->title,
            'description' => $this->description,
            'type' => $this->type,
            'priority' => $this->priority,
            'votes' => 1, // Start with 1 vote (from requester)
            'status' => 'pending',
        ]);

        session()->flash('success', 'Request berhasil dikirim! Admin akan review segera.');

        // Reset form
        $this->reset(['title', 'description', 'type', 'priority']);
    }

    public function render()
    {
        return view('livewire.user.content-request-form');
    }
}
