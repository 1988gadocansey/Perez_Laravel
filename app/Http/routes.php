<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
	return view('auth.login');
}) ;
 
// Authentication Routes...
Route::post('/auth/login', 'Auth\AuthController@postLogin');
Route::post('/login', 'Auth\AuthController@postLogin');
Route::get('/auth/login', 'Auth\AuthController@getLogin');
Route::get('/auth/logout', 'Auth\AuthController@getLogout');

// Registration Routes...
Route::get('/register', 'Auth\AuthController@getRegister');
Route::post('/register', 'Auth\AuthController@postRegister');

// frame Routes
   
Route::get('/', "FrameController@show_dashboard");
Route::get('/navigator', "FrameController@show_navigator");
Route::get('/home', "FrameController@showIndex");
Route::get('/dashboard', 'MembersController@index');
Route::post('/dashboard', 'MembersController@smsMembers');
Route::post('/dashboard', 'MembersController@sendMail');
 
// Members Routes
Route::get('/addMembers', 'MembersController@create');
Route::get('/viewMembers', 'MembersController@index');
Route::get('/printMembers', 'MembersController@memberPrint');


Route::resource('perez_service_type', 'Perez_Service_TypeController');

Route::resource('log', 'LogController');
 

