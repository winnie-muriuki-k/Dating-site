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
	    if (!empty(Auth::user()) &&Auth::user()->role=="customer") {
            return redirect()->route('user-dashboard')->with([
            	'status'=>'info',
            	'message'=>'welcome back!'
            ]);
        }
    return view('welcome');
})->name('welcome');



Route::prefix('user')->group(function () {
	Route::get('/login','User\UserController@login')->name('user-login');
    Route::post('/login','User\UserController@login')->name('process-user-login');

    Route::get('/register','User\UserController@register')->name('user-register');
    Route::post('/register','User\UserController@register')->name('process-user-register');




    Route::match(['post','get'], '/edit-profile','User\UserController@editProfile')->name('edit-profile');
	Route::match(['get', 'post'], '/password-reset','User\UserController@passwordReset')->name( 'user-password-reset');
	Route::get('/dashboard', 'User\UserController@dashboard')->name('user-dashboard');
	Route::get('/password/reset/{token}', 'User\UserController@resetToken')->name('user-reset-token');
	Route::post('/password/reset/true', 'User\UserController@PasswordResetReal')->name('user-reset-real');
	Route::post('/match-user', 'User\UserController@MatchUser')->name('match-user');
	Route::get('/logout', 'User\UserController@UserLogout')->name('user-logout');
    Route::post('/profile', 'User\UserController@update_avatar')->name('user-update-avatar');
    Route::post('/send-message', 'User\UserController@sendMessage')->name('user-send-message');
    Route::post('/get-convesations', 'User\UserController@getUserChats')->name('user-get-convesations');
    Route::post('/notifications', 'User\UserController@clearNotifications')->name('clear-user-notifications');
    Route::get('/profile', 'User\UserController@profile')->name('view-profile');
    Route::post('/confirm_match', 'User\UserController@ConfirmMatch')->name('confirm-match');
    Route::post('/fetch-user-info', 'User\UserController@fetchUserInformation')->name('fetch-user-info');
    Route::post('/search', 'User\UserController@searchWithUsername')->name('user-search');
    Route::get('/search', 'User\UserController@advancedSearch')->name('advanced-search');

});
Route::prefix('admin')->group(function () {
    Route::get('', 'Admin\AdminController@index')->name('admin-dashboard');
    Route::get('/users', 'Admin\AdminController@Admins')->name('admin-users');
    Route::get('/members', 'Admin\AdminController@Members')->name('normal-users');
});

//this is a special route to get a countrys' cities
Route::get('country/{country}/cities', 'CountriesController@getCities');
