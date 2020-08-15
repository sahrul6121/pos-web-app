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
        Route::get('list', 'Api\User\Index')->name('api.user.list');
        Route::post('store', 'Api\User\Store')->name('api.user.store');
        Route::post('upload/avatar', 'Api\User\UploadAvatar')->name('api.user.upload.avatar');

        Route::group(['prefix' => 'staff'], function () {
            Route::post('store', 'Api\User\Admin\AddStaff')->name('api.user.staff.store');
            Route::get('list', 'Api\User\Staff\Index')->name('api.user.staff.index');
        });
    });

    Route::group(['prefix' => 'store', 'middleware' => 'auth:api'], function () {
        Route::get('list', 'Api\Store\Index')->name('api.store.list');
        Route::post('store', 'Api\Store\Store')->name('api.store.store');
        Route::post('upload/logo', 'Api\Store\UploadLogo')->name('api.store.upload.logo');
    });

    Route::group(['prefix' => 'product', 'middleware' => 'auth:api'], function () {
        Route::post('upload/picture', 'Api\Product\UploadPicture')->name('api.product.upload.picture');
        Route::post('store', 'Api\Product\Store')->name('api.product.store');
    });
});
