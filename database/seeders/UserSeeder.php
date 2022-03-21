<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now('America/Mexico_City')->format('Y-m-d H:i:s');

        User::insert([
            'Nombre'  => 'Administrador',
            'Apellido_Paterno'  => 'Dsm',
            'Apellido_Materno'  => 'Dmm',
            'Fecha_Nacimiento'  => '2020-01-01',
            'Tipo_Usuario' => 'Administrador',
            'Email'  => 'administrador@correo.com',
            'Password' => encrypt('12345678'),
            'Foto' => 'Angel.jpg',
            'created_at' => $now,
            'updated_at' => $now
        ]);
    }
}
