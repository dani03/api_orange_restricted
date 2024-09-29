<?php

namespace App\Http\Repositories\Users;

use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository
{
    public function createUser(RegisterRequest $request)
    {
        return User::create(
            [
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]
        );
    }

    public function findUserByEmail(String $email): User | null
    {
        return User::where('email', $email)->first();
    }

    public function find(int $id): User|null {
        return User::find($id);
    }

}
