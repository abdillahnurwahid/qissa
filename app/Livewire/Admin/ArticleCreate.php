<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Artikel;
use App\Models\Category;
use Illuminate\Support\Str;

#[Layout('layouts.admin')]
class ArticleCreate extends Component
{
    public $title = '';
    public $excerpt = '';
    public $content = '';
    public $category_id = '';
    public $status = 'approved';

    protected function rules()
    {
        return [
            'title' => 'required|min:10|max:255',
            'excerpt' => 'nullable|max:300',
            'content' => 'required|min:100|max:50000',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|in:pending,approved,rejected',
        ];
    }

    protected $messages = [
        'title.required' => 'Judul artikel wajib diisi.',
        'title.min' => 'Judul minimal 10 karakter.',
        'content.required' => 'Konten artikel wajib diisi.',
        'content.min' => 'Konten minimal 100 karakter.',
        'category_id.required' => 'Kategori wajib dipilih.',
    ];

    public function save()
    {
        $this->validate();

        Artikel::create([
            'category_id' => $this->category_id,
            'user_id' => auth()->id(),
            'title' => $this->title,
            'slug' => Str::slug($this->title),
            'excerpt' => $this->excerpt ?: Str::limit($this->content, 200),
            'content' => $this->content,
            'status' => $this->status,
            'views' => 0,
            'votes' => 0,
        ]);

        session()->flash('success', 'Artikel berhasil ditambahkan!');
        
        return redirect()->route('admin.articles');
    }

    public function render()
    {
        $categories = Category::all();
        return view('livewire.admin.article-create', compact('categories'));
    }
}