<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTempPoblacionTable extends Migration
{
    public function up()
    {
        Schema::create('temp_poblacion', function (Blueprint $table) {
            $table->string('nombre');
            $table->string('paterno');
            $table->string('materno');
            $table->string('telefono');
            $table->string('calle');
            $table->string('numero_exterior');
            $table->string('numero_interior')->nullable();
            $table->string('colonia');
            $table->string('cp');
        });
    }

    public function down()
    {
        Schema::dropIfExists('temp_poblacion');
    }
}
