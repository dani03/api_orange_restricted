<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Commande extends Model
{
    use HasFactory, SoftDeletes;


    protected $fillable = ['numberLicences', 'description', 'client_id', 'offre_id','option_technology'];

    // Une commande est rattachée à une offre
    public function offre(): BelongsTo {
        return $this->belongsTo(Offre::class);
    }

    // une commande possède une ou plusieurs technologies (has many)
    public function technologies(): BelongsToMany {
        return $this->belongsToMany(Technology::class);
    }

    // une commande appartient à un client
    public function client(): BelongsTo {
       return $this->belongsTo(Client::class);
    }

}
