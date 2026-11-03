
@extends('layout.app')

@section('title', 'Surat Keluar')

@section('content')
   <h1>Halaman ini menampilkan data surat keluar.</h1>

    @can('manage-letters')
        <p><a href="{{ route('surat-keluar.create') }}">+ Tambah Surat</a></p>
    @endcan

    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>No.</th>
                <th>Nomor Surat</th>
                <th>Tanggal</th>
                <th>Tujuan</th>
                <th>Perihal</th>
                <th>Keterangan</th>
                <th>aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($suratKeluar as $surat)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $surat->nomor_surat }}</td>
                    <td>{{ $surat->tanggal->format('d-m-Y') }}</td>
                    <td>{{ $surat->tujuan }}</td>
                    <td>{{ $surat->perihal }}</td>
                    <td>{{ $surat->keterangan }}</td>
                    <td>
                        <a href="{{ route('surat-keluar.show', $surat->id) }}">Detail</a>
                        @can('manage-letters')
                            <a href="{{ route('surat-keluar.edit', $surat->id) }}">Edit</a>
                            <form method="POST" action="{{ route('surat-keluar.destroy', $surat->id) }}" style="display:inline" onsubmit="return confirm('Hapus surat ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Hapus</button>
                            </form>
                        @endcan
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">Belum ada surat keluar.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
