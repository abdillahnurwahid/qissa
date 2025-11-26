{{-- resources/views/livewire/admin/user-management.blade.php --}}
<div>
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-[var(--burgundy)]">Manajemen Users</h2>
        <input 
            type="text" 
            wire:model.live="search"
            placeholder="Cari user..."
            class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--burgundy)]">
    </div>

    @if (session()->has('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-4">
            {{ session('error') }}
        </div>
    @endif

    <div class="space-y-4">
        @forelse($users as $user)
            <div class="bg-white p-4 rounded-lg shadow flex justify-between items-center">
                <div>
                    <h3 class="font-bold text-[var(--burgundy)]">{{ $user->name }}</h3>
                    <p class="text-xs text-gray-500">{{ $user->email }}</p>
                    <span class="inline-block mt-1 px-2 py-1 text-xs rounded {{ $user->role === 'admin' ? 'bg-purple-100 text-purple-600' : 'bg-blue-100 text-blue-600' }}">
                        {{ ucfirst($user->role) }}
                    </span>
                </div>
                <div class="flex gap-2">
                    @if($user->id !== auth()->id())
                        <button 
                            wire:click="deleteUser({{ $user->id }})"
                            wire:confirm="Yakin ingin menghapus user ini?"
                            class="bg-red-50 text-red-600 py-1.5 px-3 rounded text-xs font-semibold hover:bg-red-100">
                            Delete
                        </button>
                    @else
                        <span class="text-xs text-gray-500 italic">(You)</span>
                    @endif
                </div>
            </div>
        @empty
            <div class="text-center py-12 text-gray-500">Tidak ada user ditemukan</div>
        @endforelse
    </div>
</div>