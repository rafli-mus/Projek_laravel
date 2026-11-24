@extends('layout.app')

@section('title', 'Detail Surat Masuk')
@section('jenis', 'masuk')

@section('content')
    @include('surat._detail', [
        'route' => 'surat-masuk',
        'judul' => 'Surat Masuk',
        'pihakLabel' => 'Pengirim',
        'pihak' => $surat->pengirim,
    ])
@endsection
