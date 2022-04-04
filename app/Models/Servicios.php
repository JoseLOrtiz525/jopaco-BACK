<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicios extends Model
{
    use HasFactory;

    protected $table = "servicios";

    protected $fillable = [
        'id',
        'Nombre_Servicio',
        'Costo',
        'Tiempo_Estimado',
        'Foto',
        'Negocio_Id'
    ];
}
