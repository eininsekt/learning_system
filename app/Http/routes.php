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

Route::get('/', array('as' => 'home_route', 'uses' => 'HomeController@get'));
Route::get('/Dashboard','DashboardController@get');
Route::get('/Contact','ContactController@get');
Route::get('/Courses/{name}','Amar10Controller@get');
Route::get('Q/Courses/{name}','Amar10Controller@quest');
Route::get('/Profile','ProfileController@get');
Route::get('/UserArea','LoginController@get');
Route::post('/SignUp','LoginController@Signup');
Route::post('/Login','LoginController@Login');
Route::get('/SignUp/Check','LoginController@checkuser');
Route::get('/Logout','LoginController@Logout');
Route::post('/Contact','ContactController@post');

