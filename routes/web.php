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

Route::get('/', 'DashboardController@index')->name('home')->middleware('auth');
Route::group(['prefix'=>'dashboard', 'middleware' => 'auth'], function(){
	Route::get('/', ['as'=>'dashboard', 'uses' => 'DashboardController@index']);
	Route::resource('transactions', 'TransactionController');
	Route::resource('customers', 'CustomerController');
	// Route::resource('user', 'UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
	Route::group(['middleware'=>'only_admin_access'], function(){
		Route::resource('users', 'UserController');
		// Route::get('user/create', ['as'=>'add_user', 'uses' => 'UserController@create']);
		// Route::post('user/create', ['as'=>'add_user', 'uses' => 'UserController@store']);
		// Route::get('user/edit/{id}', ['as'=>'edit_user', 'uses' => 'UserController@edit']);
		// Route::post('user/edit/{id}', ['as'=>'update_user', 'uses' => 'UserController@update']);
		Route::post('user/password/{id}', ['as'=>'user_password', 'uses' =>  'UserController@updatePassword']);
		Route::get('settings', ['as'=>'settings', 'uses'=>'DashboardController@settings']);
		Route::post('settings', ['as'=>'update_settings', 'uses'=>'DashboardController@settingsUpdate']);
		Route::get('available-credits', ['as' => 'available_credits', 'uses' => 'DashboardController@availableCredits']);
		Route::get('customers/merge/{id}', ['as' => 'merge', 'uses' => 'CustomerController@merge']);
		Route::post('customers/merge/{id}', ['as' => 'merge_submit', 'uses' => 'CustomerController@mergeSubmit']);
	});
});
Route::get('customer_ajax', 'CustomerController@customers');

