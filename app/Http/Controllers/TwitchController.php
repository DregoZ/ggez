<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Support\Facades\Cache;
use MarcReichel\IGDBLaravel\Builder as IGDB;
use MarcReichel\IGDBLaravel\Models\Platform;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use MarcReichel\IGDBLaravel\Models\Game;

class TwitchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            
        //  $getAuth = Http::post('https://id.twitch.tv/oauth2/token', [
        //     'client_id' => "9ykyznssb1ba4y7mqz8dw6y2u2ztrw",
        //     'client_secret' => "lqzzdrc3f5156vf70sxbqdsz0ss60d",
        //     'grant_type' => "client_credentials"
        //     ]);

        // 2e5i3nr09ah87i4ldny5dx11pxx7a2
  

    /** Llamada de ejemplo para comprobar datos ***********/
    //     $igdb = new IGDB('games');
    //    $platforms = new IGDB('platforms');

    //    $games = $igdb->orderBy('rating', 'desc')->where('rating', '!=', null)->where('slug', 'like', '%dark%')->limit(20)->get();
    //     $plataforma = $platforms->limit(20)->get();
    //     $resultado = array([
    //         'games' => $games,
    //         'platforms' => $plataforma
    //     ]); 

    //     return $resultado;
    
    
        /** Llamada de ejmplo 2 ***********/
        // $games = Game::where('first_release_date', '>=', 1546297200)->get();
        // $games = Game::search('Dark')->get();
      
        //      return $games;
        
        /** EJEMPLO CACHE */
        
        /* no almacena en el [0] ?? */
        
       
        //Cache::forget('example');
        if (Cache::has('example')) {
            $cached = '*';
            $game_example = Cache::get('example');
            return view('twitch', $game_example)->with('cached', $cached);
        } else {
            
            $date = strtotime("2015-01-01") * 1000;
            $game_example = Game:: orderBy('rating', 'desc')->where('rating', '!=', null)->where('first_release_date', '>=', $date)->limit(50)->get();
           
            Cache::put('example', compact('game_example'));
            
            return view('twitch', compact('game_example'));
        }

        //return $example_cache;
        //return compact('game_example');

        // $gamekey = 1;
        //     foreach ($gamedb as $game) {
        //         // OJO!! si pasamos un array debemos transformarlo en coleccion -> collect()
        //         //    Cache::put($gamekey, ['id' => $game->id, 'name' => $game->name, 'rating'=> $game->rating], 3600);
        //         Cache::put($gamekey, $game);
        //         $gamekey++;
        //     }
        
     
    
        // juegos con nombre mario
        //$games = $cached_query->orderBy('rating', 'desc')->where('rating', '!=', null)->where('slug', 'like', '%mario%')->limit(50)->get();

        //return $gamecollection;
       // return compact('gamecollection');
       
       //return view('twitch', compact('gamecollection'));
      

     //   return gettype($gamedb);
   
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
