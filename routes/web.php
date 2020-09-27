<?php

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


Route::get('/', function () { return view('welcome');});
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');


// ログイン状態
Route::group(['middleware' => 'auth'], function() {

    // ユーザ関連
    Route::resource('users', 'UsersController', ['only' => ['index', 'show', 'edit', 'update']]);

    // フォロー/フォロー解除を追加
    Route::post('users/{user}/follow', 'UsersController@follow')->name('follow');
    Route::delete('users/{user}/unfollow', 'UsersController@unfollow')->name('unfollow');

    Route::get('users/{user}/edit', 'UsersController@edit')->name('users.edit');

    // ツイート関連
    Route::resource('tweets', 'TweetsController', ['only' => ['index', 'create', 'store', 'show', 'edit', 'update', 'destroy']]);
    // Route::post('tweets/{tweets}/edit', 'TweetssController@edit')->name('edit');

    // コメント関連
    Route::resource('comments', 'CommentsController', ['only' => ['store']]);

    // いいね関連
    Route::resource('favorites', 'FavoritesController', ['only' => ['store', 'destroy']]);

});


