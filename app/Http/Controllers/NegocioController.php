<?php

namespace App\Http\Controllers;

use App\Http\Resources\NegocioCollection;
use App\Models\Negocio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

use App\Exports\UsersExport;
use Prophecy\Doubler\Generator\Node\ReturnTypeNode;

class NegocioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new NegocioCollection(Negocio::all());
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
            'Nombre_Negocio' => 'required|string|max:25',
            'Direccion' => 'required|string|max:25',
            'Horario_Servicio' => 'required|string|max:25',
            'Dias_Servicio' => 'required|string|max:25',
            'Descripcion_Del_Negocio' => 'required|string|max:25',
            'Usuario_Id' => 'required',
            'Foto' => "required|image|mimes:jpeg,png,jpg|max:3000"
        ]);
        //$negocio = Negocio::create($request->all());
        // return new UserResource($usuario);

        $file = $request->file('Foto');

        $extension = $file->getClientOriginalExtension();

        $name = time() . "." . $extension;

        $file->move(public_path() . '/img/', $name);

        DB::table("negocios")
            ->insert([
                "Nombre_Negocio" => $request['Nombre_Negocio'],
                "Direccion" => $request['Direccion'],
                "Horario_Servicio" => $request['Horario_Servicio'],
                "Dias_Servicio" => $request['Dias_Servicio'],
                "Descripcion_Del_Negocio" => $request['Descripcion_Del_Negocio'],
                "Usuario_Id" => $request['Usuario_Id'],
                "Foto" => $name
            ]);
        return ['success' => "Negocio Creado Correctamente"];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Negocio  $negocio
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $negocio = Negocio::find($id);
        return $negocio;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Negocio  $negocio
     * @return \Illuminate\Http\Response
     */
    public function edit(Negocio $negocio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Negocio  $negocio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'Nombre_Negocio' => 'required|string|max:25',
            'Direccion' => 'required|string|max:25',
            'Horario_Servicio' => 'required|string|max:25',
            'Dias_Servicio' => 'required|string|max:25',
            'Descripcion_Del_Negocio' => 'required|string|max:25',
            'Usuario_Id' => 'required',
            'Foto' => 'required'
        ]);

        $negocio = Negocio::find($id);

        if ($negocio->Foto != $request->Foto) {
            // Define the Base64 value you need to save as an image
            $b64 = $request->Foto;

            $data = explode(',', $b64);
            // Obtain the original content (usually binary data)
            $bin = base64_decode($data[1]);

            // Load GD resource from binary data
            $im = imageCreateFromString($bin);

            // Make sure that the GD library was able to load the image
            // This is important, because you should not miss corrupted or unsupported images
            if (!$im) {
                die('Base64 value is not a valid image');
            }

            // Specify the location where you want to save the image
            $img_file = "img/" . $negocio->Foto;

            // Save the GD resource as PNG in the best possible quality (no compression)
            // This will strip any metadata or invalid contents (including, the PHP backdoor)
            // To block any possible exploits, consider increasing the compression level
            imagepng($im, $img_file, 0);

            $name = $negocio->Foto;
        } else {
            $name = $negocio->Foto;
        }

        $negocio->Nombre_Negocio = $request->Nombre_Negocio;
        $negocio->Direccion = $request->Direccion;
        $negocio->Horario_Servicio = $request->Horario_Servicio;
        $negocio->Dias_Servicio = $request->Dias_Servicio;
        $negocio->Descripcion_Del_Negocio = $request->Descripcion_Del_Negocio;
        $negocio->Usuario_Id = $request->Usuario_Id;
        $negocio->Foto = $name;

        $negocio->save();

        // se necesita validar por algun error en el correo

        return ['success' => "Negocio Actualizado Correctamente"];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Negocio  $negocio
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $negocio = Negocio::find($id);
        $negocio->delete();
        return ['success' => "Negocio Eliminado Correctamente"];
    }
}
