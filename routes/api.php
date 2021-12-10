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

Route::namespace('Api')->group(function () {
    Route::post('/uploadImage', 'FileController@uploadImage');
    Route::post('/uploadImages', 'FileController@uploadImages');

    // auth関連
    Route::post('/login/email', 'LoginController@loginByEmail');
    Route::post('/login/twitter', 'LoginController@loginByTwitter');
    Route::post('/register', 'RegisterController@register');

    Route::middleware('auth:api')->group(function () {
        // 行きたいリスト
        Route::post('/user-bookmarks/get-list', 'UserBookmarkController@getList');
        Route::post('/user-bookmarks/store', 'UserBookmarkController@store');
        Route::post('/user-bookmarks/{id}/update', 'UserBookmarkController@update')->name('user-bookmarks.update');
        Route::post('/user-bookmarks/update-sort', 'UserBookmarkController@updateSort')->name('user-bookmarks.update-sort');
        Route::post('/user-bookmarks/{id}/destroy', 'UserBookmarkController@destroy')->name('user-bookmarks.destroy');

        // ユーザー関連
        Route::post('/users/get', 'UserController@get');
        Route::post('/users/{id}/get', 'UserController@getById');
        Route::post('/users/update', 'UserController@update');
        Route::post('/users/destroy', 'UserController@destroy');

        // キャンプ場関連
        Route::post('/camp-places/get-list', 'CampPlaceController@getList');
        Route::post('/camp-places/get', 'CampPlaceController@get');

        // キャンプ予定関連
        Route::post('/camp-schedules/get-list', 'CampScheduleController@getList');
        Route::post('/camp-schedules/{id}/get', 'CampScheduleController@get');
        Route::post('/camp-schedules/store', 'CampScheduleController@store');
        Route::post('/camp-schedules/{id}/update', 'CampScheduleController@update');
        Route::post('/camp-schedules/{id}/destroy', 'CampScheduleController@destroy');

        Route::post('/refresh/token', 'LoginController@refreshToken');
    });
});
