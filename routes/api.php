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

Route::group(['prefix' => 'v1'], function () {
    Route::group(['prefix' => 'auth'], function () {
        Route::post('login', 'Api\Auth\Login')->name('api.auth.login');

        Route::group(['middleware' => 'auth:api'], function () {
            Route::post('logout', 'Api\Auth\Logout')->name('api.auth.logout');
        });
    });
});
