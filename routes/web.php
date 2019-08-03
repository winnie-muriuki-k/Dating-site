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
            return redirect()->route('user-dashboard');
        }
    return view('welcome');
})->name('welcome');



Route::prefix('user')->group(function () {
	Route::get('/login','User\UserController@login')->name('user-login');
    Route::post('/login','User\UserController@login')->name('process-user-login');

    Route::get('/register','User\UserController@register')->name('user-register');
    Route::post('/register','User\UserController@register')->name('process-user-register');




    Route::match(['post','get'], '/edit-profile','User\UserController@editProfile')->name('edit-profile');

    Route::match(['post','get'], '/email-verification','User\SubscriptionController@checkAccountVeriffied')->name('email-verification');

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
    Route::post('/search', 'User\UserController@search')->name('user-search');

    Route::get('/search', 'User\UserController@advancedSearch')->name('advanced-search');
    
    Route::get('/user-messages', 'User\UserController@userMessages')->name('user-messages');
    Route::get('/interests/{id}', 'User\UserController@interests')->name('interests');
    Route::get('/interested/{id}', 'User\UserController@interested')->name('interested');
    Route::get('/view/{id}', 'User\UserController@view')->name('view-user');
    Route::post('/edit-profile/interests', 'User\UserController@editInterests')->name('edit-interests');
    Route::post('/add-favourite', 'User\UserController@addFav')->name('user-add-fav');
    Route::get('/view-favourites/iam-their-favourite/{id}', 'User\UserController@favourited')->name('user-favourited');
    Route::get('/my-favourite', 'User\UserController@favourites')->name('user-favourites');

    Route::get('/settings', 'User\UserController@settings')->name('settings');

    Route::post('/delete-conversations', 'User\UserController@deleteUserConversations')->name('delete-conversations');
    
    Route::post('/update-message-read-status', 'User\UserController@updateMessagesReadStatus')->name('update-message-read-status');

    Route::post('/get-cities', 'User\SubscriptionController@getCountryCities')->name('get-country-cities');

    Route::post('/complete-user-profile' ,'ProfileController@completeUserProfile')->name('complete-user-profile');
    Route::get('/email/verification/{token?}' ,'ProfileController@sendEmailVerification')->name('process-send-email-verification');

    Route::post('/send-email-verification' ,'ProfileController@sendEmailVerification')->name('send-email-verification');



});


Route::get("/admin/login" ,'Admin\AdminController@login')->name('admin.login');
Route::get("/admin/logout" ,'Admin\AdminController@logOut')->name('sign-out');
Route::post("/admin/process/login" ,'Admin\AdminController@processLogin')->name('process-admin-login');
Route::group(['prefix' => 'admin' ,'middleware'=>'admin'], function()
{
    Route::get('', 'Admin\AdminController@index')->name('admin-dashboard');
    Route::get('/users', 'Admin\AdminController@Admins')->name('admin-users');
    Route::post('/process/new/users', 'Admin\AdminController@store')->name('process-new-user');
    Route::get('/members', 'Admin\AdminController@Members')->name('normal-users');
    Route::get('/roles', 'Admin\RoleController@index')->name('roles-view');

    Route::post('/process/roles', 'Admin\RoleController@store')->name('process-role');
    Route::post('/ban-user', 'Admin\AdminController@banUser')->name('ban-user');



    Route::get('/countries' ,'Admin\CountryController@index')->name('admin-country');
    Route::get('/cities' ,'CitiesController@index')->name('admin-cities');
    Route::post('/countries' ,'Admin\CountryController@store')->name('process-country');
    Route::post('/cities' ,'CitiesController@store')->name('process-city');
    Route::post('/edit-city' ,'CitiesController@EditCity')->name('edit-city');
    Route::post('/edit-eye-color' ,'ProfileController@EditEyeColor')->name('edit-eye-color');

    Route::post('/countries/delete' ,'Admin\CountryController@destroy')->name('delete-country');

    Route::post('/city/delete' ,'CitiesController@destroy')->name('delete-city');

    Route::post('/role/delete' ,'Admin\RoleController@destroy')->name('delete-role');

    Route::get('/eye-color' ,'ProfileController@eyeColor')->name('eye-color-view');

    Route::get('/gender-view' ,'ProfileController@userGender')->name('gender-view');

    Route::get('/eye-wear' ,'ProfileController@eyeWear')->name('eye-wear-view');

    Route::get('/ethicity' ,'ProfileController@userEthnicity')->name('ethicity-view');

    Route::get('/height' ,'ProfileController@Height')->name('height-view');

    Route::post('/edit-eye-wear' ,'ProfileController@EditEyeWear')->name('edit-eye-wear');

    Route::post('/edit-user-height' ,'ProfileController@EditHeight')->name('edit-user-height');

    Route::post('/edit-user-gender' ,'ProfileController@EditGender')->name('edit-user-gender');

    Route::post('/edit-user-ethnicity' ,'ProfileController@EditEthnicity')->name('edit-user-ethnicity');

    Route::post('/delete-eye-color' ,'ProfileController@destroyEyeColor')->name('delete-eye-color');

    Route::post('/delete-user-height' ,'ProfileController@destroyHeight')->name('delete-user-height');

    Route::post('/delete-ethnicity' ,'ProfileController@destroyEthnicity')->name('delete-ethnicity');

    Route::post('/delete-eye-wear' ,'ProfileController@destroyEyeWear')->name('delete-eye-wear');

    Route::post('/delete-user-gender' ,'ProfileController@destroyGender')->name('delete-user-gender');

    Route::post('/process-eye-color' ,'ProfileController@processEyeColor')->name('process-eye-color');

    Route::post('/process-user-gender' ,'ProfileController@processGender')->name('process-user-gender');

    Route::post('/process-eye-wear' ,'ProfileController@processEyeWear')->name('process-eye-wear');

    Route::post('/process-ethinicity' ,'ProfileController@processEthnicity')->name('process-ethinicity');

    Route::post('/process-user-height' ,'ProfileController@processHeight')->name('process-user-height');

    

    

});

//this is a special route to get a countrys' cities
Route::get('country/{country}/cities', 'CountriesController@getCities');

