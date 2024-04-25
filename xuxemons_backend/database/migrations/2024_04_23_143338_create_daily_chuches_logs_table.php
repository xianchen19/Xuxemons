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
        Schema::create('daily_chuches_logs', function (Blueprint $table) {
            $table->id();
            $table->string('email'); // Cambio de tipo de dato a string para almacenar el email
            $table->foreign('email')->references('email')->on('users')->onDelete('cascade'); // Referencia al campo 'email' de la tabla 'users'
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
        Schema::dropIfExists('daily_chuches_logs');
    }
};
