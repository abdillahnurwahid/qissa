{{-- results/views/livewire/auth/login.blade.php --}}
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
                    <p class="text-gray-600 text-sm">Platform Pembelajaran Video dan Artikel</p>
                </div>

                <h2 class="text-xl font-bold text-[var(--burgundy)] mb-4 text-center">Masuk ke Akun</h2>

                @if (session()->has('success'))
                    <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-4 text-sm">
                        {{ session('success') }}
                    </div>
                @endif

                <form wire:submit="login" class="space-y-4">
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

                    <div class="flex items-center">
                        <input type="checkbox" wire:model="remember" id="remember" class="mr-2">
                        <label for="remember" class="text-xs text-gray-600">Ingat saya</label>
                    </div>

                    <button 
                        type="submit"
                        class="w-full btn-main py-2 rounded-lg text-sm font-semibold shadow-md hover:shadow-lg transition-all"
                        wire:loading.attr="disabled">
                        <span wire:loading.remove>Masuk</span>
                        <span wire:loading>Loading...</span>
                    </button>
                </form>

                <div class="mt-4 text-center">
                    <a href="{{ route('register') }}" class="text-sm text-gray-600">
                        Belum punya akun?
                        <span class="text-[var(--burgundy)] font-semibold hover:underline">Daftar</span>
                    </a>
                </div>
            </div>
        </div>

        {{-- <div class="mt-4 bg-white rounded-lg p-4 shadow text-xs">
            <p class="font-bold text-gray-700 mb-2">Demo Credentials:</p>
            <p class="text-gray-600">User: <span class="font-mono bg-gray-100 px-2 py-1 rounded">user@qissa.com</span></p>
            <p class="text-gray-600">Admin: <span class="font-mono bg-gray-100 px-2 py-1 rounded">admin@qissa.com</span></p>
            <p class="text-gray-600">Password: <span class="font-mono bg-gray-100 px-2 py-1 rounded">password</span></p>
        </div> --}}
    </div>
</div>