<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArtisKonserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artis_konser', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_eo');
            $table->unsignedBigInteger('id_konser_eo');
            $table->unsignedBigInteger('id_artis');
            $table->timestamps();

            $table->foreign('id_eo')->references('id')->on('eo')->onDelete('cascade');
            $table->foreign('id_konser_eo')->references('id')->on('konser_eo')->onDelete('cascade');
            $table->foreign('id_artis')->references('id')->on('artis')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('artis_konser');
    }
}
