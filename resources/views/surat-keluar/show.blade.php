@extends('layout.app')

@section('title', 'Detail Surat Keluar')

@section('content')
    <div class="mx-auto max-w-3xl">
        <a href="{{ route('surat-keluar.index') }}" class="mb-5 inline-flex items-center gap-2 text-sm font-semibold text-slate-500 transition hover:text-fuchsia-700"><span aria-hidden="true">←</span> Kembali ke daftar</a>
        <section class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">
            <div class="bg-gradient-to-r from-fuchsia-700 to-violet-800 px-6 py-7 text-white sm:px-8">
                <span class="rounded-full bg-white/15 px-3 py-1 text-xs font-semibold text-fuchsia-50">Detail Surat Keluar</span>
                <h1 class="mt-4 text-2xl font-bold tracking-tight sm:text-3xl">{{ $surat->perihal }}</h1>
                <p class="mt-2 text-sm text-fuchsia-100">{{ $surat->nomor_surat }}</p>
            </div>
            <div class="grid gap-0 sm:grid-cols-2">
                <div class="border-b border-slate-100 px-6 py-5 sm:px-8">
                    <p class="text-xs font-bold uppercase tracking-wider text-slate-400">Tanggal</p>
                    <p class="mt-2 font-semibold text-slate-800">{{ $surat->tanggal->format('d-m-Y') }}</p>
                </div>
                <div class="border-b border-slate-100 px-6 py-5 sm:px-8">
                    <p class="text-xs font-bold uppercase tracking-wider text-slate-400">Tujuan</p>
                    <p class="mt-2 font-semibold text-slate-800">{{ $surat->tujuan }}</p>
                </div>
                <div class="px-6 py-5 sm:col-span-2 sm:px-8">
                    <p class="text-xs font-bold uppercase tracking-wider text-slate-400">Keterangan</p>
                    <p class="mt-2 whitespace-pre-line leading-7 text-slate-700">{{ $surat->keterangan ?: 'Tidak ada keterangan.' }}</p>
                </div>
            </div>
            <div class="flex flex-col-reverse gap-3 border-t border-slate-100 bg-slate-50 px-6 py-4 sm:flex-row sm:justify-end sm:px-8">
                <a href="{{ route('surat-keluar.index') }}" class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-bold text-slate-600 transition hover:bg-slate-100">Kembali</a>
                @can('manage-letters')
                    <a href="{{ route('surat-keluar.edit', $surat->id) }}" class="inline-flex items-center justify-center rounded-xl bg-fuchsia-600 px-4 py-2.5 text-sm font-bold text-white transition hover:bg-fuchsia-700">Edit Surat</a>
                @endcan
            </div>
        </section>
    </div>
@endsection
