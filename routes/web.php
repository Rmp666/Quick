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

Route::get('/', 'Api\ArticleController@index');

Route::resource('articles', 'Api\ArticleController');

Route::resource('/download', 'DownloadController')->only(['store', 'update', 'destroy']);

Route::get('/download/{download}', 'DownloadController@load')->name('load');

Auth::routes();

