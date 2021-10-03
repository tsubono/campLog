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

    Route::middleware('auth:api')->group(function () {
        Route::post('/user-bookmarks/update', 'UserBookmarkController@update')->name('user-bookmarks.update');
        Route::post('/user-bookmarks/update-sort', 'UserBookmarkController@updateSort')->name('user-bookmarks.update-sort');
        Route::post('/user-bookmarks/destroy', 'UserBookmarkController@destroy')->name('user-bookmarks.destroy');
    });
});
