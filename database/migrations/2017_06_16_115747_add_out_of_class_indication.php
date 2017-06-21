<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOutOfClassIndication extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
   		Schema::table ( 'character_skill', function (Blueprint $table) {
   			$table->boolean('is_out_of_class_skill');
   		} );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
   		Schema::table ( 'character_skill', function (Blueprint $table) {
   			$table->dropColumn('is_out_of_class_skill');
   		} );
    }
}
