<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login SIM-Surat</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=fraunces:500,600,700|plus-jakarta-sans:400,500,600,700|jetbrains-mono:500" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-paper font-sans text-ink antialiased">
    <main class="grid min-h-screen lg:grid-cols-[1.1fr_1fr]">
        {{-- Panel kiri --}}
        <section class="relative hidden overflow-hidden bg-brand-deep px-14 py-14 text-white lg:flex lg:flex-col">
            <div class="flex items-center gap-3">
                @include('layout._logo')
                <span class="font-display text-xl font-semibold">SIM-Surat</span>
            </div>

            <div class="relative my-auto max-w-lg">
                <p class="text-[11px] font-bold tracking-[0.24em] text-gold uppercase">Sistem Informasi Persuratan</p>
                <h1 class="mt-5 font-display text-5xl leading-[1.1] font-semibold tracking-tight">Setiap surat tercatat, setiap arsip mudah ditemukan.</h1>
                <p class="mt-6 max-w-md text-base leading-7 text-white/60">Catat surat masuk dan keluar, beri kategori, lampirkan dokumen, lalu temukan kembali dalam hitungan detik.</p>
            </div>

            {{-- Ilustrasi amplop bercap --}}
            <div class="pointer-events-none absolute -right-16 -bottom-10 rotate-[-8deg] opacity-90" aria-hidden="true">
                <div class="relative h-56 w-80 rounded-2xl border border-white/15 bg-white/5">
                    <svg class="absolute inset-0 h-full w-full text-white/15" viewBox="0 0 320 224" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M8 12 160 120 312 12"/></svg>
                    <span class="absolute top-6 right-6 flex h-20 w-20 rotate-12 items-center justify-center rounded-full border-2 border-dashed border-gold/70 text-center font-display text-[11px] leading-tight font-semibold text-gold uppercase">Arsip<br>Tercatat</span>
                </div>
            </div>

            <p class="relative text-xs text-white/40">© {{ date('Y') }} SIM-Surat</p>
        </section>

        {{-- Form --}}
        <section class="flex items-center justify-center px-5 py-12 sm:px-10">
            <div class="w-full max-w-sm">
                <div class="mb-10 flex items-center gap-3 lg:hidden">
                    <span class="flex h-11 w-11 items-center justify-center rounded-full bg-brand-deep">@include('layout._logo', ['kecil' => true])</span>
                    <span class="font-display text-xl font-semibold">SIM-Surat</span>
                </div>

                <p class="eyebrow">Selamat datang kembali</p>
                <h2 class="mt-3 font-display text-4xl font-semibold tracking-tight">Masuk ke akun</h2>
                <p class="mt-3 text-sm leading-6 text-ink-soft">Gunakan email dan password yang terdaftar.</p>

                @if ($errors->any())
                    <p role="alert" class="mt-6 rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm font-medium text-rose-800">{{ $errors->first('email') ?: $errors->first('password') }}</p>
                @endif

                <form method="POST" action="{{ route('login.submit') }}" class="mt-8 space-y-5">
                    @csrf
                    <div>
                        <label for="email" class="label">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="nama@contoh.com" class="field py-3">
                    </div>
                    <div>
                        <label for="password" class="label">Password</label>
                        <input id="password" type="password" name="password" required autocomplete="current-password" placeholder="Masukkan password" class="field py-3">
                    </div>
                    <button type="submit" class="btn btn-primary w-full py-3">
                        Masuk
                        <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M3 10a.75.75 0 0 1 .75-.75h10.69L10.22 5.03a.75.75 0 1 1 1.06-1.06l5.5 5.5a.75.75 0 0 1 0 1.06l-5.5 5.5a.75.75 0 1 1-1.06-1.06l4.22-4.22H3.75A.75.75 0 0 1 3 10Z" clip-rule="evenodd"/></svg>
                    </button>
                </form>
            </div>
        </section>
    </main>
</body>
</html>
