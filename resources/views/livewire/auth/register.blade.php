<div class="bg-[var(--mint)] min-h-screen flex items-center justify-center p-6">
    <div class="w-full max-w-md">
        <div class="brand-gradient rounded-2xl p-[2px] shadow-xl">
            <div class="bg-white rounded-2xl p-8">
                
                <div class="text-center mb-6">
                    <div class="inline-block bg-[var(--mint)] p-3 rounded-2xl shadow mb-3">
                        <div class="w-12 h-12 bg-[var(--burgundy)] rounded-xl flex items-center justify-center">
                            <span class="text-white font-bold text-2xl">Q+</span>
                        </div>
                    </div>
                    <h1 class="text-3xl font-bold text-[var(--burgundy)] mb-1">Qissa+</h1>
                    <p class="text-gray-600 text-sm">Buat akun baru untuk mulai belajar</p>
                </div>

                <h2 class="text-xl font-bold text-[var(--burgundy)] mb-4 text-center">Daftar Akun Baru</h2>

                <form wire:submit="register" class="space-y-4">
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Nama Lengkap</label>
                        <input 
                            type="text" 
                            wire:model="name"
                            class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--burgundy)] bg-[var(--mint)] @error('name') border-red-500 @enderror"
                            placeholder="Nama lengkap">
                        @error('name') 
                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Email</label>
                        <input 
                            type="email" 
                            wire:model="email"
                            class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--burgundy)] bg-[var(--mint)] @error('email') border-red-500 @enderror"
                            placeholder="nama@email.com">
                        @error('email') 
                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Password</label>
                        <input 
                            type="password" 
                            wire:model="password"
                            class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--burgundy)] bg-[var(--mint)] @error('password') border-red-500 @enderror"
                            placeholder="password">
                        @error('password') 
                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Konfirmasi Password</label>
                        <input 
                            type="password" 
                            wire:model="password_confirmation"
                            class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--burgundy)] bg-[var(--mint)]"
                            placeholder="konfirmasi password">
                    </div>

                    <button 
                        type="submit"
                        class="w-full btn-main py-2 rounded-lg text-sm font-semibold shadow-md hover:shadow-lg transition-all"
                        wire:loading.attr="disabled">
                        <span wire:loading.remove>Daftar</span>
                        <span wire:loading>Loading...</span>
                    </button>
                </form>

                <div class="mt-4 text-center">
                    <a href="{{ route('login') }}" class="text-sm text-gray-600">
                        Sudah punya akun?
                        <span class="text-[var(--burgundy)] font-semibold hover:underline">Masuk</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>