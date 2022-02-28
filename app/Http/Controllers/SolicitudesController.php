<?php

namespace App\Http\Controllers;

use App\Http\Resources\SolicitudesCollection;
use App\Models\Solicitudes;
use Illuminate\Http\Request;

class SolicitudesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new SolicitudesCollection(Solicitudes::all());
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
            'Total' => 'required|string|max:25',
            'Horario_Renta' => 'required|string|max:25',
            'Usuario_Id' => 'required',
            'Servicio_Id' => 'required',
        ]);
        $solicitudes = Solicitudes::create($request->all());
        // return new UserResource($usuario);
        return ['success' => "Solicitudes Creado Correctamente"];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Solicitudes  $solicitudes
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $solicitudes = Solicitudes::find($id);
        return $solicitudes;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Solicitudes  $solicitudes
     * @return \Illuminate\Http\Response
     */
    public function edit(Solicitudes $solicitudes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Solicitudes  $solicitudes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'Total' => 'required|string|max:25',
            'Horario_Renta' => 'required|string|max:25',
            'Usuario_Id' => 'required',
            'Servicio_Id' => 'required',
        ]);

        $solicitudes = Solicitudes::find($id);

        $solicitudes->Total = $request->Total;
        $solicitudes->Horario_Renta = $request->Horario_Renta;
        $solicitudes->Usuario_Id = $request->Usuario_Id;
        $solicitudes->Servicio_Id = $request->Servicio_Id;

        $solicitudes->save();

        return ['success' => "Solicitud Actualizado Correctamente"];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Solicitudes  $solicitudes
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $solicitudes = Solicitudes::find($id);
        $solicitudes->delete();
        return ['success' => "Solicitud Eliminado Correctamente"];
    }
}
