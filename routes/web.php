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

Route::get('/dashboard/edit/{post}', 'App\Http\Controllers\PostController@edit') -> middleware(['auth'])
    -> name('posts.edit');

Route::post('/dashboard', 'App\Http\Controllers\PostController@store') -> middleware(['auth'])
    -> name('posts.store');

Route::post('/dashboard/edit/{post}', 'App\Http\Controllers\PostController@update') -> middleware(['auth'])
    -> name('posts.update');

Route::get('/dashboard/{post}', 'App\Http\Controllers\PostController@show') -> middleware(['auth'])
    -> name('posts.show');

Route::get('/dashboard/edit/{post}/{comment}', 'App\Http\Controllers\CommentController@edit') -> middleware(['auth'])
    -> name('comments.edit');

Route::post('/dashboard/{post}', 'App\Http\Controllers\CommentController@store') -> middleware(['auth'])
    -> name('comments.store');

Route::post('/dashboard/{post}/{comment}', 'App\Http\Controllers\CommentController@update') -> middleware(['auth'])
    -> name('comments.update');

Route::delete('/dashboard/{notification}', 'App\Http\Controllers\NotificationController@destroy') -> middleware(['auth'])
    -> name('notifications.destroy');

require __DIR__.'/auth.php';
