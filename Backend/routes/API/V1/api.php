<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([
	'prefix' => 'auth',
	'namespace' => 'V1'
], function ($router) {
	Route::post('login', 'AuthController@login');
	Route::post('register', 'AuthController@register');
	Route::get('logout', 'AuthController@logout');
});

Route::group([
	'prefix' => 'profile',
	'namespace' => 'V1',
	'middleware' => ['auth']
], function ($router) {
	Route::get('', 'ProfileController@show');
	Route::post('update', 'ProfileController@update');
});

Route::group([
	'prefix' => 'customization',
	'namespace' => 'V1',
	'middleware' => ['auth']
], function ($router) {
	Route::get('', 'CustomizationController@show');
	Route::post('update', 'CustomizationController@update');
});

Route::group([
	'prefix' => 'company',
	'namespace' => 'V1',
	'middleware' => ['auth']
], function ($router) {
	Route::get('', 'CompanyController@show');
	Route::post('update', 'CompanyController@update');
});

Route::group([
	'prefix' => 'users',
	'namespace' => 'V1',
	'middleware' => ['auth']
], function ($router) {
	Route::get('/', 'UserController@index');
	Route::get('show/{id}', 'UserController@show');
	Route::post('update/{id}', 'UserController@update');
	Route::post('store', 'UserController@store');
});

Route::group([
	'prefix' => 'customers',
	'namespace' => 'V1',
	'middleware' => ['auth']
], function ($router) {
	Route::get('/', 'CustomerController@index');
	Route::post('store', 'CustomerController@store');
});

Route::group([
	'prefix' => 'items',
	'namespace' => 'V1',
	'middleware' => ['auth']
], function ($router) {
	Route::get('/', 'ItemController@index');
	Route::post('store', 'ItemController@store');
});