<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login SIM-Surat</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-950 font-sans text-slate-900 antialiased">
    <main class="grid min-h-screen lg:grid-cols-2">
        <section class="relative flex items-center justify-center overflow-hidden bg-gradient-to-br from-violet-700 via-violet-800 to-fuchsia-950 px-6 py-16 text-white sm:px-10 lg:px-16">
            <div class="absolute -right-24 -top-24 h-80 w-80 rounded-full border border-white/10"></div>
            <div class="absolute -bottom-36 -left-20 h-96 w-96 rounded-full border border-white/10"></div>
            <div class="relative max-w-xl">
                <span class="mb-8 inline-flex h-14 w-14 items-center justify-center rounded-2xl bg-white/10 ring-1 ring-white/20 backdrop-blur">
                    <svg class="h-8 w-8" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M7 3.75h7l4.25 4.5v11A1.75 1.75 0 0 1 16.5 21h-9A1.75 1.75 0 0 1 5.75 19.25v-13.75A1.75 1.75 0 0 1 7.5 3.75Z" stroke="currentColor" stroke-width="1.6"/><path d="M14 4v4.5h4M8.5 12h7M8.5 15.5h7" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </span>
                <p class="mb-3 text-sm font-bold uppercase tracking-[0.24em] text-violet-200">SIM-Surat</p>
                <h1 class="max-w-lg text-4xl font-bold leading-tight tracking-tight sm:text-5xl">Urus persuratan dengan lebih mudah.</h1>
                <p class="mt-5 max-w-lg text-base leading-7 text-violet-100/80">Satu tempat untuk melihat, mencatat, dan mengelola surat masuk serta surat keluar.</p>
                <div class="mt-10 hidden items-center gap-3 text-sm text-violet-100/80 sm:flex">
                    <span class="flex h-9 w-9 items-center justify-center rounded-full bg-white/10">✓</span>
                    <span>Akses aman sesuai peran pengguna</span>
                </div>
            </div>
        </section>

        <section class="flex items-center justify-center bg-slate-50 px-5 py-12 sm:px-10">
            <div class="w-full max-w-md">
                <div class="mb-8 lg:hidden">
                    <p class="text-sm font-bold uppercase tracking-[0.2em] text-violet-700">SIM-Surat</p>
                </div>
                <div class="rounded-3xl border border-slate-200 bg-white p-7 shadow-xl shadow-slate-900/5 sm:p-10">
                    <div class="mb-8">
                        <p class="text-sm font-semibold text-violet-700">Selamat datang kembali</p>
                        <h2 class="mt-2 text-3xl font-bold tracking-tight text-slate-900">Masuk ke akun</h2>
                        <p class="mt-2 text-sm leading-6 text-slate-500">Masukkan email dan password yang terdaftar.</p>
                    </div>

                    @if ($errors->has('email'))
                        <p role="alert" class="mb-4 rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm font-medium text-rose-700">{{ $errors->first('email') }}</p>
                    @endif

                    @if ($errors->has('password'))
                        <p role="alert" class="mb-4 rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm font-medium text-rose-700">{{ $errors->first('password') }}</p>
                    @endif

                    <form method="POST" action="{{ route('login.submit') }}" class="space-y-5">
                        @csrf
                        <div>
                            <label for="email" class="mb-2 block text-sm font-semibold text-slate-700">Email</label>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="nama@contoh.com" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-violet-500 focus:ring-4 focus:ring-violet-500/10">
                        </div>
                        <div>
                            <label for="password" class="mb-2 block text-sm font-semibold text-slate-700">Password</label>
                            <input id="password" type="password" name="password" required autocomplete="current-password" placeholder="Masukkan password" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-violet-500 focus:ring-4 focus:ring-violet-500/10">
                        </div>
                        <button type="submit" class="flex w-full items-center justify-center gap-2 rounded-xl bg-violet-600 px-4 py-3 text-sm font-bold text-white shadow-lg shadow-violet-600/20 transition hover:bg-violet-700 focus:outline-none focus:ring-4 focus:ring-violet-500/20">
                            Masuk
                            <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M3 10a.75.75 0 0 1 .75-.75h10.69L10.22 5.03a.75.75 0 1 1 1.06-1.06l5.5 5.5a.75.75 0 0 1 0 1.06l-5.5 5.5a.75.75 0 1 1-1.06-1.06l4.22-4.22H3.75A.75.75 0 0 1 3 10Z" clip-rule="evenodd"/></svg>
                        </button>
                    </form>
                </div>
                <p class="mt-6 text-center text-xs text-slate-500">SIM-Surat · Sistem Informasi Persuratan</p>
            </div>
        </section>
    </main>
</body>
</html>
