
@extends('layout.app')

@section('title', 'Surat Keluar')

@section('content')
   <h1>Halaman ini menampilkan data surat keluar.</h1>

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
