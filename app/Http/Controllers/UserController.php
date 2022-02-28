<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new UserCollection(User::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'Nombre' => 'required|string|max:25',
            'Apellido_Paterno' => 'required|string|max:25',
            'Apellido_Materno' => 'required|nullable|string|max:25',
            'Fecha_Nacimiento' => 'required|date_format:Y-m-d',
            'Tipo_Usuario' => 'required|in:Administrador, Usuario, Usuario_Privilegiado',
            'Email' => 'required|email|unique:users,email',
            'Password' => 'required|min:8'
        ]);
        $usuario = User::create($request->all());
        // return new UserResource($usuario);
        return ['success' => "Usuario Creado Correctamente"];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return $user;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'Nombre' => 'required|string|max:25',
            'Apellido_Paterno' => 'required|string|max:25',
            'Apellido_Materno' => 'bail|nullable|string|max:25',
            'Fecha_Nacimiento' => 'required|date_format:Y-m-d',
            'Tipo_Usuario' => 'required|in:Administrador, Usuario, Usuario_Privilegiado',
            'Email' => 'required|email',
            'Password' => 'required|min:8'
        ]);

        $user = User::find($id);

        $user->Nombre = $request->Nombre;
        $user->Apellido_Paterno = $request->Apellido_Paterno;
        $user->Apellido_Materno = $request->Apellido_Materno;
        $user->Fecha_Nacimiento = $request->Fecha_Nacimiento;
        $user->Tipo_Usuario = $request->Tipo_Usuario;
        $user->Email = $request->Email;
        $user->Password = $request->Password;

        $user->save();

        // se necesita validar por algun error en el correo

        return ['success' => "Usuario Actualizado Correctamente"];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return ['success' => "Usuario Eliminado Correctamente"];
    }
}
