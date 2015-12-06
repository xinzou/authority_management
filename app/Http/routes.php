<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('login', 'Admin\LoginController@index');
Route::post('login', 'Admin\LoginController@login');
Route::get('401', 'Admin\LoginController@noAuthority');

Route::group(['middleware' => 'user'], function () {
    Route::get('edit_password', 'Admin\UserController@getEditPassword');
    Route::post('edit_password/{id}', 'Admin\UserController@postEditPassword');
    Route::get('logout', 'Admin\LoginController@logout');
    Route::resource('user', 'Admin\UserController');
    Route::resource('role', 'Admin\RoleController');
    Route::resource('auth', 'Admin\AuthController');
    Route::resource('auth_group', 'Admin\AuthGroupController');
}
);