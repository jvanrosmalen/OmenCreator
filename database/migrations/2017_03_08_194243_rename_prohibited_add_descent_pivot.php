<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameProhibitedAddDescentPivot extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	Schema::rename('player_class_race','prohibited_player_class_race');
    	
 		Schema::create ( 'descent_player_class_race', function (Blueprint $table) {
			$table->integer ( 'race_id' )->unsigned ()->index ();
			$table->integer ( 'player_class_id' )->unsigned ()->index ();
		} );
		
		Schema::table ( 'descent_player_class_race', function (Blueprint $table) {
			$table->foreign ( 'race_id' )->references ( 'id' )->on ( 'races' )->onDelete ( 'cascade' );
			$table->foreign ( 'player_class_id' )->references ( 'id' )->on ( 'player_classes' )->onDelete ( 'cascade' );
		} );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    	Schema::rename('prohibited_player_class_race','player_class_race');
    	Schema::drop('descent_player_class_race');
    }
}
