<div>
    <!-- Navbar untuk Guest -->
    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-[var(--burgundy)] rounded-lg flex items-center justify-center">
                    <span class="text-white font-bold text-lg">Q+</span>
                </div>
                <span class="text-2xl font-bold text-[var(--burgundy)]">Qissa+</span>
            </div>
            
            <div class="flex gap-3">
                <a href="{{ route('login') }}" class="px-6 py-2 border-2 border-[var(--burgundy)] text-[var(--burgundy)] rounded-lg font-semibold hover:bg-[var(--burgundy)] hover:text-white transition">
                    Masuk
                </a>
                <a href="{{ route('register') }}" class="btn-main px-6 py-2 rounded-lg font-semibold shadow hover:shadow-lg transition">
                    Daftar Gratis
                </a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="brand-gradient text-white py-20">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <h1 class="text-5xl font-bold mb-4">Belajar Sejarah Islam</h1>
            <p class="text-xl mb-8 text-white text-opacity-90">
                Platform video dan artikel terbaik untuk memahami kisah-kisah inspiratif dalam Islam
            </p>
            
            <div class="flex flex-wrap justify-center gap-4 mb-12">
                <div class="bg-white bg-opacity-20 rounded-xl px-6 py-4 backdrop-blur">
                    <div class="text-3xl font-bold">{{ number_format($stats['total_videos']) }}+</div>
                    <div class="text-sm">Video Pembelajaran</div>
                </div>
                <div class="bg-white bg-opacity-20 rounded-xl px-6 py-4 backdrop-blur">
                    <div class="text-3xl font-bold">{{ number_format($stats['total_articles']) }}+</div>
                    <div class="text-sm">Artikel Inspiratif</div>
                </div>
                <div class="bg-white bg-opacity-20 rounded-xl px-6 py-4 backdrop-blur">
                    <div class="text-3xl font-bold">{{ $stats['total_categories'] }}+</div>
                    <div class="text-sm">Kategori</div>
                </div>
            </div>

            <a href="{{ route('register') }}" class="inline-block bg-white text-[var(--burgundy)] px-8 py-4 rounded-lg font-bold text-lg shadow-xl hover:shadow-2xl transition transform hover:scale-105">
                🚀 Mulai Belajar Gratis
            </a>
        </div>
    </div>

    <!-- Categories Section -->
    <div class="max-w-7xl mx-auto px-6 py-16">
        <h2 class="text-3xl font-bold text-[var(--burgundy)] mb-8 text-center">Kategori Populer</h2>
        
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            @foreach($categories as $category)
                <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition text-center">
                    <div class="text-3xl mb-3">📚</div>
                    <h3 class="font-bold text-[var(--burgundy)] mb-2">{{ $category->name }}</h3>
                    <p class="text-xs text-gray-600">
                        {{ $category->videos_count + $category->artikels_count }} konten
                    </p>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Popular Videos Section -->
    <div class="max-w-7xl mx-auto px-6 py-12">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-3xl font-bold text-[var(--burgundy)]">📹 Video Terpopuler</h2>
            <a href="{{ route('login') }}" class="text-[var(--burgundy)] font-semibold hover:underline">
                Lihat Semua →
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($popularVideos as $video)
                <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition group">
                    <div class="relative">
                        <img src="{{ $video->thumbnail ?? 'https://placehold.co/400x225/912f56/ffffff?text=' . urlencode($video->title) }}" 
                             class="w-full h-48 object-cover group-hover:scale-105 transition duration-300">
                        <div class="absolute inset-0 bg-black bg-opacity-40 opacity-0 group-hover:opacity-100 transition flex items-center justify-center">
                            <a href="{{ route('login') }}" class="bg-white text-[var(--burgundy)] px-6 py-3 rounded-full font-bold">
                                🔒 Login untuk Menonton
                            </a>
                        </div>
                        <div class="absolute bottom-2 right-2 bg-black bg-opacity-75 text-white text-xs px-2 py-1 rounded">
                            {{ $video->duration }} menit
                        </div>
                    </div>
                    <div class="p-4">
                        <span class="text-xs bg-purple-100 text-purple-600 px-2 py-1 rounded">{{ $video->category->name }}</span>
                        <h3 class="font-bold text-[var(--burgundy)] mt-2 mb-2 line-clamp-2">{{ $video->title }}</h3>
                        <p class="text-sm text-gray-600 mb-2 line-clamp-2">{{ Str::limit($video->description, 80) }}</p>
                        <div class="flex items-center justify-between text-xs text-gray-500">
                            <span>👁️ {{ number_format($video->views) }} views</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Popular Articles Section -->
    <div class="bg-white py-12">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-3xl font-bold text-[var(--burgundy)]">📝 Artikel Terpopuler</h2>
                <a href="{{ route('login') }}" class="text-[var(--burgundy)] font-semibold hover:underline">
                    Lihat Semua →
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($popularArtikels as $artikel)
                    <div class="bg-gray-50 rounded-lg p-6 shadow hover:shadow-lg transition">
                        <span class="text-xs bg-green-100 text-green-600 px-2 py-1 rounded">{{ $artikel->category->name }}</span>
                        <h3 class="font-bold text-[var(--burgundy)] text-lg mt-3 mb-2">{{ $artikel->title }}</h3>
                        <p class="text-sm text-gray-600 mb-3 line-clamp-3">{{ $artikel->excerpt ?? Str::limit($artikel->content, 150) }}</p>
                        
                        <div class="flex items-center justify-between text-xs text-gray-500 mb-3">
                            <span>✍️ {{ $artikel->user->name }}</span>
                            <span>👁️ {{ number_format($artikel->views) }} views</span>
                        </div>

                        <a href="{{ route('login') }}" class="text-[var(--burgundy)] text-sm font-semibold hover:underline">
                            🔒 Login untuk Membaca →
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="brand-gradient text-white py-20">
        <div class="max-w-4xl mx-auto px-6 text-center">
            <h2 class="text-4xl font-bold mb-4">Siap Memulai Perjalanan Belajar?</h2>
            <p class="text-xl mb-8 text-white text-opacity-90">
                Bergabunglah dengan ribuan pengguna yang telah belajar di Qissa+
            </p>
            <div class="flex flex-wrap justify-center gap-4">
                <a href="{{ route('register') }}" class="bg-white text-[var(--burgundy)] px-8 py-4 rounded-lg font-bold text-lg shadow-xl hover:shadow-2xl transition">
                    Daftar Sekarang
                </a>
                <a href="{{ route('login') }}" class="border-2 border-white text-white px-8 py-4 rounded-lg font-bold text-lg hover:bg-white hover:text-[var(--burgundy)] transition">
                    Sudah Punya Akun
                </a>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="bg-gray-900 text-white py-8">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <div class="flex items-center justify-center gap-2 mb-4">
                <div class="w-8 h-8 bg-[var(--burgundy)] rounded-lg flex items-center justify-center">
                    <span class="text-white font-bold">Q+</span>
                </div>
                <span class="text-xl font-bold">Qissa+</span>
            </div>
            <p class="text-gray-400 text-sm">© 2025 Qissa+. Platform Pembelajaran Islami Terbaik</p>
        </div>
    </div>
</div>