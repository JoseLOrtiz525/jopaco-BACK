<?php

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Auth\AuthenticationException;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    Route::apiResource('usuarios', UsuariosController::class);
});

Route::post('/tokens/create', function (Request $request) {


    if ($request->email == null || $request->password == null) {
        return;
        //$error = ["error" => "Campos Email o Password Vacio"];
    }

    $user = Usuario::where("email", $request->email)->where("password", $request->password)->first();

    if ($user) {
        $token = $user->createToken('Personal Access Token');

        return [
            'token' => $token->plainTextToken,
            // 'user' => $user
        ];
    } else {
        return ['error' => "Usuario no encontrado"];
    }
});
