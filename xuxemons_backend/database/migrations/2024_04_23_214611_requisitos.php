<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('xuxemons', function (Blueprint $table) {
            $table->integer('requisitos_crecimiento')->default(0);
        });
    }

    public function down()
    {
        Schema::table('xuxemons', function (Blueprint $table) {
            $table->dropColumn('requisitos_crecimiento');
        });
    }
};
