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
	Route::get('/skillshowall', array( 'as'=> 'skill_showall', 'uses'=>'SkillController@showAll'))->middleware('isStoryTellingSystemRep');
	Route::get('/skillgroupshowall', array('as'=>'skillgroup_showall', 'uses'=>'SkillGroupController@showAll'))->middleware('isStoryTellingSystemRep');
	Route::get('/create_skill/{id?}', 'SkillController@showCreateSkill')->middleware('isSystemRep');
	Route::get('/create_skillgroup/{id?}', 'SkillGroupController@showCreateSkillGroup')->middleware('isSystemRep');
	Route::post('/create_skill_submit', 'SkillController@submitSkillCreate')->middleware('isSystemRep');
	Route::post('/create_skillgroup_submit', 'SkillGroupController@submitSkillGroupCreate')->middleware('isSystemRep');
	Route::post('/create_skill_update/{id}', 'SkillController@updateSkill')->middleware('isSystemRep');
	Route::post('/create_skillgroup_update/{id}', 'SkillGroupController@updateSkillGroup')->middleware('isSystemRep');
	Route::get('/show_delete_skill/{id}', 'SkillController@showDeleteSkill')->middleware('isSystemRep');
	Route::get('/show_delete_skillgroup/{id}', 'SkillGroupController@showDeleteSkillGroup')->middleware('isSystemRep');
	Route::get('/delete_skill/{id}', 'SkillController@deleteSkill')->middleware('isSystemRep');
	Route::get('/delete_skillgroup/{id}', 'SkillGroupController@deleteSkillGroup')->middleware('isSystemRep');
	Route::get('/home', 'HomeController@index');
	Route::get('/', 'HomeController@index');
	Route::get('/get_skill_levels_classes', 'JsonSkillController@getSkillLevelsClassesJson')->middleware('isStoryTellingSystemRep');
	Route::get('/get_skill_details', 'JsonSkillController@getSkillDetailsJson')->middleware('auth');
	
	Route::get('/create_armor/{id?}', 'EquipmentController@showCreateArmor')->middleware('isSystemRep');
	Route::get('/show_delete_armor/{id?}', 'EquipmentController@showDeleteArmor')->middleware('isSystemRep');
	Route::get('/delete_armor/{id?}', 'EquipmentController@deleteArmor')->middleware('isSystemRep');
	Route::post('/create_armor_submit', 'EquipmentController@submitArmorCreate')->middleware('isSystemRep');
	Route::post('/create_armor_update/{id?}', 'EquipmentController@updateArmor')->middleware('isSystemRep');
	Route::get('/showall_armor', array( 'as'=> 'showall_armor', 'uses'=>'EquipmentController@showAllArmor'))->middleware('isStoryTellingSystemRep');
	Route::get('/check_armor_name', 'JsonEquipmentController@checkArmorName')->middleware('isSystemRep');
	
	Route::get('/create_shield/{id?}', 'EquipmentController@showCreateShield')->middleware('isSystemRep');
	Route::get('/show_delete_shield/{id?}', 'EquipmentController@showDeleteShield')->middleware('isSystemRep');
	Route::get('/delete_shield/{id?}', 'EquipmentController@deleteShield')->middleware('isSystemRep');
	Route::post('/create_shield_submit', 'EquipmentController@submitShieldCreate')->middleware('isSystemRep');
	Route::post('/create_shield_update/{id?}', 'EquipmentController@updateShield')->middleware('isSystemRep');
	Route::get('/showall_shield', array( 'as'=> 'showall_shield', 'uses'=>'EquipmentController@showAllShield'))->middleware('isStoryTellingSystemRep');
	Route::get('/check_shield_name', 'JsonEquipmentController@checkShieldName')->middleware('isSystemRep');
	
	Route::get('/create_weapon/{id?}', 'EquipmentController@showCreateWeapon')->middleware('isSystemRep');
	Route::get('/show_delete_weapon/{id?}', 'EquipmentController@showDeleteWeapon')->middleware('isSystemRep');
	Route::get('/delete_weapon/{id?}', 'EquipmentController@deleteWeapon')->middleware('isSystemRep');
	Route::post('/create_weapon_submit', 'EquipmentController@submitWeaponCreate')->middleware('isSystemRep');
	Route::post('/create_weapon_update/{id?}', 'EquipmentController@updateWeapon')->middleware('isSystemRep');
	Route::get('/showall_weapon', array( 'as'=> 'showall_weapon', 'uses'=>'EquipmentController@showAllWeapon'))->middleware('isStoryTellingSystemRep');
	Route::get('/check_weapon_name', 'JsonEquipmentController@checkWeaponName')->middleware('isSystemRep');
	
	Route::get('/create_craft_equipment/{id?}', 'EquipmentController@showCreateCraftEquipment')->middleware('isSystemRep');
	Route::get('/show_delete_craft_equipment/{id?}', 'EquipmentController@showDeleteCraftEquipment')->middleware('isSystemRep');
	Route::get('/delete_craft_equipment/{id?}', 'EquipmentController@deleteCraftEquipment')->middleware('isSystemRep');
	Route::post('/create_craft_equipment_submit', 'EquipmentController@submitCraftEquipmentCreate')->middleware('isSystemRep');
	Route::post('/create_craft_equipment_update/{id?}', 'EquipmentController@updateCraftEquipment')->middleware('isSystemRep');
	Route::get('/showall_craft_equipment', array( 'as'=> 'showall_craft_equipment', 'uses'=>'EquipmentController@showAllCraftEquipment'))->middleware('isStoryTellingSystemRep');
	Route::get('/check_craft_equipment_name', 'JsonEquipmentController@checkCraftEquipmentName')->middleware('isSystemRep');
	
	Route::get('/create_generic_equipment/{id?}', 'EquipmentController@showCreateGenericEquipment')->middleware('isSystemRep');
	Route::get('/show_delete_generic_equipment/{id?}', 'EquipmentController@showDeleteGenericEquipment')->middleware('isSystemRep');
	Route::get('/delete_generic_equipment/{id?}', 'EquipmentController@deleteGenericEquipment')->middleware('isSystemRep');
	Route::post('/create_generic_equipment_submit', 'EquipmentController@submitGenericEquipmentCreate')->middleware('isSystemRep');
	Route::post('/create_generic_equipment_update/{id?}', 'EquipmentController@updateGenericEquipment')->middleware('isSystemRep');
	Route::get('/showall_generic_equipment', array( 'as'=> 'showall_generic_equipment', 'uses'=>'EquipmentController@showAllGenericEquipment'))->middleware('isStoryTellingSystemRep');
	Route::get('/check_generic_equipment_name', 'JsonEquipmentController@checkGenericEquipmentName')->middleware('isSystemRep');

	Route::get('/create_race/{id?}', 'RaceController@showCreateRace')->middleware('isSystemRep');
	Route::get('/show_delete_race/{id?}', 'RaceController@showDeleteRace')->middleware('isSystemRep');
	Route::get('/delete_race/{id?}', 'RaceController@deleteRace')->middleware('isSystemRep');
	Route::post('/create_race_submit', 'RaceController@submitRaceCreate')->middleware('isSystemRep');
	Route::post('/create_race_update/{id?}', 'RaceController@updateRace')->middleware('isSystemRep');
	Route::get('/showall_race', array( 'as'=> 'showall_race', 'uses'=>'RaceController@showAllRace'))->middleware('isStoryTellingSystemRep');
	Route::get('/check_race_name', 'JsonRaceController@checkRaceName')->middleware('isSystemRep');

	Route::get('/create_class/{id?}', 'ClassController@showCreateClass')->middleware('isSystemRep');
	Route::get('/show_delete_class/{id?}', 'ClassController@showDeleteClass')->middleware('isSystemRep');
	Route::get('/delete_class/{id?}', 'ClassController@deleteClass')->middleware('isSystemRep');
	Route::post('/create_class_submit', 'ClassController@submitClassCreate')->middleware('isSystemRep');
	Route::post('/create_class_update/{id?}', 'ClassController@updateClass')->middleware('isSystemRep');
	Route::get('/showall_class', array( 'as'=> 'showall_class', 'uses'=>'ClassController@showAllClass'))->middleware('isStoryTellingSystemRep');
	Route::get('/check_class_name', 'JsonClassController@checkClassName')->middleware('isSystemRep');
	Route::get('/get_prohibited_classes', 'JsonRaceController@getProhibitedClasses')->middleware('isStoryTelling');
	Route::get('/get_descent_skills', 'JsonRaceController@getDescentSkills')->middleware('isStoryTelling');
	Route::get('/get_class_skills_and_wealth', 'JsonClassController@getClassSkillsAndWealth')->middleware('isStoryTelling');
	Route::get('/get_class_wealth', 'JsonClassController@getClassWealth')->middleware('isStoryTelling');
	
	Route::get('/showall_rule', array( 'as'=> 'showall_rule', 'uses'=>'RulesController@showAllRule'))->middleware('isSystemRep');
	Route::get('/create_rule', 'RulesController@showCreateRule')->middleware('isSystemRep');
	Route::post('/create_rule_submit', 'RulesController@submitRuleCreate')->middleware('isSystemRep');
	Route::get('/show_delete_rule_statistic/{id?}', 'RulesController@showDeleteRuleStatistic')->middleware('isSystemRep');
	Route::get('/delete_rule_statistic/{id?}', 'RulesController@deleteRuleStatistic')->middleware('isSystemRep');
	Route::get('/check_rule_submit_statistic', 'JsonRuleController@ruleExistsStatistic')->middleware('isSystemRep');
	Route::get('/check_rule_submit_resistance', 'JsonRuleController@ruleExistsResistance')->middleware('isSystemRep');
	Route::get('/show_delete_rule_resistance/{id?}', 'RulesController@showDeleteRuleResistance')->middleware('isSystemRep');
	Route::get('/delete_rule_resistance/{id?}', 'RulesController@deleteRuleResistance')->middleware('isSystemRep');
	
	Route::get('/showall_user', ['as'=>'showall_user', 'uses' => 'UserController@showAll'])->middleware('isAdmin');
	Route::post('/submit_user/{id?}', 'UserController@submitUser')->middleware('isAdmin');
	Route::get('/show_delete_user/{id?}', 'UserController@showDeleteUser')->middleware('isAdmin');
	Route::get('/delete_user/{id?}', 'UserController@deleteUser')->middleware('isAdmin');
		
	Route::get('/create_player_character', 'CharacterController@showCreatePlayerCharacter')->middleware('isStoryTelling');
	Route::get('/create_player_character_basic_info', 'CharacterController@showCreatePlayerCharBasicInfo')->middleware('isStoryTelling');
	Route::post('/create_character_submit_basic_info', 'CharacterController@showCreatePlayerCharSkills')->middleware('isStoryTelling');
	Route::post('/create_character_submit_skills', 'CharacterController@doCreatePlayerChar')->middleware('isStoryTelling');
	Route::get('/show_kill_character/{charId?}', 'CharacterController@showKillCharacter')->middleware('isStoryTelling');
	Route::get('/kill_character/{charId?}', 'CharacterController@doKillCharacter')->middleware('isStoryTelling');
	Route::get('/show_delete_character/{charId?}', 'CharacterController@showDeleteCharacter')->middleware('isStoryTelling');
	Route::get('/delete_character/{charId?}', 'CharacterController@doDeleteCharacter')->middleware('isStoryTelling');
	Route::get('/showall_character', ['as'=>'showall_character', 'uses'=>'CharacterController@doShowAllPlayerChars'])->middleware('isStoryTelling');
	Route::get('/show_character/{charId?}', ['as'=>'show_character', 'uses'=>'CharacterController@doShowPlayerChar'])->middleware('isStoryTelling');
	Route::get('/show_edit_character/{charId?}', ['as'=>'show_edit_character', 'uses'=>'CharacterController@showEditPlayerChar'])->middleware('isStoryTelling');
	Route::post('/edit_character_submit', ['as'=>'edit_character_submit', 'uses'=>'CharacterController@editPlayerCharSubmit'])->middleware('isStoryTelling');
	Route::get('/get_combat_sheet','CharacterController@generateCombatSheet')->middleware('auth');
	Route::get('/my_playerchar', 'CharacterController@showMyCharacter')->middleware('auth');
