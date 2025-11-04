<div>
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-[var(--burgundy)]">Manajemen Video</h2>
        
        <select wire:model.live="statusFilter" class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--burgundy)]">
            <option value="all">Semua Status</option>
            <option value="pending">Pending</option>
            <option value="approved">Approved</option>
            <option value="rejected">Rejected</option>
        </select>
    </div>

    @if (session()->has('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @forelse($videos as $video)
            <div class="bg-white shadow rounded-lg overflow-hidden">
                <img src="{{ $video->thumbnail ?? 'https://placehold.co/400x200/912f56/ffffff?text=' . urlencode($video->title) }}" class="w-full h-40 object-cover">
                <div class="p-4">
                    <span class="inline-block px-2 py-1 text-xs rounded mb-2 {{ $video->status === 'approved' ? 'bg-green-100 text-green-600' : ($video->status === 'pending' ? 'bg-yellow-100 text-yellow-600' : 'bg-red-100 text-red-600') }}">
                        {{ ucfirst($video->status) }}
                    </span>
                    <h3 class="font-bold text-[var(--burgundy)] mb-1">{{ $video->title }}</h3>
                    <p class="text-xs text-gray-500 mb-2">Durasi: {{ $video->duration }} menit</p>
                    <p class="text-xs text-gray-400 mb-3">Kategori: {{ $video->category->name }}</p>
                    <div class="flex gap-2">
                        @if($video->status !== 'approved')
                            <button 
                                wire:click="approve({{ $video->id }})"
                                class="bg-green-50 text-green-600 py-1 px-3 rounded text-xs font-semibold hover:bg-green-100 flex-1">
                                Approve
                            </button>
                        @endif
                        @if($video->status !== 'rejected')
                            <button 
                                wire:click="reject({{ $video->id }})"
                                class="bg-red-50 text-red-600 py-1 px-3 rounded text-xs font-semibold hover:bg-red-100 flex-1">
                                Reject
                            </button>
                        @endif
                        <button 
                            wire:click="delete({{ $video->id }})"
                            wire:confirm="Yakin ingin menghapus video ini?"
                            class="bg-gray-50 text-gray-600 py-1 px-3 rounded text-xs font-semibold hover:bg-gray-100">
                            🗑️
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-3 text-center py-12 text-gray-500">Tidak ada video</div>
        @endforelse
    </div>
</div>