<?php


Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/home', 'HomeController@index');

    Route::get('/skillshowall', 'SkillController@showAll');
    Route::get('/create', 'SkillController@showSkillCreate');
    Route::post('/create_submit', 'SkillController@submitSkillCreate');

    Route::get('/player/', 'PlayerController@all');
    Route::get('/player/create', 'PlayerController@create');
    Route::post('/player/create_submit', 'PlayerController@createSubmit');


});
