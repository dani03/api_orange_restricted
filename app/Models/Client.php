<?php

namespace App\Models;

use ApiPlatform\Metadata\ApiResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;


#[ApiResource]
class Client extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['nom_legal', 'siren', 'siret'];

    public function commandes(): HasMany {
        return $this->hasMany(Commande::class);
    }
}
