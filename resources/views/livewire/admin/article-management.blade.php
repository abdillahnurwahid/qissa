{{-- resources/views/livewire/admin/article-management.blade.php --}}
<div>
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-[var(--burgundy)]">Manajemen Artikel</h2>
    
    <div class="flex gap-3">
        <select wire:model.live="statusFilter" class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--burgundy)]">
            <option value="all">Semua Status</option>
            <option value="pending">Pending</option>
            <option value="approved">Approved</option>
            <option value="rejected">Rejected</option>
        </select>
        
        <a href="{{ route('admin.articles.create') }}" class="btn-main px-4 py-2 rounded-lg font-semibold">
            + Tambah Artikel
        </a>
    </div>
</div>

    @if (session()->has('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="space-y-4">
        @forelse($artikels as $artikel)
            <div class="bg-white p-6 rounded-lg shadow">
                <div class="flex justify-between items-start mb-2">
                    <div class="flex-1">
                        <span class="inline-block px-2 py-1 text-xs rounded mb-2 {{ $artikel->status === 'approved' ? 'bg-green-100 text-green-600' : ($artikel->status === 'pending' ? 'bg-yellow-100 text-yellow-600' : 'bg-red-100 text-red-600') }}">
                            {{ ucfirst($artikel->status) }}
                        </span>
                        <h3 class="font-bold text-[var(--burgundy)] mb-1">{{ $artikel->title }}</h3>
                        <p class="text-xs text-gray-500 mb-2">{{ $artikel->user->name }} • {{ $artikel->votes }} votes • {{ $artikel->category->name }}</p>
                    </div>
                </div>
                <div class="flex gap-2">
                    @if($artikel->status !== 'approved')
                        <button 
                            wire:click="approve({{ $artikel->id }})"
                            class="bg-green-50 text-green-600 py-1 px-3 rounded text-xs font-semibold hover:bg-green-100">
                            Approve
                        </button>
                    @endif
                    @if($artikel->status !== 'rejected')
                        <button 
                            wire:click="reject({{ $artikel->id }})"
                            class="bg-red-50 text-red-600 py-1 px-3 rounded text-xs font-semibold hover:bg-red-100">
                            Reject
                        </button>
                    @endif
                    <button 
                        wire:click="delete({{ $artikel->id }})"
                        wire:confirm="Yakin ingin menghapus artikel ini?"
                        class="bg-gray-50 text-gray-600 py-1 px-3 rounded text-xs font-semibold hover:bg-gray-100">
                        Delete
                    </button>
                </div>
            </div>
        @empty
            <div class="text-center py-12 text-gray-500">Tidak ada artikel</div>
        @endforelse
    </div>
</div>