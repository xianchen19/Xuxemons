<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
   public function up()
    {
        Schema::create('enfermedades', function (Blueprint $table) {
            $table->id();
            $table->integer('porcentaje_bajon_azucar')->default(5);
            $table->integer('porcentaje_sobredosis_azucar')->default(10);
            $table->integer('porcentaje_atracon')->default(15);
            // Otros campos que puedas necesitar
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
        Schema::dropIfExists('enfermedades');
    }
};
