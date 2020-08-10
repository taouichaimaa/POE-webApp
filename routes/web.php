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



Route::get('/', 'PagesController@index');

Route::get('/contact','PagesController@contact');
Route::get('/action','PagesController@action');
Route::get('/about','PagesController@about');
Route::post('/posts/searchfile','PostsController@file_check')->name('file.check')->middleware('auth');
Route::get('/posts/search','PostsController@search')->middleware('auth');
Route::get('/posts/publish','PostsController@publishfile')->middleware('auth');
Route::get('/posts/checkfile','PostsController@check')->middleware('auth');
Route::post('/posts/fileuploaded','PostsController@store')->name('file.publish')->middleware('auth');;
//Route::get('/posts/confirmation','PostsController@confirm');
Route::get('/posts/generatedpoe','PostsController@generated')->middleware('auth');;
Auth::routes();





Auth::routes();

Route::get('/home', 'PagesController@index')->name('home');
