<?php

namespace App\Http\Repositories\Commandes;

use App\Models\Commande;
use Illuminate\Database\Eloquent\Collection;

class CommandeRepository
{


    public function getOnlyCommandes(): Collection | null {
        return Commande::all();
    }

    public function getCommandeWithOffre(): Collection | null {
        return Commande::with(['offre'])->get();

    }

    public function getCommande($id): Commande | null {
        return Commande::find($id);
    }

    public function storeCommande(array $data): Commande {
        return Commande::create($data);
    }
    public function update(array $data, Commande $commande):bool {
        return $commande->update($data);
    }

    public function commandeFilter( $params, $value, Commande $commande) {
        return $commande->where($params, $value)->get();
    }




    /**
     * récupère une commande avec l'offre et les technologies qui sont associées
     * @return Collection|null
     */
    public function getCommandeWithOffreAndTechnologies(): Collection|null {
        return Commande::with(['technologies', 'offre'])->get();
    }


    public function delete(Commande $commande): bool {
       return  $commande->delete();
    }

}
