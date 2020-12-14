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

Route::middleware('access-code-check')->group(function() {
    /**
     * 認証
     */
    Auth::routes();
    Route::get('/', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('/', 'Auth\RegisterController@register');

    /**
     * Twitter認証
     */
    Route::get('login/twitter', 'Auth\LoginController@redirectToTwitterProvider')->name('twitter.auth');
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
        Route::delete('/profile', 'ProfileController@destroy')->name('profile.destroy');
        // キャンプ場インポート
        Route::get('/camp-places/import', 'CampPlaceController@import')->name('camp-places.import');
        Route::post('/camp-places/import', 'CampPlaceController@postImport');
        Route::get('/access-code', 'AccessCodeController@index')->name('access-code.index');
        Route::put('/access-code/{access_code}', 'AccessCodeController@update')->name('access-code.update');
    });
});

/**
 * アクセスコード入力
 */
Route::get('/access-code', 'AccessCodeController@index')->name('access-code.index');
Route::post('/access-code', 'AccessCodeController@check')->name('access-code.check');

/**
 * プロフィール
 */
Route::get('/{userName}', 'ProfileController@index')->name('profile.index');
