<?php

namespace App\Pipes;

class StatusFilter
{
    public function handle($query , \Closure $next) {
        //on effectue la requete si on a le parametre status dans la request
        $query->when(request()->has('status'), function ($query) {
            // on effectue le filtre
            $query->where('status', request()->query('status'));
        });
        return $next($query);
    }

}
