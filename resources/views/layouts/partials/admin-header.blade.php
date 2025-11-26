{{-- admin-header.blade.php --}}
<div class="brand-gradient text-white py-6 shadow-md">
    <div class="max-w-6xl mx-auto px-6 flex items-center justify-between">
        <div class="flex items-center gap-3">
            <div class="w-12 h-12 bg-white bg-opacity-20 rounded-xl flex items-center justify-center">
                <span class="text-2xl font-bold">Q+</span>
            </div>
            <h1 class="text-3xl font-bold">Dashboard Admin</h1>
        </div>
        <div class="flex items-center gap-4 text-sm">
            <a href="{{ route('admin.dashboard') }}" 
               class="font-semibold text-white {{ request()->routeIs('admin.dashboard') ? 'border-b-2 border-white' : 'text-opacity-80 hover:text-opacity-100' }}">
                Dashboard
            </a>
            <a href="{{ route('admin.users') }}" 
               class="font-semibold text-white {{ request()->routeIs('admin.users') ? 'border-b-2 border-white' : 'text-opacity-80 hover:text-opacity-100' }}">
                Users
            </a>
            <a href="{{ route('admin.videos') }}" 
               class="font-semibold text-white {{ request()->routeIs('admin.videos') ? 'border-b-2 border-white' : 'text-opacity-80 hover:text-opacity-100' }}">
                Videos
            </a>
            <a href="{{ route('admin.articles') }}" 
               class="font-semibold text-white {{ request()->routeIs('admin.articles') ? 'border-b-2 border-white' : 'text-opacity-80 hover:text-opacity-100' }}">
                Articles
            </a>
            <a href="{{ route('admin.requests') }}" 
               class="font-semibold text-white {{ request()->routeIs('admin.requests') ? 'border-b-2 border-white' : 'text-opacity-80 hover:text-opacity-100' }}">
                Requests
            </a>
            <form action="{{ route('logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="bg-white text-[var(--burgundy)] px-4 py-2 rounded-full font-semibold text-sm hover:bg-gray-100">
                    Logout
                </button>
            </form>
        </div>
    </div>
</div>
