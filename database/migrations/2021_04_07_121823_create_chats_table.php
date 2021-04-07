<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chats', function (Blueprint $table) {
            $table->bigIncrements('chatId');
            $table->bigInteger('senderId')->unsigned();
            $table->foreign('senderId')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('receiverId')->unsigned();
            $table->foreign('receiverId')->references('id')->on('users')->onDelete('cascade');;
            $table->text('chatText');
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
        Schema::dropIfExists('chats');
    }
}
