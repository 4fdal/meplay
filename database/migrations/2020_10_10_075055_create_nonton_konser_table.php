<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNontonKonserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nonton_konser', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_penonton')->nullable();
            $table->unsignedBigInteger('id_tiket_dibeli')->nullable();
            $table->unsignedBigInteger('id_konser_eo')->nullable();
            $table->timestamps();

            $table->foreign('id_penonton')->references('id')->on('penonton')->onDelete('cascade');
            $table->foreign('id_tiket_dibeli')->references('id')->on('tiket_dibeli')->onDelete('cascade');
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
        Schema::dropIfExists('nonton_konser');
    }
}
