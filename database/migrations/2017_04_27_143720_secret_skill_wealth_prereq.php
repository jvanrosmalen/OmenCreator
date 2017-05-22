<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SecretSkillWealthPrereq extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('skills', function(Blueprint $table){
        	$table->boolean('secret_skill');
        	$table->integer('wealth_prereq_id')->unsigned();
        });
        
       	Schema::table('skills', function(Blueprint $table){
       		$table->foreign('wealth_prereq_id')->references('id')->on('wealth_types');
       	});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('skills', function($table)
		{
    		$table->dropForeign(['wealth_prereq_id']);
    		$table->dropColumn('wealth_prereq_id');
    		$table->dropColumn('secret_skill');
		});
    }
}
