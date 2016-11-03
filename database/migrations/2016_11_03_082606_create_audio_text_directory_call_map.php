<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAudioTextDirectoryCallMap extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('audio_text_directory_call_map', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('audio_id');
            $table->integer('text_id');
            $table->integer('directory_id');
            $table->integer('call');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('audio_text_directory_call_map');
    }
}
