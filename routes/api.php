<?php

use App\Http\Controllers\API\V1\Auth\LoginController;
use App\Http\Controllers\API\V1\Auth\RegisterController;
use App\Http\Controllers\API\V1\Clients\ClientController;
use App\Http\Controllers\API\V1\Commandes\CommandeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('register', RegisterController::class);
Route::get('test', static function() {
    return "Vous êtes bien à l'API.";
});
Route::post('login', LoginController::class);
Route::post('register', RegisterController::class);

//routes vers les clients sans authentification
// routes clients
Route::get('clients', [ClientController::class, 'index']);
Route::post('clients', [ClientController::class, 'store']);
Route::get('clients/{id}', [ClientController::class, 'show']);
Route::put('clients/{id}', [ClientController::class, 'update']);
Route::delete('clients/{id}', [ClientController::class, 'destroy']);

// routes commandes
Route::get('commandes', [CommandeController::class, 'index']);
Route::post('commandes', [CommandeController::class, 'store']);
Route::put('commandes/{id}', [CommandeController::class, 'update']);

