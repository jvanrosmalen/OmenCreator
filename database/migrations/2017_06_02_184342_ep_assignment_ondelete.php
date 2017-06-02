<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EpAssignmentOndelete extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table( 'ep_assignments', function (Blueprint $table){
        	$table->dropForeign('ep_assignment_character_id_foreign');
   			$table->foreign( 'character_id' )->references('id')->on('characters')->onDelete('cascade');
   		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    	Schema::table( 'ep_assignments', function (Blueprint $table){
    		$table->dropForeign(['character_id']);
    		$table->foreign( 'character_id' )->references('id')->on('characters');
    	});
    }
}
