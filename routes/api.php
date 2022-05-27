<?php

use App\Http\Controllers\CarritoController;
use App\Http\Controllers\ExcelController;
use App\Http\Controllers\NegocioController;
use App\Http\Controllers\ServiciosController;
use App\Http\Controllers\SolicitudesController;
use App\Http\Controllers\SubServicioController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VentasController;
use App\Models\Negocio;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

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

Route::get('/negociosall', function () {

    $negocios = Negocio::all();

    return $negocios;
});

Route::post('/registrar', function (Request $request) {
    $request->validate([
        'Nombre' => 'required|string|max:25',
        'Apellido_Paterno' => 'required|string|max:25',
        'Apellido_Materno' => 'required|string|max:25',
        'Fecha_Nacimiento' => 'required',
        'Email' => 'required|email|unique:users,email',
        'Password' => 'required|min:8',

    ]);

    if ($request->has('foto')) {
        $request->validate([
            'Foto' => "required|image|mimes:jpeg,png,jpg|max:3000",
        ]);
        $file = $request->file('Foto');
        $extension = $file->getClientOriginalExtension();
        $name = time() . "." . $extension;
        $file->move(public_path() . '/img/', $name);
    } else {
        $name = 'user.jpg';
    }

    $tipo = 'Cliente';

    DB::table("users")
        ->insert([
            "Nombre" => $request['Nombre'],
            "Apellido_Paterno" => $request['Apellido_Paterno'],
            "Apellido_Materno" => $request['Apellido_Materno'],
            "Fecha_Nacimiento" => $request['Fecha_Nacimiento'],
            "Tipo_Usuario" => $tipo,
            "Email" => $request['Email'],
            "Password" => encrypt($request['Password']),
            "Foto" => $name
        ]);

    $user = User::where("email", $request['Email'])->first();

    if ($user) {
        $token = $user->createToken('Token');

        return [
            'token' => $token->plainTextToken,
            'user' => $user
        ];
    } else {
        return ['error' => "Usuario no encontrado"];
    }
});

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('ventas', VentasController::class)->except(['create', 'edit']);
    Route::apiResource('usuarios', UserController::class)->except(['create', 'edit']);
    Route::apiResource('negocios', NegocioController::class)->except(['create', 'edit']);
    Route::apiResource('solicitudes', SolicitudesController::class)->except(['create', 'edit']);
    Route::apiResource('servicios', ServiciosController::class)->except(['create', 'edit']);
    Route::apiResource('subservicios', SubServicioController::class)->except(['create', 'edit']);
    Route::apiResource('carrito', CarritoController::class)->except(['create', 'edit', 'update']);
    Route::apiResource('excel', ExcelController::class)->except(['create', 'edit', 'update', 'store', 'show', 'destroy']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/tokens/create', function (Request $request) {

    if ($request->email == null || $request->password == null) {
        return ["error" => "Campos Email o Password Vacio"];
    }
    $newPass = $request->password;

    $user = User::where("email", $request->email)->first();

    $comprobar = decrypt($user->Password);

    if ($newPass == $comprobar) {
        if ($user) {
            $token = $user->createToken('Token');

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
