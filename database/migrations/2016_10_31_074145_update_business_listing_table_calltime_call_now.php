<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateBusinessListingTableCalltimeCallNow extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('business_listing', function (Blueprint $table) {
            $table->time('call_time')->nullable()->after('subscribed');
            $table->integer('call_now')->nullable()->after('call_time');
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
        Schema::table('business_listing', function(Blueprint $table) {
            $table->dropColumn('call_time');
            $table->dropColumn('call_now');   
        });
    }
}
