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
    		$table->boolean('is_accepted');
    		$table->boolean('is_admin');
    		$table->boolean('is_system_rep');
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
    		$table->dropColumn('is_accepted');
    		$table->dropColumn('is_admin');
    		$table->dropColumn('is_system_rep');
    		$table->dropColumn('is_story_telling');
    	});
    }
}
