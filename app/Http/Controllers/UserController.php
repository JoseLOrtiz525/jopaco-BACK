<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

use App\Exports\UsersExport;
use Prophecy\Doubler\Generator\Node\ReturnTypeNode;

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
            'Apellido_Materno' => 'required|string|max:25',
            'Fecha_Nacimiento' => 'required',
            'Tipo_Usuario' => 'required|in:Administrador, Usuario, Usuario_Privilegiado',
            'Email' => 'required|email|unique:users,email',
            'Password' => 'required|min:8',
            'Foto' => "required|image|mimes:jpeg,png,jpg|max:3000",
        ]);

        $file = $request->file('Foto');

        $extension = $file->getClientOriginalExtension();

        $name = time() . "." . $extension;

        $file->move(public_path() . '/img/', $name);

        DB::table("users")
            ->insert([
                "Nombre" => $request['Nombre'],
                "Apellido_Paterno" => $request['Apellido_Paterno'],
                "Apellido_Materno" => $request['Apellido_Materno'],
                "Fecha_Nacimiento" => $request['Fecha_Nacimiento'],
                "Tipo_Usuario" => $request['Tipo_Usuario'],
                "Email" => $request['Email'],
                "Password" => $request['Password'],
                "Foto" => $name
            ]);
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
            'Apellido_Materno' => 'required|string|max:25',
            'Fecha_Nacimiento' => 'required',
            'Tipo_Usuario' => 'required|in:Administrador, Usuario, Usuario_Privilegiado',
            'Email' => 'required|email',
            'Password' => 'required|min:8',
            'Foto' => 'required'
        ]);

        $user = User::find($id);

        if ($user->Foto != $request->Foto) {
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
            $img_file = "img/" . $user->Foto;

            // Save the GD resource as PNG in the best possible quality (no compression)
            // This will strip any metadata or invalid contents (including, the PHP backdoor)
            // To block any possible exploits, consider increasing the compression level
            imagepng($im, $img_file, 0);

            $name = $user->Foto;
        } else {
            $name = $user->Foto;
        }

        $user->Nombre = $request->Nombre;
        $user->Apellido_Paterno = $request->Apellido_Paterno;
        $user->Apellido_Materno = $request->Apellido_Materno;
        $user->Fecha_Nacimiento = $request->Fecha_Nacimiento;
        $user->Tipo_Usuario = $request->Tipo_Usuario;
        $user->Email = $request->Email;
        $user->Password = $request->Password;
        $user->Foto = $name;

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
