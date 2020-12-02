@extends('plantilla')

<!-- se puede poner sin endsection incluyendo el texto como 2o parámetro -->
@section('title')
Portfolio    
@endsection

@section('contenido')
<h1>Portfolio</h1>
Hola caracola, {{ $nombre ?? "Invitado" }}! 

<ul>
    <!-- php plano  
    ?php foreach ($portfolio as $portfolioItem) {
        echo "<li>".$portfolioItem['title']."</li>";
    }
    ?>
    -->
    <!-- laravel OJO! : al final 
    ?php foreach($portfolio as $portfolioItem): ?>
        <li> { {$portfolioItem['title']}}</li>
    ?php endforeach ?>
-->
<!-- top bet : BLADE -->
{{-- 
    @isset($portfolio)
        @foreach($portfolio as $portfolioItem)
            <li>{{$portfolioItem['title']}}</li>
        @endforeach
    @else <li>No hay proyectos para mostrar.</li>
    @endisset
--}}

@forelse($portfolio as $portfolioItem)
    <li>{{$portfolioItem['title']}}</li>

    @empty
    <li>No hay proyectos para mostrar.</li>
@endforelse

</ul>



@endsection

