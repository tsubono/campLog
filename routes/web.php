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
    Auth::routes(['verify' => true, 'register' => false]);
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
    Route::middleware(['auth', 'verified'])->prefix('mypage')->namespace('Mypage')->as('mypage.')->group(function () {
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
        // ブックマーク一覧
        Route::get('/bookmarks', 'BookmarkController@index')->name('bookmarks.index');
    });
});

/**
 * アクセスコード入力
 */
Route::get('/access-code', 'AccessCodeController@index')->name('access-code.index');
Route::post('/access-code', 'AccessCodeController@check')->name('access-code.check');

/**
 * 固定ページ
 */
// 利用手順
Route::get('/guide', 'PageController@guide')->name('guide');
// 利用規約
Route::get('/rules', 'PageController@rules')->name('rules');
// プライバシーポリシー
Route::get('/privacy-policy', 'PageController@privacyPolicy')->name('privacy-policy');

/**
 * サイトマップ
 */
Route::get('/sitemap', [App\Http\Controllers\SitemapController::class, 'index'])->name('sitemap');

/**
 * キャンプ場検索一覧・詳細
 */
Route::get('/camp-places', [App\Http\Controllers\CampPlaceController::class, 'index'])->name('camp-places.index');
Route::get('/camp-places/{campPlace}', [App\Http\Controllers\CampPlaceController::class, 'show'])->name('camp-places.show');
Route::post('/camp-places/{campPlace}/add-bookmark', [App\Http\Controllers\CampPlaceController::class, 'addBookmark'])->name('camp-places.add-bookmark')->middleware(['auth', 'verified']);
Route::post('/camp-places/{campPlace}/remove-bookmark', [App\Http\Controllers\CampPlaceController::class, 'removeBookmark'])->name('camp-places.remove-bookmark')->middleware(['auth', 'verified']);

/**
 * プロフィール
 */
Route::get('/{userName}', 'ProfileController@index')->name('profile.index');