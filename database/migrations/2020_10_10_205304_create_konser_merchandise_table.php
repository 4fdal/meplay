<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKonserMerchandiseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('konser_merchandise', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_konser_eo')->nullable();
            $table->string('foto');
            $table->string('nama');
            $table->double('harga');
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
        Schema::dropIfExists('konser_merchandise');
    }
}
