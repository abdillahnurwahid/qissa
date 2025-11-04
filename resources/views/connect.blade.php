<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Qissa+ Login & Register</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    :root {
      --burgundy: #912f56;
      --mint: #eaf2ef;
    }

    body {
      background-color: var(--mint);
    }

    .brand-gradient {
      background: linear-gradient(135deg, var(--burgundy) 0%, #b24b77 100%);
    }

    .btn-main {
      background-color: var(--burgundy);
      color: white;
    }

    .btn-main:hover {
      background-color: #7a2548;
    }

    .fade {
      transition: opacity 0.3s ease;
    }
  </style>
</head>
<body class="bg-[var(--mint)] min-h-screen flex items-center justify-center p-6">

  <div class="w-full max-w-md">
    <!-- Wrapper -->
    <div id="card" class="brand-gradient rounded-2xl p-[2px] shadow-xl fade">
      <div class="bg-white rounded-2xl p-8" id="content">

        <!-- Isi akan diubah via JS -->
      </div>
    </div>
  </div>

  <script>
    const content = document.getElementById("content");

    const pages = {
      login: `
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

        <div class="space-y-4">
          <div>
            <label class="block text-xs font-medium text-gray-700 mb-1">Email</label>
            <input type="email" value="user@qissa.com"
              class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--burgundy)] bg-[var(--mint)]"
              placeholder="nama@email.com">
          </div>

          <div>
            <label class="block text-xs font-medium text-gray-700 mb-1">Password</label>
            <input type="password" value="password"
              class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--burgundy)] bg-[var(--mint)]"
              placeholder="password">
          </div>

          <button class="w-full btn-main py-2 rounded-lg text-sm font-semibold shadow-md hover:shadow-lg transition-all">
            Masuk
          </button>
        </div>

        <div class="mt-4 text-center">
          <a href="#" onclick="showPage('register')" class="text-sm text-gray-600">
            Belum punya akun?
            <span class="text-[var(--burgundy)] font-semibold hover:underline">Daftar</span>
          </a>
        </div>
      `,

      register: `
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

        <div class="space-y-4">
          <div>
            <label class="block text-xs font-medium text-gray-700 mb-1">Nama Lengkap</label>
            <input type="text" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--burgundy)] bg-[var(--mint)]" placeholder="Nama lengkap">
          </div>

          <div>
            <label class="block text-xs font-medium text-gray-700 mb-1">Email</label>
            <input type="email" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--burgundy)] bg-[var(--mint)]" placeholder="nama@email.com">
          </div>

          <div>
            <label class="block text-xs font-medium text-gray-700 mb-1">Password</label>
            <input type="password" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--burgundy)] bg-[var(--mint)]" placeholder="password">
          </div>

          <button class="w-full btn-main py-2 rounded-lg text-sm font-semibold shadow-md hover:shadow-lg transition-all">
            Daftar
          </button>
        </div>

        <div class="mt-4 text-center">
          <a href="#" onclick="showPage('login')" class="text-sm text-gray-600">
            Sudah punya akun?
            <span class="text-[var(--burgundy)] font-semibold hover:underline">Masuk</span>
          </a>
        </div>
      `
    };

    function showPage(page) {
      const card = document.getElementById('card');
      card.style.opacity = 0;
      setTimeout(() => {
        content.innerHTML = pages[page];
        card.style.opacity = 1;
      }, 150);
    }

    // Default tampilan awal
    showPage("login");
  </script>
</body>
</html>
