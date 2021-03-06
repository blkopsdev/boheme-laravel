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

Route::get('/home', 'DashboardController@index')->middleware('auth');

Route::get('/', 'DashboardController@index')->name('home')->middleware('auth');
Route::group(['prefix'=>'dashboard', 'middleware' => 'auth'], function(){
	Route::get('/', ['as'=>'dashboard', 'uses' => 'DashboardController@index']);
	Route::resource('transactions', 'TransactionController');
	Route::get('transactions/list/this-month', ['as' => 'transactions.month', 'uses' => 'TransactionController@month']);
	Route::get('transactions/list/this-year', ['as' => 'transactions.this_year', 'uses' => 'TransactionController@thisYear']);
	Route::get('transactions/list/last-year', ['as' => 'transactions.last_year', 'uses' => 'TransactionController@lastYear']);
	Route::get('transactions/list/all', ['as' => 'transactions.all', 'uses' => 'TransactionController@index']);
	Route::resource('customers', 'CustomerController', ['except' => ['delete']]);
	Route::resource('users', 'UserController');
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
	Route::group(['middleware'=>'only_admin_access'], function(){
		Route::resource('users', 'UserController');
		Route::post('user/password/{id}', ['as'=>'user_password', 'uses' =>  'UserController@updatePassword']);
		Route::get('settings', ['as'=>'settings', 'uses'=>'DashboardController@settings']);
		Route::post('settings', ['as'=>'update_settings', 'uses'=>'DashboardController@settingsUpdate']);
		Route::get('available-credits', ['as' => 'available_credits', 'uses' => 'DashboardController@availableCredits']);
		Route::get('customers/merge/{id}', ['as' => 'merge', 'uses' => 'CustomerController@merge']);
		Route::post('customers/merge/{id}', ['as' => 'merge_submit', 'uses' => 'CustomerController@mergeSubmit']);
		Route::resource('customers', 'CustomerController', ['only' => ['delete']]);
		Route::get('reports', ['as' => 'reports', 'uses'=>'TransactionController@reports']);
	});
});
Route::get('customer_ajax', 'CustomerController@customers');
Route::get('transactions_ajax', 'TransactionController@transactions');
Route::get('transactions_month_ajax', 'TransactionController@transactionsMonth');
Route::get('transactions_this_year_ajax', 'TransactionController@transactionsThisYear');
Route::get('transactions_last_year_ajax', 'TransactionController@transactionsLastYear');