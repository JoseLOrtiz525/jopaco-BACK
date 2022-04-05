<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Models\User;
use Illuminate\Http\Request;

use Maatwebsite\Excel\Facades\Excel; 

class ExcelController extends Controller
{
    public function index()
    {
        return Excel::download(new UsersExport, 'user-list.xls');  
    }

    public function descargar(){
        
        $file="Archivo";
        $data=array(
            array("", "id","","Nombre","","Apellido Paterno","","Apellido Materno","","Fecha de nacimineto","Tipo de usuario","Email","Password","Foto")
        );

        $users=User::where('Nombre', '=', )->get();

        foreach ($users as $row){
       $vacio = "";
           array_push($data, array(

                $vacio,
                $row->id,
                $vacio,
                $row->Nombre,
                $row->Apellido_Paterno,
                $row->Apellido_Materno,
                $row->Fecha_Nacimiento,
                $row->Tipo_Usuario,
                $vacio,
                $row->Email,
                $row->Password,
                $row->Foto,
                
            ));
        }

        $export = new UsersExport($data);
        return Excel::download($export, $file.'.xlsx');
    }
}
