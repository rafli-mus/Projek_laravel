<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') · SIM-Surat</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=fraunces:500,600,700|plus-jakarta-sans:400,500,600,700|jetbrains-mono:500" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
@php
    $menu = [
        ['route' => 'dashboard', 'aktif' => 'dashboard', 'label' => 'Dashboard', 'icon' => 'M3.75 12 12 4.5l8.25 7.5M5.25 10.5v8.25c0 .41.34.75.75.75h3.75v-5.25h4.5v5.25H18c.41 0 .75-.34.75-.75V10.5'],
        ['route' => 'surat-masuk.index', 'aktif' => 'surat-masuk.*', 'label' => 'Surat Masuk', 'icon' => 'M3.75 13.5h4.5l1.5 2.25h4.5l1.5-2.25h4.5M3.75 13.5 6 5.25h12l2.25 8.25v5.25H3.75V13.5ZM12 3.75v6.75m0 0-2.25-2.25M12 10.5l2.25-2.25'],
        ['route' => 'surat-keluar.index', 'aktif' => 'surat-keluar.*', 'label' => 'Surat Keluar', 'icon' => 'M6 12 3.27 3.13A59.8 59.8 0 0 1 21.49 12 59.8 59.8 0 0 1 3.27 20.88L6 12Zm0 0h7.5'],
    ];
@endphp
<body data-jenis="@yield('jenis', 'umum')" class="min-h-screen bg-paper font-sans text-ink antialiased">

    {{-- Sidebar (desktop) --}}
    <aside class="fixed inset-y-0 left-0 z-30 hidden w-72 flex-col bg-brand-deep text-white lg:flex">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-7 pt-8 pb-10">
            @include('layout._logo')
            <span>
                <span class="block font-display text-xl font-semibold tracking-tight">SIM-Surat</span>
                <span class="block text-[11px] font-medium tracking-wide text-white/50">Sistem Informasi Persuratan</span>
            </span>
        </a>

        <p class="px-7 pb-3 text-[10px] font-bold tracking-[0.22em] text-white/35 uppercase">Menu</p>
        <nav class="flex flex-col gap-1 px-4" aria-label="Navigasi utama">
            @foreach ($menu as $item)
                @php $aktif = request()->routeIs($item['aktif']); @endphp
                <a href="{{ route($item['route']) }}" @if ($aktif) aria-current="page" @endif
                   class="group relative flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-semibold transition {{ $aktif ? 'bg-white/10 text-white' : 'text-white/60 hover:bg-white/5 hover:text-white' }}">
                    @if ($aktif)
                        <span class="absolute top-2 bottom-2 -left-4 w-1 rounded-r-full bg-gold"></span>
                    @endif
                    <svg class="h-5 w-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="{{ $item['icon'] }}"/></svg>
                    {{ $item['label'] }}
                </a>
            @endforeach
        </nav>

        @can('manage-letters')
            <div class="mx-4 mt-8 rounded-2xl border border-white/10 bg-white/5 p-4">
                <p class="text-xs font-semibold text-white/80">Catat surat baru</p>
                <div class="mt-3 grid grid-cols-2 gap-2">
                    <a href="{{ route('surat-masuk.create') }}" class="rounded-lg bg-white/10 px-2 py-2 text-center text-xs font-semibold transition hover:bg-white/20">+ Masuk</a>
                    <a href="{{ route('surat-keluar.create') }}" class="rounded-lg bg-white/10 px-2 py-2 text-center text-xs font-semibold transition hover:bg-white/20">+ Keluar</a>
                </div>
            </div>
        @endcan

        @auth
            <div class="mt-auto border-t border-white/10 p-4">
                <div class="flex items-center gap-3 rounded-xl px-3 py-2">
                    <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-gold font-display text-lg font-semibold text-brand-deep">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                    <span class="min-w-0 flex-1">
                        <span class="block truncate text-sm font-semibold">{{ auth()->user()->name }}</span>
                        <span class="block text-xs text-white/50">{{ ucfirst(auth()->user()->role) }}</span>
                    </span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" title="Keluar" class="rounded-lg p-2 text-white/50 transition hover:bg-white/10 hover:text-white">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l3 3m0 0-3 3m3-3H2.25"/></svg>
                            <span class="sr-only">Keluar</span>
                        </button>
                    </form>
                </div>
            </div>
        @endauth
    </aside>

    {{-- Header (mobile) --}}
    <header class="sticky top-0 z-30 bg-brand-deep text-white lg:hidden">
        <details class="group">
            <summary class="flex cursor-pointer list-none items-center justify-between px-4 py-3 [&::-webkit-details-marker]:hidden">
                <span class="flex items-center gap-3">
                    @include('layout._logo', ['kecil' => true])
                    <span class="font-display text-lg font-semibold">SIM-Surat</span>
                </span>
                <span class="rounded-lg border border-white/15 px-3 py-1.5 text-xs font-semibold">
                    <span class="group-open:hidden">Menu</span><span class="hidden group-open:inline">Tutup</span>
                </span>
            </summary>
            <nav class="flex flex-col gap-1 border-t border-white/10 px-3 py-3" aria-label="Navigasi utama">
                @foreach ($menu as $item)
                    <a href="{{ route($item['route']) }}" class="rounded-lg px-3 py-2.5 text-sm font-semibold {{ request()->routeIs($item['aktif']) ? 'bg-white/10 text-white' : 'text-white/70' }}">{{ $item['label'] }}</a>
                @endforeach
                @auth
                    <div class="mt-2 flex items-center justify-between border-t border-white/10 px-3 pt-3">
                        <span class="text-xs text-white/60">{{ auth()->user()->name }} · {{ ucfirst(auth()->user()->role) }}</span>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="rounded-lg bg-white/10 px-3 py-1.5 text-xs font-semibold">Keluar</button>
                        </form>
                    </div>
                @endauth
            </nav>
        </details>
    </header>

    <div class="flex min-h-screen flex-col lg:pl-72">
        <main class="mx-auto w-full max-w-6xl flex-1 px-4 py-8 sm:px-6 lg:px-10 lg:py-12">
            @if (session('success'))
                <div role="status" class="mb-6 flex items-start gap-3 rounded-xl border border-emerald-800/15 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-900">
                    <svg class="mt-0.5 h-5 w-5 shrink-0" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm3.78-9.72a.75.75 0 0 0-1.06-1.06l-3.47 3.47-1.47-1.47a.75.75 0 0 0-1.06 1.06l2 2a.75.75 0 0 0 1.06 0l4-4Z" clip-rule="evenodd"/></svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif
            @yield('content')
        </main>

        <footer class="mx-auto w-full max-w-6xl px-4 pb-8 sm:px-6 lg:px-10">
            <div class="flex flex-col gap-1 border-t border-line pt-5 text-xs text-ink-faint sm:flex-row sm:justify-between">
                <p>© {{ date('Y') }} SIM-Surat</p>
                <p>Arsip surat masuk & keluar yang tertata.</p>
            </div>
        </footer>
    </div>
</body>
</html>
