<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessListingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('business_listing', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('type');
            $table->longText('company_name')->nullable();
            $table->longText('website')->nullable();
            $table->longText('address')->nullable();
            $table->longText('phone')->nullable();
            $table->longText('email_id')->nullable();
            $table->integer('called')->nullable();
            $table->integer('subscribed')->nullable();
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
        Schema::drop('business_listing');
    }
}
