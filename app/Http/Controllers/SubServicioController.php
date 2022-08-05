<?php

namespace App\Http\Controllers;

use App\Http\Resources\SubServicioCollection;
use App\Models\Negocio;
use App\Models\Servicios;
use App\Models\SubServicio;
use Illuminate\Http\Request;

class SubServicioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new SubServicioCollection(SubServicio::all());
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
            'Descripcion' => 'required|string',
            'Calificacion' => 'required|string|max:25',
            'Precio' => 'required|string|max:25',
            'Servicio_Id' => 'required'
        ]);
        $subServicio = SubServicio::create($request->all());
        // return new UserResource($Sub Servicio);
        return ['success' => "Sub Servicio Creado Correctamente"];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = SubServicio::find($id);
        return $user;
    }

    public function serviciosSubservicios($id)
    {
        $servicio = Servicios::find($id);
        $subServicio = SubServicio::where('Servicio_Id', $servicio->id)->get();
        return $subServicio;
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
            'Descripcion' => 'required|string',
            'Calificacion' => 'required|string|max:25',
            'Precio' => 'required|string|max:25',
            'Servicio_Id' => 'required'
        ]);

        $subServicio = SubServicio::find($id);

        $subServicio->Nombre = $request->Nombre;
        $subServicio->Descripcion = $request->Descripcion;
        $subServicio->Calificacion = $request->Calificacion;
        $subServicio->Precio = $request->Precio;
        $subServicio->Servicio_Id = $request->Servicio_Id;

        $subServicio->save();

        // se necesita validar por algun error en el correo

        return ['success' => "Sub Servicio Actualizado Correctamente"];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = SubServicio::find($id);
        $user->delete();
        return ['success' => "Sub Servicio Eliminado Correctamente"];
    }

    public function showAll($id)
    {
        // return $id;
        $subServicio = SubServicio::find($id);
        
        $servicio = Servicios::where('id', '=', $subServicio->Servicio_Id)
        ->get();
        $negocio = Negocio::where('id', '=', $servicio->Negocio_Id)
        ->get();


        $detalle = array(
            'Negocio_id' => $negocio->id,
            'Nombre_Negocio' => $negocio->Nombre_Negocio,
            'Direccion' => $negocio->Direccion,
            'Horario_Servicio' => $negocio->Horario_Servicio,
            'Dias_Servicio' => $negocio->Dias_Servicio,
            'Foto_Negocio' => $negocio->Foto,

            'Nombre_Servicio' => $servicio->Nombre_Servicio,
            'Costo' => $servicio->Costo,
            'Tiempo_Estimado' => $servicio->Tiempo_Estimado,
            'Foto_Servicio' => $servicio->Foto,

            'Nombre' => $subServicio->Nombre,
            'Descripcion' => $subServicio->Descripcion,
            'Calificacion' => $subServicio->Calificacion,
            'Precio' => $subServicio->Precio,
        );
        return $detalle;
    }
}
