<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTiketDibeliTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tiket_dibeli', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_penonton');
            $table->unsignedBigInteger('id_konser_eo');
            $table->double('jum_pembayaran')->nullable();
            $table->integer('status_penggunaan')->nullable();
            $table->datetime('exp_pembatalan')->nullable();
            $table->timestamps();

            $table->foreign('id_penonton')->references('id')->on('penonton')->onDelete('cascade');
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
        Schema::dropIfExists('tiket_dibeli');
    }
}
