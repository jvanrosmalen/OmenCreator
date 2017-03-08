<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RaceDecentProhibitedClasses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::table ( 'races', function ($table) {
			$table->integer('descent_class')->unsigned()->nullable();
			$table->foreign('descent_class')->references('id')->on('player_classes');
		} );
		
		Schema::create ( 'player_class_race', function (Blueprint $table) {
			$table->integer ( 'race_id' )->unsigned ()->index ();
			$table->integer ( 'player_class_id' )->unsigned ()->index ();
		} );
		
		Schema::table ( 'player_class_race', function (Blueprint $table) {
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
		Schema::table ( 'races', function (Blueprint $table) {
			$table->dropColumn ( 'descent_class' );
		} );
		
		Schema::drop("player_class_race");
    }
}
