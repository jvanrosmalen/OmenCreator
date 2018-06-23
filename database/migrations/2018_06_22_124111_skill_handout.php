<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SkillHandout extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table ( 'skills', function (Blueprint $table) {
            $table->string('skill_handout');
        } );        //
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table ( 'skills', function (Blueprint $table) {
            $table->dropColumn('skill_handout');
        } );        //
    }
}
