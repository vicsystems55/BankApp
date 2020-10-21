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

Route::post('/post_transaction', 'TransactionController@transact')->name('post_trans');

Route::get('/transfer', 'TransactionController@transfer_p')->name('transfer_p');

Route::post('/transfer', 'TransactionController@transfer')->name('transfer');

Route::get('/blog', 'BlogController@blog')->name('blog');

Route::get('/authors', 'BlogController@authors')->name('author');

Route::get('/single_autor/{id}', 'BlogController@single_author')->name('single_author');

Route::get('/create_post', 'BlogController@index')->name('post_page');

Route::post('/like', 'BlogController@like')->name('like');

Route::post('/follow', 'BlogController@follow')->name('follow');

Route::post('/create_postx', 'BlogController@create')->name('create_postx');

Route::get('/single_post/{slug}', 'BlogController@single_post')->name('single_post');


Route::get('send-mail', function () {
   
    $details = [
        'title' => 'Mail from ItSolutionStuff.com',
        'body' => 'This is for testing email using smtp'
    ];
   
    \Mail::to('your_receiver_email@gmail.com')->send(new \App\Mail\BankAlert($details));
   
    dd("Email is Sent.");
});

