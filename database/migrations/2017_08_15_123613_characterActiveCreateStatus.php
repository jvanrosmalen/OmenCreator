<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CharacterActiveCreateStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	Schema::table ( 'characters', function (Blueprint $table) {
    		$table->boolean( 'is_active' );
    		$table->integer( 'create_status' )->unsigned();
    	} );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    	Schema::table('characters', function($table) {
    		$table->dropColumn('is_active');
    		$table->dropColumn('create_status');
    	});
    }
}
