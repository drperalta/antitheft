<?php

use Illuminate\Http\Request;
use Intervention\Image\ImageManager;

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

// KIT ROUTES
Route::group(['prefix' => 'kit' ], function()
{
    Route::post('add', 'KitController@add');
});

// USER KIT ROUTES
Route::group([ 'middleware' => 'auth:api', 'prefix' => 'user'  ], function()
{
    Route::post('kit/add', 'UserKitController@add');
    Route::get('kit/set/{id}', 'UserKitController@set');
    Route::post('kit/remove', 'UserKitController@remove');
    Route::get('kit/edit/set/{id}', 'UserKitController@edit_set');
    Route::post('kit/edit', 'UserKitController@edit');
});

Route::group(['prefix' => 'event'], function()
{
    Route::post('upload', 'EventController@upload');

    Route::get('get/{user_id}/{serial_number}', 'EventController@get');

    Route::get('image/{user_id}/{serial_number}/{folder_name}/{file_name}', [
        'as'   => 'event.image',
        'uses' => 'EventController@getImage',
    ]);

    Route::post('ping', 'EventController@ping' );

});
