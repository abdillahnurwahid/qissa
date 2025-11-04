<div>
    <h2 class="text-2xl font-bold text-[var(--burgundy)] mb-6">Dashboard Overview</h2>
    
    @if (session()->has('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid sm:grid-cols-2 md:grid-cols-4 gap-4 mb-10">
        <div class="bg-white rounded-xl p-4 text-center shadow hover:shadow-lg transition">
            <div class="text-2xl font-bold text-[var(--burgundy)]">{{ number_format($stats['total_users']) }}</div>
            <div class="text-xs text-gray-600">Total Users</div>
        </div>
        <div class="bg-white rounded-xl p-4 text-center shadow hover:shadow-lg transition">
            <div class="text-2xl font-bold text-[var(--burgundy)]">{{ number_format($stats['total_videos']) }}</div>
            <div class="text-xs text-gray-600">Total Videos</div>
        </div>
        <div class="bg-white rounded-xl p-4 text-center shadow hover:shadow-lg transition">
            <div class="text-2xl font-bold text-[var(--burgundy)]">{{ number_format($stats['total_articles']) }}</div>
            <div class="text-xs text-gray-600">Total Articles</div>
        </div>
        <div class="bg-white rounded-xl p-4 text-center shadow hover:shadow-lg transition">
            <div class="text-2xl font-bold text-[var(--burgundy)]">{{ number_format($stats['pending_requests']) }}</div>
            <div class="text-xs text-gray-600">Pending Requests</div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white rounded-xl p-6 shadow">
        <h3 class="font-bold text-[var(--burgundy)] mb-4">Quick Actions</h3>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
            <a href="{{ route('admin.users') }}" class="btn-main text-center py-3 rounded-lg text-sm">Manage Users</a>
            <a href="{{ route('admin.videos') }}" class="btn-main text-center py-3 rounded-lg text-sm">Manage Videos</a>
            <a href="{{ route('admin.articles') }}" class="btn-main text-center py-3 rounded-lg text-sm">Manage Articles</a>
            <a href="{{ route('admin.requests') }}" class="btn-main text-center py-3 rounded-lg text-sm">View Requests</a>
        </div>
    </div>
</div>