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

// Auth::routes();
Route::prefix('admin')->namespace('Admin')->group(function () {
    Route::namespace('Auth')->group(function () {
        Route::get('login', 'LoginController@showLoginForm')->name('login');
        Route::post('login', 'LoginController@login');
        Route::post('logout', 'LoginController@logout')->name('logout');
        Route::middleware('auth')->group(function () {
            Route::prefix('password')->group(function() {
                Route::get('confirm', 'ConfirmPasswordController@showConfirmForm')->name('password.confirm');
                Route::post('confirm', 'ConfirmPasswordController@confirm');
                Route::post('email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
                Route::get('reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
                Route::post('reset', 'ResetPasswordController@reset')->name('password.update');
                Route::get('reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
                Route::get('register', 'RegisterController@showRegistrationForm')->name('register');
                Route::post('register', 'RegisterController@register');
            });
        });
    });
});

Route::get('/home', 'HomeController@index')->name('home');
