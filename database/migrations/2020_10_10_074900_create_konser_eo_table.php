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
            $table->integer('jum_tiket')->nullable();
            $table->string('foto')->nullable();
            $table->string('judul')->nullable();
            $table->datetime('waktu_mulai')->nullable();
            $table->datetime('waktu_selesai')->nullable();
            $table->text('desk')->nullable();
            $table->text('link_live_konser')->nullable();
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
