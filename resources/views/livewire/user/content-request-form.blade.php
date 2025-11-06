<div>
    <h2 class="text-2xl font-bold text-[var(--burgundy)] mb-6">Request Konten Baru</h2>

    <!-- Info Box -->
    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
        <h3 class="font-bold text-blue-800 mb-2">📢 Cara Request Konten:</h3>
        <ul class="text-sm text-blue-700 space-y-1">
            <li>✅ Jelaskan konten yang kamu inginkan dengan detail</li>
            <li>✅ Pilih tipe: Video atau Artikel</li>
            <li>✅ Tentukan prioritas (High untuk urgent)</li>
            <li>✅ User lain bisa vote request kamu!</li>
            <li>✅ Admin akan review dan approve request populer</li>
        </ul>
    </div>

    <!-- Flash Message -->
    @if (session()->has('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-6">
            {{ session('success') }}
        </div>
    @endif

    <!-- Form -->
    <div class="bg-white rounded-lg shadow-lg p-6">
        <form wire:submit="submit" class="space-y-4">
            <!-- Title -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Judul Request <span class="text-red-500">*</span>
                </label>
                <input 
                    type="text" 
                    wire:model="title"
                    placeholder="Contoh: Tutorial Laravel Livewire untuk Pemula"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--burgundy)] @error('title') border-red-500 @enderror">
                @error('title') 
                    <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <!-- Description -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Deskripsi (Opsional)
                </label>
                <textarea 
                    wire:model="description"
                    rows="4"
                    placeholder="Jelaskan detail konten yang kamu inginkan..."
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--burgundy)] @error('description') border-red-500 @enderror"></textarea>
                @error('description') 
                    <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <!-- Type & Priority -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Type -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Tipe Konten <span class="text-red-500">*</span>
                    </label>
                    <select 
                        wire:model="type"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--burgundy)]">
                        <option value="video">📹 Video</option>
                        <option value="artikel">📝 Artikel</option>
                    </select>
                </div>

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
            </div>

            <!-- Submit Button -->
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