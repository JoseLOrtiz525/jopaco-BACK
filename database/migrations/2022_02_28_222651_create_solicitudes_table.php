<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolicitudesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitudes', function (Blueprint $table) {
            $table->id();
            $table->string('Total', 25)->comment('Total');
            $table->string('Horario_Renta', 25)->comment('Horario_Renta');
            $table->timestamps();

            $table->unsignedBigInteger('Usuario_Id');
            $table->foreign('Usuario_Id')->references('id')->on('users');

            $table->unsignedBigInteger('Servicio_Id');
            $table->foreign('Servicio_Id')->references('id')->on('servicios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('solicitudes');
    }
}
