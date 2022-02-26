<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;
    
    protected $table = "usuarios";

    protected $fillable = [
        'id',
        'Nombre',
        'Apellido_Paterno',
        'Apellido_Materno',
        'Fecha_Nacimiento',
        'Tipo_Usuario',
        'Email',
        'Password'
    ];

    
}
