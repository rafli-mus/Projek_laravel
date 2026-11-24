@extends('layout.app')

@section('title', 'Tambah Surat Masuk')
@section('jenis', 'masuk')

@section('content')
    <div class="mx-auto max-w-3xl">
        <a href="{{ route('surat-masuk.index') }}" class="mb-6 inline-flex items-center gap-2 text-sm font-semibold text-ink-soft transition hover:text-accent"><span aria-hidden="true">←</span> Kembali ke daftar</a>
        <div class="mb-6">
            <p class="eyebrow">Surat Masuk</p>
            <h1 class="page-title mt-2">Tambah Surat</h1>
            <p class="mt-2 text-sm text-ink-soft">Catat surat yang diterima ke dalam arsip.</p>
        </div>
        <section class="card p-6 sm:p-8">
            @include('surat._form', [
                'action' => route('surat-masuk.store'),
                'method' => 'POST',
                'surat' => null,
                'route' => 'surat-masuk',
                'pihakField' => 'pengirim',
                'pihakLabel' => 'Pengirim',
            ])
        </section>
    </div>
@endsection
