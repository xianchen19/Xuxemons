<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('evo_config', function (Blueprint $table) {
            $table->integer('chuches_diarias')->default(10); // Añadir el campo chuches_diarias con un valor predeterminado de 10
        });
    }

    public function down()
    {
        Schema::table('evo_config', function (Blueprint $table) {
            $table->dropColumn('chuches_diarias'); // Eliminar el campo chuches_diarias si se hace un rollback
        });
    }
};
