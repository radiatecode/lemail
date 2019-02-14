<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReceiversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receivers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('receiver_id')->unsigned();
            $table->integer('message_id')->unsigned();
            $table->timestamp('deleted_at')->nullable();
            $table->timestamp('read_at')->nullable();
            $table->foreign('receiver_id')->references('id')
                ->on('users')->onDelete('cascade');
            $table->foreign('message_id')->references('id')
                ->on('messages')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('receivers');
    }
}
