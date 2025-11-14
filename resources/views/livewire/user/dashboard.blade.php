<div>
    <div class="bg-[var(--burgundy)] rounded-2xl p-8 text-white mb-6 shadow-lg">
        <h1 class="text-3xl font-bold mb-2">Selamat Datang, {{ auth()->user()->name }}! 👋</h1>
        <p class="text-white text-opacity-90">Jelajahi konten terbaru dan populer hari ini</p>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-10">
        <div class="bg-white rounded-xl p-4 text-center shadow hover:shadow-lg transition">
            <div class="text-2xl font-bold text-[var(--burgundy)]">{{ number_format($stats['total_videos']) }}</div>
            <div class="text-xs text-gray-600">Video Tersedia</div>
        </div>
        <div class="bg-white rounded-xl p-4 text-center shadow hover:shadow-lg transition">
            <div class="text-2xl font-bold text-[var(--burgundy)]">{{ number_format($stats['total_articles']) }}</div>
            <div class="text-xs text-gray-600">Artikel Tersedia</div>
        </div>
        <div class="bg-white rounded-xl p-4 text-center shadow hover:shadow-lg transition">
            <div class="text-2xl font-bold text-[var(--burgundy)]">{{ number_format($stats['total_users']) }}</div>
            <div class="text-xs text-gray-600">Pengguna Aktif</div>
        </div>
        <div class="bg-white rounded-xl p-4 text-center shadow hover:shadow-lg transition">
            <div class="text-2xl font-bold text-[var(--burgundy)]">{{ $stats['platform_rating'] }}</div>
            <div class="text-xs text-gray-600">Rating Platform</div>
        </div>
    </div>

    <div class="mb-10">
        <h3 class="text-lg font-bold text-[var(--burgundy)] mb-4">📚 Kategori Populer</h3>
        
        <div class="grid grid-cols-2 md:grid-cols-5 gap-3">
            @forelse($categories as $category)
                <button 
                    wire:click="filterByCategory({{ $category->id }})"
                    class="bg-white border-2 border-[var(--burgundy)] text-[var(--burgundy)] p-4 rounded-xl text-center font-bold text-sm hover:bg-[var(--burgundy)] hover:text-white transition cursor-pointer group">
                    <div class="mb-2">{{ $category->name }}</div>
                    <div class="text-xs text-gray-500 group-hover:text-white">
                        📹 {{ $category->videos_count }} video
                        <br>
                        📝 {{ $category->artikels_count }} artikel
                    </div>
                </button>
            @empty
                <div class="col-span-5 text-center text-gray-500 py-8">Belum ada kategori</div>
            @endforelse
        </div>
    </div>

    <div class="mb-10">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-bold text-[var(--burgundy)]">📹 Video Terpopuler</h3>
            <a href="{{ route('user.video') }}" class="text-sm text-[var(--burgundy)] font-semibold hover:underline">
                Lihat Semua →
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @forelse($popularVideos->take(6) as $video)
                <div class="bg-white shadow rounded-lg overflow-hidden hover:shadow-xl transition group">
                    <div class="relative">
                        <img src="{{ $video->thumbnail ?? 'https://placehold.co/400x225/912f56/ffffff?text=' . urlencode($video->title) }}" 
                             class="w-full h-48 object-cover group-hover:scale-105 transition">
                        <div class="absolute bottom-2 right-2 bg-black bg-opacity-75 text-white text-xs px-2 py-1 rounded">
                            {{ $video->duration }} menit
                        </div>
                    </div>

                    <div class="p-4">
                        <span class="text-xs bg-purple-100 text-purple-600 px-2 py-1 rounded">{{ $video->category->name }}</span>
                        <h3 class="font-bold text-[var(--burgundy)] mt-2 mb-2 line-clamp-2">{{ $video->title }}</h3>
                        <p class="text-sm text-gray-600 mb-3 line-clamp-2">{{ Str::limit($video->description, 80) }}</p>
                        
                        <div class="flex items-center justify-between text-xs text-gray-500 mb-3">
                            <span>👁️ {{ number_format($video->views) }} views</span>
                        </div>
                        
                        <div class="flex gap-2">
                            <a 
                                href="{{ $video->video_url }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="btn-main px-4 py-2 rounded-md text-sm flex-1 text-center hover:shadow-lg transition">
                                ▶️ Tonton
                            </a>
                            <button 
                                wire:click="toggleFavoriteVideo({{ $video->id }})"
                                class="px-4 py-2 rounded-md text-sm border-2 transition {{ auth()->user()->hasFavorited($video) ? 'border-red-500 text-red-500 bg-red-50' : 'border-gray-300 text-gray-600 hover:border-red-300' }}">
                                {{ auth()->user()->hasFavorited($video) ? '❤️' : '🤍' }}
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-8 text-gray-500">Belum ada video</div>
            @endforelse
        </div>
    </div>

    <div>
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-bold text-[var(--burgundy)]">📝 Artikel Terbaru</h3>
            <a href="{{ route('user.artikel') }}" class="text-sm text-[var(--burgundy)] font-semibold hover:underline">
                Lihat Semua →
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @forelse(\App\Models\Artikel::approved()->with(['user', 'category'])->latest()->limit(4)->get() as $artikel)
                <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
                    <div class="flex justify-between items-start">
                        <div class="flex-1">
                            <span class="inline-block text-xs bg-green-100 text-green-600 px-2 py-1 rounded mb-2">
                                {{ $artikel->category->name }}
                            </span>
                            
                            <h3 class="font-bold text-[var(--burgundy)] mb-2">{{ $artikel->title }}</h3>
                            <p class="text-sm text-gray-600 mb-3 line-clamp-3">{{ $artikel->excerpt ?? Str::limit($artikel->content, 150) }}</p>
                            
                            <div class="flex items-center gap-4 text-xs text-gray-500 mb-3">
                                <span>✍️ {{ $artikel->user->name }}</span>
                                <span>👁️ {{ number_format($artikel->views) }} views</span>
                                <span>⭐ {{ number_format($artikel->votes) }} votes</span>
                            </div>
                            
                            <a 
                                href="{{ route('user.artikel.show', $artikel->id) }}"
                                class="text-[var(--burgundy)] text-sm font-semibold hover:underline">
                                Baca Selengkapnya →
                            </a>
                        </div>

                        <button 
                            wire:click="toggleFavoriteArtikel({{ $artikel->id }})"
                            class="ml-4 text-xl {{ auth()->user()->hasFavorited($artikel) ? 'text-red-500' : 'text-gray-400 hover:text-red-300' }}">
                            {{ auth()->user()->hasFavorited($artikel) ? '❤️' : '🤍' }}
                        </button>
                    </div>
                </div>
            @empty
                <div class="col-span-2 text-center py-8 text-gray-500">Belum ada artikel</div>
            @endforelse
        </div>
    </div>
</div>