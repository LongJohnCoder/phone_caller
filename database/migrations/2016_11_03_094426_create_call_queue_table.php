<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCallQueueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('call_queue', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('pathxl')->nullable();
            $table->longText('phone')->nullable();
            $table->longText('usable_id')->nullable();
            $table->integer('called')->nullable();
            $table->integer('directory_type');
            $table->integer('buisness_listing_id');
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
        Schema::drop('call_queue');
    }
}
