<?php

namespace App\Http\Services\Clients;

use App\Http\Repositories\Clients\ClientRepository;
use App\Models\Client;
use Illuminate\Support\Collection;

class ClientService
{

    public function __construct(private ClientRepository $ClientRepository) {

    }

    /**
     * cette methode permet de récupérer tous les clients
     */
    public function getClients(): Collection | null {
        return $this->ClientRepository->findAllClients();
    }


    /**
     * @param array $client
     * @return bool
     * retourne un booléen pour valider la création d'un client
     */
    public function storeClient(array $client): bool {
        // on associe bien les clés et les valeurs
        $clientArray = self::makeArrayWithKey($client);
       return (bool) $this->ClientRepository->insertClient($clientArray);

    }

    // ajoute les clés du tableau afin de matcher avec les colonnes de
    // la base de données
    public static function makeArrayWithKey(array $client): array {
        return [
            'siren' => $client['siren'],
            'siret' => $client['siret'],
            'nom_legal' => $client['nom_legal'],
        ];
    }

    public function updateClient(Client $client , array $newData): Client | bool {
        $data = self::makeArrayWithKey($newData);
       $updated = $this->ClientRepository->update($client, $data);
       return  $updated ? $client : false;

    }

    public function findClientById(int $id): Client | null {
        return $this->ClientRepository->getClient($id);
    }

}
