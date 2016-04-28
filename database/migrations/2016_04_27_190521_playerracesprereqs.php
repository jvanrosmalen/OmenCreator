<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Playerracesprereqs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		// PlayerRacesPrereqs: contains race prereqs for a certain skill
		// Skills_id: foreign key to id in Skills
		// PlayerRace_race_name: foreign key to id in PlayerRaces
		Schema::create ( 'SkillRacePrereqs', function (Blueprint $table) {
			$table->integer ( 'Skills_id' )->unsigned ()->index ();
			$table->integer ( 'PlayerRaces_id' )->unsigned() -> index ();
		} );
		// set foreign keys
		Schema::table ( 'SkillRacePrereqs', function (Blueprint $table) {
			$table->foreign ( 'Skills_id' )->references ( 'id' )->on ( 'Skills' );
			$table->foreign ( 'PlayerRaces_id' )->references ( 'id' )->on ( 'PlayerRaces' );
		} );        //
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop("SkillRacePrereqs");
    }
}
