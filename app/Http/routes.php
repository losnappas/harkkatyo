<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();


Route::get('/home', function(){
    return view('welcome');
});
// 'HomeController@index');


Route::group(['middleware'=>'auth'], function(){
	Route::resource('/courses', 'CourseController');
	Route::resource('/tasks', 'TaskController');

	// Route::post('/courses/{id}/enroll', 'CourseController@enroll')->name('courses.enroll');
	Route::post('/courses/{id}/start', 'CourseController@start')->name('courses.start');
	
	//for js
	Route::get('/courses/{id}/tasks', 'CourseController@forvue');
	
	//prefix admin means '/admin/user' ..me thinks
	Route::group(['prefix' => 'admin'], function(){
		Route::get('/users/{id}/enrolls', 'UserController@enrolls');
		Route::resource('/users', 'UserController');
	});
	
});

Route::group(['prefix' => 'tiko'], function(){

	Route::post('/answered', 'TikoController@checkAnswers');
	Route::get('/answer/{taskid}', 'TikoController@getAnswers');
	Route::post('/attempt/start', 'TikoController@attemptStart');
	Route::post('/attempt', 'TikoController@attempt');
	Route::post('/session/done', 'TikoController@done');

	Route::get('/reports/r1', 'TikoController@r1');
	Route::get('/reports/r2', 'TikoController@r2');

});