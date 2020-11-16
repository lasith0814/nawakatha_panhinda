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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::get('reader-password/reset', 'Api\Auth\ForgotPasswordController@showLinkRequestForm');
Route::post('reader-password/email', 'Api\Auth\ForgotPasswordController@sendResetLinkEmail');
Route::get('reader-password/reset/{token}', 'Api\Auth\ResetPasswordController@showResetForm');
Route::post('reader-password/reset', 'Api\Auth\ResetPasswordController@reset');

Route::prefix('auth')->group(function () {
    Route::group(['middleware' => 'api'], function () {
        Route::post('register', 'Api\Auth\LoginController@register');
        Route::post('login', 'Api\Auth\LoginController@login');
        Route::post('logout', 'Api\Auth\LoginController@logout');
        Route::post('refresh', 'Api\Auth\LoginController@refresh');

        Route::get('profile', 'Api\Auth\ProfileController@edit');
        Route::post('profile', 'Api\Auth\ProfileController@update');
        Route::post('profile/password', 'Api\Auth\ProfileController@password');
    });
});

Route::group(['middleware' => 'auth:api'], function () {
        Route::get('/books', 'Api\ReaderApiController@bookIndex');
        Route::get('/books/{book}', 'Api\ReaderApiController@bookShowPages');
        Route::get('/books/{book}/like', 'Api\ReaderApiController@likeDislikeBook');
    Route::prefix('/books/{book}')->group(function () {
        Route::get('/pages/{page}', 'Api\ReaderApiController@bookPage');
        Route::get('/pages/{page}/bookmark', 'Api\ReaderApiController@bookmark');
    });
});


