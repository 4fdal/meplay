<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMerchandiseDibeliTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchandise_dibeli', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_konser_marchandise');
            $table->unsignedBigInteger('id_penonton');
            $table->integer('jum');
            $table->double('total_harga');
            $table->integer('status_dibeli');
            $table->integer('status_pengiriman');
            $table->timestamps();

            $table->foreign('id_konser_marchandise')->references('id')->on('konser_merchandise')->onDelete('cascade');
            $table->foreign('id_penonton')->references('id')->on('penonton')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('merchandise_dibeli');
    }
}
