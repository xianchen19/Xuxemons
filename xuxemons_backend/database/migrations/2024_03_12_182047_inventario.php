<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('inventario', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->enum('tipo', ['chuches', 'objeto']);
            $table->integer('cantidad');
            $table->text('descripcion')->nullable();
            $table->string('imagen')->nullable();
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('inventario');
    }
};
