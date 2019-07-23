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

Auth::routes();
Route::middleware('auth')->resource('/admin/word' , 'Admin\WordController');
Route::middleware('auth')->get('/admin' , 'Admin\PanelController@index');
Route::middleware('auth')->post('/word/search' , 'Admin\WordController@search');

Route::get('/home', 'HomeController@index')->name('home');
