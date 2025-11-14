<div>
    <div class="mb-6">
        <div class="flex items-center gap-2 text-sm text-gray-600 mb-2">
            <a href="{{ route('user.dashboard') }}" class="hover:text-[var(--burgundy)]">Home</a>
            <span>›</span>
            <span class="text-[var(--burgundy)] font-semibold">Video</span>
            @if($currentCategory)
                <span>›</span>
                <span class="text-[var(--burgundy)] font-semibold">{{ $currentCategory->name }}</span>
            @endif
        </div>
        
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-2xl font-bold text-[var(--burgundy)]">
                    @if($currentCategory)
                        Video: {{ $currentCategory->name }}
                    @else
                        Koleksi Video Pembelajaran
                    @endif
                </h2>
                @if($currentCategory && $currentCategory->description)
                    <p class="text-sm text-gray-600 mt-1">{{ $currentCategory->description }}</p>
                @endif
            </div>
            
            <input 
                type="text" 
                wire:model.live="search"
                placeholder="Cari video..."
                class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--burgundy)]">
        </div>
    </div>

    <div class="mb-6 bg-white rounded-lg shadow p-4">
        <div class="flex items-center gap-2 mb-3">
            <span class="text-sm font-semibold text-gray-700">Filter Kategori:</span>
            @if($selectedCategory)
                <button 
                    wire:click="clearFilter"
                    class="text-xs bg-red-50 text-red-600 px-3 py-1 rounded-full font-semibold hover:bg-red-100">
                    ✕ Clear Filter
                </button>
            @endif
        </div>
        
        <div class="flex flex-wrap gap-2">
            <button 
                wire:click="clearFilter"
                class="px-4 py-2 rounded-lg text-sm font-semibold transition {{ !$selectedCategory ? 'bg-[var(--burgundy)] text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                Semua ({{ \App\Models\Video::approved()->count() }})
            </button>
            
            @foreach($categories as $category)
                <button 
                    wire:click="filterByCategory({{ $category->id }})"
                    class="px-4 py-2 rounded-lg text-sm font-semibold transition {{ $selectedCategory == $category->id ? 'bg-[var(--burgundy)] text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                    {{ $category->name }} ({{ $category->videos_count }})
                </button>
            @endforeach
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @forelse($videos as $video)
            <div class="bg-white shadow rounded-lg overflow-hidden hover:shadow-xl transition">
                <div class="relative">
                    <img src="{{ $video->thumbnail ?? 'https://placehold.co/400x200/912f56/ffffff?text=' . urlencode($video->title) }}" 
                         class="w-full h-48 object-cover">
                    <div class="absolute bottom-2 right-2 bg-black bg-opacity-75 text-white text-xs px-2 py-1 rounded">
                        {{ $video->duration }} menit
                    </div>
                </div>

                <div class="p-4">
                    <h3 class="font-bold text-[var(--burgundy)] mb-2 line-clamp-2">{{ $video->title }}</h3>
                    <p class="text-sm text-gray-600 mb-2 line-clamp-2">{{ Str::limit($video->description, 80) }}</p>
                    
                    <div class="flex items-center justify-between text-xs text-gray-500 mb-3">
                        <span class="bg-purple-100 text-purple-600 px-2 py-1 rounded">{{ $video->category->name }}</span>
                        <span class="flex items-center gap-1">
                            👁️ {{ number_format($video->views) }} views
                        </span>
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
                            wire:click="toggleFavorite({{ $video->id }})"
                            class="px-4 py-2 rounded-md text-sm border-2 transition {{ auth()->user()->hasFavorited($video) ? 'border-red-500 text-red-500 bg-red-50' : 'border-gray-300 text-gray-600 hover:border-red-300' }}">
                            {{ auth()->user()->hasFavorited($video) ? '❤️' : '🤍' }}
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-3 text-center py-12">
                <div class="text-6xl mb-4">📹</div>
                @if($selectedCategory)
                    <p class="text-gray-500 text-lg mb-4">Belum ada video untuk kategori "{{ $currentCategory->name }}"</p>
                    <button 
                        wire:click="clearFilter"
                        class="btn-main px-6 py-2 rounded-lg font-semibold">
                        Lihat Semua Video
                    </button>
                @else
                    <p class="text-gray-500 text-lg">Belum ada video tersedia</p>
                @endif
            </div>
        @endforelse
    </div>
</div>