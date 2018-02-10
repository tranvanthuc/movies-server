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


Route::group(['namespace' => 'API'], function () {
    // Controllers Within The "App\Http\Controllers\Admin" Namespace

    Route::group(['middleware' => 'auth:api'], function () {
        Route::group(['prefix' => 'posts'], function () {
            Route::post('/', 'PostController@getAll');
            Route::post('create', 'PostController@create');
            Route::post('update', 'PostController@update');
            Route::get('{id}/delete', 'PostController@delete');
            Route::get('{id}', 'PostController@getById');
        });

        Route::get('me', 'PassportController@me');
        Route::post('refreshToken', 'PassportController@refreshToken');
        Route::get('redirect', 'PassportController@redirect');

    });
    Route::post('login', 'PassportController@login');
    Route::post('register', 'PassportController@register');
});
