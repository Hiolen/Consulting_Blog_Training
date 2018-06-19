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

Auth::routes();

Route::group(['prefix' => '/user', 'as' => 'user', 'middleware' => ['auth', 'admin']], function() {
    Route::get('/', ['as' => 'Index', 'uses' => 'UserController@index']);
    Route::get('/create', ['as' => 'Create', 'uses' => 'UserController@create']);
    Route::post('/store', ['as' => 'Store', 'uses' => 'UserController@store']);
    Route::get('/{user}/edit', ['as' => 'Edit', 'uses' => 'UserController@edit']);
    Route::post('/{user}/edit/update', ['as' => 'Update', 'uses' => 'UserController@update']);
    Route::get('/{user}/destroy', ['as' => 'Delete', 'uses' => 'UserController@delete']);
    Route::post('/{user}/destroy', ['as' => 'Destroy', 'uses' => 'UserController@destroy']);
});

Auth::routes();

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
