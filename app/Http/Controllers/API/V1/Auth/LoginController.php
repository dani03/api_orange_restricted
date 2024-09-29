<?php

namespace App\Http\Controllers\API\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Services\Auth\LoginService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends Controller
{
    public function __construct(private LoginService $loginService)
    {

    }
    public function __invoke(LoginRequest $request)
    {
        $user = $this->loginService->getUser($request);
        if (!$user || !Hash::check($request->input('password'), $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['l\'email ou le mot de passe est incorrecte...']
            ]);
        }

        //si tout est bon
        $device = substr($request->userAgent() ?? '', 0, 30);

        return Response()->json([
            "access_token" => $user->createToken($device)->plainTextToken,
            'token_type' => 'Bearer',
            'name' => $user->name,


        ], Response::HTTP_CREATED);
    }
}
