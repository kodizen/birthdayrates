<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'external'], function () {
    Route::get('/fixer', 'ApiController@index')->name('fixer');
});

Route::group(['prefix' => 'birthdays'], function () {
    Route::get('/', 'BirthdaysController@index')->name('birthdays');
    Route::post('/', 'BirthdaysController@store')->name('birthdays.store');
});

