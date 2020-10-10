<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTiketTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tiket', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_konser_eo');
            $table->string('nama');
            $table->integer('level');
            $table->double('harga');
            $table->integer('status_replay');
            $table->datetime('exp_replay');
            $table->text('desk');
            $table->timestamps();

            $table->foreign('id_konser_eo')->references('id')->on('konser_eo')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tiket');
    }
}
