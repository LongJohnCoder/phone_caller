<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCallStackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('call_stack', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('pathxl')->nullable();
            $table->longText('phone')->nullable();
            $table->longText('audiofile')->nullable();
            $table->integer('called')->nullable();
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
        Schema::drop('call_stack');
    }
}
