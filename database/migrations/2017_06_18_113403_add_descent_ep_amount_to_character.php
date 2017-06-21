<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDescentEpAmountToCharacter extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
   		Schema::table ( 'characters', function (Blueprint $table) {
   			$table->integer('descent_ep_amount');
   		} );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
   		Schema::table ( 'characters', function (Blueprint $table) {
   			$table->dropColumn('descent_ep_amount');
   		} );
    }
}
