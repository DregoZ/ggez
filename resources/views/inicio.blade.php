@extends('plantilla')

 

@section('contenido')
Hola caracola, {{ $nombre ?? "Invitado" }}!
<br>    
CACHE GET {{ $value ?? 'Es null' }}
@endsection

