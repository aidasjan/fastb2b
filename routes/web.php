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

// Categories routes
Route::get('/', 'CategoriesController@index')->name('index');
Route::post('categories', 'CategoriesController@store')->name('categories.store');
Route::get('categories/create', 'CategoriesController@create')->name('categories.create');
Route::get('categories/{category}', 'CategoriesController@show')->name('categories.show');
Route::put('categories/{category}', 'CategoriesController@update')->name('categories.update');
Route::delete('categories/{category}', 'CategoriesController@destroy')->name('categories.destroy');
Route::get('categories/{category}/edit', 'CategoriesController@edit')->name('categories.edit');

// Subcategories routes
Route::post('subcategories', 'SubcategoriesController@store')->name('subcategories.store');
Route::get('subcategories/create/{category}', 'SubcategoriesController@create')->name('subcategories.create');
Route::get('subcategories/{subcategory}', 'SubcategoriesController@show')->name('subcategories.show');
Route::put('subcategories/{subcategory}', 'SubcategoriesController@update')->name('subcategories.update');
Route::delete('subcategories/{subcategory}', 'SubcategoriesController@destroy')->name('subcategories.destroy');
Route::get('subcategories/{subcategory}/edit', 'SubcategoriesController@edit')->name('subcategories.edit');


// Discounts routes
Route::get('discounts', 'DiscountsController@index')->name('discounts.index');
Route::post('discounts', 'DiscountsController@store')->name('discounts.store');
Route::get('discounts/{user}/edit', 'DiscountsController@edit')->name('discounts.edit');

// Products routes
Route::post('products', 'ProductsController@store')->name('products.store');
Route::get('products/create/{subcategory}', 'ProductsController@create')->name('products.create');
Route::get('products/{product}', 'ProductsController@show')->name('products.show');
Route::put('products/{product}', 'ProductsController@update')->name('products.update');
Route::delete('products/{product}', 'ProductsController@destroy')->name('products.destroy');
Route::get('products/{product}/edit', 'ProductsController@edit')->name('products.edit');
Route::post('products/search', 'ProductsController@search')->name('products.search');

// Product Files routes
Route::post('product_files', 'ProductFilesController@store')->name('product_files.store');
Route::get('product_files/create/{product}', 'ProductFilesController@create')->name('product_files.create');
Route::put('product_files/{product_file}', 'ProductFilesController@update')->name('product_files.update');
Route::delete('product_files/{product_file}', 'ProductFilesController@destroy')->name('product_files.destroy');
Route::get('product_files/{product_file}/edit', 'ProductFilesController@edit')->name('product_files.edit');


// Users routes
Route::get('users', 'UsersController@index')->name('users.index');

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('register', 'Auth\RegisterController@showRegistrationForm');
Route::post('register', 'Auth\RegisterController@register');

Route::get('dashboard', 'DashboardController@index');
