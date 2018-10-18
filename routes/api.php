<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// AUTHENTICATION ROUTES
Route::group([ 'prefix' => 'auth' ], function ()
{
    Route::post('login', 'AuthController@login');
    Route::post('register', 'AuthController@register');

    Route::get('signup/open/{token}', 'AuthController@open');
    Route::get('signup/check/{token}', 'AuthController@check');
    Route::get('signup/confirm/{token}', 'AuthController@confirm');
    Route::get('setEmail/{token}', 'AuthController@setEmail');

    Route::group([ 'middleware' => 'auth:api' ], function()
    {
        Route::get('logout', 'AuthController@logout');
        Route::get('user', 'AuthController@user');
    });
});

// PASSWORD RESET ROUTES
Route::group([ 'middleware' => 'api', 'prefix' => 'password'], function ()
{
    Route::post('create', 'PasswordResetController@create');
    Route::get('find/{token}', 'PasswordResetController@find');
    Route::post('reset', 'PasswordResetController@reset');
    Route::get('setEmail/{token}' , 'PasswordResetController@setEmail');
    Route::get('check/{token}', 'PasswordResetController@check');
});
