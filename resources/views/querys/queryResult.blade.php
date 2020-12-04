@extends('plantilla')

@section('title') {{-- mostrando Dark --}}
{{ 'Búsqueda: ' . $search_field }}
@endsection

@section('contenido')
    @isset($cached)
        {{ $cached }}
    @endisset
<br> 
<h3>Mostrando resultados para: {{ $search_field }}</h3>

@foreach($games as $game)
<div class="game-card">

    <div class="title">
        <h2> <a href="{{ route('gamepage', $game->slug) }}" > {{ $game->name ?? "" }}</a> </h2>
    </div>
    
    <div class="rating">
        <h4>Rating: {{ floor($game->rating) ?? 'Sin rating' }}</h4> 
    </div>

    <div class="cover">
         @foreach($portadas as $portada)
            @if($portada != null && $portada->id == $game->cover)
                <img src="https://images.igdb.com/igdb/image/upload/t_cover_big/{{ $portada->image_id }}.jpg" alt="Imágen de portada">  
                @break
            @endif 
        @endforeach 
    </div>

    <div class="summary">
        <p>"{{ $game->summary ?? "" }}" <p>
          
    </div>

    <div class="plataformas">
        <h4>Disponible en:</h4>  
        <ul>
            @foreach($plataformas as $plataforma) 
                @if($plataforma != null && $game->platforms != null && in_array($plataforma->id, $game->platforms))
                    <li> {{ $plataforma->abbreviation }}</li>
                @endif
            @endforeach 

        </ul>   
    </div>
    <br><br>
</div>
@endforeach 
@endsection
   
