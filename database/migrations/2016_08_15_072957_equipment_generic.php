<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EquipmentGeneric extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create ( 'generic_equipments', function (Blueprint $table) {
			$table->increments ( 'id' )->index ();
			$table->string ('name');
			$table->text( 'description' );
			$table->integer('price_normal');
			$table->integer('price_good');
			$table->integer('price_master');
		} );
		
		Schema::create ( 'call_rule_generic_equipment', function (Blueprint $table) {
			$table->integer( 'generic_equipment_id' )->unsigned()->index();
			$table->integer( 'call_rule_id' )->unsigned()->index();
		} );
		
		Schema::table('call_rule_generic_equipment', function(Blueprint $table){
			$table->foreign('generic_equipment_id')->references('id')->on('generic_equipments')->onDelete('cascade');
			$table->foreign('call_rule_id')->references('id')->on('call_rules')->onDelete('cascade');
		});

		Schema::create ( 'damage_rule_generic_equipment', function (Blueprint $table) {
			$table->integer( 'generic_equipment_id' )->unsigned()->index();
			$table->integer( 'damage_rule_id' )->unsigned()->index();
		} );
		
		Schema::table('damage_rule_generic_equipment', function(Blueprint $table){
			$table->foreign('generic_equipment_id')->references('id')->on('generic_equipments')->onDelete('cascade');
			$table->foreign('damage_rule_id')->references('id')->on('damage_rules')->onDelete('cascade');
		});
			
		Schema::create ( 'generic_equipment_resistance_rule', function (Blueprint $table) {
			$table->integer( 'generic_equipment_id' )->unsigned()->index();
			$table->integer( 'resistance_rule_id' )->unsigned()->index();
		} );
		
		Schema::table('generic_equipment_resistance_rule', function(Blueprint $table){
			$table->foreign('generic_equipment_id')->references('id')->on('generic_equipments')->onDelete('cascade');
			$table->foreign('resistance_rule_id')->references('id')->on('resistance_rules')->onDelete('cascade');
		});

		Schema::create ( 'generic_equipment_statistic_rule', function (Blueprint $table) {
			$table->integer( 'generic_equipment_id' )->unsigned()->index();
			$table->integer( 'statistic_rule_id' )->unsigned()->index();
		} );
		
		Schema::table('generic_equipment_statistic_rule', function(Blueprint $table){
			$table->foreign('generic_equipment_id')->references('id')->on('generic_equipments')->onDelete('cascade');
			$table->foreign('statistic_rule_id')->references('id')->on('statistic_rules')->onDelete('cascade');
		});
		
		Schema::create ( 'generic_equipment_wealth_rule', function (Blueprint $table) {
			$table->integer( 'generic_equipment_id' )->unsigned()->index();
			$table->integer( 'wealth_rule_id' )->unsigned()->index();
		} );
		
		Schema::table('generic_equipment_wealth_rule', function(Blueprint $table){
			$table->foreign('generic_equipment_id')->references('id')->on('generic_equipments')->onDelete('cascade');
			$table->foreign('wealth_rule_id')->references('id')->on('wealth_rules')->onDelete('cascade');
		});
	}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    	Schema::drop('call_rule_generic_equipment');
    	Schema::drop('damage_rule_generic_equipment');
    	Schema::drop('generic_equipment_resistance_rule');
    	Schema::drop('generic_equipment_statistic_rule');
    	Schema::drop('generic_equipment_wealth_rule');
    	Schema::drop('generic_equipments');
    }
}
