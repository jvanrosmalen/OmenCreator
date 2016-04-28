<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlayerraces extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create ( 'playerraces', function (Blueprint $table) {
			$table->increments( 'id')->index();
			$table->string ( 'race_name', 255 );
		} );
		
		// Seed the PlayerClasses table
		DB::table ( 'playerraces' )->insert ( array (
				'race_name' => 'Mannheimer'
		) );
		DB::table ( 'playerraces' )->insert ( array (
				'race_name' => 'Goliad'
		) );
		DB::table ( 'playerraces' )->insert ( array (
				'race_name' => 'Khali&euml;r'
		) );
		DB::table ( 'playerraces' )->insert ( array (
				'race_name' => 'Bhanda Korr'
		) );
		DB::table ( 'playerraces' )->insert ( array (
				'race_name' => 'Ranae'
		) );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::drop ( 'playerraces' );
    }
}
