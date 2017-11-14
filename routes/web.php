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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/profile/{slug}', [
        'uses' => 'ProfileController@index',
        'as' => 'profile',
    ]);

    Route::get('/profile/edit/profile', 'ProfileController@edit')->name('profile.edit');

    Route::post('/profile/update/profile', 'ProfileController@update')->name('profile.update');

    Route::get('/check_relationship_status/{id}', [
        'uses' => 'FriendshipsController@check',
        'as' => 'check',
    ]);

    Route::get('/add_friend/{id}', 'FriendshipsController@add_friend')->name('add_friend');

    Route::get('/accept_friend/{id}', 'FriendshipsController@accept_friend')->name('accept_friend');

    Route::get('get_unread', function() {
        return Auth::user()->unreadNotifications;
    });

    Route::get('/get_auth_user_data', function() {
        return Auth::user();
    });

    Route::get('/notifications', 'HomeController@notifications')->name('notifications');

    Route::post('/create/post', 'PostsController@store');

    Route::get('/feed', 'FeedsController@feed')->name('feed');

    Route::get('/like/{id}', 'LikesController@like');

    Route::get('/unlike/{id}', 'LikesController@unlike');

    Route::group(['prefix' => 'messages'], function () {
        Route::get('/', ['as' => 'messages', 'uses' => 'MessagesController@index']);
        Route::get('create', ['as' => 'messages.create', 'uses' => 'MessagesController@create']);
        Route::post('/', ['as' => 'messages.store', 'uses' => 'MessagesController@store']);
        Route::get('{id}', ['as' => 'messages.show', 'uses' => 'MessagesController@show']);
        Route::put('{id}', ['as' => 'messages.update', 'uses' => 'MessagesController@update']);
    });
});