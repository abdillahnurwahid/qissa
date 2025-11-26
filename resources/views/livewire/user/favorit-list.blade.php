{{-- resources/views/livewire/user/favorit-list.blade.php --}}
<div>
    <h2 class="text-2xl font-bold text-[var(--burgundy)] mb-6">Konten Favorit Kamu</h2>

    <div class="space-y-4">
        @forelse($favorites as $favorite)
            <div class="bg-white p-6 rounded-lg shadow">
                <div class="flex justify-between items-start">
                    <div class="flex-1">
                        <span class="inline-block px-2 py-1 text-xs font-semibold rounded {{ $favorite->favoritable_type === 'App\Models\Video' ? 'bg-blue-100 text-blue-600' : 'bg-green-100 text-green-600' }} mb-2">
                            {{ $favorite->favoritable_type === 'App\Models\Video' ? 'Video' : 'Artikel' }}
                        </span>

                        <h3 class="font-bold text-[var(--burgundy)] mb-2">{{ $favorite->favoritable->title }}</h3>
                        
                        @if($favorite->favoritable_type === 'App\Models\Video')
                            <p class="text-sm text-gray-600">Durasi: {{ $favorite->favoritable->duration }} menit</p>
                        @else
                            <p class="text-sm text-gray-600">{{ Str::limit($favorite->favoritable->excerpt ?? $favorite->favoritable->content, 120) }}</p>
                        @endif
                    </div>

                    <button 
                        wire:click="removeFavorite({{ $favorite->id }})"
                        wire:confirm="Hapus dari favorit?"
                        class="ml-4 px-3 py-1 text-red-500 hover:text-red-700">
                        🗑️
                    </button>
                </div>
            </div>
        @empty
            <div class="text-center py-12">
                <p class="text-gray-500">Belum ada konten favorit</p>
                <a href="{{ route('user.video') }}" class="text-[var(--burgundy)] text-sm font-semibold hover:underline mt-2 inline-block">
                    Jelajahi Video →
                </a>
            </div>
        @endforelse
    </div>
</div>