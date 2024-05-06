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
        Schema::table('enfermedades', function (Blueprint $table) {
            $table->integer('xuxesBajon')->nullable()->default(2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('enfermedades', function (Blueprint $table) {
            $table->dropColumn('xuxesBajon');
        });
    }
};
