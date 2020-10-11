<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArtisMerchandiseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artis_merchandise', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_artis')->nullable();
            $table->string('foto');
            $table->string('nama');
            $table->double('harga');
            $table->text('desk');
            $table->timestamps();

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
        Schema::dropIfExists('artis_merchandise');
    }
}
