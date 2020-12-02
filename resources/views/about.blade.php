@extends('plantilla')

@section('title', 'About')


@section('contenido')
<h1>About</h1>
Hola caracola, {{ $nombre ?? "Invitado" }}! 
@endsection