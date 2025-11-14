<?php

namespace App\Livewire\Admin;

use App\Models\Artikel;
use App\Models\Category;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Component;

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
            'content' => 'required|min:100',
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
        'excerpt.max' => 'Ringkasan maksimal 300 karakter.', 
    ];

    public function save()
    {
        // Validate dulu
        $this->validate();

        try {
            // Generate slug unik
            $slug = Str::slug($this->title);
            $count = 1;
            $originalSlug = $slug;

            while (Artikel::where('slug', $slug)->exists()) {
                $slug = $originalSlug.'-'.$count;
                $count++;
            }

            // Create artikel
            $artikel = Artikel::create([
                'category_id' => $this->category_id,
                'user_id' => auth()->id(),
                'title' => $this->title,
                'slug' => $slug,
                'excerpt' => $this->excerpt ?: Str::limit(strip_tags($this->content), 200),
                'content' => $this->content,
                'status' => $this->status,
                'views' => 0,
                'votes' => 0,
            ]);

            session()->flash('success', '✅ Artikel "'.$artikel->title.'" berhasil ditambahkan!');

            return redirect()->route('admin.articles');

        } catch (\Exception $e) {
            session()->flash('error', '❌ Terjadi error: '.$e->getMessage());
            \Log::error('Article Create Error', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);
        }
    }

    public function render()
    {
        $categories = Category::all();

        return view('livewire.admin.article-create', compact('categories'));
    }
}
