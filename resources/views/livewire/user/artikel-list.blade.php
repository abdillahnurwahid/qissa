<div>
    <!-- Breadcrumb & Title -->
    <div class="mb-6">
        <div class="flex items-center gap-2 text-sm text-gray-600 mb-2">
            <a href="{{ route('user.dashboard') }}" class="hover:text-[var(--burgundy)]">Home</a>
            <span>›</span>
            <span class="text-[var(--burgundy)] font-semibold">Artikel</span>
            @if($currentCategory)
                <span>›</span>
                <span class="text-[var(--burgundy)] font-semibold">{{ $currentCategory->name }}</span>
            @endif
        </div>
        
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-2xl font-bold text-[var(--burgundy)]">
                    @if($currentCategory)
                        Artikel: {{ $currentCategory->name }}
                    @else
                        Artikel Terbaru
                    @endif
                </h2>
                @if($currentCategory && $currentCategory->description)
                    <p class="text-sm text-gray-600 mt-1">{{ $currentCategory->description }}</p>
                @endif
            </div>
            
            <!-- Search -->
            <input 
                type="text" 
                wire:model.live="search"
                placeholder="Cari artikel..."
                class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--burgundy)]">
        </div>
    </div>

    <!-- Category Filter -->
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
                Semua ({{ \App\Models\Artikel::approved()->count() }})
            </button>
            
            @foreach($categories as $category)
                <button 
                    wire:click="filterByCategory({{ $category->id }})"
                    class="px-4 py-2 rounded-lg text-sm font-semibold transition {{ $selectedCategory == $category->id ? 'bg-[var(--burgundy)] text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                    {{ $category->name }} ({{ $category->artikels_count }})
                </button>
            @endforeach
        </div>
    </div>

    <!-- Artikel List -->
    <div class="space-y-4">
        @forelse($artikels as $artikel)
            <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
                <div class="flex justify-between items-start mb-2">
                    <div class="flex-1">
                        <span class="inline-block text-xs bg-green-100 text-green-600 px-2 py-1 rounded mb-2">
                            {{ $artikel->category->name }}
                        </span>
                        
                        <h3 class="font-bold text-[var(--burgundy)] mb-2">{{ $artikel->title }}</h3>
                        <p class="text-sm text-gray-600 mb-3">{{ $artikel->excerpt ?? Str::limit($artikel->content, 150) }}</p>
                        
                        <div class="flex items-center gap-4 text-xs text-gray-500 mb-3">
                            <span>✍️ {{ $artikel->user->name }}</span>
                            <span>📅 {{ $artikel->created_at->diffForHumans() }}</span>
                            <span>👁️ {{ number_format($artikel->views) }} views</span>
                            <span>⭐ {{ number_format($artikel->votes) }} votes</span>
                        </div>
                        
                        <div class="flex gap-2">
                            <button 
                                wire:click="readArtikel({{ $artikel->id }})"
                                class="text-[var(--burgundy)] text-sm font-semibold hover:underline">
                                Baca Selengkapnya →
                            </button>
                        </div>
                    </div>

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
                @if($selectedCategory)
                    <p class="text-gray-500 text-lg mb-4">Belum ada artikel untuk kategori "{{ $currentCategory->name }}"</p>
                    <button 
                        wire:click="clearFilter"
                        class="btn-main px-6 py-2 rounded-lg font-semibold">
                        Lihat Semua Artikel
                    </button>
                @else
                    <p class="text-gray-500 text-lg">Belum ada artikel tersedia</p>
                @endif
            </div>
        @endforelse
    </div>
</div>