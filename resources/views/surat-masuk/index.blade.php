@extends('layout.app')

@section('title', 'Surat Masuk')

@section('content')

    <h1>Halaman ini menampilkan data surat masuk.</h1>

    <table border="1" cellpadding="10">
        <thread>
            <tr>
                <th>no</th>
                <th>nomor surat</th>
                <th>tanggal</th>
                <th>pengirim</th>
                <th>perihal</th>
                <th>aksi</th>
            </tr>
        </thread>

        <tbody>
            @foreach($SuratMasuk as $surat)
            <tr>
                <td>{{ $loop -> iteration}}</td>
                <td>{{ $surat['nomor_surat'] }}</td>
                <td>{{ $surat['tanggal'] }}</td>
                <td>{{ $surat['pengirim'] }}</td>
                <td>{{ $surat['perihal'] }}</td>
                <td>
                    <a href="{{route('surat-masuk.show', $surat['id'])}}">Detail</a>
                </td>
            </tr>
            @endforeach

