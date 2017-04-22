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
		Schema::create ( 'race_prereq_skill', function (Blueprint $table) {
			$table->integer ( 'race_id' )->unsigned ()->index ();
			$table->integer ( 'skill_id' )->unsigned ()->index ();
		} );
		
		Schema::create ( 'race_race_skill', function (Blueprint $table) {
			$table->integer ( 'race_id' )->unsigned ()->index ();
			$table->integer ( 'skill_id' )->unsigned ()->index ();
		} );
		
		Schema::table ( 'race_prereq_skill', function (Blueprint $table) {
			$table->foreign ( 'race_id' )->references ( 'id' )->on ( 'races' )->onDelete ( 'cascade' );
			$table->foreign ( 'skill_id' )->references ( 'id' )->on ( 'skills' )->onDelete ( 'cascade' );
		} );
	
		Schema::table ( 'race_race_skill', function (Blueprint $table) {
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
        Schema::drop('race_race_skill');
        Schema::drop('race_prereq_skill');
    }
}
