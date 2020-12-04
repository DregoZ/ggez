@extends('plantilla');

@section('contenido')
    @isset($cached)
        {{ $cached }} <br>
    @endisset

    @foreach($game_example as $game)
        {{ $game->name }}<br>
    @endforeach
@endsection