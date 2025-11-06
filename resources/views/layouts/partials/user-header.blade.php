<div class="brand-gradient text-white py-10 shadow-md">
    <div class="max-w-6xl mx-auto px-6 flex items-center justify-between">
        <div class="flex items-center gap-3">
            <div class="w-12 h-12 bg-white bg-opacity-20 rounded-xl flex items-center justify-center">
                <span class="text-2xl font-bold">Q+</span>
            </div>
            <div>
                <h1 class="text-3xl font-bold">Qissa+</h1>
            </div>
        </div>
        <div class="flex items-center gap-4 text-sm">
            <a href="{{ route('user.dashboard') }}" 
               class="font-semibold text-white {{ request()->routeIs('user.dashboard') ? 'border-b-2 border-white' : 'text-opacity-80 hover:text-opacity-100' }}">
                Home
            </a>
            <a href="{{ route('user.video') }}" 
               class="font-semibold text-white {{ request()->routeIs('user.video') ? 'border-b-2 border-white' : 'text-opacity-80 hover:text-opacity-100' }}">
                Video
            </a>
            <a href="{{ route('user.artikel') }}" 
               class="font-semibold text-white {{ request()->routeIs('user.artikel*') ? 'border-b-2 border-white' : 'text-opacity-80 hover:text-opacity-100' }}">
                Artikel
            </a>
            <a href="{{ route('user.request.list') }}" 
               class="font-semibold text-white {{ request()->routeIs('user.request.*') ? 'border-b-2 border-white' : 'text-opacity-80 hover:text-opacity-100' }}">
                Request
            </a>
            <a href="{{ route('user.favorit') }}" 
               class="font-semibold text-white {{ request()->routeIs('user.favorit') ? 'border-b-2 border-white' : 'text-opacity-80 hover:text-opacity-100' }}">
                Favorit
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