<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Masuk') — InvenSpace</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-50 text-slate-800 antialiased">
    <div class="min-h-screen grid lg:grid-cols-2">

        <div class="hidden lg:flex flex-col justify-between bg-gradient-to-br from-indigo-600 via-indigo-700 to-violet-800 text-white p-10">
            <div class="flex items-center gap-2">
                <div class="w-9 h-9 rounded-lg bg-white/15 flex items-center justify-center font-bold">I</div>
                <span class="font-semibold">InvenSpace</span>
            </div>
            <div class="space-y-3 max-w-md">
                <h2 class="text-3xl font-bold leading-tight">Kelola inventaris sekolah dengan mudah.</h2>
                <p class="text-indigo-100 text-sm leading-relaxed">Pantau stok barang, ajukan peminjaman, dan tangani komplain dalam satu platform terpadu.</p>
            </div>
            <div class="text-xs text-indigo-200">&copy; {{ date('Y') }} InvenSpace</div>
        </div>

        <div class="flex items-center justify-center p-6">
            <div class="w-full max-w-sm">@yield('content')</div>
        </div>
    </div>
</body>
</html>
