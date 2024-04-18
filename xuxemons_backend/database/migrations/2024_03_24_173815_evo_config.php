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
<<<<<<< HEAD
            $table->unsignedInteger('required_chuches')->default(3); // Caramelos necesarios para subir de nivel
=======
            $table->unsignedInteger('required_chuches'); // Caramelos necesarios para subir de nivel
>>>>>>> 36c47a0f9bea999d24e080a78e1e1e0bb8a2cbfb
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
