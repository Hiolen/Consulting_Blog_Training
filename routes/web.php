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
Route::get('/', ['as' => 'index', 'uses' => 'PageController@index']);

Route::resource('user', 'UserController');
Route::get('/user/{user}/destroy', ['as' => 'userDelete', 'uses' => 'UserController@delete']);

Route::resource('category', 'CategoryController');
Route::get('/category/{category}/destroy', ['as' => 'categoryDelete', 'uses' => 'CategoryController@delete']);


Auth::routes();
