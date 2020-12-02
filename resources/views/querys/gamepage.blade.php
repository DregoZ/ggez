@extends('plantilla')

@section('title')
    {{ $gameweb->name }} 
@endsection

@section('contenido')
<div class="gamepage">
   
    
    <div class="title">
        <h2> {{ $gameweb->name ?? "" }}</a> </h2>
    </div>
    
    <div class="rating">
         <h4>Rating: {{ floor($gameweb->rating) ?? 'Sin rating' }}</h4>  -
    </div>

    <div class="cover">
         @isset($portada->image_id)
            <img src="https://images.igdb.com/igdb/image/upload/t_cover_big/{{ $portada->image_id }}.jpg" alt="Imágen de portada">  
        @endisset
        @empty($portada->image_id)
            <img src="https://via.placeholder.com/264x374.png?text=No+hay+portada+disponible" alt="No hay portada">
        @endempty
               
    </div>

    <div class="summary">
        @isset($summary)
            <p>"{{ $gameweb->summary ?? "" }}" <p> 
        @endisset
        @empty($summary)
                <p>No hay resumen disponible</p>
        @endempty
    </div>


    <div class="plataformas">
        <h4>Disponible en:</h4>  
        <ul>
           @isset($plataformas) 
            @foreach($plataformas as $plataforma)
                <li>{{ $plataforma->abbreviation }}</li>
            @endforeach 
           @endisset
           @empty($plataformas)
               <p>No hay plataformas disponibles</p> 
           @endempty
        </ul>   
    </div>
    

    <div class="screenshots">
        <h2>Screenshots</h2>
        @isset($screenshots)
           @foreach($screenshots as $screenshot)  
            <img src="https://images.igdb.com/igdb/image/upload/t_screenshot_big/{{ $screenshot->image_id }}.jpg" alt="">     
           @endforeach
        @endisset
        @empty($screenshots)
            <p>No hay imágenes disponibles</p>
        @endempty
    </div> 

    <div class="videos">
        <h2>Videos</h2>
        @isset($videos)
           @foreach($videos as $video) 
           <iframe width="420" height="315" 
            src="https://youtube.com/embed/{{ $video->video_id }}?controls=1" type="video/webm">     
           </iframe>
           @endforeach
        @endisset
        @empty($videos)
            <p>No hay videos disponibles</p>
        @endempty
    </div> 

    <br><br>
</div>
@endsection
