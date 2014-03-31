<?php

Route::post('queue/push', function()
{
	return Queue::marshal();
});

/*
|--------------------------------------------------------------------------
| Auth
|--------------------------------------------------------------------------
*/

Route::get('login', array('as' => 'auth-login', 'uses' => 'AuthController@create'));
Route::get('logout', array('as' => 'auth-logout', 'uses' => 'AuthController@destroy'));
Route::resource('auth', 'AuthController', array('only' => array('create', 'store', 'destroy')));

Route::get('forgot-password', array('as' => 'auth-forgot-password', 'uses' => 'AuthController@forgotPassword'));
Route::post('forgot-password', array('uses' => 'AuthController@postForgotPassword'));
Route::get('reset-password/{token}', array('as' => 'auth-reset-password', 'uses' => 'AuthController@resetPassword'));
Route::post('reset-password', array('uses' => 'AuthController@postResetPassword'));

/*
|--------------------------------------------------------------------------
| Basic User functions
|--------------------------------------------------------------------------
*/

// Route::get('user/profile/{show_tab}', array('as' => 'user-profile-tab', 'uses' => 'UserController@profileTab'));
Route::get('user/profile', array('as' => 'user-profile', 'uses' => 'UserController@profile'));
Route::post('user/profile/update-password', array('as' => 'user-update-password', 'uses' => 'UserController@selfChangePassword'));
Route::post('user/profile/update-localization', array('as' => 'user-update-localization', 'uses' => 'UserController@selfUpdateLocalization'));

Route::get('user/register', array('as' => 'user-register', 'uses' => 'UserController@register'));
Route::post('user/register', array('uses' => 'UserController@postRegister'));

Route::get('user/verify/{crypt_user_id}', array('as' => 'user-verify', 'uses' => 'UserController@verify'));
Route::post('user/verify', array('uses' => 'UserController@postVerify'));

/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
*/

Route::group(array('prefix' => 'dashboard', 'before' => 'auth'), function()
{
	## General Dashboard functions

	Route::get('/', array('as' => 'dashboard-index', 'uses' => 'DashboardController@index'));

	## User Management

	Route::get('users/verification-reminder/{crypt_user_id}', array('as' => 'dashboard.users.verification_reminder', 'uses' => 'UserController@verificationRemind'));
	Route::resource('users', 'UserController');
});

/*-------------- end admin --------------*/



Route::resource('cart', 'CartController');

/*
|--------------------------------------------------------------------------
| Deal detail
|--------------------------------------------------------------------------
*/

Route::get('deal/{deal_link}', array('as' => 'deal-detail', 'uses' => 'DealController@detail'));/*

|--------------------------------------------------------------------------
| City promotions & selection
|--------------------------------------------------------------------------
*/

Route::get('select', array('as' => 'city-index', 'uses' => 'CityController@index'));
Route::get('{city_slug}/{dealcategory_slug?}', array('as' => 'city-promos', 'uses' => 'CityController@promotions'));

/*
|--------------------------------------------------------------------------
| Home
|--------------------------------------------------------------------------
*/

Route::get('/', array('as' => 'home-index', 'uses' => 'HomeController@index'));