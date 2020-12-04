@extends('plantilla')

 

@section('contenido')
Hola caracola, {{ $nombre ?? "Invitado" }}!
<br>    
CACHE GET {{ $value ?? 'Es null' }}
<form action=" {{ route('flush') }}" method="POST">
    <button>FLUSH DB</button>
</form>

@endsection

