<?php

use Illuminate\Support\Facades\Route;

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

/**
 * 認証
 */
Auth::routes();

/**
 * Twitter認証
 */
Route::get('login/twitter', 'Auth\LoginController@redirectToTwitterProvider');
Route::get('login/twitter/callback', 'Auth\LoginController@handleTwitterProviderCallback');

/**
 * ログイン後マイページ
 */
Route::middleware('auth')->prefix('mypage')->namespace('Mypage')->as('mypage.')->group(function () {
    // キャンプ予定CRUD
    Route::resource('/camp-schedules', 'CampScheduleController', ['except' => ['show']]);
    // プロフィール設定
    Route::get('/profile', 'ProfileController@edit')->name('profile.edit');
    Route::put('/profile', 'ProfileController@update')->name('profile.update');
    // キャンプ場インポート
    Route::get('/camp-places/import', 'CampPlaceController@import')->name('camp-places.import');
    Route::post('/camp-places/import', 'CampPlaceController@postImport');
    Route::get('/access-code', 'AccessCodeController@index');
    Route::post('/access-code', 'AccessCodeController@create');
});

/**
 * プロフィール
 */
Route::get('/{userName}', 'ProfileController@index')->name('profile.index');
