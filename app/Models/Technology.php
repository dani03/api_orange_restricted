<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Technology extends Model
{

    protected $fillable = ['name'];
    use HasFactory, SoftDeletes;

    // une technologie appartient à une ou plusieurs commandes
    public function commandes(): BelongsToMany {
        return $this->belongsToMany( Commande::class);
    }
}
