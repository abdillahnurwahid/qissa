<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Qissa+ Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root {
            --mint: #eaf2ef;
            --burgundy: #912f56;
        }
        body {
            background-color: var(--mint);
        }
        .brand-gradient {
            background: linear-gradient(90deg, var(--burgundy) 0%, #b24b77 100%);
        }
        .btn-main {
            background-color: var(--burgundy);
            color: white;
        }
        .btn-main:hover {
            background-color: #7a2548;
        }
    </style>
</head>
<body class="bg-[var(--mint)]">

    <!-- Header -->
    <div class="brand-gradient text-white py-6 shadow-md">
        <div class="max-w-6xl mx-auto px-6 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 bg-white bg-opacity-20 rounded-xl flex items-center justify-center">
                    <span class="text-2xl font-bold">Q+</span>
                </div>
                <h1 class="text-3xl font-bold">Dashboard Admin</h1>
            </div>
            <div class="flex items-center gap-4 text-sm">
                <button onclick="showPage('dashboard')" id="nav-dashboard" class="font-semibold text-white border-b-2 border-white">Dashboard</button>
                <button onclick="showPage('users')" id="nav-users" class="font-semibold text-white text-opacity-80 hover:text-opacity-100">Users</button>
                <button onclick="showPage('videos')" id="nav-videos" class="font-semibold text-white text-opacity-80 hover:text-opacity-100">Videos</button>
                <button onclick="showPage('articles')" id="nav-articles" class="font-semibold text-white text-opacity-80 hover:text-opacity-100">Articles</button>
                <button onclick="showPage('requests')" id="nav-requests" class="font-semibold text-white text-opacity-80 hover:text-opacity-100">Requests</button>
                <button onclick="logout()" class="bg-white text-[var(--burgundy)] px-4 py-2 rounded-full font-semibold text-sm hover:bg-gray-100">Logout</button>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div id="content" class="max-w-6xl mx-auto px-6 py-12 transition-all duration-300"></div>

    <!-- Footer -->
    <div class="bg-[var(--burgundy)] text-white py-12 mt-16">
        <div class="max-w-6xl mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <div class="flex items-center gap-2 mb-4">
                        <div class="w-10 h-10 bg-white bg-opacity-20 rounded-lg flex items-center justify-center">
                            <span class="text-white font-bold">Q+</span>
                        </div>
                        <span class="text-xl font-bold">Qissa+</span>
                    </div>
                    <p class="text-gray-200 text-sm">Platform pembelajaran video dan artikel terbaik untuk pengguna dan admin.</p>
                </div>
                <div></div>
                <div>
                    <h3 class="font-bold mb-4">Kontak</h3>
                    <p class="text-sm text-gray-200">Email: support@qissa.com</p>
                    <p class="text-sm text-gray-200">Website: qissa.id</p>
                    <p class="text-sm text-gray-200">Phone: 08213456789</p>
                </div>
            </div>
            <div class="border-t border-white border-opacity-20 mt-8 pt-8 text-center text-sm text-gray-200">
                <p>© 2025 Qissa+. dibuat dengan setulus hati</p>
            </div>
        </div>
    </div>

    <script>
        const pages = {
            dashboard: `
                <h2 class="text-2xl font-bold text-[var(--burgundy)] mb-6">Dashboard Overview</h2>
                <div class="grid sm:grid-cols-2 md:grid-cols-4 gap-4 mb-10">
                    <div class="bg-white rounded-xl p-4 text-center shadow">
                        <div class="text-2xl font-bold text-[var(--burgundy)]">45,231</div>
                        <div class="text-xs text-gray-600">Total Users</div>
                    </div>
                    <div class="bg-white rounded-xl p-4 text-center shadow">
                        <div class="text-2xl font-bold text-[var(--burgundy)]">1,234</div>
                        <div class="text-xs text-gray-600">Total Videos</div>
                    </div>
                    <div class="bg-white rounded-xl p-4 text-center shadow">
                        <div class="text-2xl font-bold text-[var(--burgundy)]">856</div>
                        <div class="text-xs text-gray-600">Total Articles</div>
                    </div>
                    <div class="bg-white rounded-xl p-4 text-center shadow">
                        <div class="text-2xl font-bold text-[var(--burgundy)]">42</div>
                        <div class="text-xs text-gray-600">Pending Requests</div>
                    </div>
                </div>
            `,
            users: `
                <h2 class="text-2xl font-bold text-[var(--burgundy)] mb-6">Manajemen Users</h2>
                <div class="space-y-4">
                    <div class="bg-white p-4 rounded-lg shadow flex justify-between items-center">
                        <div>
                            <h3 class="font-bold text-[var(--burgundy)]">Ahmad Rizki</h3>
                            <p class="text-xs text-gray-500">ahmad@example.com</p>
                        </div>
                        <div class="flex gap-2">
                            <button class="bg-green-50 text-green-600 py-1.5 px-3 rounded text-xs font-semibold">Edit</button>
                            <button class="bg-red-50 text-red-600 py-1.5 px-3 rounded text-xs font-semibold">Delete</button>
                        </div>
                    </div>
                    <div class="bg-white p-4 rounded-lg shadow flex justify-between items-center">
                        <div>
                            <h3 class="font-bold text-[var(--burgundy)]">Siti Nurhaliza</h3>
                            <p class="text-xs text-gray-500">siti@example.com</p>
                        </div>
                        <div class="flex gap-2">
                            <button class="bg-green-50 text-green-600 py-1.5 px-3 rounded text-xs font-semibold">Edit</button>
                            <button class="bg-red-50 text-red-600 py-1.5 px-3 rounded text-xs font-semibold">Delete</button>
                        </div>
                    </div>
                </div>
            `,
            videos: `
                <h2 class="text-2xl font-bold text-[var(--burgundy)] mb-6">Manajemen Video</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-white shadow rounded-lg overflow-hidden">
                        <img src="https://placehold.co/400x200" class="w-full">
                        <div class="p-4">
                            <h3 class="font-bold text-[var(--burgundy)]">Muhammad Al-Fatih: Pemuda Penakluk Konstantinopel</h3>
                            <p class="text-xs text-gray-500 mb-2">Durasi: 45 menit</p>
                            <div class="flex gap-2">
                                <button class="bg-green-50 text-green-600 py-1 px-3 rounded text-xs font-semibold">Approve</button>
                                <button class="bg-red-50 text-red-600 py-1 px-3 rounded text-xs font-semibold">Reject</button>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white shadow rounded-lg overflow-hidden">
                        <img src="https://placehold.co/400x200" class="w-full">
                        <div class="p-4">
                            <h3 class="font-bold text-[var(--burgundy)]">Imam Syafi'i: Si Kecil yang Haus Ilmu</h3>
                            <p class="text-xs text-gray-500 mb-2">Durasi: 35 menit</p>
                            <div class="flex gap-2">
                                <button class="bg-green-50 text-green-600 py-1 px-3 rounded text-xs font-semibold">Approve</button>
                                <button class="bg-red-50 text-red-600 py-1 px-3 rounded text-xs font-semibold">Reject</button>
                            </div>
                        </div>
                    </div>
                </div>
            `,
            articles: `
                <h2 class="text-2xl font-bold text-[var(--burgundy)] mb-6">Manajemen Artikel</h2>
                <div class="space-y-4">
                    <div class="bg-white p-6 rounded-lg shadow">
                        <h3 class="font-bold text-[var(--burgundy)] mb-1">Tutorial Docker untuk Pemula</h3>
                        <p class="text-xs text-gray-500 mb-2">Ahmad Rizki • 245 votes</p>
                        <div class="flex gap-2">
                            <button class="bg-green-50 text-green-600 py-1 px-3 rounded text-xs font-semibold">Approve</button>
                            <button class="bg-red-50 text-red-600 py-1 px-3 rounded text-xs font-semibold">Reject</button>
                        </div>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow">
                        <h3 class="font-bold text-[var(--burgundy)] mb-1">Belajar Laravel 10</h3>
                        <p class="text-xs text-gray-500 mb-2">Siti Nurhaliza • 180 votes</p>
                        <div class="flex gap-2">
                            <button class="bg-green-50 text-green-600 py-1 px-3 rounded text-xs font-semibold">Approve</button>
                            <button class="bg-red-50 text-red-600 py-1 px-3 rounded text-xs font-semibold">Reject</button>
                        </div>
                    </div>
                </div>
            `,
            requests: `
                <h2 class="text-2xl font-bold text-[var(--burgundy)] mb-6">Pending Content Requests</h2>
                <div class="space-y-4">
                    <div class="bg-white p-4 rounded-lg shadow flex flex-col md:flex-row justify-between items-start md:items-center">
                        <div>
                            <h3 class="font-bold text-[var(--burgundy)] mb-1">Tutorial React JS</h3>
                            <p class="text-xs text-gray-500 mb-1">Submitted by Ahmad • 120 votes • <span class="text-red-600 font-semibold">high</span></p>
                        </div>
                        <div class="flex gap-2 mt-2 md:mt-0">
                            <button class="bg-green-50 text-green-600 py-1 px-3 rounded text-xs font-semibold">Approve</button>
                            <button class="bg-red-50 text-red-600 py-1 px-3 rounded text-xs font-semibold">Reject</button>
                        </div>
                    </div>
                    <div class="bg-white p-4 rounded-lg shadow flex flex-col md:flex-row justify-between items-start md:items-center">
                        <div>
                            <h3 class="font-bold text-[var(--burgundy)] mb-1">Tutorial Vue JS</h3>
                            <p class="text-xs text-gray-500 mb-1">Submitted by Siti • 95 votes • <span class="text-yellow-600 font-semibold">medium</span></p>
                        </div>
                        <div class="flex gap-2 mt-2 md:mt-0">
                            <button class="bg-green-50 text-green-600 py-1 px-3 rounded text-xs font-semibold">Approve</button>
                            <button class="bg-red-50 text-red-600 py-1 px-3 rounded text-xs font-semibold">Reject</button>
                        </div>
                    </div>
                </div>
            `
        };

        function showPage(page) {
            const content = document.getElementById('content');
            content.style.opacity = 0;
            setTimeout(() => {
                content.innerHTML = pages[page];
                content.style.opacity = 1;
            }, 150);

            document.querySelectorAll('[id^="nav-"]').forEach(btn => {
                btn.classList.remove('border-b-2', 'border-white');
                btn.classList.add('text-opacity-80');
            });
            document.getElementById('nav-' + page).classList.add('border-b-2', 'border-white');
            document.getElementById('nav-' + page).classList.remove('text-opacity-80');
        }

        function logout() {
            document.body.innerHTML = `
                <div class="flex flex-col items-center justify-center h-screen brand-gradient text-white">
                    <h1 class="text-4xl font-bold mb-4">Terima kasih Admin!</h1>
                    <p class="mb-6 text-white text-opacity-90">Anda telah logout dari dashboard Qissa+.</p>
                    <button onclick="location.reload()" class="bg-white text-[var(--burgundy)] px-6 py-2 rounded-full font-semibold text-sm hover:bg-gray-100">Login Kembali</button>
                </div>
            `;
        }

        showPage('dashboard');
    </script>
</body>
</html>
