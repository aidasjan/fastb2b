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

Route::get('/', 'CategoriesController@index')->name('index');
Route::post('categories', 'CategoriesController@store')->name('categories.store');
Route::get('categories/create', 'CategoriesController@create')->name('categories.create');
Route::get('categories/{category}', 'CategoriesController@show')->name('categories.show');
Route::put('categories/{category}', 'CategoriesController@update')->name('categories.update');
Route::delete('categories/{category}', 'CategoriesController@destroy')->name('categories.destroy');
Route::get('categories/{category}/edit', 'CategoriesController@edit')->name('categories.edit');

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('register', 'Auth\RegisterController@showRegistrationForm');
Route::post('register', 'Auth\RegisterController@register');

Route::get('dashboard', 'DashboardController@index');
