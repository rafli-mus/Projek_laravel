@extends('layout.app')

@section('title', 'Tambah Surat Keluar')

@section('content')
    <div class="mx-auto max-w-3xl">
        <a href="{{ route('surat-keluar.index') }}" class="mb-5 inline-flex items-center gap-2 text-sm font-semibold text-slate-500 transition hover:text-indigo-700"><span aria-hidden="true">←</span> Kembali ke daftar</a>
        <div class="mb-6">
            <p class="text-sm font-semibold text-indigo-700">Surat Keluar</p>
            <h1 class="mt-1 text-3xl font-bold tracking-tight text-slate-900">Tambah Surat</h1>
            <p class="mt-2 text-sm text-slate-500">Lengkapi informasi surat yang akan dikirim.</p>
        </div>
        <section class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-8">
            @include('surat-keluar._form', ['action' => route('surat-keluar.store'), 'method' => 'POST', 'surat' => null])
        </section>
    </div>
@endsection
