<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MarcReichel\IGDBLaravel\Models\Cover;
use MarcReichel\IGDBLaravel\Models\Game;
use MarcReichel\IGDBLaravel\Models\GameVideo;
use MarcReichel\IGDBLaravel\Models\Platform;
use MarcReichel\IGDBLaravel\Models\Screenshot;
use Illuminate\Support\Facades\Cache;


class GamePageController extends Controller
{
    /**
     * Handle the incoming request.
     *
     *@param $slug      dato pasado desde la ruta   
     */
    public function __invoke(String $slug)
    {
        /* si la búsqueda especificada existe en la cache, devuelve esa búsqueda... */
        if (Cache::has('gamepage' . $slug)) {
            $gamepage_cache = Cache::get('gamepage' . $slug);
            return view('querys.gamepage', $gamepage_cache);
        } else {
            // recupera datos a partir del slug  
            //juegos
            $gameweb = Game::where('slug', $slug)->first();
            //portadas
            $gameweb_cover = Game::select('cover')->where('slug', $slug)->first();
            $gameweb_cover == null ? $portada = null : $portada = Cover::where('id', $gameweb_cover->cover)->first();
            //plataformas
            $gameweb_plataformas = Game::select('platforms')->where('slug', $slug)->get();
            $gameweb_plataformas[0]->platforms == null ? $plataformas = null : $plataformas = Platform::whereIn('id', $gameweb_plataformas[0]->platforms)->get();
            // screenshots
            $gameweb_screenshots = Game::select('screenshots')->where('slug', $slug)->get();
            $gameweb_screenshots[0]->screenshots == null ? $screenshorts = null : $screenshots = Screenshot::whereIn('id', $gameweb_screenshots[0]->screenshots)->get();
            //videos
            $gameweb_videos = Game::select('videos')->where('slug', $slug)->get();
            $gameweb_videos[0]->videos == null ? $videos = null : $videos = GameVideo::whereIn('id', $gameweb_videos[0]->videos)->get();
            
            // almacena en la cache la búsqueda y muestra el resultado del query
            Cache::put('gamepage'.$slug, compact(['gameweb', 'portada', 'plataformas', 'screenshots', 'videos']));
            return view('querys.gamepage', compact('gameweb', 'portada', 'plataformas', 'screenshots', 'videos'));
        }
    }
}


            /* TEST CODE */
            // $gamepage_plataformas = $gamepage->platforms;   //array
            // $gamepage_videos = $gamepage->videos; //array

            // querys a las bbdd
            // $portada = Cover::where('id', $gamepage_cover)->first();
            // $screenshots = Screenshot::whereIn('id', $gamepage_screenshots)->get();
            // $plataformas = Platform::whereIn('id', $gamepage_plataformas)->get();
            // $gamepage_videos == null ? '' : $videos = GameVideo::whereIn('id', $gamepage_videos)->get();

            // echo gettype($gamepage_screenshots);
            // echo gettype($gamepage_plataformas);
            // echo gettype($gamepage_videos);

            //    return compact('portada');
            // return view('gamepage', compact(['gamepage', 'screenshots', 'portada', 'plataformas', 'videos']));
            // return compact(['gamepage', 'portada', 'screenshots', 'plataformas', 'videos']);
            //return $gamepage_screenshots;
            //return  'GAMEPAGE: ' . compact('gamepage');
            //return view('gamepage', compact('gamepage'));

