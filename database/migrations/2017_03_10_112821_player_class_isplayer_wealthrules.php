<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PlayerClassIsplayerWealthrules extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('player_classes',function($table){
        	$table->integer('wealth_type_id')->unsigned();
        	$table->boolean('is_player_class');
        	$table->text('description');
        });      
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::table ( 'player_classes', function ($table) {
			$table->dropColumn ( 'description' );
			$table->dropColumn ( 'is_player_class' );
			$table->dropColumn ( 'wealth_type_id' );
		} );
    }
}
