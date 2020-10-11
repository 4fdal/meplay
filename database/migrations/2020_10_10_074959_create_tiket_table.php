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
            $table->string('nama')->nullable();
            $table->integer('jumlah_tiket')->nullable();
            $table->dateTime('exp_waktu_pembelian')->nullable();
            $table->double('harga')->nullable();
            $table->double('harga_replay')->nullable();
            $table->text('desk')->nullable();
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
