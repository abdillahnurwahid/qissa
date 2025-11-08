<div class="mt-8">
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-xl font-bold text-[var(--burgundy)]">
            💬 Komentar ({{ $comments->count() }})
        </h3>
    </div>

    @if (session()->has('comment_success'))
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-4">
            {{ session('comment_success') }}
        </div>
    @endif

    @if (session()->has('comment_error'))
        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-4">
            {{ session('comment_error') }}
        </div>
    @endif

    <div class="bg-white rounded-lg shadow p-6 mb-6">
        @auth
            <form wire:submit="postComment">
                @if($replyingTo)
                    <div class="bg-blue-50 border border-blue-200 text-blue-700 px-4 py-2 rounded-lg mb-3 flex justify-between items-center">
                        <span class="text-sm">💬 Membalas komentar...</span>
                        <button 
                            type="button"
                            wire:click="cancelReply"
                            class="text-xs text-blue-600 hover:text-blue-800 font-semibold">
                            ✕ Batal
                        </button>
                    </div>
                @endif

                <div class="flex gap-3">
                    <div class="flex-shrink-0">
                        <div class="w-10 h-10 bg-[var(--burgundy)] rounded-full flex items-center justify-center text-white font-bold">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                    </div>

                    <div class="flex-1">
                        <textarea 
                            wire:model="content"
                            rows="3"
                            placeholder="Tulis komentar..."
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--burgundy)] @error('content') border-red-500 @enderror"></textarea>
                        
                        @error('content') 
                            <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                        @enderror

                        <div class="flex justify-end mt-2">
                            <button 
                                type="submit"
                                class="btn-main px-4 py-2 rounded-lg text-sm font-semibold"
                                wire:loading.attr="disabled">
                                <span wire:loading.remove>Kirim Komentar</span>
                                <span wire:loading>Mengirim...</span>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        @else
            <div class="text-center py-4">
                <p class="text-gray-600 mb-3">Silakan login untuk berkomentar</p>
                <a href="{{ route('login') }}" class="btn-main px-6 py-2 rounded-lg text-sm font-semibold inline-block">
                    Login
                </a>
            </div>
        @endauth
    </div>

    <div class="space-y-4">
        @forelse($comments as $comment)
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex justify-between items-start mb-3">
                    <div class="flex gap-3">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 bg-[var(--burgundy)] rounded-full flex items-center justify-center text-white font-bold">
                                {{ strtoupper(substr($comment->user->name, 0, 1)) }}
                            </div>
                        </div>

                        <div>
                            <div class="flex items-center gap-2">
                                <span class="font-bold text-gray-800">{{ $comment->user->name }}</span>
                                @if($comment->user->isAdmin())
                                    <span class="text-xs bg-purple-100 text-purple-600 px-2 py-0.5 rounded">Admin</span>
                                @endif
                            </div>
                            <span class="text-xs text-gray-500">{{ $comment->created_at->diffForHumans() }}</span>
                        </div>
                    </div>

                    @auth
                        @if($comment->isOwnedBy(auth()->user()) || auth()->user()->isAdmin())
                            <button 
                                wire:click="deleteComment({{ $comment->id }})"
                                wire:confirm="Yakin ingin menghapus komentar ini?"
                                class="text-xs text-red-600 hover:text-red-800 font-semibold">
                                🗑️ Hapus
                            </button>
                        @endif
                    @endauth
                </div>

                <div class="ml-13 text-gray-700 whitespace-pre-line">
                    {{ $comment->content }}
                </div>

                @auth
                    <div class="ml-13 mt-3">
                        <button 
                            wire:click="setReplyingTo({{ $comment->id }})"
                            class="text-xs text-[var(--burgundy)] font-semibold hover:underline">
                            💬 Balas
                        </button>
                    </div>
                @endauth

                @if($comment->replies->count() > 0)
                    <div class="ml-13 mt-4 space-y-3 border-l-2 border-gray-200 pl-4">
                        @foreach($comment->replies as $reply)
                            <div class="bg-gray-50 rounded-lg p-4">
                                <div class="flex justify-between items-start mb-2">
                                    <div class="flex gap-2">
                                        <div class="w-8 h-8 bg-[var(--burgundy)] rounded-full flex items-center justify-center text-white text-xs font-bold">
                                            {{ strtoupper(substr($reply->user->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <div class="flex items-center gap-2">
                                                <span class="font-semibold text-sm text-gray-800">{{ $reply->user->name }}</span>
                                                @if($reply->user->isAdmin())
                                                    <span class="text-xs bg-purple-100 text-purple-600 px-2 py-0.5 rounded">Admin</span>
                                                @endif
                                            </div>
                                            <span class="text-xs text-gray-500">{{ $reply->created_at->diffForHumans() }}</span>
                                        </div>
                                    </div>

                                    @auth
                                        @if($reply->isOwnedBy(auth()->user()) || auth()->user()->isAdmin())
                                            <button 
                                                wire:click="deleteComment({{ $reply->id }})"
                                                wire:confirm="Yakin ingin menghapus balasan ini?"
                                                class="text-xs text-red-600 hover:text-red-800">
                                                🗑️
                                            </button>
                                        @endif
                                    @endauth
                                </div>

                                <div class="text-sm text-gray-700 whitespace-pre-line ml-10">
                                    {{ $reply->content }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        @empty
            <div class="bg-white rounded-lg shadow p-12 text-center">
                <div class="text-6xl mb-4">💬</div>
                <p class="text-gray-500 text-lg">Belum ada komentar</p>
                <p class="text-gray-400 text-sm mt-2">Jadilah yang pertama berkomentar!</p>
            </div>
        @endforelse
    </div>
</div>