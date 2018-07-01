<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PlayerExtraInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table ( 'characters', function (Blueprint $table) {
            $table->mediumText('extra_info');
        } );         //
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table ( 'characters', function (Blueprint $table) {
            $table->dropColumn('extra_info');
        } );   
    }
}
