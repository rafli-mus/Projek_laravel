
@extends('layout.app')

@section('title', 'surat keluar')

@section('content')
    <h1>Halaman Detail Surat Keluar</h1>

    @if($SuratKeluarShow)
        <p>
            <strong>Nomor Surat : </strong>{{ $SuratKeluarShow['nomor_surat'] }}<br>
            <strong>Tanggal : </strong>{{ $SuratKeluarShow['tanggal'] }}<br>
            <strong>Tujuan : </strong>{{ $SuratKeluarShow['tujuan'] }}<br>
            <strong>Perihal : </strong>{{ $SuratKeluarShow['perihal'] }}<br>
        </p>
    @else
        <p>Data tidak ditemukan</p>
    @endif
@endsection
