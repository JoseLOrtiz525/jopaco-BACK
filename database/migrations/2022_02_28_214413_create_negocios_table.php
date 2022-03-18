<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNegociosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('negocios', function (Blueprint $table) {
            $table->id();
            $table->string('Nombre_Negocio', 25)->comment('Nombre_Negocio');
            $table->string('Direccion', 25)->comment('Direccion');
            $table->string('Horario_Servicio', 25)->comment('Horario_Servicio');
            $table->string('Dias_Servicio', 25)->comment('Dias_Servicio');
            $table->string('Descripcion_Del_Negocio', 100)->comment('Descripcion_Del_Negocio');
            $table->string('Foto', 25)->comment('Foto');
            $table->timestamps();

            $table->unsignedBigInteger('Usuario_Id');
            $table->foreign('Usuario_Id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('negocios');
    }
}
