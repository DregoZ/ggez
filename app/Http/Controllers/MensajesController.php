<?php

namespace App\Http\Controllers;

use App\Mail\MensajeRecibido;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class MensajesController extends Controller
{
    public function store() { //param Request $request

        //return $request;
        //return request()->get('email');
        //return request();
        //return request('name');

        // devuelve al formulario si no se cumple la condicion
        $mensaje = request()->validate([
            'name' => ['required', 'max:20'],
            'email' => 'required|email',
            'asunto' => 'required',
            'contenido' => 'required|min:5'
        ],
        [
            'name.required' => 'Que como te llamas',
            'email.email' => 'Con algarroba'

        ]);

        // envia un email

   // Mail::to('midireccion@email.com')->send(new MensajeRecibido($mensaje));
   Mail::to('midireccion@email.com')->queue(new MensajeRecibido($mensaje));

        // return new MensajeRecibido($mensaje);
        return 'Mensaje enviado';
    }
}
