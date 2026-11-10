
@extends('layout.app')

@section('title', 'Dashboard')

@section('content')
    <section class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-blue-700 via-blue-700 to-indigo-900 px-6 py-10 text-white shadow-xl shadow-blue-900/10 sm:px-10 sm:py-14">
        <div class="absolute -right-16 -top-24 h-72 w-72 rounded-full border border-white/10"></div>
        <div class="absolute -bottom-36 right-36 h-72 w-72 rounded-full border border-white/10"></div>
        <div class="relative max-w-2xl">
            <span class="inline-flex items-center gap-2 rounded-full bg-white/10 px-3 py-1.5 text-xs font-semibold text-blue-100 ring-1 ring-white/15">
                <span class="h-2 w-2 rounded-full bg-emerald-300"></span>
                Sistem siap digunakan
            </span>
            <h1 class="mt-5 text-3xl font-bold tracking-tight sm:text-4xl">Selamat datang di SIM-Surat</h1>
            <p class="mt-3 max-w-xl text-sm leading-6 text-blue-100 sm:text-base">Kelola surat masuk dan surat keluar dalam satu tempat. Pilih menu untuk mulai melihat data persuratan.</p>
            <div class="mt-7 flex flex-wrap gap-3">
                <a href="{{ route('surat-masuk.index') }}" class="inline-flex items-center gap-2 rounded-xl bg-white px-4 py-3 text-sm font-bold text-blue-700 shadow-lg transition hover:bg-blue-50">
                    Lihat Surat Masuk <span aria-hidden="true">→</span>
                </a>
                <a href="{{ route('surat-keluar.index') }}" class="inline-flex items-center gap-2 rounded-xl border border-white/25 bg-white/10 px-4 py-3 text-sm font-bold text-white transition hover:bg-white/15">
                    Lihat Surat Keluar <span aria-hidden="true">→</span>
                </a>
            </div>
        </div>
    </section>

    <section class="mt-8 grid gap-5 md:grid-cols-2">
        <a href="{{ route('surat-masuk.index') }}" class="group rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-0.5 hover:border-blue-200 hover:shadow-lg hover:shadow-blue-900/5">
            <span class="flex h-12 w-12 items-center justify-center rounded-xl bg-blue-50 text-blue-700">
                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M4 7.75A2.75 2.75 0 0 1 6.75 5h10.5A2.75 2.75 0 0 1 20 7.75v8.5A2.75 2.75 0 0 1 17.25 19H6.75A2.75 2.75 0 0 1 4 16.25v-8.5Z" stroke="currentColor" stroke-width="1.7"/><path d="m5 7 7 5 7-5" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </span>
            <h2 class="mt-5 text-lg font-bold text-slate-900">Surat Masuk</h2>
            <p class="mt-2 text-sm leading-6 text-slate-500">Lihat daftar, detail, dan kelola surat yang diterima.</p>
            <span class="mt-5 inline-flex items-center gap-2 text-sm font-bold text-blue-700">Buka daftar <span class="transition group-hover:translate-x-1">→</span></span>
        </a>

        <a href="{{ route('surat-keluar.index') }}" class="group rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-0.5 hover:border-indigo-200 hover:shadow-lg hover:shadow-indigo-900/5">
            <span class="flex h-12 w-12 items-center justify-center rounded-xl bg-indigo-50 text-indigo-700">
                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M20 4 10.8 13.2M20 4l-5.8 16-3.4-6.6L4 10l16-6Z" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </span>
            <h2 class="mt-5 text-lg font-bold text-slate-900">Surat Keluar</h2>
            <p class="mt-2 text-sm leading-6 text-slate-500">Lihat daftar, detail, dan kelola surat yang dikirim.</p>
            <span class="mt-5 inline-flex items-center gap-2 text-sm font-bold text-indigo-700">Buka daftar <span class="transition group-hover:translate-x-1">→</span></span>
        </a>
    </section>
@endsection
