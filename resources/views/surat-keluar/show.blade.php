@extends('layout.app')

@section('title', 'Detail Surat Keluar')

@section('content')
    <h1>Halaman Detail Surat Keluar</h1>

    <p><strong>Nomor Surat:</strong> {{ $surat->nomor_surat }}</p>
    <p><strong>Tanggal:</strong> {{ $surat->tanggal->format('d-m-Y') }}</p>
    <p><strong>Tujuan:</strong> {{ $surat->tujuan }}</p>
    <p><strong>Perihal:</strong> {{ $surat->perihal }}</p>
    <p><strong>Keterangan:</strong> {{ $surat->keterangan }}</p>

    <a href="{{ route('surat-keluar.index') }}">Kembali ke daftar</a>
@endsection
