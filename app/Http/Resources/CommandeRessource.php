<?php

namespace App\Http\Resources;

use App\Enums\Status;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class CommandeRessource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
       $globalRevenue = round((double) $this->offre->frais_mensuel + (double) $this->offre->frais_installation, 2);
        return [
            'id' => $this->id,
            'numberLicences' => $this->numberLicences,
            'description' => $this->description,
            'statut' =>  Status::fromValue($this->status)->label(),
            'statut_number' =>  $this->status,
            'revenue_global' => $globalRevenue,
            'options_technology' => json_decode($this->option_technology),
            'created_at' =>  Carbon::make($this->created_at)->diffForHumans(),
            'updated_at' => Carbon::make($this->updated_at)->diffForHumans(),
            'technologies' => TechnologyRessource::collection($this->technologies) ,
            'offre' => OffreRessource::make($this->offre),

        ];
    }
}
