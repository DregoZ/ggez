<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use MarcReichel\IGDBLaravel\Builder as IGDB;
use MarcReichel\IGDBLaravel\Models\Cover;
use MarcReichel\IGDBLaravel\Models\Game;
use MarcReichel\IGDBLaravel\Models\Platform;

class SearchController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function __invoke(Request $request)
    {
        $search_field = request('search'); // busca lo introducido en el form, transformado en slug
        $request = slugify($search_field);

        /* query Builders para cuando no usamos el wrapper */
        // $igdb = new IGDB('games');
        // $platforms = new IGDB('platforms');

        /**
         * TODO redirect a página TRENDING GAMES
         */
        try {
            if (trim($request) == null or trim($request) == "") {
                throw new Exception('No query data');
            }
        } catch (Exception $e) {
            $errors = $e->getMessage();
            return view('querys.queryErrors', compact('errors'));
        }

        /**
         * query a Games según el formulario de búsqueda, ordenándolos por rating (máximo 50, modificable)
         * TODO mostrar resultados variables por página
         */

        $games = Game::orderBy('rating', 'desc')->where('rating', '!=', null)->where('slug', 'like', '%' . $request . '%')->limit(50)->get();
        $games == null ? view('trendingGames') : 'Buscando en la base de datos...';
        /**
         * almacena en arrays los elementos que a los que haremos query en otras tablas (Platform y Covers)
         * 
         */
        $game_covers_arr = array();
        $game_platforms_arr = array();

        foreach ($games as $game) {
            $slug_code = $game->slug;

            //portadas
            $game_cover = Game::select('cover')->where('slug', $slug_code)->first();
            if ($game_cover->cover != null) array_push($game_covers_arr, $game_cover->cover);

            //plataformas
            $game_plataformas = Game::select('platforms')->where('slug', $slug_code)->get();
            if ($game_plataformas != null) {
                foreach ($game_plataformas as $plataforma) {
                    if ($plataforma->platforms != null) {
                        foreach ($plataforma->platforms as $plataforma_ind) {
                            in_array($plataforma_ind, $game_platforms_arr) ? 'Plataforma ya existente' : array_push($game_platforms_arr, $plataforma_ind);
                        }
                    }
                }
            }
        }


        $game_covers_arr == null ? $portadas = null : $portadas = Cover::whereIn('id', $game_covers_arr)->limit(50)->get();
        $game_platforms_arr == null ? $plataformas = null : $plataformas = Platform::whereIn('id', $game_platforms_arr)->limit(170)->get();


        return view('querys.queryResult', compact(['games', 'portadas', 'plataformas']))->with('search_field', $search_field);
    }
}
        // return $lista_plataformas;
        //         array_push($game_covers, $game->cover); // $game->cover referencia a covers.id

        //         // introduzco en el array todas las plataformas correspondientes a los juegos de la búsqueda, llamando a in_array() para evitar duplicados
        //         for($i=0; $i < count($game->platforms); $i++) {
        //            in_array($game->platforms[$i], $game_platforms) ? 'Plataforma ya existente' : array_push($game_platforms, $game->platforms[$i]); // evita valores duplicados
        //         }

        // // querys a la bbdd de los datos especificados
        // $plataformas = Platform::whereIn('id', $game_platforms)->limit(170)->get();
        // $portadas = Cover::whereIn('id', $game_covers)->limit(50)->get();

        //  return view('querys.queryResult', compact(['games', 'plataformas', 'portadas']))->with('search_field', $search_field);

        /* TEST CODE */
        //$plataformas = Platform::all();
        //return $games;
        // $portadas = Cover::all();
        //$games = Game::search($request)->orderBy('rating', 'desc')->where('rating', '!=', null)->get();
        // $games = Game::orderBy('rating', 'desc')->select('name', 'summary', 'platforms', 'rating')->where('rating', '!=', null)->get();
        // $games = $igdb->search($request)->orderBy('first_release_date', 'desc')->limit(20)->get();
        //$plataformas = Platform::select(['id', 'name', 'abbreviation'])->limit(200)->get();
        // $plataformas = $platforms->select('id', 'name', 'abbreviation')->limit(200)->get();
        // var_dump($cover_selected)  ;
