<?php

use App\Http\Controllers\NegocioController;
use App\Http\Controllers\ServiciosController;
use App\Http\Controllers\SolicitudesController;
use App\Http\Controllers\SubServicioController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('usuarios', UserController::class)->except(['create', 'edit']);
    Route::apiResource('negocios', NegocioController::class)->except(['create', 'edit']);
    Route::apiResource('solicitudes', SolicitudesController::class)->except(['create', 'edit']);
    Route::apiResource('servicios', ServiciosController::class)->except(['create', 'edit']);
    Route::apiResource('subservicios', SubServicioController::class)->except(['create', 'edit']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/tokens/create', function (Request $request) {

    if ($request->email == null || $request->password == null) {
        $error = ["error" => "Campos Email o Password Vacio"];
    }
    $newPass = $request->password;

    $user = User::where("email", $request->email)->first();

    $comprobar = decrypt($user->Password);

    if ($newPass == $comprobar) {
        if ($user) {
            $token = $user->createToken('Personal Access Token');

            return [
                'token' => $token->plainTextToken,
                'user' => $user
            ];
        } else {
            return ['error' => "Usuario no encontrado"];
        }
    } else {
        return ['error' => "Contraseña Incorrecta"];
    }
});
