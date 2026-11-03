@extends('layout.app')

@section('title', 'Tambah Surat Masuk')

@section('content')
    <h1>Tambah Surat Masuk</h1>
    @include('surat-masuk._form', ['action' => route('surat-masuk.store'), 'method' => 'POST', 'surat' => null])
@endsection
