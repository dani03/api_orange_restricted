<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Offre extends Model
{

    protected $fillable = ['name', 'frais_mensuel', 'frais_installation'];
    use HasFactory, SoftDeletes;




    public function commandes(): HasMany {
        return $this->hasMany(Commande::class);
    }


}
