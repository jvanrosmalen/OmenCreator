<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddClassRuleSkill extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create ( 'class_rule_skill', function (Blueprint $table) {
			$table->integer( 'skill_id' )->unsigned()->index();
			$table->integer( 'class_rule_id' )->unsigned()->index();
		} );
		
		Schema::table('class_rule_skill', function(Blueprint $table){
			$table->foreign('skill_id')->references('id')->on('skills')->onDelete('cascade');
			$table->foreign('class_rule_id')->references('id')->on('class_rules')->onDelete('cascade');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('class_rule_skill');
    }
}
