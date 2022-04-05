<?php

namespace App\Http\Controllers;

use App\Http\Resources\CarritoCollection;
use App\Models\Carrito;
use App\Models\SubServicio;
use Illuminate\Http\Request;

class CarritoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new CarritoCollection(Carrito::all());
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
            'Usuario_Id' => 'required',
            'SubServicio_Id' => 'required'
        ]);
        Carrito::create($request->all());
        // return new UserResource($usuario);
        return ['success' => "Carrito Agregado Correctamente"];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Carrito = Carrito::find($id);
        return $Carrito;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
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
        $subservicios = SubServicio::where('id', $id)->get();
        return $subservicios;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Carrito = Carrito::where('SubServicio_Id', $id)->get();
        $Carrito[0]->delete();
        return ['success' => "Carrito Eliminado Correctamente"];
    }
}
