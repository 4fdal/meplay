<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNontonReplayKonserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nonton_replay_konser', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_penonton');
            $table->unsignedBigInteger('id_tiket_dibeli');
            $table->unsignedBigInteger('id_replay_konser_eo');
            $table->timestamps();

            $table->foreign('id_penonton')->references('id')->on('penonton')->onDelete('cascade');
            $table->foreign('id_tiket_dibeli')->references('id')->on('tiket_dibeli')->onDelete('cascade');
            $table->foreign('id_replay_konser_eo')->references('id')->on('replay_konser_eo')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nonton_replay_konser');
    }
}
