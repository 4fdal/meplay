<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKonserReviewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('konser_review', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_konser_eo')->nullable();
            $table->unsignedBigInteger('id_penonton')->nullable();
            $table->integer('rating')->nullable();
            $table->text('komentar');
            $table->timestamps();

            $table->foreign('id_konser_eo')->references('id')->on('konser_eo')->onDelete('cascade');
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
        Schema::dropIfExists('konser_review');
    }
}
