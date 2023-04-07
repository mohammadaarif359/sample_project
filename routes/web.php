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

// product and cart
Route::get('/', 'ProductController@index')->name('home');  
Route::get('cart', 'ProductController@cart')->name('cart');
Route::get('add-to-cart/{id}', 'ProductController@addToCart')->name('add.to.cart');
Route::patch('update-cart', 'ProductController@update')->name('update.cart');
Route::delete('remove-from-cart', 'ProductController@remove')->name('remove.from.cart');

// checkout
Route::get('/checkout', 'OrderController@index');
Route::post('/order', 'OrderController@order');

// admin login route
Route::get('/login','Admin\AuthController@showLoginForm')->name('login');
Route::post('/login','Admin\AuthController@login')->name('login');
Route::get('/logout', 'Admin\AuthController@logout')->name('logout');

// admin after login route
Route::prefix('admin')->middleware(['auth'])->name('admin.')->group(function(){
	
	// dashboard
	Route::get('/dashboard','Admin\DashboardController@index')->name('dashboard');
	
	// user
	Route::get('/user','Admin\UserController@index')->name('user');
	
	// product
	Route::get('/product','Admin\ProductController@index')->name('product');
	Route::get('/product/add','Admin\ProductController@add')->name('product.add');
	Route::post('/product/store','Admin\ProductController@store')->name('product.store');
	Route::get('/product/edit/{id}','Admin\ProductController@edit')->name('product.edit');
	Route::post('/product/update','Admin\ProductController@update')->name('product.update');
	Route::get('/product/delete/{id}','Admin\ProductController@delete')->name('product.delete');
	
	// order
	Route::get('/order','Admin\OrderController@index')->name('order');
	Route::get('/order/{id}','Admin\OrderController@detail')->name('order.deatil');
	
});
