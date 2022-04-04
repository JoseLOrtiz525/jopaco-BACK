<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiciosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servicios', function (Blueprint $table) {
            $table->id();
            $table->string('Nombre_Servicio', 25)->comment('Nombre_Servicio');
            $table->string('Costo', 25)->comment('Costo');
            $table->string('Tiempo_Estimado', 25)->comment('Tiempo_Estimado');
            $table->string('Foto', 25)->comment('Foto');
            $table->timestamps();

            $table->unsignedBigInteger('Negocio_Id');
            $table->foreign('Negocio_Id')->references('id')->on('negocios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('servicios');
    }
}
