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


Route::get('/admin/login', 'Auth\AdminLoginController@showLoginForm');
Route::post('/admin/login', 'Auth\AdminLoginController@login')->name('admin.login');
Route::post('/admin/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');


Route::post('/user/logout', 'Auth\LoginController@logout')->name('logout');
Route::get('/user/login', 'Auth\LoginController@showLoginForm');
Route::post('/user/login', 'Auth\LoginController@login')->name('login');
Route::get('/user/register', 'Auth\RegisterController@showRegistrationForm');
Route::post('/user/register', 'Auth\RegisterController@register')->name('user.register');

Route::group(['middleware'=>'auth:admin'],function (){

    Route::get('/admin/dashboard', 'HomeController@adminDashboard');
    Route::get('admin/profile','ProfileController@showAdminProfile');

    Route::put('admin/profile/update/{id}','ProfileController@adminProfileUpdate')
        ->name('admin.profile.update');

    Route::get('user/list', 'ProfileController@userList');
    Route::get('get/user/list', 'ProfileController@getUserList');
    Route::post('user/data/{action}','ProfileController@dataAction');


});
Route::group(['middleware'=>'auth:web'],function (){

    Route::get('user/profile','ProfileController@showUserProfile');
    Route::put('user/profile/update/{id}','ProfileController@userProfileUpdate')->name('user.profile.update');

    Route::get('/user/dashboard', 'HomeController@userDashboard');

    Route::get('inbox/message','MessageController@inbox');
    Route::get('get/inbox/message','MessageController@getInbox');
    Route::get('read/message/{id}','MessageController@readMessageByReceiver')
        ->name('read.message');

    Route::get('sent/message','MessageController@sentMessages');
    Route::get('get/sent/message','MessageController@getSentMessages');
    Route::get('view/sent/message/{id}','MessageController@readMessageBySender')->name('view.message');

    Route::get('new/message','MessageController@messageForm');
    Route::post('send/message','MessageController@sendMessage')
        ->name('send.message');

    Route::post('/delete/receiver/message/{action}','MessageController@deleteReceiverMessages');
    Route::post('/delete/sender/message/{action}','MessageController@deleteSenderMessages');
    Route::get('/sender/deleted/message/{id}','MessageController@deleteMessageBySender');
    Route::get('/receiver/deleted/message/{id}','MessageController@deleteMessageByReceiver');

    Route::get('/notifications','MessageController@notifications');
});

