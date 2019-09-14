@extends('dashboard.layout')

@section('dash-content')
    {{-- Konten Dashboard untuk Guru     --}}
    <h1>Conten untuk {{ Auth::user()->fullname }}</h1>
@endsection