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
Route::get('tweets/{user}', 'tweetsController@tweets')->name('tweets.tweets');
Route::get('tweets/{user}/toggle/{tweet}', 'tweetsController@toggleHide')->name('tweets.togglehide');
