<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Qissa+ User Dashboard</title>
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
    <div class="brand-gradient text-white py-10 shadow-md">
        <div class="max-w-6xl mx-auto px-6 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 bg-white bg-opacity-20 rounded-xl flex items-center justify-center">
                    <span class="text-2xl font-bold">Q+</span>
                </div>
                <div>
                    <h1 class="text-3xl font-bold">Qissa+</h1>
                    {{-- <p class="text-sm text-white text-opacity-90">Platform Pembelajaran Video dan Artikel</p> --}}
                </div>
            </div>
            <div class="flex items-center gap-4 text-sm">
                <button onclick="showPage('home')" id="nav-home" class="font-semibold text-white border-b-2 border-white">Home</button>
                <button onclick="showPage('video')" id="nav-video" class="font-semibold text-white text-opacity-80 hover:text-opacity-100">Video</button>
                <button onclick="showPage('artikel')" id="nav-artikel" class="font-semibold text-white text-opacity-80 hover:text-opacity-100">Artikel</button>
                <button onclick="showPage('favorit')" id="nav-favorit" class="font-semibold text-white text-opacity-80 hover:text-opacity-100">Favorit</button>
                <button onclick="logout()" class="bg-white text-[var(--burgundy)] px-4 py-2 rounded-full font-semibold text-sm hover:bg-gray-100">Logout</button>
            </div>
        </div>
    </div>

    <!-- Dashboard Container -->
    <div id="content" class="max-w-6xl mx-auto px-6 py-12 transition-all duration-300"></div>

    <!-- Footer -->
    <div class="bg-[var(--burgundy)] text-white py-6 mt-16">
        <div class="max-w-6xl mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <div class="flex items-center gap-2 mb-4">
                        <div class="w-10 h-10 bg-white bg-opacity-20 rounded-lg flex items-center justify-center">
                            <span class="text-white font-bold">Q+</span>
                        </div>
                        <span class="text-xl font-bold">Qissa+</span>
                    </div>
                    <p class="text-gray-200 text-sm">Platform pembelajaran video dan artikel terbaik untuk meningkatkan skill Anda.</p>
                </div>
                <div>
                    {{-- <h3 class="font-bold mb-4">Tech Stack</h3> --}}
                    {{-- <ul class="space-y-2 text-sm text-gray-200">
                        <li>• Laravel 10</li>
                        <li>• Livewire 3</li>
                        <li>• Tailwind CSS</li>
                        <li>• Alpine.js</li>
                        <li>• MySQL</li>
                    </ul> --}}
                </div>
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
        // halaman konten
        const pages = {
            home: `
                <div class="bg-[var(--burgundy)] rounded-2xl p-8 text-white mb-6 shadow-lg">
                    <h1 class="text-3xl font-bold mb-2">Selamat Datang di Qissa+</h1>
                    <p class="text-white text-opacity-90 mb-4">Platform pembelajaran video dan artikel terbaik</p>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-10">
                    <div class="bg-white rounded-xl p-4 text-center shadow">
                        <div class="text-2xl mb-1"></div>
                        <div class="text-2xl font-bold text-[var(--burgundy)]">1,234</div>
                        <div class="text-xs text-gray-600">Video Tersedia</div>
                    </div>
                    <div class="bg-white rounded-xl p-4 text-center shadow">
                        <div class="text-2xl mb-1"></div>
                        <div class="text-2xl font-bold text-[var(--burgundy)]">856</div>
                        <div class="text-xs text-gray-600">Artikel Tersedia</div>
                    </div>
                    <div class="bg-white rounded-xl p-4 text-center shadow">
                        <div class="text-2xl mb-1"></div>
                        <div class="text-2xl font-bold text-[var(--burgundy)]">45.2K</div>
                        <div class="text-xs text-gray-600">Pengguna Aktif</div>
                    </div>
                    <div class="bg-white rounded-xl p-4 text-center shadow">
                        <div class="text-2xl mb-1"></div>
                        <div class="text-2xl font-bold text-[var(--burgundy)]">4.8</div>
                        <div class="text-xs text-gray-600">Rating Platform</div>
                    </div>
                </div>

                <div>
                    <h3 class="text-lg font-bold text-[var(--burgundy)] mb-3">Kategori Populer</h3>
                    <div class="grid grid-cols-2 md:grid-cols-5 gap-3">
                        <div class="bg-white border-2 border-[var(--burgundy)] text-[var(--burgundy)] p-4 rounded-xl text-center font-bold text-sm">Sirah Nabawiyah</div>
                        <div class="bg-white border-2 border-[var(--burgundy)] text-[var(--burgundy)] p-4 rounded-xl text-center font-bold text-sm">Kisah Para Nabi</div>
                        <div class="bg-white border-2 border-[var(--burgundy)] text-[var(--burgundy)] p-4 rounded-xl text-center font-bold text-sm">Khulafaur Rasyidin</div>
                        <div class="bg-white border-2 border-[var(--burgundy)] text-[var(--burgundy)] p-4 rounded-xl text-center font-bold text-sm">Keemasan Islam</div>
                        <div class="bg-white border-2 border-[var(--burgundy)] text-[var(--burgundy)] p-4 rounded-xl text-center font-bold text-sm">Akhir Zaman</div>
                    </div>
                </div>
            `,
            video: `
            <h2 class="text-2xl font-bold text-[var(--burgundy)] mb-6">Koleksi Video Pembelajaran</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-white shadow rounded-lg overflow-hidden">
                        <img src="https://placehold.co/400x200" class="w-full">
                        <div class="p-4">
                            <h3 class="font-bold text-[var(--burgundy)]">Muhammad Al-Fatih: Pemuda Penakluk Konstantinopel</h3>
                            <p class="text-sm text-gray-500 mb-3">Durasi: 45 menit</p>
                            <button class="btn-main px-4 py-2 rounded-md text-sm">Tonton</button>
                        </div>
                    </div>
                    <div class="bg-white shadow rounded-lg overflow-hidden">
                        <img src="https://placehold.co/400x200" class="w-full">
                        <div class="p-4">
                            <h3 class="font-bold text-[var(--burgundy)]">Imam Syafi'i: Si Kecil yang Haus Ilmu</h3>
                            <p class="text-sm text-gray-500 mb-3">Durasi: 35 menit</p>
                            <button class="btn-main px-4 py-2 rounded-md text-sm">Tonton</button>
                        </div>
                    </div>
                    <div class="bg-white shadow rounded-lg overflow-hidden">
                        <img src="https://placehold.co/400x200" class="w-full">
                        <div class="p-4">
                            <h3 class="font-bold text-[var(--burgundy)]">Tanda-Tanda Kiamat yang Sudah Terjadi</h3>
                            <p class="text-sm text-gray-500 mb-3">Durasi: 50 menit</p>
                            <button class="btn-main px-4 py-2 rounded-md text-sm">Tonton</button>
                        </div>
                    </div>
                </div>
            `,
            artikel: `
               <h2 class="text-2xl font-bold text-[var(--burgundy)] mb-6">Artikel Terbaru</h2>
                <div class="space-y-4">
                    <div class="bg-white p-6 rounded-lg shadow">
                        <h3 class="font-bold text-[var(--burgundy)] mb-2">Pemuda Jujur dari Makkah</h3>
                        <p class="text-sm text-gray-600">Nabi Muhammad ﷺ dikenal sebagai Al-Amin, sosok jujur yang dipercaya semua orang bahkan sebelum menjadi Rasul.</p>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow">
                        <h3 class="font-bold text-[var(--burgundy)] mb-2">Perang Badar: 313 vs 1000</h3>
                        <p class="text-sm text-gray-600">Pasukan kecil kaum Muslim menghadapi ribuan musuh, namun kemenangan datang berkat iman dan doa.</p>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow">
                        <h3 class="font-bold text-[var(--burgundy)] mb-2">Nabi Yusuf: Dari Sumur ke Istana</h3>
                        <p class="text-sm text-gray-600">Dikhianati dan dipenjara, Nabi Yusuf tetap sabar hingga Allah memuliakannya sebagai penguasa Mesir.</p>
                    </div>
                </div>

            `,
            favorit: `
               <h2 class="text-2xl font-bold text-[var(--burgundy)] mb-6">Konten Favorit Kamu</h2>

               <div class="space-y-4">
                  <!-- Artikel Favorit -->
                  <div class="bg-white p-6 rounded-lg shadow">
                       <h3 class="font-bold text-[var(--burgundy)] mb-2">Umar bin Khattab: Pemimpin yang Menangis</h3>
                       <p class="text-sm text-gray-600">Dikenal tegas di siang hari, namun lembut di malam hari. Umar bin Khattab memimpin dengan hati dan takut kepada Allah.</p>
                  </div>

                  <!-- Video Favorit -->
                  <div class="bg-white p-6 rounded-lg shadow flex items-start space-x-4">
                       <img src="thumbnail-umat-islam.jpg" alt="Video Umar bin Khattab" class="w-32 h-20 object-cover rounded">
                       <div>
                           <h3 class="font-bold text-[var(--burgundy)] mb-2">Video: Kisah Umar bin Khattab</h3>
                           <p class="text-sm text-gray-600">Tonton perjalanan Umar bin Khattab dalam memimpin umat dengan adil dan bijaksana. Video berdurasi 5 menit yang menginspirasi.</p>
                       </div>
                </div>

                  <!-- Artikel Favorit -->
                  <div class="bg-white p-6 rounded-lg shadow">
                       <h3 class="font-bold text-[var(--burgundy)] mb-2">Muhammad Al-Fatih: Penakluk Muda</h3>
                       <p class="text-sm text-gray-600">Di usia 21 tahun, Al-Fatih menaklukkan Konstantinopel sesuai sabda Rasulullah ﷺ — bukti kekuatan iman dan ilmu.</p>
                  </div>

                  <!-- Video Favorit -->
                  <div class="bg-white p-6 rounded-lg shadow flex items-start space-x-4">
                       <img src="thumbnail-al-fatih.jpg" alt="Video Muhammad Al-Fatih" class="w-32 h-20 object-cover rounded">
                       <div>
                          <h3 class="font-bold text-[var(--burgundy)] mb-2">Video: Muhammad Al-Fatih</h3>
                          <p class="text-sm text-gray-600">Lihat strategi dan keberanian Al-Fatih menaklukkan Konstantinopel dalam video singkat yang penuh inspirasi.</p>
                       </div>
                  </div>
               </div>
            `
        };

        // ganti halaman
        function showPage(page) {
            const content = document.getElementById('content');
            content.style.opacity = 0;
            setTimeout(() => {
                content.innerHTML = pages[page];
                content.style.opacity = 1;
            }, 200);

            document.querySelectorAll('[id^="nav-"]').forEach(btn => {
                btn.classList.remove('border-b-2', 'border-white');
                btn.classList.add('text-opacity-80');
            });
            document.getElementById('nav-' + page).classList.add('border-b-2', 'border-white');
            document.getElementById('nav-' + page).classList.remove('text-opacity-80');
        }

        // fungsi logout
        function logout() {
            document.body.innerHTML = `
                <div class="flex flex-col items-center justify-center h-screen brand-gradient text-white">
                    <h1 class="text-4xl font-bold mb-4">Terima kasih telah belajar di Qissa+</h1>
                    <p class="mb-6 text-white text-opacity-90">Anda telah berhasil logout.</p>
                    <button onclick="location.reload()" class="bg-white text-[var(--burgundy)] px-6 py-2 rounded-full font-semibold text-sm hover:bg-gray-100">Login Kembali</button>
                </div>
            `;
        }

        // halaman awal
        showPage('home');
    </script>
</body>
</html>
