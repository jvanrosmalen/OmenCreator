<?php

use App\Skill;
use App\SkillLevel;
/*
 * Testje
 */



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
