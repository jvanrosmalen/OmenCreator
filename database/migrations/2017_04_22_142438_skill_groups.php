<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SkillGroups extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create ( 'skill_groups', function (Blueprint $table) {
    		$table->increments('id')->index();
    		$table->string('name');
    		$table->string('desc_short');
    	} );
		
		Schema::create('skill_skill_group', function(Blueprint $table){
			$table->integer( 'skill_id' )->unsigned()->index();
			$table->integer( 'skill_group_id' )->unsigned()->index();			
		});
		
		Schema::table('skill_skill_group', function (Blueprint $table) {
   			$table->foreign ( 'skill_id' )->references ( 'id' )->on ( 'skills' )->onDelete('cascade');
   			$table->foreign ( 'skill_group_id' )->references ( 'id' )->on ( 'skill_groups' )->onDelete('cascade');
   		} );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('skill_skill_group');
        Schema::drop('skill_groups');
    }
}
