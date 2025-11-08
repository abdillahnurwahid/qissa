<?php

namespace App\Livewire;

use App\Models\Comment;
use Livewire\Component;

class CommentSection extends Component
{
    public $commentable;
    public $commentableType;
    
    public $content = '';
    public $replyingTo = null;

    protected $rules = [
        'content' => 'required|min:3|max:1000',
    ];

    protected $messages = [
        'content.required' => 'Komentar tidak boleh kosong.',
        'content.min' => 'Komentar minimal 3 karakter.',
        'content.max' => 'Komentar maksimal 1000 karakter.',
    ];

    public function mount($commentable, $commentableType)
    {
        $this->commentable = $commentable;
        $this->commentableType = $commentableType;
    }

    public function postComment()
    {
        $this->validate();

        Comment::create([
            'user_id' => auth()->id(),
            'commentable_id' => $this->commentable->id,
            'commentable_type' => $this->commentableType,
            'content' => $this->content,
            'parent_id' => $this->replyingTo,
        ]);

        $this->reset(['content', 'replyingTo']);
        
        session()->flash('comment_success', 'Komentar berhasil ditambahkan!');
    }

    public function deleteComment($commentId)
    {
        $comment = Comment::findOrFail($commentId);

        if ($comment->isOwnedBy(auth()->user()) || auth()->user()->isAdmin()) {
            $comment->delete();
            session()->flash('comment_success', 'Komentar berhasil dihapus!');
        } else {
            session()->flash('comment_error', 'Tidak bisa menghapus komentar orang lain!');
        }
    }

    public function setReplyingTo($commentId)
    {
        $this->replyingTo = $commentId;
    }

    public function cancelReply()
    {
        $this->replyingTo = null;
    }

    public function render()
    {
        $comments = Comment::where('commentable_id', $this->commentable->id)
            ->where('commentable_type', $this->commentableType)
            ->topLevel()
            ->with(['user', 'replies.user'])
            ->latest()
            ->get();

        return view('livewire.comment-section', compact('comments'));
    }
}
