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

    Route::get('get/folder/{user_id}/{serial_number}', 'EventController@getFolder');
    Route::get('get/file/{folder_name}/{serial_number}', 'EventController@getFile');

    // Route::get('get/{filename}',['as' => 'getImage'], function($filename)
    // {   
    //     Image::configure(array('driver' => 'local', 'root' => storage_path('app')));

    //     $img = Image::make($filename)->resize(300, 200);

    //     return $img->response('jpg');
    // });


    

    Route::post('ping', 'EventController@ping' );

    Route::post('log', 'LogController@log');

    Route::get('user/{serial_number}', 'EventController@user');

});

Route::get('storage/{filePath}', function($filePath) {
    $path = storage_path('app/'.$filePath);
    $mime = \File::mimeType($path);
    header('Content-type: ' . $mime);

    return readfile($path);
})->where('filePath', '(.*)');
