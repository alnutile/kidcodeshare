<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
    //Latest 4 codes
    $code = Code::all()->take(5);
    $account = getenv('git_user');
	return View::make('layouts.home', compact('code', 'account'));
});


//

// Confide routes
Route::get('users/create', 'UsersController@create');
Route::post('users', 'UsersController@store');
Route::get('users/login', 'UsersController@login');
Route::post('users/login', 'UsersController@doLogin');
Route::get('users/confirm/{code}', 'UsersController@confirm');
Route::get('users/forgot_password', 'UsersController@forgotPassword');
Route::post('users/forgot_password', 'UsersController@doForgotPassword');
Route::get('users/reset_password/{token}', 'UsersController@resetPassword');
Route::post('users/reset_password', 'UsersController@doResetPassword');
Route::get('users/logout', 'UsersController@logout');

Route::get('codes/{id}', 'CodesController@show');

Route::group(array('before'=>'auth'), function() {
    Route::resource('codes', 'CodesController');
    Route::get('codes/mine/{user_id}', 'CodesController@mine');
    Route::get('profile', function()
        {
            return "Coming soon...";
        });
});