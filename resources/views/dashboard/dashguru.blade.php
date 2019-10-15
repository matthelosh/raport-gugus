@extends('dashboard.layout')

@section('content')
    @if(isset($page))
        @switch($page)
            @case('profil')
                @include('dashboard.gurupages.profil')
                @break
            @case('siswaku')
                @include('dashboard.gurupages.siswaku')
                @break
            @case('nharian')
                @include('dashboard.gurupages.nharian')
                @break
            @case('raport')
                @include('dashboard.gurupages.raport')
                @break
            
        @endswitch
    @else
        @include('dashboard.gurupages.beranda')
    @endif
    {{-- @include('dashboard.gurupages.beranda') --}}
@endsection