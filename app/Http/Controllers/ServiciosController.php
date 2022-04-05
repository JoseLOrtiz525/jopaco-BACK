<?php

namespace App\Http\Controllers;

use App\Http\Resources\ServiciosCollection;
use App\Http\Resources\ServiciosResource;
use App\Models\Servicios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServiciosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new ServiciosCollection(Servicios::all());
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
            'Nombre_Servicio' => 'required|string|max:25',
            'Costo' => 'required|string|max:25',
            'Tiempo_Estimado' => 'required|string|max:25',
            'Foto' => "required",
            "Negocio_Id" => "required"
        ]);
        //$servicios = Servicios::create($request->all());
        // return new ServiciosResource($servicios);

        $file = $request->file('Foto');

        $extension = $file->getClientOriginalExtension();

        $name = time() . "." . $extension;

        $file->move(public_path() . '/img/', $name);

        DB::table("servicios")
            ->insert([
                "Nombre_Servicio" => $request['Nombre_Servicio'],
                "Costo" => $request['Costo'],
                "Tiempo_Estimado" => $request['Tiempo_Estimado'],
                "Foto" => $name,
                "Negocio_Id" => $request['Negocio_Id']
            ]);

        return ['success' => "Servicio Creado Correctamente"];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Servicios  $servicios
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $servicios = Servicios::find($id);
        return $servicios;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Servicios  $servicios
     * @return \Illuminate\Http\Response
     */
    public function edit(Servicios $servicios)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Servicios  $servicios
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'Nombre_Servicio' => 'required|string|max:25',
            'Costo' => 'required|string|max:25',
            'Tiempo_Estimado' => 'required|string|max:25',
            'Foto' => 'required',
            "Negocio_Id" => "required"
        ]);

        $file = $request->file('Foto');

        $extension = $file->getClientOriginalExtension();

        $name = time() . "." . $extension;

        $file->move(public_path() . '/img/', $name);

        $servicios = Servicios::find($id);

        $servicios->Nombre_Servicio = $request->Nombre_Servicio;
        $servicios->Costo = $request->Costo;
        $servicios->Tiempo_Estimado = $request->Tiempo_Estimado;
        $servicios->Foto = $name;
        $servicios->Negocio_Id = $request->Negocio_Id;

        $servicios->save();

        // se necesita validar por algun error en el correo

        return ['success' => "Servicio Actualizado Correctamente"];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Servicios  $servicios
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $servicios = Servicios::find($id);
        $servicios->delete();
        return ['success' => "Servicio Eliminado Correctamente"];
    }
}
