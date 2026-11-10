
@extends('layout.app')

@section('title', 'Daftar Surat Masuk')

@section('content')
    <div class="mb-7 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <p class="text-sm font-semibold text-violet-700">Arsip persuratan</p>
            <h1 class="mt-1 text-3xl font-bold tracking-tight text-slate-900">Surat Masuk</h1>
            <p class="mt-2 text-sm text-slate-500">Daftar surat yang diterima dan tercatat dalam sistem.</p>
        </div>
        @can('manage-letters')
            <a href="{{ route('surat-masuk.create') }}" class="inline-flex items-center justify-center gap-2 rounded-xl bg-violet-600 px-4 py-3 text-sm font-bold text-white shadow-lg shadow-violet-600/20 transition hover:bg-violet-700">
                <span class="text-lg leading-none">+</span> Tambah Surat
            </a>
        @endcan
    </div>

    <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
        <div class="flex items-center justify-between border-b border-slate-100 px-5 py-4 sm:px-6">
            <div>
                <h2 class="font-bold text-slate-900">Daftar surat</h2>
                <p class="mt-1 text-xs text-slate-500">{{ $suratMasuk->count() }} surat tercatat</p>
            </div>
            <span class="rounded-full bg-violet-50 px-3 py-1 text-xs font-semibold text-violet-700">Surat Masuk</span>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full min-w-[760px] text-left text-sm">
                <thead class="bg-slate-50 text-xs uppercase tracking-wider text-slate-500">
                    <tr>
                        <th class="px-5 py-3.5 font-bold sm:px-6">No</th>
                        <th class="px-5 py-3.5 font-bold">Nomor Surat</th>
                        <th class="px-5 py-3.5 font-bold">Tanggal</th>
                        <th class="px-5 py-3.5 font-bold">Pengirim</th>
                        <th class="px-5 py-3.5 font-bold">Perihal</th>
                        <th class="px-5 py-3.5 font-bold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($suratMasuk as $surat)
                <tr class="transition hover:bg-slate-50/80">
                    <td class="whitespace-nowrap px-5 py-4 font-medium text-slate-500 sm:px-6">{{ $loop->iteration }}</td>
                    <td class="whitespace-nowrap px-5 py-4 font-semibold text-slate-900">{{ $surat->nomor_surat }}</td>
                    <td class="whitespace-nowrap px-5 py-4 text-slate-600">{{ $surat->tanggal->format('d-m-Y') }}</td>
                    <td class="px-5 py-4 text-slate-600">{{ $surat->pengirim }}</td>
                    <td class="px-5 py-4 text-slate-600">{{ $surat->perihal }}</td>
                    <td class="whitespace-nowrap px-5 py-4">
                        <div class="flex items-center gap-2">
                        <a class="rounded-lg px-2.5 py-1.5 text-xs font-bold text-violet-700 transition hover:bg-violet-50" href="{{ route('surat-masuk.show', $surat->id) }}">Detail</a>
                        @can('manage-letters')
                            <a class="rounded-lg px-2.5 py-1.5 text-xs font-bold text-slate-600 transition hover:bg-slate-100" href="{{ route('surat-masuk.edit', $surat->id) }}">Edit</a>
                            <form method="POST" action="{{ route('surat-masuk.destroy', $surat->id) }}" onsubmit="return confirm('Hapus surat ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="rounded-lg px-2.5 py-1.5 text-xs font-bold text-rose-600 transition hover:bg-rose-50" type="submit">Hapus</button>
                            </form>
                        @endcan
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-6 py-14 text-center">
                        <span class="mx-auto flex h-12 w-12 items-center justify-center rounded-2xl bg-slate-100 text-slate-500">✉</span>
                        <p class="mt-4 font-semibold text-slate-800">Belum ada surat masuk</p>
                        <p class="mt-1 text-sm text-slate-500">Surat yang ditambahkan akan muncul di daftar ini.</p>
                    </td>
                </tr>
            @endforelse
                </tbody>
            </table>
        </div>
    </section>
@endsection
