<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Negocio extends Model
{
    use HasFactory;

    protected $table = "negocios";

    protected $fillable = [
        'id',
        'Nombre_Negocio',
        'Direccion',
        'Horario_Servicio',
        'Dias_Servicio',
        'Descripcion_Del_Negocio',
        'Usuario_Id'
    ];
}
