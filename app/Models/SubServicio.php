<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubServicio extends Model
{
    use HasFactory;

    protected $table = "Sub_Servicios";

    protected $fillable = [
        'id',
        'Nombre',
        'Descripcion',
        'Calificacion',
        'Precio',
        'Servicio_Id'
    ];
}
