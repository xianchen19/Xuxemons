<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
 /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('xuxemons', function (Blueprint $table) {
            $table->boolean('atracon')->default(false)->after('vida');
            $table->boolean('sobredosis_azucar')->default(false)->after('vida');
            $table->boolean('bajon_azucar')->default(false)->after('vida');
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
            $table->dropColumn('atracon');
            $table->dropColumn('sobredosis_azucar');
            $table->dropColumn('bajon_azucar');
        });
    }
};
