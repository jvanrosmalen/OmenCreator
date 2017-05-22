<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLifespark extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	Schema::table ( 'characters', function (Blueprint $table) {
    		$table->string('spark_data');
    	} );
    	
   		Schema::table ( 'character_skill', function (Blueprint $table) {
   			$table->dropForeign(['character_id']);
   			$table->foreign('character_id')->references('id')->on('characters')->onDelete('cascade');
   			$table->dropForeign(['skill_id']);
   			$table->foreign('skill_id')->references('id')->on('skills')->onDelete('cascade');
   		} );    	
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table ( 'characters', function (Blueprint $table) {
    		$table->dropColumn('spark_data');
    	} );
    }
}
