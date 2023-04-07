<?php

use Illuminate\Support\Facades\Route;

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

/*Route::get('/', function () {
    return view('welcome');
});
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');*/

// web route
Route::get('/','PageController@home')->name('home');
Route::get('/about','PageController@about')->name('about');
Route::get('/contact','PageController@contact')->name('contact');
Route::get('/privacy-policy','PageController@privacyPolicy')->name('privacy-policy');
Route::post('/contact-inquiry','PageController@contactInquiry')->name('contact-inquiry');

// admin login route
Route::get('/login','Admin\AuthController@showLoginForm')->name('login');
Route::post('/login','Admin\AuthController@login')->name('login');
Route::get('/logout', 'Admin\AuthController@logout')->name('logout');
Route::get('/password/request','Admin\ForgotPasswordController@passwordRequest')->name('password.request');
Route::post('/password/email','Admin\ForgotPasswordController@passwordRequestEmail')->name('password.email');
Route::get('/password/reset/{token}','Admin\ForgotPasswordController@passwordReset')->name('password.reset');
Route::post('/password/update','Admin\ForgotPasswordController@passwordResetUpdate')->name('password.update');

// admin after login route
Route::prefix('admin')->middleware(['auth'])->name('admin.')->group(function(){
	
	// dashboard
	Route::get('/dashboard','Admin\DashboardController@index')->name('dashboard');
	
	// user
	Route::get('/user','Admin\UserController@index')->name('user');
	Route::get('/user/add','Admin\UserController@add')->name('user.add');
	Route::post('/user/store','Admin\UserController@store')->name('user.store');
	Route::get('/user/edit/{id}','Admin\UserController@edit')->name('user.edit');
	Route::post('/user/update','Admin\UserController@update')->name('user.update');
	Route::get('/user/delete/{id}','Admin\UserController@delete')->name('user.delete');
	Route::get('/user/export','Admin\UserController@export')->name('user.export');
	
	// push notification
	Route::get('/notification','Admin\NotificationController@index')->name('notification');
	Route::get('/notification/add','Admin\NotificationController@add')->name('notification.add');
	Route::post('/notification/store','Admin\NotificationController@store')->name('notification.store');
	Route::get('/notification/edit/{id}','Admin\NotificationController@edit')->name('notification.edit');
	Route::post('/notification/update','Admin\NotificationController@update')->name('notification.update');
	Route::get('/notification/delete/{id}','Admin\NotificationController@delete')->name('notification.delete');
	
	// cms
	Route::get('/cms-page','Admin\CmsPageController@index')->name('cms-page');
	Route::get('/cms-page/add','Admin\CmsPageController@add')->name('cms-page.add');
	Route::post('/cms-page/store','Admin\CmsPageController@store')->name('cms-page.store');
	Route::get('/cms-page/edit/{id}','Admin\CmsPageController@edit')->name('cms-page.edit');
	Route::post('/cms-page/update','Admin\CmsPageController@update')->name('cms-page.update');
	Route::get('/cms-page/delete','Admin\CmsPageController@delete')->name('cms-page.delete');
	
	// module
	Route::match(['get', 'post', 'options'], 'module/{module}', 'Admin\ModuleController@index')->name('module');
	Route::get('/module/{module}/export','Admin\ModuleController@export')->name('module.export');
	
});
