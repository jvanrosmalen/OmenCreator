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
	Route::get('/skillshowall', 'SkillController@showAll');
	//Route::get('/create_skill', 'SkillController@showCreateSkill');
	Route::get('/create_skill/{id?}', 'SkillController@showCreateSkill');
	Route::post('/create_skill_submit', 'SkillController@submitSkillCreate');
	Route::post('/create_skill_update/{id}', 'SkillController@updateSkill');
	Route::get('/show_delete_skill/{id}', 'SkillController@showDeleteSkill');
	Route::get('/delete_skill/{id}', 'SkillController@deleteSkill');
	Route::get('/home', 'HomeController@index');
	Route::get('/', 'HomeController@index');
	Route::get('/get_skill_levels_classes', 'JsonSkillController@getSkillLevelsClassesJson');
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

	Route::get('/create_race/{id?}', 'RaceController@showCreateRace');
	Route::get('/show_delete_race/{id?}', 'RaceController@showDeleteRace');
	Route::get('/delete_race/{id?}', 'RaceController@deleteRace');
	Route::post('/create_race_submit', 'RaceController@submitRaceCreate');
	Route::post('/create_race_update/{id?}', 'RaceController@updateRace');
	Route::get('/showall_race', array( 'as'=> 'showall_race', 'uses'=>'RaceController@showAllRace'));
	Route::get('/check_race_name', 'JsonRaceController@checkRaceName');

	Route::get('/create_class/{id?}', 'ClassController@showCreateClass');
	Route::get('/show_delete_class/{id?}', 'ClassController@showDeleteClass');
	Route::get('/delete_class/{id?}', 'ClassController@deleteClass');
	Route::post('/create_class_submit', 'ClassController@submitClassCreate');
	Route::post('/create_class_update/{id?}', 'ClassController@updateClass');
	Route::get('/showall_class', array( 'as'=> 'showall_class', 'uses'=>'ClassController@showAllClass'));
	Route::get('/check_class_name', 'JsonClassController@checkClassName');
	Route::get('/get_prohibited_classes', 'JsonRaceController@getProhibitedClasses');
	Route::get('/get_descent_skills', 'JsonRaceController@getDescentSkills');
	Route::get('/get_class_skills', 'JsonClassController@getClassSkills');
	
	Route::get('/showall_rule', array( 'as'=> 'showall_rule', 'uses'=>'RulesController@showAllRule'));
	Route::get('/create_rule', 'RulesController@showCreateRule');
	Route::post('/create_rule_submit', 'RulesController@submitRuleCreate');
	Route::get('/show_delete_rule_statistic/{id?}', 'RulesController@showDeleteRuleStatistic');
	Route::get('/delete_rule_statistic/{id?}', 'RulesController@deleteRuleStatistic');
	Route::get('/check_rule_submit_statistic', 'JsonRuleController@ruleExistsStatistic');
	Route::get('/check_rule_submit_resistance', 'JsonRuleController@ruleExistsResistance');
	Route::get('/show_delete_rule_resistance/{id?}', 'RulesController@showDeleteRuleResistance');
	Route::get('/delete_rule_resistance/{id?}', 'RulesController@deleteRuleResistance');
	
	Route::get('/showall_user', ['as'=>'showall_user', 'uses' => 'UserController@showAll']);
	Route::post('/submit_user/{id?}', 'UserController@submitUser');
	Route::get('/show_delete_user/{id?}', 'UserController@showDeleteUser');
	Route::get('/delete_user/{id?}', 'UserController@deleteUser');
	
	Route::get('/create_player_character', 'CharacterController@showCreatePlayerCharacter');
	Route::get('/showall_character', ['as'=>'showall_character', 'uses'=>'CharacterController@showAllCharacter']);
	
	Route::auth();

    Route::get('/home', 'HomeController@index');
});

// Route::group(['middleware' => 'web'], function () {
// 	Route::auth();
	
// 	Route::get('/home', 'HomeController@index');

// });


View::composer(array('popups.createSkillSelector'), function($view)
{
	$selectedProducts = "a1, a2";
	$view->with(['skills' => Skill::all(), "skilllevels"=>SkillLevel::all()]);
});
?>