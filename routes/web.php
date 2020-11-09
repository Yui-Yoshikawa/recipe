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

Route::group(['prefix' => 'admin' , 'middleware'=> 'auth'], function() {
    Route::get('recipe/create', 'Admin\RecipeController@add');
    Route::post('recipe/create', 'Admin\RecipeController@create');
    Route::get('recipe', 'Admin\RecipeController@index');
    Route::get('recipe/edit', 'Admin\RecipeController@edit');
    Route::post('recipe/edit', 'Admin\RecipeController@update');
    Route::get('recipe/delete', 'Admin\RecipeController@delete');
    
    Route::get('profile', 'Admin\ProfileController@index');
    Route::get('profile/create', 'Admin\ProfileController@add');
    Route::post('profile/create', 'Admin\ProfileController@create');
    Route::get('profile/edit', 'Admin\ProfileController@edit');
    Route::post('profile/edit', 'Admin\ProfileController@update');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
