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
Route::get('/create_armor', 'EquipmentController@showCreateArmor');
Route::post('/create_armor_submit', 'EquipmentController@submitArmorCreate');
Route::get('/showall_armor', 'EquipmentController@showAllArmor');

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
