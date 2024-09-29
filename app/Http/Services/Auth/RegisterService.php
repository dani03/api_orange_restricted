<?php

namespace App\Http\Services\Auth;

use App\Http\Repositories\Users\UserRepository;
use App\Http\Requests\Auth\RegisterRequest;

class RegisterService
{
    public function __construct( private UserRepository $userRepository )
    {
    }

    public function addUser(RegisterRequest $request) {
        return $this->userRepository->createUser($request);
    }
}
