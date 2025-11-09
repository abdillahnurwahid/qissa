<div>
    <h2 class="text-2xl font-bold text-[var(--burgundy)] mb-6">Request Konten Baru</h2>

    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
        <h3 class="font-bold text-blue-800 mb-2">📢 Cara Request Konten:</h3>
        <ul class="text-sm text-blue-700 space-y-1">
            <li>✅ Pilih kategori yang sesuai</li>
            <li>✅ Untuk video: Paste link YouTube lengkap</li>
            <li>✅ Untuk artikel: Tulis konten lengkap (minimal 100 karakter)</li>
            <li>✅ User lain bisa vote request kamu!</li>
            <li>✅ Admin akan review dan approve request populer</li>
        </ul>
    </div>

    @if (session()->has('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-6">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-lg shadow-lg p-6">
        <form wire:submit="submit" class="space-y-4">
            
            <!-- Type Selection -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Tipe Konten <span class="text-red-500">*</span>
                </label>
                <div class="grid grid-cols-2 gap-3">
                    <button 
                        type="button"
                        wire:click="$set('type', 'video')"
                        class="px-4 py-3 rounded-lg border-2 text-sm font-semibold transition {{ $type === 'video' ? 'border-blue-500 bg-blue-50 text-blue-700' : 'border-gray-300 text-gray-700 hover:border-blue-300' }}">
                        📹 Video
                    </button>
                    <button 
                        type="button"
                        wire:click="$set('type', 'artikel')"
                        class="px-4 py-3 rounded-lg border-2 text-sm font-semibold transition {{ $type === 'artikel' ? 'border-green-500 bg-green-50 text-green-700' : 'border-gray-300 text-gray-700 hover:border-green-300' }}">
                        📝 Artikel
                    </button>
                </div>
            </div>

            <!-- Category -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Kategori <span class="text-red-500">*</span>
                </label>
                <select 
                    wire:model="category_id"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--burgundy)] @error('category_id') border-red-500 @enderror">
                    <option value="">Pilih Kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id') 
                    <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <!-- Title -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Judul <span class="text-red-500">*</span>
                </label>
                <input 
                    type="text" 
                    wire:model="title"
                    placeholder="Contoh: Kisah Inspiratif Salahuddin Al-Ayyubi"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--burgundy)] @error('title') border-red-500 @enderror">
                @error('title') 
                    <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <!-- Description -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Deskripsi Singkat (Opsional)
                </label>
                <textarea 
                    wire:model="description"
                    rows="3"
                    placeholder="Ringkasan singkat..."
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--burgundy)]"></textarea>
            </div>

            <!-- VIDEO FIELDS -->
            @if($type === 'video')
                <div class="bg-blue-50 border-2 border-blue-200 rounded-lg p-4 space-y-4">
                    <h4 class="font-bold text-blue-800">📹 Informasi Video</h4>
                    
                    <!-- YouTube URL -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Link YouTube <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="url" 
                            wire:model="video_url"
                            placeholder="https://www.youtube.com/watch?v=dQw4w9WgXcQ"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('video_url') border-red-500 @enderror">
                        <p class="text-xs text-gray-500 mt-1">Paste link YouTube lengkap. Sistem akan otomatis extract ID-nya.</p>
                        @error('video_url') 
                            <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Duration -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Durasi (Menit) <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="number" 
                            wire:model="duration"
                            min="1"
                            max="300"
                            placeholder="Contoh: 15"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('duration') border-red-500 @enderror">
                        <p class="text-xs text-gray-500 mt-1">Durasi video dalam menit (1-300 menit)</p>
                        @error('duration') 
                            <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            @endif

            <!-- ARTIKEL FIELDS -->
            @if($type === 'artikel')
                <div class="bg-green-50 border-2 border-green-200 rounded-lg p-4">
                    <h4 class="font-bold text-green-800 mb-3">📝 Konten Artikel</h4>
                    
                    <textarea 
                        wire:model="content"
                        rows="12"
                        placeholder="Tulis konten artikel lengkap di sini (minimal 100 karakter)..."
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 font-mono text-sm @error('content') border-red-500 @enderror"></textarea>
                    
                    <div class="flex justify-between items-center mt-2">
                        @error('content') 
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @else
                            <span class="text-xs text-gray-500">Minimal 100 karakter</span>
                        @enderror
                        <span class="text-xs {{ strlen($content) >= 100 ? 'text-green-600 font-semibold' : 'text-gray-500' }}">
                            {{ strlen($content) }} karakter
                        </span>
                    </div>
                </div>
            @endif

            <!-- Priority -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Prioritas <span class="text-red-500">*</span>
                </label>
                <select 
                    wire:model="priority"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--burgundy)]">
                    <option value="low">🟢 Low - Tidak urgent</option>
                    <option value="medium">🟡 Medium - Standar</option>
                    <option value="high">🔴 High - Sangat dibutuhkan</option>
                </select>
            </div>

            <!-- Submit -->
            <div class="flex gap-3">
                <button 
                    type="submit"
                    class="btn-main px-6 py-2 rounded-lg font-semibold shadow-md hover:shadow-lg transition"
                    wire:loading.attr="disabled">
                    <span wire:loading.remove>🚀 Kirim Request</span>
                    <span wire:loading>⏳ Mengirim...</span>
                </button>
                
                <a 
                    href="{{ route('user.request.list') }}"
                    class="px-6 py-2 bg-gray-100 text-gray-700 rounded-lg font-semibold hover:bg-gray-200 transition">
                    📋 Lihat Semua Request
                </a>
            </div>
        </form>
    </div>
</div>