// 	Route::get('/my_extras', 'CharacterController@showMyExtras');
	
	Route::get('/show_spark_start/{charId?}', ['as'=>'show_spark_start', 'uses'=>'SparkController@showSparkStart'])->middleware('isStoryTelling');
	Route::get('/show_spark_choice/{charId?}', ['as'=>'show_spark_choice', 'uses'=>'SparkController@showSparkChoice'])->middleware('isStoryTelling');
	Route::get('/show_spark_random/{charId?}', ['as'=>'show_spark_random', 'uses'=>'SparkController@showSparkRandom'])->middleware('isStoryTelling');
	Route::post('/spark_submit/{sparkId?}', ['as'=>'spark_submit', 'uses'=>'SparkController@submitSpark'])->middleware('isStoryTelling');
	Route::post('//handle_spark_choice', ['as'=>'handle_spark_choice', 'uses'=>'SparkController@handleSparkChoice'])->middleware('isStoryTelling');
	
	Route::auth();
	Route::get('/illegal_link', array( 'as'=> 'illegal_link', 'uses'=>function () {
		return view('/auth/illegal_link');
	}));
	
	Route::get('/my_profile', 'UserController@showProfile')->middleware('auth');
	Route::post('/new_username_submit', 'UserController@changeUserName')->middleware('auth');
	Route::post('/new_email_submit', 'UserController@changeUserEmail')->middleware('auth');
	Route::post('/new_password_submit', 'UserController@changeUserPassword')->middleware('auth');
	Route::get('/password_error', ['as'=>'password_error', 'uses'=>function(){return view('/user/errorWrongPassword');}])->middleware('auth');
	Route::get('/new_password_error', ['as'=>'new_password_error', 'uses'=>function(){return view('/user/errorNewPassword');}])->middleware('auth');
	Route::get('/new_passwords_not_equal_error', ['as'=>'new_passwords_not_equal_error', 'uses'=>function(){return view('/user/errorNewPasswordsNotEqual');}])->middleware('auth');
	Route::get('/profile_change_successful', ['as'=>'profile_change_successful', 'uses'=>function(){return view('/user/successChangeProfile');}])->middleware('auth');
	Route::get('/profile_name_change_error', ['as'=>'profile_name_change_error', 'uses'=>function(){return view('/user/profileNameChangeError');}])->middleware('auth');
	Route::get('/profile_email_change_error', ['as'=>'profile_email_change_error', 'uses'=>function(){return view('/user/profileEmailChangeError');}])->middleware('auth');
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