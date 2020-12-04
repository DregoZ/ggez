<?php

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* 1er EJEMPLO: rutas web, rutas con nombre */

/*
Route::get('/', function () {
    //return view('welcome');
    return "Hola caracola desde la frontpage";
});

Route :: get('contacteishon', function() {

    return 'Seccion de contactos';

})->name('contacto');

Route :: get ('/', function() {
    echo "<a href='". route('contacto')."'>Contacto 1</a><br>";
    echo "<a href='". route('contacto')."'>Contacto 2</a><br>";
    echo "<a href='". route('contacto')."'>Contacto 3</a><br>";
    echo "<a href='". route('contacto')."'>Contacto 4</a><br>";
});


Route :: get('saludos/{nombre?}', function($nombre = "invitado") {
    return 'Hola caracola, ' . $nombre . '.';
    
});
*/

/* 2o EJEMPLO: devolviendo vistas  */

/* 
Route :: get('/', function() {

    $nombre = "ant1";

    return view('inicio')->with('nombre', $nombre);
    // return view('inicio')->with('nombre' => $nombre);
    // return view('inicio', ['nombre' => $nombre]);
    // return view('inicio', compact('nombre')); // devuelve ['nombre' => $nombre]);

})->name('home');

*/

// Route::view('/', 'inicio')->name('home');


Route::get('/', UserController::class)->name('home');
Route::view('/about', 'about')->name('about');
//Route::view('/portfolio', 'portfolio', compact('portfolio'))->name('portfolio');
Route::view('/contacto', 'contacto')->name('contacto');
Route::resource('portfolio', 'PortfolioController')->name('index', 'portfolio');
//Route::resource('portfolio', PortfolioController::class)->name('index', 'portfolio');
Route::post('contacto', 'MensajesController@store')->name('contacto');

Route::get('/twitch', 'TwitchController@store')->name('twitch');

Route::post('/busqueda', 'SearchController')->name('search');
Route::get('/gamepage/{slug}', 'GamePageController')->name('gamepage'); 

Route::post('/', HomeController::class)->name('flush');