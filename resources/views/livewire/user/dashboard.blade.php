<div>
    <!-- Welcome Banner -->
    <div class="bg-[var(--burgundy)] rounded-2xl p-8 text-white mb-6 shadow-lg">
        <h1 class="text-3xl font-bold mb-2">Selamat Datang di Qissa+</h1>
        <p class="text-white text-opacity-90 mb-4">Platform pembelajaran video dan artikel terbaik</p>
        <p class="text-sm">Halo, <span class="font-semibold">{{ auth()->user()->name }}</span>! 👋</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-10">
        <div class="bg-white rounded-xl p-4 text-center shadow">
            <div class="text-2xl font-bold text-[var(--burgundy)]">{{ number_format($stats['total_videos']) }}</div>
            <div class="text-xs text-gray-600">Video Tersedia</div>
        </div>
        <div class="bg-white rounded-xl p-4 text-center shadow">
            <div class="text-2xl font-bold text-[var(--burgundy)]">{{ number_format($stats['total_articles']) }}</div>
            <div class="text-xs text-gray-600">Artikel Tersedia</div>
        </div>
        <div class="bg-white rounded-xl p-4 text-center shadow">
            <div class="text-2xl font-bold text-[var(--burgundy)]">{{ number_format($stats['total_users']) }}</div>
            <div class="text-xs text-gray-600">Pengguna Aktif</div>
        </div>
        <div class="bg-white rounded-xl p-4 text-center shadow">
            <div class="text-2xl font-bold text-[var(--burgundy)]">{{ $stats['platform_rating'] }}</div>
            <div class="text-xs text-gray-600">Rating Platform</div>
        </div>
    </div>

    <!-- Popular Categories -->
    <div>
        <h3 class="text-lg font-bold text-[var(--burgundy)] mb-3">Kategori Populer</h3>
        <p class="text-sm text-gray-600 mb-4">Klik kategori untuk melihat video & artikel terkait</p>
        
        <div class="grid grid-cols-2 md:grid-cols-5 gap-3">
            @forelse($categories as $category)
                <button 
                    wire:click="filterByCategory({{ $category->id }}, 'video')"
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
</div>