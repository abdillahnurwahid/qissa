<div>
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-[var(--burgundy)]">Artikel Terbaru</h2>
        
        <!-- Search -->
        <input 
            type="text" 
            wire:model.live="search"
            placeholder="Cari artikel..."
            class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--burgundy)]">
    </div>

    <div class="space-y-4">
        @forelse($artikels as $artikel)
            <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
                <div class="flex justify-between items-start mb-2">
                    <div class="flex-1">
                        <!-- Category Badge -->
                        <span class="inline-block text-xs bg-green-100 text-green-600 px-2 py-1 rounded mb-2">
                            {{ $artikel->category->name }}
                        </span>
                        
                        <!-- Title -->
                        <h3 class="font-bold text-[var(--burgundy)] mb-2">{{ $artikel->title }}</h3>
                        
                        <!-- Excerpt -->
                        <p class="text-sm text-gray-600 mb-3">{{ $artikel->excerpt ?? Str::limit($artikel->content, 150) }}</p>
                        
                        <!-- Meta Info -->
                        <div class="flex items-center gap-4 text-xs text-gray-500 mb-3">
                            <span>✍️ {{ $artikel->user->name }}</span>
                            <span>📅 {{ $artikel->created_at->diffForHumans() }}</span>
                            <span>👁️ {{ number_format($artikel->views) }} views</span>
                            <span>⭐ {{ number_format($artikel->votes) }} votes</span>
                        </div>
                        
                        <!-- Actions -->
                        <div class="flex gap-2">
                            <!-- PENTING: wire:click untuk call method readArtikel() -->
                            <button 
                                wire:click="readArtikel({{ $artikel->id }})"
                                class="text-[var(--burgundy)] text-sm font-semibold hover:underline">
                                Baca Selengkapnya →
                            </button>
                        </div>
                    </div>

                    <!-- Favorite Button -->
                    <button 
                        wire:click="toggleFavorite({{ $artikel->id }})"
                        class="ml-4 px-3 py-1 rounded text-xl transition {{ auth()->user()->hasFavorited($artikel) ? 'text-red-500' : 'text-gray-400 hover:text-red-300' }}">
                        {{ auth()->user()->hasFavorited($artikel) ? '❤️' : '🤍' }}
                    </button>
                </div>
            </div>
        @empty
            <div class="text-center py-12">
                <div class="text-6xl mb-4">📝</div>
                <p class="text-gray-500 text-lg">Belum ada artikel tersedia</p>
                @if($search)
                    <p class="text-gray-400 text-sm mt-2">Cari dengan kata kunci lain</p>
                @endif
            </div>
        @endforelse
    </div>
</div>
