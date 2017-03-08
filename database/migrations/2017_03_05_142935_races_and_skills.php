<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RacesAndSkills extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create ( 'race_skill', function (Blueprint $table) {
			$table->integer ( 'race_id' )->unsigned ()->index ();
			$table->integer ( 'skill_id' )->unsigned ()->index ();
		} );
		
		Schema::table ( 'race_skill', function (Blueprint $table) {
			$table->foreign ( 'race_id' )->references ( 'id' )->on ( 'races' )->onDelete ( 'cascade' );
			$table->foreign ( 'skill_id' )->references ( 'id' )->on ( 'skills' )->onDelete ( 'cascade' );
		} );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('race_skill');
    }
}
