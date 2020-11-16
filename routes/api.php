<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
header('Access-Control-Allow-Origin: *');
// header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
// header('Access-Control-Allow-Headers: Content-Type, X-Auth-Token, Origin, Authorization');

Route::post('login', 'Api\AuthController@login');

Route::post('register', 'Api\AuthController@register');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'auth:api'], function(){
    Route::get('user-detail', 'Api\AuthController@userDetail');
});

Route::get('all', 'BlogController@all');

Route::post('upload_pix', 'Api\PostController@store');

Route::get('say_greeting', 'Api\PostController@index');

Route::post('like_post', 'BlogController@apilike');

Route::get('single_post/{id}', 'BlogController@single_post');

Route::get('author/{id}', 'BlogController@api_author');