{{-- view resources/views/layouts/admin.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Qissa+ Admin Dashboard')</title>
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
    @livewireStyles
</head>
<body class="bg-[var(--mint)]">

    @include('layouts.partials.admin-header')

    <div class="max-w-6xl mx-auto px-6 py-12 transition-all duration-300">
        {{ $slot }}
    </div>

    @include('layouts.partials.footer')

    @livewireScripts
</body>
</html>