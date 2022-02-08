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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/', 'TopController@index')->name('top.index');

Route::group(['middleware' => 'auth'], function () {
Route::get('/movie', 'MovieController@index')->name('movie.index');
// Route::get('/movie/{id}', 'MovieController@index')->name('movie.index');
Route::get('/movie/create/file', 'MovieController@createFileForm')->name('movie.create.file');
Route::post('/movie/create/file', 'MovieController@createFile');
Route::get('/movie//sale/{id}', 'MovieController@createSaleForm')->name('movie.create.sale');
Route::post('/movie/create/sale/{id}', 'MovieController@createSale');
Route::get('/movie/detail/{id}', 'MovieController@detail')->name('movie.detail.index');
Route::get('/movie/confirm/{id}', 'MovieController@confirm')->name('movie.confirm.index');
Route::post('/movie/confirm/{id}', 'MovieController@open');
Route::get('/movie/preview/{id}', 'MovieController@preview')->name('movie.preview.index');
Route::get('/movie/edit/{id}', 'MovieController@editForm')->name('movie.edit.index');
Route::post('/movie/edit/{id}', 'MovieController@edit');
Route::delete('/movie/delete/{id}', 'MovieController@delete')->name('movie.delete');

Route::get('/my', 'MyPageController@index')->name('my.index');
});
Route::get('/home', 'HomeController@index')->name('home');
Auth::routes();
