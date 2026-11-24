@extends('layout.app')

@section('title', 'Dashboard')

@section('content')
    @php
        $kartu = [
            ['label' => 'Surat masuk', 'nilai' => $statistik['masuk'], 'warna' => 'text-masuk', 'ket' => 'total tercatat'],
            ['label' => 'Surat keluar', 'nilai' => $statistik['keluar'], 'warna' => 'text-keluar', 'ket' => 'total tercatat'],
            ['label' => 'Bulan ini', 'nilai' => $statistik['bulanIni'], 'warna' => 'text-ink', 'ket' => now()->locale('id')->translatedFormat('F Y')],
            ['label' => 'Berlampiran', 'nilai' => $statistik['lampiran'], 'warna' => 'text-ink', 'ket' => 'surat dengan file'],
        ];

        $baris = $categories->map(fn ($k) => [
            'nama' => $k->nama,
            'masuk' => $k->incoming_letters_count,
            'keluar' => $k->outgoing_letters_count,
        ])->push(['nama' => 'Tanpa kategori', 'masuk' => $tanpaKategori['masuk'], 'keluar' => $tanpaKategori['keluar']]);
        $maks = max(1, $baris->max(fn ($b) => $b['masuk'] + $b['keluar']));

        $daftarTerbaru = [
            ['judul' => 'Surat masuk terbaru', 'jenis' => 'masuk', 'data' => $terbaruMasuk, 'route' => 'surat-masuk', 'pihak' => 'pengirim', 'awalan' => 'Dari'],
            ['judul' => 'Surat keluar terbaru', 'jenis' => 'keluar', 'data' => $terbaruKeluar, 'route' => 'surat-keluar', 'pihak' => 'tujuan', 'awalan' => 'Kepada'],
        ];
    @endphp

    {{-- Sambutan --}}
    <div class="flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <p class="eyebrow">{{ now()->locale('id')->translatedFormat('l, d F Y') }}</p>
            <h1 class="page-title mt-2">Halo, {{ auth()->user()->name }}.</h1>
            <p class="mt-2 max-w-xl text-sm leading-6 text-ink-soft">Berikut ringkasan arsip persuratan hari ini.</p>
        </div>
    </div>

    {{-- Statistik --}}
    <section class="mt-8 grid grid-cols-2 gap-px overflow-hidden rounded-2xl border border-line bg-line lg:grid-cols-4">
        @foreach ($kartu as $k)
            <div class="bg-surface px-5 py-6">
                <p class="text-xs font-semibold text-ink-soft">{{ $k['label'] }}</p>
                <p class="mt-3 font-display text-4xl font-semibold tracking-tight {{ $k['warna'] }}">{{ $k['nilai'] }}</p>
                <p class="mt-1 text-xs text-ink-faint">{{ $k['ket'] }}</p>
            </div>
        @endforeach
    </section>

    <div class="mt-8 grid gap-6 lg:grid-cols-5">
        {{-- Sebaran kategori --}}
        <section class="card p-6 lg:col-span-2">
            <h2 class="font-display text-xl font-semibold">Sebaran kategori</h2>
            <div class="mt-2 flex gap-4 text-xs text-ink-soft">
                <span class="inline-flex items-center gap-1.5"><span class="h-2.5 w-2.5 rounded-sm bg-masuk"></span>Masuk</span>
                <span class="inline-flex items-center gap-1.5"><span class="h-2.5 w-2.5 rounded-sm bg-keluar"></span>Keluar</span>
            </div>
            <ul class="mt-6 space-y-5">
                @foreach ($baris as $b)
                    <li>
                        <div class="flex items-baseline justify-between text-sm">
                            <span class="font-semibold {{ $loop->last ? 'text-ink-faint' : 'text-ink' }}">{{ $b['nama'] }}</span>
                            <span class="font-mono text-xs text-ink-soft">{{ $b['masuk'] + $b['keluar'] }}</span>
                        </div>
                        <div class="mt-2 flex h-2.5 overflow-hidden rounded-full bg-paper-deep">
                            <span class="bg-masuk" style="width: {{ $b['masuk'] / $maks * 100 }}%"></span>
                            <span class="bg-keluar" style="width: {{ $b['keluar'] / $maks * 100 }}%"></span>
                        </div>
                    </li>
                @endforeach
            </ul>
        </section>

        {{-- Surat terbaru --}}
        <div class="grid gap-6 lg:col-span-3">
            @foreach ($daftarTerbaru as $d)
                <section class="card overflow-hidden" data-jenis="{{ $d['jenis'] }}">
                    <div class="flex items-center justify-between border-b border-line px-6 py-4">
                        <h2 class="font-display text-xl font-semibold">{{ $d['judul'] }}</h2>
                        <a href="{{ route($d['route'] . '.index') }}" class="text-xs font-bold text-accent hover:underline">Lihat semua →</a>
                    </div>
                    <ul class="divide-y divide-line">
                        @forelse ($d['data'] as $surat)
                            <li>
                                <a href="{{ route($d['route'] . '.show', $surat->id) }}" class="flex items-center gap-4 px-6 py-3.5 transition hover:bg-paper/60">
                                    <span class="w-11 shrink-0 text-center">
                                        <span class="block font-display text-xl leading-none font-semibold text-accent">{{ $surat->tanggal->format('d') }}</span>
                                        <span class="block text-[10px] font-bold tracking-wider text-ink-faint uppercase">{{ $surat->tanggal->locale('id')->translatedFormat('M') }}</span>
                                    </span>
                                    <span class="min-w-0 flex-1">
                                        <span class="block truncate text-sm font-semibold text-ink">{{ $surat->perihal }}</span>
                                        <span class="block truncate text-xs text-ink-soft">{{ $d['awalan'] }} {{ $surat->{$d['pihak']} }}</span>
                                    </span>
                                    @if ($surat->category)
                                        <span class="stamp hidden sm:inline-flex">{{ $surat->category->nama }}</span>
                                    @endif
                                </a>
                            </li>
                        @empty
                            <li class="px-6 py-8 text-center text-sm text-ink-faint">Belum ada surat.</li>
                        @endforelse
                    </ul>
                </section>
            @endforeach
        </div>
    </div>
@endsection
