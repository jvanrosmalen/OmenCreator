<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CharacterDescentClassPivot extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create ( 'character_descent_class', function (Blueprint $table) {
			$table->integer ( 'character_id' )->unsigned ()->index ();
			$table->integer ( 'player_class_id' )->unsigned() -> index ();
		} );
		
		Schema::table ( 'character_descent_class', function (Blueprint $table) {
			$table->foreign ( 'character_id' )->references ( 'id' )->on ( 'characters' )->onDelete('cascade');
			$table->foreign ( 'player_class_id' )->references ( 'id' )->on ( 'player_classes' )->onDelete('cascade');
		} );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('character_descent_class');
    }
}
