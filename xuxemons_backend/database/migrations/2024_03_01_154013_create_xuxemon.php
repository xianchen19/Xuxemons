<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('xuxemons', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('tipo');
            $table->string('tamano')->default('pequeño');
            $table->enum('role', ['administrador', 'usuario'])->default('usuario');
            $table->integer('vida')->default(100);
            $table->string('archivo')->nullable();;
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('xuxemons');
    }
};
