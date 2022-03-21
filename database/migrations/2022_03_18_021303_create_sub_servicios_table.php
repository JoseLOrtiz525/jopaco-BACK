<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubServiciosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_servicios', function (Blueprint $table) {
            $table->id();
            $table->string('Nombre', 25)->comment('Nombre');
            $table->string('Descripcion', 100)->comment('Descripcion');
            $table->string('Calificacion', 25)->comment('Calificacion');
            $table->string('Precio', 25)->comment('Precio');
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
        Schema::dropIfExists('sub_servicios');
    }
}
