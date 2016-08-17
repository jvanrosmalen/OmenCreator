<?php 
use App\Skill;
use App\SkillLevel;



/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// // route to show the login form
// Route::get('login', array('uses' => 'HomeController@showLogin'));

// // route to process the form
// Route::post('login', array('uses' => 'HomeController@doLogin'));

Route::get('/skillshowall', 'SkillController@showAll');
Route::get('/create', 'SkillController@showSkillCreate');
Route::post('/create_submit', 'SkillController@submitSkillCreate');
Route::get('/home', 'HomeController@index');
Route::get('/', 'HomeController@index');
Route::get('/jsonskill', 'JsonSkillController@decodeJson');
Route::get('/get_skill_details', 'JsonSkillController@getSkillDetailsJson');

Route::get('/create_armor/{id?}', 'EquipmentController@showCreateArmor');
Route::get('/show_delete_armor/{id?}', 'EquipmentController@showDeleteArmor');
Route::get('/delete_armor/{id?}', 'EquipmentController@deleteArmor');
Route::post('/create_armor_submit', 'EquipmentController@submitArmorCreate');
Route::post('/create_armor_update/{id?}', 'EquipmentController@updateArmor');
Route::get('/showall_armor', array( 'as'=> 'showall_armor', 'uses'=>'EquipmentController@showAllArmor'));
Route::get('/check_armor_name', 'JsonEquipmentController@checkArmorName');

Route::get('/create_shield/{id?}', 'EquipmentController@showCreateShield');
Route::get('/show_delete_shield/{id?}', 'EquipmentController@showDeleteShield');
Route::get('/delete_shield/{id?}', 'EquipmentController@deleteShield');
Route::post('/create_shield_submit', 'EquipmentController@submitShieldCreate');
Route::post('/create_shield_update/{id?}', 'EquipmentController@updateShield');
Route::get('/showall_shield', array( 'as'=> 'showall_shield', 'uses'=>'EquipmentController@showAllShield'));
Route::get('/check_shield_name', 'JsonEquipmentController@checkShieldName');

Route::get('/create_weapon/{id?}', 'EquipmentController@showCreateWeapon');
Route::get('/show_delete_weapon/{id?}', 'EquipmentController@showDeleteWeapon');
Route::get('/delete_weapon/{id?}', 'EquipmentController@deleteWeapon');
Route::post('/create_weapon_submit', 'EquipmentController@submitWeaponCreate');
Route::post('/create_weapon_update/{id?}', 'EquipmentController@updateWeapon');
Route::get('/showall_weapon', array( 'as'=> 'showall_weapon', 'uses'=>'EquipmentController@showAllWeapon'));
Route::get('/check_weapon_name', 'JsonEquipmentController@checkWeaponName');

Route::get('/create_craft_equipment/{id?}', 'EquipmentController@showCreateCraftEquipment');
Route::get('/show_delete_craft_equipment/{id?}', 'EquipmentController@showDeleteCraftEquipment');
Route::get('/delete_craft_equipment/{id?}', 'EquipmentController@deleteCraftEquipment');
Route::post('/create_craft_equipment_submit', 'EquipmentController@submitCraftEquipmentCreate');
Route::post('/create_craft_equipment_update/{id?}', 'EquipmentController@updateCraftEquipment');
Route::get('/showall_craft_equipment', array( 'as'=> 'showall_craft_equipment', 'uses'=>'EquipmentController@showAllCraftEquipment'));
Route::get('/check_craft_equipment_name', 'JsonEquipmentController@checkCraftEquipmentName');

Route::get('/create_generic_equipment/{id?}', 'EquipmentController@showCreateGenericEquipment');
Route::get('/show_delete_generic_equipment/{id?}', 'EquipmentController@showDeleteGenericEquipment');
Route::get('/delete_generic_equipment/{id?}', 'EquipmentController@deleteGenericEquipment');
Route::post('/create_generic_equipment_submit', 'EquipmentController@submitGenericEquipmentCreate');
Route::post('/create_generic_equipment_update/{id?}', 'EquipmentController@updateGenericEquipment');
Route::get('/showall_generic_equipment', array( 'as'=> 'showall_generic_equipment', 'uses'=>'EquipmentController@showAllGenericEquipment'));
Route::get('/check_generic_equipment_name', 'JsonEquipmentController@checkGenericEquipmentName');

Route::get('/showall_rule', array( 'as'=> 'showall_rule', 'uses'=>'RulesController@showAllRule'));
Route::get('/create_rule', 'RulesController@showCreateRule');
Route::post('/create_rule_submit', 'RulesController@submitRuleCreate');
Route::get('/show_delete_rule_statistic/{id?}', 'RulesController@showDeleteRuleStatistic');
Route::get('/delete_rule_statistic/{id?}', 'RulesController@deleteRuleStatistic');
Route::get('/check_rule_submit_statistic', 'JsonRuleController@ruleExistsStatistic');
Route::get('/check_rule_submit_resistance', 'JsonRuleController@ruleExistsResistance');
Route::get('/show_delete_rule_resistance/{id?}', 'RulesController@showDeleteRuleResistance');
Route::get('/delete_rule_resistance/{id?}', 'RulesController@deleteRuleResistance');


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/home', 'HomeController@index');
});


View::composer(array('popups.createSkillSelector'), function($view)
{
	$selectedProducts = "a1, a2";
	$view->with(['skills' => Skill::all(), "skilllevels"=>SkillLevel::all()]);
});
?>