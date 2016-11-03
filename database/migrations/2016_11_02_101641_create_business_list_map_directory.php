<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessListMapDirectory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_list_map_directory', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('business_list_id');
            $table->integer('directory_id');
            $table->integer('called')->nullable();
            $table->integer('subscribed')->nullable();
            $table->time('call_time')->nullable();
            $table->integer('call_now')->nullable();
            $table->dateTime('call_at')->nullable();
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
        
        Schema::drop('business_list_map_directory');
    }
}
