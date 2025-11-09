<div>
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-[var(--burgundy)]">Daftar Request Konten</h2>
        
        <div class="flex gap-3">
            <select 
                wire:model.live="statusFilter"
                class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--burgundy)]">
                <option value="all">Semua Status</option>
                <option value="pending">⏳ Pending</option>
                <option value="approved">✅ Approved</option>
                <option value="rejected">❌ Rejected</option>
            </select>

            <a 
                href="{{ route('user.request.form') }}"
                class="btn-main px-4 py-2 rounded-lg font-semibold shadow-md hover:shadow-lg transition">
                + Request Baru
            </a>
        </div>
    </div>

    @if (session()->has('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-6">
            {{ session('success') }}
        </div>
    @endif

    <div class="space-y-4">
        @forelse($requests as $request)
            <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
                <div class="flex justify-between items-start mb-3">
                    <div class="flex-1">
                        <div class="flex gap-2 mb-2">
                            <span class="inline-block px-2 py-1 text-xs rounded {{ $request->status === 'approved' ? 'bg-green-100 text-green-600' : ($request->status === 'pending' ? 'bg-yellow-100 text-yellow-600' : 'bg-red-100 text-red-600') }}">
                                {{ $request->status === 'approved' ? '✅ Approved' : ($request->status === 'pending' ? '⏳ Pending' : '❌ Rejected') }}
                            </span>
                            <span class="inline-block px-2 py-1 text-xs rounded {{ $request->type === 'video' ? 'bg-blue-100 text-blue-600' : 'bg-green-100 text-green-600' }}">
                                {{ $request->type === 'video' ? '📹 Video' : '📝 Artikel' }}
                            </span>
                            <span class="inline-block px-2 py-1 text-xs rounded font-semibold {{ $request->priority === 'high' ? 'bg-red-100 text-red-600' : ($request->priority === 'medium' ? 'bg-yellow-100 text-yellow-600' : 'bg-green-100 text-green-600') }}">
                                {{ $request->priority === 'high' ? '🔴 High' : ($request->priority === 'medium' ? '🟡 Medium' : '🟢 Low') }}
                            </span>
                            @if($request->category)
                                <span class="inline-block px-2 py-1 text-xs rounded bg-purple-100 text-purple-600">
                                    {{ $request->category->name }}
                                </span>
                            @endif
                        </div>

                        <h3 class="font-bold text-[var(--burgundy)] text-lg mb-2">{{ $request->title }}</h3>

                        @if($request->description)
                            <p class="text-sm text-gray-600 mb-3">{{ Str::limit($request->description, 200) }}</p>
                        @endif

                        <div class="flex items-center gap-4 text-xs text-gray-500">
                            <span>👤 {{ $request->user->name }}</span>
                            <span>📅 {{ $request->created_at->diffForHumans() }}</span>
                            <span class="font-semibold text-[var(--burgundy)]">⭐ {{ number_format($request->votes) }} votes</span>
                        </div>

                        <!-- Link to Created Artikel (if approved & artikel created) -->
                        @if($request->status === 'approved' && $request->type === 'artikel' && $request->created_content_id)
                            <div class="mt-3">
                                <a 
                                    href="{{ route('user.artikel.show', $request->created_content_id) }}"
                                    class="inline-flex items-center gap-2 text-sm font-semibold text-green-600 hover:text-green-700 hover:underline">
                                    📰 Lihat Artikel →
                                </a>
                            </div>
                        @endif
                    </div>

                    @if($request->status === 'pending')
                        <button 
                            wire:click="vote({{ $request->id }})"
                            class="ml-4 px-4 py-2 bg-purple-50 border-2 border-purple-500 text-purple-600 rounded-lg text-sm font-semibold hover:bg-purple-100 transition">
                            👍 Vote
                        </button>
                    @endif
                </div>
            </div>
        @empty
            <div class="text-center py-12">
                <div class="text-6xl mb-4">📬</div>
                <p class="text-gray-500 text-lg mb-4">Belum ada request konten</p>
                <a 
                    href="{{ route('user.request.form') }}"
                    class="btn-main px-6 py-2 rounded-lg font-semibold inline-block">
                    + Buat Request Pertama
                </a>
            </div>
        @endforelse
    </div>
</div>