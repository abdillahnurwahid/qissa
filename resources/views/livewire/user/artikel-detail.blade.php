<div>
    <!-- Back Button -->
    <div class="mb-6">
        <a href="{{ route('user.artikel') }}" class="text-[var(--burgundy)] text-sm font-semibold hover:underline">
            ← Kembali ke Artikel
        </a>
    </div>

    <!-- Article Header -->
    <div class="bg-white rounded-lg shadow-lg p-8 mb-6">
        <!-- Category Badge -->
        <span class="inline-block text-xs bg-green-100 text-green-600 px-3 py-1 rounded mb-3">
            {{ $artikel->category->name }}
        </span>

        <!-- Title -->
        <h1 class="text-3xl font-bold text-[var(--burgundy)] mb-4">{{ $artikel->title }}</h1>

        <!-- Meta Info -->
        <div class="flex items-center gap-6 text-sm text-gray-500 mb-4 pb-4 border-b">
            <span class="flex items-center gap-1">
                ✍️ {{ $artikel->user->name }}
            </span>
            <span class="flex items-center gap-1">
                📅 {{ $artikel->created_at->format('d M Y') }}
            </span>
            <span class="flex items-center gap-1">
                👁️ {{ number_format($artikel->views) }} views
            </span>
            <span class="flex items-center gap-1">
                ⭐ {{ number_format($artikel->votes) }} votes
            </span>
        </div>

        <!-- Favorite & Share Actions -->
        <div class="flex gap-3 mb-6">
            <button 
                wire:click="toggleFavorite"
                class="px-4 py-2 rounded-lg text-sm font-semibold transition {{ auth()->user()->hasFavorited($artikel) ? 'bg-red-50 text-red-500 border-2 border-red-500' : 'bg-gray-50 text-gray-600 border-2 border-gray-300 hover:border-red-300' }}">
                {{ auth()->user()->hasFavorited($artikel) ? '❤️ Favorit' : '🤍 Tambah ke Favorit' }}
            </button>
        </div>

        <!-- Thumbnail (if exists) -->
        @if($artikel->thumbnail)
            <img src="{{ $artikel->thumbnail }}" alt="{{ $artikel->title }}" class="w-full rounded-lg mb-6">
        @endif

        <!-- Content -->
        <div class="prose max-w-none">
            <div class="text-gray-700 leading-relaxed whitespace-pre-line">
                {{ $artikel->content }}
            </div>
        </div>
    </div>

    <!-- Author Info -->
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="font-bold text-[var(--burgundy)] mb-2">Tentang Penulis</h3>
        <div class="flex items-center gap-3">
            <div class="w-12 h-12 bg-[var(--burgundy)] rounded-full flex items-center justify-center text-white font-bold">
                {{ strtoupper(substr($artikel->user->name, 0, 1)) }}
            </div>
            <div>
                <p class="font-semibold text-gray-800">{{ $artikel->user->name }}</p>
                <p class="text-sm text-gray-500">{{ $artikel->user->email }}</p>
            </div>
        </div>
    </div>
</div>