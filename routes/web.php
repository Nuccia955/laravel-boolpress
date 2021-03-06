<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

/* Routes for Authentication */
Auth::routes();


/* Route for Admin */
Route::middleware('auth')
    ->namespace('Admin')
    ->name('admin.')
    ->prefix('admin')
    ->group( function () {
        Route::get('/', 'HomeController@index')->name('home');

        Route::resource('/posts', 'PostController');

        Route::get('/categories/{id}', 'CategoryController@show')->name('category');

        Route::get('/tags/{id}', 'TagController@show')->name('tag');
    });


/* Default with routes not found */
Route::get("{any?}", function() {
    return view('guests.home');
})->where('any', '.*');
