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

    $user = Usuario::where('Email', $request->email)->where('Password', $request->password)->first();

    if ($user) {
        $success['token'] =  $user->createToken('test')->accessToken;
        return response()->json(['success' => $success['token']]);
    } else {
        return response()->json(['error' => 'Unauthorised'], 401);
    }
});
