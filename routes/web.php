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



Route::get('/', 'TestController@getLogin')->name('login');
Route::get('/login-slack', 'TestController@getLoginSlack')->name('login.slack');
Route::get('/slack/auth', 'TestController@getToken');
Route::get('/home', 'TestController@getHome')->name('home');
Route::get('/send-msg', 'TestController@sendMessage')->name('send.msg');
