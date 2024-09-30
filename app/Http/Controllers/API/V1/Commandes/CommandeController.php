<?php

namespace App\Http\Controllers\API\V1\Commandes;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Technologies\TechnologyRepository;
use App\Http\Requests\Commandes\CommandeStoreRequest;
use App\Http\Resources\CommandeRessource;
use App\Http\Services\Commandes\CommandeService;
use App\Http\Services\Technologies\TechnologyService;
use App\Models\Commande;
use App\Pipes\ClientFilter;
use App\Pipes\OffreFilter;
use App\Pipes\StatusFilter;
use App\Pipes\TechnologyFilter;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class CommandeController extends Controller
{
    public function __construct(private CommandeService $commandeService)
    {
    }

    /**
     * Display a listing of the commandes.
     */
    public function index(Request $request)
    {

        // applique les filtres s'il y a des paramètres de requête
        if ($request->query()) {
            $commandes = app(Pipeline::class)
                ->send(Commande::query()->with('technologies'))
                ->through([
                    StatusFilter::class,
                    TechnologyFilter::class,
                    OffreFilter::class,
                    ClientFilter::class,
                ])->thenReturn()->get();

        } else {
            // Récupère toutes les commandes si aucun paramètre n'est présent
            $commandes = $this->commandeService->getCommandes();
        }
        return response()->json(CommandeRessource::collection($commandes), Response::HTTP_OK);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CommandeStoreRequest $request): Response
    {
        //on appelle notre service qui va traiter l'ajout de la commande
        $commandeCreated = $this->commandeService->addCommande($request);
        if (!$commandeCreated) {
            return response()->json(['message => impossible de créer la commande'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        //on traite ensuite la liaison des technologies à la commande
        $technologies = $request->get('technology');
        //recupération des ids technos
        $technoFind = (new TechnologyService(new TechnologyRepository()))->getTechnologiesIds($technologies);
        // on lie les technologies à la commande
        if (!empty($technoFind)) {
            $commandeCreated->technologies()->attach($technoFind);
        }
        return response()->json(['message' => 'votre commande a été enregistrée avec succès. '], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CommandeStoreRequest $request, int $id)
    {
        $commande = $this->commandeService->getCommande($id);
        if (!$commande) {
            return response()->json(['message' => 'cette commande n\'existe pas'], Response::HTTP_NOT_FOUND);

        }
        // Utilisation des gates pour vérifier l'accès
        if (!Gate::allows('update-commande', $commande)) {
            return response()->json(['message' => 'impossible de modifier une commande donc le status est complétée'], Response::HTTP_UNAUTHORIZED);
        }

        //on met a jour
        $this->commandeService->updateCommande($request, $commande);
        if ($commande->wasChanged()) {
            return response()->json(['message' => 'commande mise à jour avec succès. '], Response::HTTP_OK);
        }

        return response()->json(['message' => 'aucune mise à jour effectuée.'], Response::HTTP_OK);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
