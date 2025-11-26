{{-- resources/views/livewire/user/content-request-list.blade.php --}}
<div>
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-[var(--burgundy)]">Daftar Request Konten</h2>
        <div class="flex gap-3">
            <select wire:model.live="statusFilter" 
                    class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--burgundy)]">
                <option value="all">Semua Status</option>
                <option value="pending">Pending</option>
                <option value="approved">Approved</option>
                <option value="rejected">Rejected</option>
            </select>
            
            <a href="{{ route('user.request.form') }}" 
               class="btn-main px-4 py-2 rounded-lg font-semibold">
                + Buat Request Baru
            </a>
        </div>
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
        @forelse($requests as $request)
            {{-- 👇 PENTING: Tambahkan wire:key untuk force re-render --}}
            <div class="bg-white p-6 rounded-lg shadow" 
                 wire:key="request-{{ $request->id }}-{{ $request->votes }}-{{ $request->votedBy->count() }}">
                <div class="flex justify-between items-start">
                    <div class="flex-1">
                        <div class="flex gap-2 mb-2">
                            <span class="inline-block px-2 py-1 text-xs font-semibold rounded 
                                {{ $request->status === 'approved' ? 'bg-green-100 text-green-600' : 
                                   ($request->status === 'pending' ? 'bg-yellow-100 text-yellow-600' : 
                                   'bg-red-100 text-red-600') }}">
                                {{ ucfirst($request->status) }}
                            </span>
                            
                            <span class="inline-block px-2 py-1 text-xs font-semibold rounded 
                                {{ $request->type === 'video' ? 'bg-blue-100 text-blue-600' : 'bg-green-100 text-green-600' }}">
                                {{ ucfirst($request->type) }}
                            </span>
                            
                            <span class="inline-block px-2 py-1 text-xs font-semibold rounded 
                                {{ $request->priority === 'high' ? 'bg-red-100 text-red-600' : 
                                   ($request->priority === 'medium' ? 'bg-yellow-100 text-yellow-600' : 
                                   'bg-gray-100 text-gray-600') }}">
                                Priority: {{ ucfirst($request->priority) }}
                            </span>
                        </div>

                        <h3 class="font-bold text-[var(--burgundy)] mb-2">{{ $request->title }}</h3>
                        
                        @if($request->description)
                            <p class="text-sm text-gray-600 mb-2">{{ Str::limit($request->description, 150) }}</p>
                        @endif

                        <div class="flex items-center gap-4 text-xs text-gray-500">
                            <span>👤 {{ $request->user->name }}</span>
                            <span>📅 {{ $request->created_at->diffForHumans() }}</span>
                            <span>⭐ {{ $request->votes }} votes</span>
                        </div>
                    </div>

                    <div class="ml-4">
                        @if($request->hasVotedBy(auth()->user()))
                            <button 
                                wire:click="unvote({{ $request->id }})"
                                wire:loading.attr="disabled"
                                wire:target="unvote({{ $request->id }})"
                                class="bg-red-50 text-red-600 px-4 py-2 rounded-lg text-sm font-semibold border-2 border-red-500 hover:bg-red-100 transition-all duration-200 disabled:opacity-50">
                                <span wire:loading.remove wire:target="unvote({{ $request->id }})">❤️ Voted</span>
                                <span wire:loading wire:target="unvote({{ $request->id }})">⏳</span>
                            </button>
                        @else
                            <button 
                                wire:click="vote({{ $request->id }})"
                                wire:loading.attr="disabled"
                                wire:target="vote({{ $request->id }})"
                                class="bg-gray-50 text-gray-600 px-4 py-2 rounded-lg text-sm font-semibold border-2 border-gray-300 hover:border-[var(--burgundy)] hover:text-[var(--burgundy)] transition-all duration-200 disabled:opacity-50">
                                <span wire:loading.remove wire:target="vote({{ $request->id }})">🤍 Vote</span>
                                <span wire:loading wire:target="vote({{ $request->id }})">⏳</span>
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center py-12">
                <p class="text-gray-500 mb-4">Belum ada request konten</p>
                <a href="{{ route('user.request.form') }}" 
                   class="inline-block btn-main px-6 py-3 rounded-lg font-semibold">
                    Buat Request Pertama
                </a>
            </div>
        @endforelse
    </div>
</div>