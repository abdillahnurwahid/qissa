<div>
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-[var(--burgundy)]">Tambah Video Baru</h2>
        <a href="{{ route('admin.videos') }}" class="text-sm text-gray-600 hover:text-[var(--burgundy)] font-semibold">
            ← Kembali ke List Video
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-lg p-6">
        <form wire:submit="save" class="space-y-5">
            
            <!-- Title -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Judul Video <span class="text-red-500">*</span>
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

            <!-- YouTube URL -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Link YouTube <span class="text-red-500">*</span>
                </label>
                <input 
                    type="url" 
                    wire:model="video_url"
                    placeholder="https://www.youtube.com/watch?v=dQw4w9WgXcQ"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--burgundy)] @error('video_url') border-red-500 @enderror">
                <p class="text-xs text-gray-500 mt-1">Paste link YouTube lengkap (watch?v= atau youtu.be/)</p>
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
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--burgundy)] @error('duration') border-red-500 @enderror">
                <p class="text-xs text-gray-500 mt-1">Durasi video dalam menit (1-300 menit)</p>
                @error('duration') 
                    <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <!-- Description -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Deskripsi
                </label>
                <textarea 
                    wire:model="description"
                    rows="4"
                    placeholder="Deskripsi singkat tentang video..."
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--burgundy)]"></textarea>
            </div>

            <!-- Status -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Status <span class="text-red-500">*</span>
                </label>
                <select 
                    wire:model="status"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--burgundy)]">
                    <option value="approved">✅ Approved (Langsung tampil)</option>
                    <option value="pending">⏳ Pending (Review dulu)</option>
                    <option value="rejected">❌ Rejected</option>
                </select>
            </div>

            <!-- Submit Buttons -->
            <div class="flex gap-3 pt-4">
                <button 
                    type="submit"
                    class="btn-main px-6 py-2 rounded-lg font-semibold shadow-md hover:shadow-lg transition"
                    wire:loading.attr="disabled">
                    <span wire:loading.remove>💾 Simpan Video</span>
                    <span wire:loading>⏳ Menyimpan...</span>
                </button>
                
                <a 
                    href="{{ route('admin.videos') }}"
                    class="px-6 py-2 bg-gray-100 text-gray-700 rounded-lg font-semibold hover:bg-gray-200 transition">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>