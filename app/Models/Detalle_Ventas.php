<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detalle_Ventas extends Model
{
    use HasFactory;

    protected $table = "detalle_ventas";

    protected $fillable = [
        'id',
        'Ventas_Id',
        'SubServicios_Id'
    ];
}
