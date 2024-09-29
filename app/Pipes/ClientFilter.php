<?php

namespace App\Pipes;

class ClientFilter
{
    public function handle($query , \Closure $next) {
        //on effectue la requete si on a le parametre client dans la request
        $query->when(request()->has('client'), function ($query) {
            // on effectue le filtre
            $query->where('client_id', request()->query('client'));
        });
        return $next($query);
    }
}
