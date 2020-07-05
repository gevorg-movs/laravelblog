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

Route::get('/', 'PostController@index')->name('home')->middleware('verified');

Auth::routes(['verify' => true]);

Route::resource('/posts', 'PostController');



// Search
Route::post('/search', 'PostController@SearchPost')->name('search');

// Admin panel
Route::group([
  'prefix' => 'admin',
  'namespace' => 'Admin',
  'middleware' => ['auth', 'chekadmin']
], function () {
    Route::get('/', 'DashboardController@dashboard');
    Route::get('/users', 'DashboardController@getUsers')->name('users');

    // Category
    Route::resource('/categories', 'CategoryController');
});
