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

// TODO: 削除
Route::get('/', function () {
    return view('home');
});

/**
 * 認証
 */
Auth::routes();

/**
 * ログイン後マイページ
 */
Route::middleware('auth')->namespace('Mypage')->as('mypage.')->group(function () {
    // キャンプ予定CRUD
    Route::resource('/camp-schedules', 'CampScheduleController', ['except' => ['show']]);
    // プロフィール設定
    Route::get('/profile', 'UserController@edit')->name('user.edit');
    Route::put('/profile', 'UserController@update')->name('user.update');
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
