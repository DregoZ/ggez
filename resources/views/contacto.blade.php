 @extends('plantilla')

@section('title', 'Contacto')

@section('contenido')

<h1>Contacto</h1>

<form action="" method="POST">
    @csrf <!-- proteccion contra xxs, agrega un token -->

    <!-- imprime el primer error del campo 'name' -->
<input name="name" placeholder="nombre..." type="text" value="{{ old('name') }}"><br>
{{ $errors->first('name') }}<br>

<!-- con esta notación podemos incrustar html en php -->
<input name="email" placeholder="Email..." type="email" value="{{ old('email') }}"><br>
{!! $errors->first('email', '<small class="pink">:message</small><br>') !!}

<input name="asunto" placeholder="Asunto..." type="text" value="{{ old('asunto') }}"><br>
{!! $errors->first('asunto', '<small class="pink">:message</small><br>') !!}

<!-- textarea no tiene value -->
<textarea name="contenido" id="contenido" cols="30" placeholder="Escriba aquí..." rows="5">{{ old('contenido') }}</textarea><br>
{!! $errors->first('contenido', '<small class="pink">:message</small><br>') !!}

<button>Enviar</button>
</form>
@endsection

<!-- LOS ARCHIVOS DE VALIDACION EN resources/lang/en/validation.php -->
<!-- podemos crear un archivo nuevo de lenguaje y traducir los errores a nuestro idioma -->
<!--  laravel lang en github -->

<!-- control de errores, se almacenan en $errors y por medio de 
    sus métodos podemos imprimirlos en pantalla -->

{{--
    @if($errors->any())
    @foreach($errors->all() as $error)
        <p>{{ $error }}</p>
    @endforeach
@endif


--}}