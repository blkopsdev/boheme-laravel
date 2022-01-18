<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/home', 'DashboardController@index')->name('home');
Auth::routes();

Route::get('/', 'DashboardController@index')->name('home')->middleware('auth');
Route::post('/send_email/welcome', ['as'=>'email_welcome', 'uses' => 'EmailController@welcome']);
Route::group(['prefix'=>'dashboard', 'middleware' => 'auth'], function(){
	Route::get('/', ['as'=>'dashboard', 'uses' => 'DashboardController@index']);
	Route::group(['prefix'=>'projects'], function(){
		Route::get('/', ['as'=>'projects', 'uses' => 'DashboardController@index']);
		Route::get('create', ['as'=>'create_project', 'uses' => 'ProjectController@create']);
		Route::post('create', ['uses' => 'ProjectController@store']);
		Route::get('/{id}', ['as'=>'project', 'uses'=> 'ProjectController@show']);
		Route::post('update/{id}', ['as'=>'update_project', 'uses'=> 'ProjectController@updateFields']);
	});
	Route::get('table-list', function () {
		return view('pages.table_list');
	})->name('table');

	Route::get('typography', function () {
		return view('pages.typography');
	})->name('typography');

	Route::get('icons', function () {
		return view('pages.icons');
	})->name('icons');

	Route::get('map', function () {
		return view('pages.map');
	})->name('map');

	Route::get('notifications', function () {
		return view('pages.notifications');
	})->name('notifications');

	Route::get('rtl-support', function () {
		return view('pages.language');
	})->name('language');

	Route::resource('user', 'UserController', ['except' => ['show']]);
	Route::get('user/create', ['as'=>'add_user', 'uses' => 'UserController@create']);
	Route::post('user/create', ['as'=>'add_user', 'uses' => 'UserController@store']);
	Route::get('user/edit/{id}', ['as'=>'edit_user', 'uses' => 'UserController@edit']);
	Route::post('user/edit/{id}', ['as'=>'update_user', 'uses' => 'UserController@update']);
	Route::post('user/password/{id}', ['as'=>'user_password', 'uses' =>  'UserController@updatePassword']);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
});


