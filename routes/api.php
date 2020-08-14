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

    Route::get('roles', 'Api\Role\GetRoles')->name('api.get.roles');

    Route::group(['prefix' => 'user', 'middleware' => 'auth:api'], function () {
        Route::post('store', 'Api\User\Store')->name('api.user.store');
        Route::post('upload/avatar', 'Api\User\UploadAvatar')->name('api.user.upload.avatar');
    });

    Route::group(['prefix' => 'store', 'middleware' => 'auth:api'], function () {
        Route::post('upload/logo', 'Api\Store\UploadLogo')->name('api.store.upload.logo');
    });
});
