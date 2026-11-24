@extends('layout.app')

@section('title', 'Surat Keluar')
@section('jenis', 'keluar')

@section('content')
    <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <p class="eyebrow">Buku agenda</p>
            <h1 class="page-title mt-2">Surat Keluar</h1>
            <p class="mt-2 text-sm text-ink-soft">Surat yang diterbitkan dan dikirim dari instansi.</p>
        </div>
        @can('manage-letters')
            <a href="{{ route('surat-keluar.create') }}" class="btn btn-primary">
                <span class="text-lg leading-none">+</span> Tambah Surat
            </a>
        @endcan
    </div>

    @include('surat._filter', ['route' => 'surat-keluar.index', 'placeholder' => 'Cari nomor, tujuan, atau perihal'])

    <section class="card overflow-hidden">
        <div class="flex items-center justify-between border-b border-line px-6 py-4">
            <p class="text-sm text-ink-soft"><span class="font-semibold text-ink">{{ $suratKeluar->total() }}</span> surat ditemukan</p>
            <span class="stamp">Keluar</span>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full min-w-[940px] text-left text-sm">
                <thead class="border-b border-line text-[11px] tracking-[0.14em] text-ink-faint uppercase">
                    <tr>
                        <th class="px-6 py-3 font-bold">No</th>
                        <th class="px-4 py-3 font-bold">Nomor Surat</th>
                        <th class="px-4 py-3 font-bold">Tanggal</th>
                        <th class="px-4 py-3 font-bold">Tujuan</th>
                        <th class="px-4 py-3 font-bold">Perihal</th>
                        <th class="px-4 py-3 font-bold">Kategori</th>
                        <th class="px-4 py-3 font-bold">Keterangan</th>
                        <th class="px-4 py-3 font-bold"><span class="sr-only">Aksi</span></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-line">
                    @forelse ($suratKeluar as $surat)
                        <tr class="transition hover:bg-paper/60">
                            <td class="px-6 py-4 font-mono text-xs text-ink-faint">{{ str_pad($suratKeluar->firstItem() + $loop->index, 2, '0', STR_PAD_LEFT) }}</td>
                            <td class="px-4 py-4 font-mono text-xs font-medium whitespace-nowrap text-ink">{{ $surat->nomor_surat }}</td>
                            <td class="px-4 py-4 whitespace-nowrap text-ink-soft">{{ $surat->tanggal->format('d-m-Y') }}</td>
                            <td class="px-4 py-4 text-ink-soft">{{ $surat->tujuan }}</td>
                            <td class="px-4 py-4">
                                <span class="font-semibold text-ink">{{ $surat->perihal }}</span>
                                @if ($surat->lampiran)
                                    <span class="ml-1 inline-flex align-middle text-ink-faint" title="Ada lampiran">
                                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m18.375 12.739-7.693 7.693a4.5 4.5 0 0 1-6.364-6.364l10.94-10.94A3 3 0 1 1 19.5 7.372L8.552 18.32m.009-.01-.01.01m5.699-9.941-7.81 7.81a1.5 1.5 0 0 0 2.112 2.13"/></svg>
                                        <span class="sr-only">Ada lampiran</span>
                                    </span>
                                @endif
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap">
                                @if ($surat->category)
                                    <span class="stamp">{{ $surat->category->nama }}</span>
                                @else
                                    <span class="text-xs text-ink-faint">Tanpa kategori</span>
                                @endif
                            </td>
                            <td class="max-w-48 truncate px-4 py-4 text-ink-soft">{{ $surat->keterangan ?: '—' }}</td>
                            <td class="px-4 py-4 whitespace-nowrap">
                                <div class="flex items-center justify-end gap-1">
                                    <a class="link-action text-accent hover:bg-accent/10" href="{{ route('surat-keluar.show', $surat->id) }}">Detail</a>
                                    @can('manage-letters')
                                        <a class="link-action text-ink-soft hover:bg-paper-deep" href="{{ route('surat-keluar.edit', $surat->id) }}">Edit</a>
                                        <form method="POST" action="{{ route('surat-keluar.destroy', $surat->id) }}" onsubmit="return confirm('Hapus surat ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="link-action text-rose-700 hover:bg-rose-50" type="submit">Hapus</button>
                                        </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @empty
                        @include('surat._kosong', ['colspan' => 8, 'jenis' => 'surat keluar'])
                    @endforelse
                </tbody>
            </table>
        </div>
        @include('surat._pagination', ['paginator' => $suratKeluar])
    </section>
@endsection
