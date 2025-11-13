<div>
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-[var(--burgundy)]">Tambah Artikel Baru</h2>
        <a href="{{ route('admin.articles') }}" class="text-sm text-gray-600 hover:text-[var(--burgundy)] font-semibold">
            ← Kembali ke List Artikel
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-lg p-6">
        <form wire:submit="save" class="space-y-5">
            
            <!-- Title -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Judul Artikel <span class="text-red-500">*</span>
                </label>
                <input 
                    type="text" 
                    wire:model="title"
                    placeholder="Contoh: Kisah Inspiratif Khalid bin Walid"
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

            <!-- Excerpt -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Ringkasan/Excerpt (Opsional)
                </label>
                <textarea 
                    wire:model="excerpt"
                    rows="3"
                    placeholder="Ringkasan singkat artikel (akan auto-generate dari konten jika dikosongkan)"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--burgundy)]"></textarea>
                <p class="text-xs text-gray-500 mt-1">Maksimal 300 karakter. Kosongkan untuk auto-generate.</p>
            </div>

            <!-- Content -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Konten Artikel <span class="text-red-500">*</span>
                </label>
                <textarea 
                    wire:model="content"
                    rows="15"
                    placeholder="Tulis konten artikel lengkap di sini (minimal 100 karakter)..."
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--burgundy)] font-mono text-sm @error('content') border-red-500 @enderror"></textarea>
                
                <div class="flex justify-between items-center mt-2">
                    @error('content') 
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @else
                        <span class="text-xs text-gray-500">Minimal 100 karakter</span>
                    @enderror
                    <span class="text-xs {{ strlen($content) >= 100 ? 'text-green-600 font-semibold' : 'text-gray-500' }}">
                        {{ number_format(strlen($content)) }} karakter
                    </span>
                </div>
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
                    <span wire:loading.remove>💾 Simpan Artikel</span>
                    <span wire:loading>⏳ Menyimpan...</span>
                </button>
                
                <a 
                    href="{{ route('admin.articles') }}"
                    class="px-6 py-2 bg-gray-100 text-gray-700 rounded-lg font-semibold hover:bg-gray-200 transition">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>