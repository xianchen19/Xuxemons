<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('chats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('userTag');
            $table->unsignedBigInteger('friendTag');
            $table->string('email');
            $table->enum('status', ['enviado', 'recibido']);
            $table->text('message');
            $table->timestamps();

            // Definir las claves foráneas
            $table->foreign('userTag')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('friendTag')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('chats');
    }
}
