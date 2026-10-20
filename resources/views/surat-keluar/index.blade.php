
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
                <th>Status</th>
                <th>aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($suratKeluar as $surat)
                <tr>
                    <td>{{ $surat['id'] }}</td>
                    <td>{{ $surat['nomor'] }}</td>
                    <td>{{ $surat['tanggal'] }}</td>
                    <td>{{ $surat['tujuan'] }}</td>
                    <td>{{ $surat['perihal'] }}</td>
                    <td>{{ $surat['status'] }}</td>
                    <td>
                        <a href="{{ route('surat-keluar.show', $surat['id']) }}">Detail</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Belum ada surat keluar.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
