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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/statement', 'HomeController@statement')->name('statement');

Route::get('/enter_transaction', 'TransactionController@enter_transaction')->name('enter');

Route::post('/post_transaction', 'TransactionController@post_transaction')->name('post_trans');
