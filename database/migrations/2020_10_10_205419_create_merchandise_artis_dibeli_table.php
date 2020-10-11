<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMerchandiseArtisDibeliTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchandise_artis_dibeli', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_artis_merchandise');
            $table->unsignedBigInteger('id_penonton');
            $table->integer('jum');
            $table->double('total_harga');
            $table->integer('status_dibeli');
            $table->integer('status_pengiriman');
            $table->timestamps();

            $table->foreign('id_artis_merchandise')->references('id')->on('artis_merchandise')->onDelete('cascade');
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
        Schema::dropIfExists('merchandise_artis_dibeli');
    }
}
