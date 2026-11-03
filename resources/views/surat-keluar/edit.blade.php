@extends('layout.app')

@section('title', 'Edit Surat Keluar')

@section('content')
    <h1>Edit Surat Keluar</h1>
    @include('surat-keluar._form', ['action' => route('surat-keluar.update', $surat->id), 'method' => 'PUT', 'surat' => $surat])
@endsection
