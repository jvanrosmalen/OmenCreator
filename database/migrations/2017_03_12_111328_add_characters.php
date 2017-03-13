<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCharacters extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	Schema::create ( 'characters', function (Blueprint $table) {
    		$table->increments('id')->index();
    		$table->string('name');
    		$table->integer( 'player_class_id' )->unsigned();
    		$table->integer( 'race_id' )->unsigned();
    		$table->integer( 'user_id' )->unsigned()->nullable();
    		$table->integer( 'ep_amount' )->unsigned();
    		$table->boolean( 'is_alive' );
    		$table->boolean( 'is_player_char' );
    		$table->string( 'link_to_background' )->nullable();
    	} );
    	
    	Schema::table ( 'characters', function (Blueprint $table) {
    		$table->foreign ( 'player_class_id' )->references ( 'id' )->on ( 'player_classes' );
    		$table->foreign ( 'race_id' )->references ( 'id' )->on ( 'races' );
    		$table->foreign ( 'user_id' )->references ( 'id' )->on ( 'users' );
    	} );
    	
    	Schema::create('character_skill', function (Blueprint $table) {
    		$table->integer( 'character_id' )->unsigned()->index();
    		$table->integer( 'skill_id' )->unsigned()->index();
    		$table->integer( 'purchase_ep_cost' );
    	} );
    	
   		Schema::table ( 'character_skill', function (Blueprint $table) {
   			$table->foreign ( 'character_id' )->references ( 'id' )->on ( 'characters' );
   			$table->foreign ( 'skill_id' )->references ( 'id' )->on ( 'skills' );
   		} );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    	Schema::drop('character_skill');
        Schema::drop('characters');
    }
}
