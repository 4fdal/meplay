<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKonserEoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('konser_eo', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_eo');
            $table->integer('jum_tiket');
            $table->string('foto');
            $table->string('judul');
            $table->datetime('waktu');
            $table->text('desk');
            $table->string('faq');
            $table->text('link_leve_konser');
            $table->timestamps();

            $table->foreign('id_eo')->references('id')->on('eo')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('konser_eo');
    }
}
