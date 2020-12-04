<?php

use Illuminate\Support\Facades\Cache;

/* sets link como active si nos encontramos en la ruta a donde apunta */
function setLinkActivo($nombreRuta) 
{
    return request()->routeIs($nombreRuta) ? 'active' : '';
}

/* transforma cadenas a modo slug */
function slugify($string){
    return strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $string), '-'));
}
