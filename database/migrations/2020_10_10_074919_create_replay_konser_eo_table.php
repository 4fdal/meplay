<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReplayKonserEoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('replay_konser_eo', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_konser_eo');
            $table->text('link_replay_konser')->nullable();
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
        Schema::dropIfExists('replay_konser_eo');
    }
}
