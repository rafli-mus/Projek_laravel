@extends('layout.app')

@section('title', 'surat masuk')

@section('content')
    <h1>Halaman Detail surat masuk</h1>
@if($SuratMasukShow)
    <p>
        <strong>Nomor Surat : </strong>{{ $SuratMasukShow['nomor_surat'] }}<br>
        <strong>Tanggal : </strong>{{ $SuratMasukShow['tanggal'] }}<br>
        <strong>Pengirim : </strong>{{ $SuratMasukShow['pengirim'] }}<br>
        <strong>Perihal : </strong>{{ $SuratMasukShow['perihal'] }}<br>
    </p>
@else
    <p>Data tidak ditemukan</p>
@endif
