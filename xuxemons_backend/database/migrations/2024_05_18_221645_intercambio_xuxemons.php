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
        Schema::create('intercambio_xuxemons', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_tag');
            $table->unsignedBigInteger('friend_tag');
            $table->unsignedBigInteger('xuxemon_id');
            $table->enum('status', ['pendiente', 'aceptada', 'rechazada'])->default('pendiente');
            $table->timestamps();

            $table->foreign('user_tag')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('friend_tag')->references('id')->on('users')->onDelete('cascade');

            $table->unique(['xuxemon_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('intercambio_xuxemons');
    }
};
