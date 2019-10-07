@extends('dashboard.layout')

@section('content')
    @if(isset($page))
        @switch($page)
            @case('profil')
                @include('dashboard.gurupages.profil')
                @break
            @default
                @include('dashboard.gurupages.beranda')
                @break
        @endswitch
    @endif
@endsection