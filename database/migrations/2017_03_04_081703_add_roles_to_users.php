<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRolesToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	Schema::table('users', function($table) {
    		$table->boolean('is_player');
    		$table->boolean('is_admin');
    		$table->boolean('is_system_resp');
    		$table->boolean('is_story_telling');
    	});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    	Schema::table('users', function($table) {
    		$table->dropColumn('is_player');
    		$table->dropColumn('is_admin');
    		$table->dropColumn('is_system_resp');
    		$table->dropColumn('is_story_telling');
    	});
    }
}
