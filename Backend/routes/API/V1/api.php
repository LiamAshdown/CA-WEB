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
], function () {
	Route::post('login', 'AuthController@login');
	Route::post('register', 'AuthController@register');
	Route::post('register/user', 'AuthController@registerUser');
	Route::post('register/company', 'AuthController@registerCompany');
	Route::get('logout', 'AuthController@logout');
});

Route::group([
	'prefix' => 'profile',
	'namespace' => 'V1',
	'middleware' => ['auth']
], function () {
	Route::get('', 'ProfileController@show');
	Route::post('update', 'ProfileController@update');
});

Route::group([
	'prefix' => 'customization',
	'namespace' => 'V1',
	'middleware' => ['auth']
], function () {
	Route::get('', 'CustomizationController@show');
	Route::post('update', 'CustomizationController@update');
});

Route::group([
	'prefix' => 'company',
	'namespace' => 'V1',
	'middleware' => ['auth']
], function () {
	Route::get('', 'CompanyController@show');
	Route::post('update', 'CompanyController@update');
});

Route::group([
	'prefix' => 'users',
	'namespace' => 'V1',
	'middleware' => ['auth']
], function () {
	Route::get('/', 'UserController@index');
	Route::get('show/{id}', 'UserController@show');
	Route::post('update/{id}', 'UserController@update');
	Route::post('store', 'UserController@store');
});

Route::group([
	'prefix' => 'customers',
	'namespace' => 'V1',
	'middleware' => ['auth']
], function () {
	Route::get('/', 'CustomerController@index');
	Route::post('store', 'CustomerController@store');
});

Route::group([
	'prefix' => 'items',
	'namespace' => 'V1',
	'middleware' => ['auth']
], function () {
	Route::get('/', 'ItemController@index');
	Route::post('store', 'ItemController@store');
});

Route::group([
	'prefix' => 'tax',
	'namespace' => 'V1',
	'middleware' => ['auth']
], function () {
	Route::get('/', 'TaxController@index');
	Route::get('show/{id}', 'TaxController@show');
	Route::post('update/{id}', 'TaxController@update');
	Route::post('store', 'TaxController@store');
});

Route::group([
	'prefix' => 'bills',
	'namespace' => 'V1',
	'middleware' => ['auth']
], function () {
	Route::post('store', 'BillController@store');
});

Route::group([
	'prefix' => 'post',
	'namespace' => 'V1',
	'middleware' => ['auth']
], function () {
	Route::get('', 'PostController@index');
	Route::post('store', 'PostController@store');
	Route::post('like', 'PostController@like');
	Route::post('unlike', 'PostController@unlike');
	Route::post('reply', 'PostController@reply');
	Route::get('replies/{id}', 'PostController@replies');
	Route::get('show/{id}', 'PostController@show');
	Route::get('likes/{id}', 'PostController@likes');
});