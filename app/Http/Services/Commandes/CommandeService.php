<?php

namespace App\Http\Services\Commandes;

use App\Http\Repositories\Commandes\CommandeRepository;
use App\Http\Requests\Commandes\CommandeStoreRequest;
use App\Models\Commande;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use JsonException;


class CommandeService
{
    public function __construct(private CommandeRepository $commandeRepository)
    {
    }

    public function getCommandes()
    {
        return $this->commandeRepository->getCommandeWithOffreAndTechnologies();

    }

    public function getCommande(int $id)
    {
        return $this->commandeRepository->getCommande($id);
    }

    //ajoute une nouvelle commande

    public function addCommande(CommandeStoreRequest $request)
    {
        $data = self::makeArrayData($request);
        return $this->commandeRepository->storeCommande($data);
    }

    // vérifie les parametères existe dans la request
    public function checkParameter(Request $request, array $parametersNeedle): array
    {
        $parameters = [];
        if (!empty($request->query())) {
            // recupération des clés de parameter
            $paramsUser = array_keys($request->query());
            // si les clés existe dans les 2 tableaux cest donc une clé valide
            $parameters = array_intersect($paramsUser, $parametersNeedle);
        }
        return $parameters;
    }

    public static function makeArrayData(CommandeStoreRequest $request): array
    {
        return [
            'numberLicences' => $request->get('numberLicence'),
            'global_revenue' => $request->get('global_revenue'),
            'description' => $request->get('description'),
            'client_id' => $request->get('client_identifier'),
            'offre_id' => $request->get('offre_identifier'),
            'status' => $request->get('status'),
            'option_technology' => json_encode($request->get('option_technology'), JSON_THROW_ON_ERROR),
        ];
    }


    // permet de mettre à jour une commande
    public function updateCommande(CommandeStoreRequest $request, Commande $commande): bool
    {
        $data = [
            'id' => $commande->id,
            'numberLicences' => $request->get('numberLicence') ?? $commande->numberLicences,
            'global_revenue' => $request->get('global_revenue') ?? $commande->global_revenue,
            'description' => $request->get('description') ?? $commande->description,
            'client_id' => $request->get('client_identifier') ?? $commande->client_id,
            'offre_id' => $request->get('offre_identifier') ?? $commande->offre_id,
            'status' => $request->get('status') ?? $commande->status,
            'option_technology' => json_encode($request->get('option_technology'), JSON_THROW_ON_ERROR) ?? $commande->option_technology,
        ];
        return $this->commandeRepository->update($data, $commande);

    }


}
