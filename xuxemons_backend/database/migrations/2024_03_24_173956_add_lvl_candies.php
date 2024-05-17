<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('xuxemons', function (Blueprint $table) {
            $table->unsignedTinyInteger('nivel')->default(1); // Columna para almacenar el nivel del Xuxemon
            $table->unsignedInteger('chuches')->default(0); // Columna para almacenar la cantidad de caramelos acumulados
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('xuxemons', function (Blueprint $table) {
            $table->dropColumn('nivel');
            $table->dropColumn('chuches');
        });
    }
};
