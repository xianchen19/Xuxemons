<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('evo_config', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('nivel'); // Nivel del Xuxemon
            $table->unsignedInteger('required_chuches'); // Caramelos necesarios para subir de nivel
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evo_config');
    }
};
