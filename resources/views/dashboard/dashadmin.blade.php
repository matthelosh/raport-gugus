@extends('dashboard.layout')

@section('content')
    {{-- Konten Dashboard untuk Guru     --}}
    {{-- <h1>Conten untuk {{ Auth::user()->fullname }}</h1> --}}
    {{-- {{$page}} --}}
    @if(isset($page))
        @switch($page)
            @case('users')
                @include('dashboard.adminpages.users')
                @break
            @case('siswas')
                @include('dashboard.adminpages.siswa')
                @break
            @case('rombels')
                @include('dashboard.adminpages.rombel')
                @break
            @case('sekolah')
                @include('dashboard.adminpages.sekolah')
                @break
            @case('tematik')
                @include('dashboard.adminpages.tematik')
                @break
            @case('mapel')
                @include('dashboard.adminpages.mapel')
                @break
            @default
                
        @endswitch
    @else
        <h1>Selamat Datang {{Auth::user()->fullname }}</h1>
    @endif
@endsection