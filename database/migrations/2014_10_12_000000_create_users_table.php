<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('Nombre', 25)->comment('Nombre');
            $table->string('Apellido_Paterno', 25)->comment('Apellido_Paterno');
            $table->string('Apellido_Materno', 25)->nullable()->comment('Apellido_Materno');
            $table->date('Fecha_Nacimiento')->comment('Fecha de nacimiento');
            $table->enum('Tipo_Usuario', ['Administrador', 'Usuario', 'Usuario_Privilegiado'])->comment('Tipo_Usuario');
            $table->string('Email')->unique();
            $table->string('Password');

            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
