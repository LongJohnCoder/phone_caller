<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateCallStackTableCallTest extends Migration
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
            $table->text('text_cont')->nullable()->after('audiofile');
            
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
            $table->dropColumn('text_cont');
        });
    }
}
