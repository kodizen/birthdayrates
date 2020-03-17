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


Route::group(['prefix' => 'birthdays'], function () {
    Route::get('/', 'BirthdaysController@index')->name('birthdays');
    Route::get('/{birthday}', 'BirthdaysController@show')->name('birthdays.show');
    Route::post('/', 'BirthdaysController@store')->name('birthdays.store');
    Route::put('/{birthday}', 'BirthdaysController@update')->name('birthdays.update');
    Route::delete('/{birthday}', 'BirthdaysController@delete')->name('birthdays.delete');
});
