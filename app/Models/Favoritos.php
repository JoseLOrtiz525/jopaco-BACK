<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favoritos extends Model
{
    use HasFactory;

    protected $table = "favoritos";

    protected $fillable = [
        'id',
        'Usuario_Id',
        'Servicio_Id'
    ];
}
