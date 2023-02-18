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
	Route::post('upload-logo', 'ProfileController@uploadLogo');
	Route::post('upload-banner', 'ProfileController@uploadBanner');
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
	Route::get('show/{id}', 'UserController@show');
	Route::get('photos/{id}', 'UserController@getPhotos');
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
	Route::get('user/{id}', 'PostController@userPosts');
	Route::get('profile', 'PostController@profilePosts');
});

Route::group([
	'prefix' => 'misc',
	'namespace' => 'V1',
	'middleware' => ['auth']
], function () {
	Route::post('postcode/lookup', 'MiscController@lookUpPostCode');
});

Route::group([
	'prefix' => 'customer',
	'namespace' => 'V1',
	'middleware' => ['auth']
], function () {
	Route::post('store', 'CustomerController@store');
	Route::post('update/{id}', 'CustomerController@update');
	Route::get('show/{id}', 'CustomerController@show');
	Route::get('', 'CustomerController@index');
});

Route::group([
	'prefix' => 'bill',
	'namespace' => 'V1',
	'middleware' => ['auth']
], function () {
	Route::post('init', 'BillController@init');
	Route::post('update/{id}', 'BillController@update');
	Route::post('item/add', 'BillController@addBillItem');
	Route::post('item/update', 'BillController@updateBillItem');
	Route::get('bills', 'BillController@bills');
	Route::get('view-pdf/{id}', 'BillController@viewPDF');
    Route::post('convert-to-invoice/{id}', 'BillController@convertToInvoice');
});

Route::group([
	'prefix' => 'notifications',
	'namespace' => 'V1',
	'middleware' => ['auth']
], function () {
	Route::get('index', 'NotificationsController@index');
    Route::get('unread', 'NotificationsController@unread');
    Route::post('mark-as-read/{id}', 'NotificationsController@markAsRead');
});


Route::group([
	'prefix' => 'email',
	'namespace' => 'V1',
	'middleware' => ['auth']
], function () {
	Route::get('init/{type}/{id}', 'EmailController@init');
	Route::post('send', 'EmailController@send');
});
