{{-- resources/views/livewire/admin/request-management.blade.php --}}
<div>
    <h2 class="text-2xl font-bold text-[var(--burgundy)] mb-6">Pending Content Requests</h2>

    @if (session()->has('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="space-y-4">
        @forelse($requests as $request)
            <div class="bg-white p-4 rounded-lg shadow flex flex-col md:flex-row justify-between items-start md:items-center">
                <div class="flex-1">
                    <h3 class="font-bold text-[var(--burgundy)] mb-1">{{ $request->title }}</h3>
                    <p class="text-xs text-gray-600 mb-1">{{ $request->description }}</p>
                    <p class="text-xs text-gray-500">
                        Submitted by {{ $request->user->name }} • {{ $request->votes }} votes • 
                        <span class="font-semibold {{ $request->priority === 'high' ? 'text-red-600' : ($request->priority === 'medium' ? 'text-yellow-600' : 'text-green-600') }}">
                            {{ $request->priority }}
                        </span> •
                        <span class="px-2 py-0.5 rounded text-xs {{ $request->type === 'video' ? 'bg-blue-100 text-blue-600' : 'bg-green-100 text-green-600' }}">
                            {{ ucfirst($request->type) }}
                        </span>
                    </p>
                </div>
                <div class="flex gap-2 mt-2 md:mt-0">
                    <button 
                        wire:click="approve({{ $request->id }})"
                        class="bg-green-50 text-green-600 py-1 px-3 rounded text-xs font-semibold hover:bg-green-100">
                        Approve
                    </button>
                    <button 
                        wire:click="reject({{ $request->id }})"
                        class="bg-red-50 text-red-600 py-1 px-3 rounded text-xs font-semibold hover:bg-red-100">
                        Reject
                    </button>
                </div>
            </div>
        @empty
            <div class="text-center py-12 text-gray-500">Tidak ada request pending</div>
        @endforelse
    </div>
</div>