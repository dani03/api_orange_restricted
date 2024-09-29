<?php

namespace App\Pipes;

class OffreFilter
{
    public function handle($query , \Closure $next) {
        //on effectue la requete si on a le parametre status dans la request
        $query->when(request()->has('offre'), function ($query) {
            // on effectue le filtre
            $query->where('offre_id', request()->query('offre'));
        });
        return $next($query);
    }

}
