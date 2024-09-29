<?php

namespace App\Http\Controllers\API\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Services\Auth\RegisterService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RegisterController extends Controller
{

    public function __construct(private RegisterService $registerService)
    {

    }

    /**
     *
     *
     *  permet de s'enregistrer
     * @param RegisterRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(RegisterRequest $request)
    {
        $userCreate = $this->registerService->addUser($request);
        if (!$userCreate) {
            return Response()->json([ 'message' => 'impossible de créer l\'utilisateur un problème....'

            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        $device = substr($request->userAgent() ?? '', 0, 255);

        return Response()->json([
            'access_token' => $userCreate->createToken($device)->plainTextToken,
            'name' => $userCreate->name,
        ], Response::HTTP_CREATED);
    }
}
