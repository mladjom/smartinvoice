<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the Closure to execute when that URI is requested.
  |
 */

Route::get('/', 'HomeController@showIndex');

// Confide routes
Route::get('users/create', 'UsersController@create');
Route::post('users', 'UsersController@store');
Route::get('users/login', 'UsersController@login');
Route::post('users/login', 'UsersController@doLogin');
Route::get('users/confirm/{code}', 'UsersController@confirm');
Route::get('users/forgot_password', 'UsersController@forgotPassword');
Route::post('users/forgot_password', 'UsersController@doForgotPassword');
Route::get('users/reset_password/{token}', 'UsersController@resetPassword');
Route::post('users/reset_password', 'UsersController@doResetPassword');
Route::get('users/logout', 'UsersController@logout');

Route::group(array('before' => 'auth'), function() {

    Route::get('dashboard', 'DashboardController@index');

    Route::get('billers/{id}/restore', 'BillersController@restore');
    Route::get('billers/{id}/delete', 'BillersController@delete');
    Route::resource('billers', 'BillersController');

    Route::get('clients/{id}/restore', 'ClientsController@restore');
    Route::get('clients/{id}/delete', 'ClientsController@delete');
    Route::resource('clients', 'ClientsController');

    Route::get('invoices/{id}/restore', 'InvoicesController@restore');
    Route::get('invoices/{id}/delete', 'InvoicesController@delete');
    Route::resource('invoices', 'InvoicesController');


    Route::any('upload', 'UploadsController@uploadLogo');
});


