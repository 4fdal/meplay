<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaveDataDocumentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('save_data_document', function (Blueprint $table) {
            $table->id();
            $table->string('key')->nullable();
            $table->string('original_name')->nullable();
            $table->string('mime_type')->nullable();
            $table->binary('value')->nullable();
            $table->timestamps();

        });
        
        DB::statement("ALTER TABLE save_data_document MODIFY COLUMN value LONGBLOB");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('save_data_document');
    }
}
