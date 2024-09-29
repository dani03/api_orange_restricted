<?php

namespace App\Http\Controllers\API\V1\Clients;

use App\Http\Controllers\Controller;
use App\Http\Requests\CLients\ClientStoreRequest;
use App\Http\Resources\ClientResource;
use App\Http\Services\Clients\ClientService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ClientController extends Controller
{
    public function __construct(private ClientService $clientService)
    {
    }

    /**
     * Display a listing of the resource.
     * utilisation des resources afin de mieux choisir les données qu'on veut retourner
     */
    public function index(): Response
    {
        $clients = $this->clientService->getClients();
        return response()->json(ClientResource::collection($clients), Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClientStoreRequest $request): Response
    {
        $client = $request->all();
        $clientSaved = $this->clientService->storeClient($client);
        if($clientSaved) {
            return \response()->json(['message' => 'client ajouté avec succès.'], Response::HTTP_CREATED);
        }
        return \response()->json(['message' => 'un problème est survenue à l\'insertion du client.'], Response::HTTP_INTERNAL_SERVER_ERROR);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): Response
    {
        $client = $this->clientService->findClientById((int)$id);
        if(!$client) {
            return response()->json(['message' => 'aucun client trouvé.'], Response::HTTP_NOT_FOUND);
        }
        return response()->json(new ClientResource($client), Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClientStoreRequest $request, string $id)
    {
        // on commence par verifier si un client existe bien sous cette id
        $client = $this->clientService->findClientById($id);
        if(!$client) {
            return response()->json(['message' => 'aucun client trouvé.'], Response::HTTP_NOT_FOUND);
        }
        // s'il existe on le modifie
        $newDataClient = $request->all();

       $clientUpdated = $this->clientService->updateClient($client, $newDataClient);
       if(!$clientUpdated->wasChanged()) {
           return response()->json(['message' => 'aucune modification effectuée'], Response::HTTP_OK);
       }

        return response()->json(['message' => 'mise à jour avec succès'], Response::HTTP_OK);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $client = $this->clientService->findClientById($id);
        if(!$client) {
            return response()->json(['message' => 'impossible de supprimer, aucun client trouvé.'], Response::HTTP_NOT_FOUND);
        }
        if($client->delete()) {
            return response()->json(['message' => 'client supprimé avec succès.'], Response::HTTP_OK);
        }

        return response()->json(['message' => 'impossible de supprimer le client. '], Response::HTTP_INTERNAL_SERVER_ERROR);


    }
}
