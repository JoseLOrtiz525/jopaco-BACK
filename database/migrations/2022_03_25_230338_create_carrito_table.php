<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarritoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carrito', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->unsignedBigInteger('Usuario_Id');
            $table->foreign('Usuario_Id')->references('id')->on('users');

            $table->unsignedBigInteger('SubServicio_Id');
            $table->foreign('SubServicio_Id')->references('id')->on('sub_servicios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('favritos');
    }
}
