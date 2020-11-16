<?php

use Illuminate\Support\Facades\Auth;
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

Auth::routes(['register' => false, 'login' => false]);
Route::get('system-login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('system-login', 'Auth\LoginController@login');
use Laravel\Ui\AuthRouteMethods;
Route::prefix('system')->group(function () {
    Route::group(['middleware' => 'auth'], function () {
        Route::get('/home', 'HomeController@index')->name('home'); // also has Controller side middleware

        Route::get('/readers', 'ReaderController@index')->name('readers.index');
        Route::get('/readers/inactive', 'ReaderController@indexInactive')->name('readers.inactive');
        Route::get('/readers/create', 'ReaderController@create')->name('readers.create');
        Route::post('/readers', 'ReaderController@store')->name('readers.store');
        Route::get('/readers/{reader}', 'ReaderController@show')->name('readers.show');
        Route::get('/readers/{reader}/edit', 'ReaderController@edit')->name('readers.edit');
        Route::patch('/readers/{reader}', 'ReaderController@update')->name('readers.update');
        Route::patch('/readers/{reader}/password', 'ReaderController@password')->name('readers.password');
        Route::delete('/readers/{reader}', 'ReaderController@deactivate')->name('readers.deactivate');
        Route::post('/readers/{reader}/active', 'ReaderController@activate')->name('readers.activate');

        Route::get('/users', 'UserController@index')->name('users.index');
        Route::get('/users/inactive', 'UserController@indexInactive')->name('users.inactive');
        Route::get('/users/create', 'UserController@create')->name('users.create');
        Route::post('/users', 'UserController@store')->name('users.store');
        Route::get('/users/{user}', 'UserController@show')->name('users.show');
        Route::get('/users/{user}/edit', 'UserController@edit')->name('users.edit');
        Route::patch('/users/{user}', 'UserController@update')->name('users.update');
        Route::patch('/users/{user}/password', 'UserController@password')->name('users.password');
        Route::delete('/users/{user}', 'UserController@deactivate')->name('users.deactivate');
        Route::post('/users/{user}/active', 'UserController@activate')->name('users.activate');

        Route::get('/roles', 'UserAccessRoleController@index')->name('roles.index');
        Route::get('/roles/create', 'UserAccessRoleController@create')->name('roles.create');
        Route::post('/roles', 'UserAccessRoleController@store')->name('roles.store');
        Route::get('/roles/{role}', 'UserAccessRoleController@show')->name('roles.show');
        Route::get('/roles/{role}/edit', 'UserAccessRoleController@edit')->name('roles.edit');
        Route::patch('/roles/{role}', 'UserAccessRoleController@update')->name('roles.update');

        Route::get('/categories', 'EbookCategoryController@index')->name('categories.index');
        Route::get('/categories/create', 'EbookCategoryController@create')->name('categories.create');
        Route::post('/categories', 'EbookCategoryController@store')->name('categories.store');
        Route::get('/categories/{category}', 'EbookCategoryController@show')->name('categories.show');
        Route::get('/categories/{category}/edit', 'EbookCategoryController@edit')->name('categories.edit');
        Route::patch('/categories/{category}', 'EbookCategoryController@update')->name('categories.update');

        Route::get('/authors', 'AuthorController@index')->name('authors.index');
        Route::get('/authors/create', 'AuthorController@create')->name('authors.create');
        Route::post('/authors', 'AuthorController@store')->name('authors.store');
        Route::get('/authors/{author}', 'AuthorController@show')->name('authors.show');
        Route::get('/authors/{author}/edit', 'AuthorController@edit')->name('authors.edit');
        Route::patch('/authors/{author}', 'AuthorController@update')->name('authors.update');

        Route::get('/books', 'EbookController@index')->name('books.index');
        Route::get('/books/inactive', 'EbookController@indexInactive')->name('books.inactive');
        Route::get('/books/create', 'EbookController@create')->name('books.create');
        Route::post('/books', 'EbookController@store')->name('books.store');
        Route::get('/books/{book}', 'EbookController@show')->name('books.show');
        Route::get('/books/{book}/edit', 'EbookController@edit')->name('books.edit');
        Route::patch('/books/{book}', 'EbookController@update')->name('books.update');
        Route::delete('/books/{book}/delete', 'EbookController@forceDelete')->name('books.delete');
        Route::delete('/books/{book}', 'EbookController@deactivate')->name('books.deactivate');
        Route::post('/books/{book}/active', 'EbookController@activate')->name('books.activate');

        Route::prefix('/books/{book}')->group(function () {
            Route::get('/pages/create', 'EbookPageController@create')->name('pages.create');
            Route::post('/pages', 'EbookPageController@store')->name('pages.store');
            Route::get('/pages/{page}', 'EbookPageController@show')->name('pages.show');
            Route::get('/pages/{page}/edit', 'EbookPageController@edit')->name('pages.edit');
            Route::patch('/pages/{page}', 'EbookPageController@update')->name('pages.update');
            Route::delete('/pages/{page}/delete', 'EbookPageController@forceDelete')->name('pages.delete');
        });

        Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
        Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
        Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
    });
});
Route::fallback(function () {
    return abort(404);
});
