<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCraftSkill extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
   		Schema::table ( 'skills', function (Blueprint $table) {
   			$table->boolean('craft_skill');
   		} );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
   		Schema::table ( 'skills', function (Blueprint $table) {
   			$table->dropColumn('craft_skill');
   		} );
    }
}
