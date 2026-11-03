@extends('layout.app')

@section('title', 'Edit Surat Masuk')

@section('content')
    <h1>Edit Surat Masuk</h1>
    @include('surat-masuk._form', ['action' => route('surat-masuk.update', $surat->id), 'method' => 'PUT', 'surat' => $surat])
@endsection
