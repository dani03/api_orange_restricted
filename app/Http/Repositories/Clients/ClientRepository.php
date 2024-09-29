<?php

namespace App\Http\Repositories\Clients;

use App\Models\Client;
use Illuminate\Database\Eloquent\Collection;

class ClientRepository
{

    /**
     * @return Collection|null
     * retourne tous les clients
     */
    public function findAllClients(): Collection | null  {
        return Client::all();
    }

    public function insertClient(array $client): Client {
        return Client::create($client);
    }

    public function getClient(int $id):Client | null{
        return Client::find($id);
    }

    public function update(Client $client, array $data): bool {
        return $client->update($data);
    }
}
