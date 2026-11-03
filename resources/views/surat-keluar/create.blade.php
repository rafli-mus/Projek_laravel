@extends('layout.app')

@section('title', 'Tambah Surat Keluar')

@section('content')
    <h1>Tambah Surat Keluar</h1>
    @include('surat-keluar._form', ['action' => route('surat-keluar.store'), 'method' => 'POST', 'surat' => null])
@endsection
