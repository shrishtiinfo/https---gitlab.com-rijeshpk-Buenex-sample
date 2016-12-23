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

Route::get('/login', 'UserController@login')->name('login');
Route::post('/signin', 'UserController@signin')->name('signin');
Route::post('/logout', 'HomeController@logout')->name('logout');

Route::get('/register', 'UserController@register')->name('register');
Route::post('/store', 'UserController@store')->name('store');

Route::get('/products', 'HomeController@products')->name('home');
Route::get('/add_product', 'HomeController@addProduct')->name('add_product');
Route::post('/product/store', 'HomeController@store')->name('store.product');

