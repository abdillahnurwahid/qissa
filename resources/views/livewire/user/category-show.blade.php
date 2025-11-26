{{-- resources/views/livewire/user/category-show.blade.php --}}
<div>
    <div class="flex items-center gap-2 text-sm text-gray-600 mb-6">
        <a href="{{ route('user.dashboard') }}" class="hover:text-[var(--burgundy)]">Home</a>
        <span>›</span>
        <span class="text-[var(--burgundy)] font-semibold">{{ $category->name }}</span>
    </div>

    <div class="bg-[var(--burgundy)] rounded-2xl p-8 text-white mb-6 shadow-lg">
        <h1 class="text-3xl font-bold mb-2">{{ $category->name }}</h1>
        @if($category->description)
            <p class="text-white text-opacity-90">{{ $category->description }}</p>
        @endif
    </div>

    <div class="bg-white rounded-lg shadow mb-6">
        <div class="flex border-b">
            <button 
                wire:click="switchTab('videos')"
                class="flex-1 px-6 py-4 font-semibold transition {{ $activeTab === 'videos' ? 'text-[var(--burgundy)] border-b-2 border-[var(--burgundy)]' : 'text-gray-600 hover:text-[var(--burgundy)]' }}">
                📹 Video ({{ $category->videos->count() }})
            </button>
            <button 
                wire:click="switchTab('artikels')"
                class="flex-1 px-6 py-4 font-semibold transition {{ $activeTab === 'artikels' ? 'text-[var(--burgundy)] border-b-2 border-[var(--burgundy)]' : 'text-gray-600 hover:text-[var(--burgundy)]' }}">
                📝 Artikel ({{ $category->artikels->count() }})
            </button>
        </div>
    </div>

    @if($activeTab === 'videos')
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @forelse($category->videos as $video)
                <div class="bg-white shadow rounded-lg overflow-hidden hover:shadow-xl transition">
                    <div class="relative">
                        <img src="{{ $video->thumbnail ?? 'https://placehold.co/400x200/912f56/ffffff?text=' . urlencode($video->title) }}" 
                             class="w-full h-48 object-cover">
                        <div class="absolute bottom-2 right-2 bg-black bg-opacity-75 text-white text-xs px-2 py-1 rounded">
                            {{ $video->duration }} menit
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="font-bold text-[var(--burgundy)] mb-2">{{ $video->title }}</h3>
                        <p class="text-sm text-gray-600 mb-3">{{ Str::limit($video->description, 80) }}</p>
                        <div class="flex items-center justify-between text-xs text-gray-500 mb-3">
                            <span>👁️ {{ number_format($video->views) }} views</span>
                        </div>
                        <div class="flex gap-2">
                        <a 
                            href="{{ $video->video_url }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="btn-main px-4 py-2 rounded-md text-sm flex-1 text-center inline-block">
                            ▶️ Tonton
                        </a>                            
                        <button 
                                wire:click="toggleFavoriteVideo({{ $video->id }})"
                                class="px-4 py-2 rounded-md text-sm border-2 {{ auth()->user()->hasFavorited($video) ? 'border-red-500 text-red-500' : 'border-gray-300 text-gray-600' }}">
                                {{ auth()->user()->hasFavorited($video) ? '❤️' : '🤍' }}
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-12">
                    <div class="text-6xl mb-4">📹</div>
                    <p class="text-gray-500 text-lg">Belum ada video untuk kategori ini</p>
                </div>
            @endforelse
        </div>
    @else
        <div class="space-y-4">
            @forelse($category->artikels as $artikel)
                <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
                    <div class="flex justify-between items-start">
                        <div class="flex-1">
                            <h3 class="font-bold text-[var(--burgundy)] mb-2">{{ $artikel->title }}</h3>
                            <p class="text-sm text-gray-600 mb-3">{{ $artikel->excerpt ?? Str::limit($artikel->content, 150) }}</p>
                            <div class="flex items-center gap-4 text-xs text-gray-500 mb-3">
                                <span>✍️ {{ $artikel->user->name }}</span>
                                <span>👁️ {{ number_format($artikel->views) }} views</span>
                                <span>⭐ {{ number_format($artikel->votes) }} votes</span>
                            </div>
                            <button 
                                wire:click="readArtikel({{ $artikel->id }})"
                                class="text-[var(--burgundy)] text-sm font-semibold hover:underline">
                                Baca Selengkapnya →
                            </button>
                        </div>
                        <button 
                            wire:click="toggleFavoriteArtikel({{ $artikel->id }})"
                            class="ml-4 text-xl {{ auth()->user()->hasFavorited($artikel) ? 'text-red-500' : 'text-gray-400' }}">
                            {{ auth()->user()->hasFavorited($artikel) ? '❤️' : '🤍' }}
                        </button>
                    </div>
                </div>
            @empty
                <div class="text-center py-12">
                    <div class="text-6xl mb-4">📝</div>
                    <p class="text-gray-500 text-lg">Belum ada artikel untuk kategori ini</p>
                </div>
            @endforelse
        </div>
    @endif
</div>