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
		// skill_id: foreign key to id in Skills
		// PlayerRace_race_name: foreign key to id in PlayerRaces
		Schema::create ( 'skill_race_prereqs', function (Blueprint $table) {
			$table->integer ( 'skill_id' )->unsigned ()->index ();
			$table->integer ( 'player_race_id' )->unsigned() -> index ();
		} );
		// set foreign keys
		Schema::table ( 'skill_race_prereqs', function (Blueprint $table) {
			$table->foreign ( 'skill_id' )->references ( 'id' )->on ( 'Skills' )->onDelete('cascade');
			$table->foreign ( 'player_race_id' )->references ( 'id' )->on ( 'player_races' )->onDelete('cascade');
		} );        //
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop("skill_race_prereqs");
    }
}
