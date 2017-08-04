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
Route::get('/Dashboard/SetGoal','DashboardController@SetGoal');
Route::get('/Contact','ContactController@get');
Route::get('/Courses/{name}','Amar10Controller@get');
Route::get('/Q/Courses/{name}','Amar10Controller@quest');
Route::get('/AddCourse/{name}','Amar10Controller@add');
Route::post('/Q/Check','Amar10Controller@check');
Route::post('/Q/Save','Amar10Controller@save');
Route::get('/Q/WarningSave','Amar10Controller@warning');
Route::get('/Q/Delete','Amar10Controller@delete');
Route::get('/Q/Continue','Amar10Controller@continuethis');
Route::get('/tashih',function (){
   return view('CorrectionAmar10');
});
Route::get('/Profile','ProfileController@get');
Route::get('/Profile/Check','ProfileController@check');
Route::post('/Profile','ProfileController@change');
Route::post('/ChangePass','ProfileController@changepass');
Route::get('/UserArea','LoginController@get');
Route::post('/SignUp','LoginController@Signup');
Route::post('/Login','LoginController@Login');
Route::get('/SignUp/Check','LoginController@checkuser');
Route::get('/Logout','LoginController@Logout');
Route::post('/Contact','ContactController@post');

