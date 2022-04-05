<?php

namespace App\Http\Controllers;

use App\Http\Resources\VentasCollection;
use App\Models\Ventas;
use Illuminate\Http\Request;

class VentasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new VentasCollection(Ventas::all());
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
            'Fecha' => 'required',
            'Usuario_Id' => 'required',
            'Total' => 'required'
        ]);
        Ventas::create($request->all());
        // return new UserResource($usuario);
        return ['success' => "Ventas Agregado Correctamente"];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ventas  $ventas
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $venta = Ventas::find($id);
        return $venta;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ventas  $ventas
     * @return \Illuminate\Http\Response
     */
    public function edit(Ventas $ventas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ventas  $ventas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'Fecha' => 'required',
            'Usuario_Id' => 'required',
            'Total' => 'required'
        ]);

        $user = Ventas::find($id);

        $user->Fecha = $request->Fecha;
        $user->Usuario_Id = $request->Usuario_Id;
        $user->Total = $request->Total;

        $user->save();

        return ['success' => "Venta Actualizado Correctamente"];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ventas  $ventas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $venta = Ventas::find($id);
        $venta->delete();
        return ['success' => "Venta Eliminada Correctamente"];
    }
}
