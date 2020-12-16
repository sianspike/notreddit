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

Route::get('/', 'App\Http\Controllers\PostController@index') -> middleware(['auth'])
    -> name('posts.index');;

Route::get('/dashboard', 'App\Http\Controllers\PostController@index') -> middleware(['auth'])
    -> name('posts.index');

Route::get('/dashboard/create', 'App\Http\Controllers\PostController@create') -> middleware(['auth'])
    -> name('posts.create');

Route::post('/dashboard', 'App\Http\Controllers\PostController@store') -> middleware(['auth'])
    -> name('posts.store');

Route::get('dashboard/{id}', 'App\Http\Controllers\PostController@show') -> middleware(['auth'])
    -> name('posts.show');

require __DIR__.'/auth.php';
