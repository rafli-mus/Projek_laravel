@extends('layout.app')

@section('title', 'Edit Surat Masuk')

@section('content')
    <div class="mx-auto max-w-3xl">
        <a href="{{ route('surat-masuk.index') }}" class="mb-5 inline-flex items-center gap-2 text-sm font-semibold text-slate-500 transition hover:text-violet-700"><span aria-hidden="true">←</span> Kembali ke daftar</a>
        <div class="mb-6">
            <p class="text-sm font-semibold text-violet-700">Surat Masuk</p>
            <h1 class="mt-1 text-3xl font-bold tracking-tight text-slate-900">Edit Surat</h1>
            <p class="mt-2 text-sm text-slate-500">Perbarui informasi surat masuk yang dipilih.</p>
        </div>
        <section class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-8">
            @include('surat-masuk._form', ['action' => route('surat-masuk.update', $surat->id), 'method' => 'PUT', 'surat' => $surat])
        </section>
    </div>
@endsection
