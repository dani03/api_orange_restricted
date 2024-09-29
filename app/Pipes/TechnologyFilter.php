<?php

namespace App\Pipes;

class TechnologyFilter
{
    public function handle($query , \Closure $next) {
        //on effectue la requete si on a le parametre status dans la request
        $query->when(request()->filled('technology'), function ($query) {
            // Filtre commandes sur les technologies (many to many)
            $query->whereHas('technologies', function ($q) {
                $q->where('technologies.name', request()->query('technology'));
            });
        });
        return $next($query);
    }

}
