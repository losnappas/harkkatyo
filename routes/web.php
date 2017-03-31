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

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::resource('/courses', 'CourseController');
Route::resource('/tasks', 'TaskController');


// uhh middleware=>web is what now?
//Route::group(['middleware' => 'web'], function(){
//prefix admin means '/admin/user' ..me thinks
Route::group(['prefix' => 'admin'], function(){
	Route::resource('/users', 'UserController');
});
//});