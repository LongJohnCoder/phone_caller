<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateCallStackDirectoryBuisnesslistingId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('call_stack', function (Blueprint $table) {
            $table->integer('directory_type');
            $table->integer('buisness_listing_id');
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
        
        Schema::table('call_stack', function(Blueprint $table) {
            $table->dropColumn('directory_type');
            $table->dropColumn('buisness_listing_id');   
        });
    }
}
