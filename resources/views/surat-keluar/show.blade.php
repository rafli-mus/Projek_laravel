@extends('layout.app')

@section('title', 'Detail Surat Keluar')
@section('jenis', 'keluar')

@section('content')
    @include('surat._detail', [
        'route' => 'surat-keluar',
        'judul' => 'Surat Keluar',
        'pihakLabel' => 'Tujuan',
        'pihak' => $surat->tujuan,
    ])
@endsection
