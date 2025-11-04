<div>
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-[var(--burgundy)]">Koleksi Video Pembelajaran</h2>
        
        <!-- Search -->
        <input 
            type="text" 
            wire:model.live="search"
            placeholder="Cari video..."
            class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--burgundy)]">
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @forelse($videos as $video)
            <div class="bg-white shadow rounded-lg overflow-hidden hover:shadow-xl transition">
                <!-- Thumbnail -->
                <div class="relative">
                    <img src="{{ $video->thumbnail ?? 'https://placehold.co/400x200/912f56/ffffff?text=' . urlencode($video->title) }}" 
                         class="w-full h-48 object-cover">
                    
                    <!-- Duration Badge -->
                    <div class="absolute bottom-2 right-2 bg-black bg-opacity-75 text-white text-xs px-2 py-1 rounded">
                        {{ $video->duration }} menit
                    </div>
                </div>

                <div class="p-4">
                    <!-- Title -->
                    <h3 class="font-bold text-[var(--burgundy)] mb-2 line-clamp-2">{{ $video->title }}</h3>
                    
                    <!-- Description -->
                    <p class="text-sm text-gray-600 mb-2 line-clamp-2">{{ Str::limit($video->description, 80) }}</p>
                    
                    <!-- Category & Views -->
                    <div class="flex items-center justify-between text-xs text-gray-500 mb-3">
                        <span class="bg-purple-100 text-purple-600 px-2 py-1 rounded">{{ $video->category->name }}</span>
                        <span class="flex items-center gap-1">
                            👁️ {{ number_format($video->views) }} views
                        </span>
                    </div>
                    
                    <!-- Actions -->
                    <div class="flex gap-2">
                        <!-- PENTING: wire:click untuk call method watchVideo() -->
                        <button 
                            wire:click="watchVideo({{ $video->id }})"
                            class="btn-main px-4 py-2 rounded-md text-sm flex-1 hover:shadow-lg transition">
                            ▶️ Tonton
                        </button>
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
                <p class="text-gray-500 text-lg">Belum ada video tersedia</p>
                @if($search)
                    <p class="text-gray-400 text-sm mt-2">Cari dengan kata kunci lain</p>
                @endif
            </div>
        @endforelse
    </div>
</div>