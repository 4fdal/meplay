<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIkutiArtisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ikuti_artis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_artis');
            $table->unsignedBigInteger('id_penonton');
            $table->timestamps();

            // jika penonton ikuti artis
            // artis share marchendes otomatis inbox user
            // artis konser otomatis inbox users

            $table->foreign('id_artis')->references('id')->on('artis')->onDelete('cascade');
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
        Schema::dropIfExists('ikuti_artis');
    }
}
