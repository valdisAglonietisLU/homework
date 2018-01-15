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


Auth::routes();

Route::post('/news/comment/{id}', 'NewsController@comment')->name('news.comment');
Route::resource('/news', 'NewsController');

Route::get('/home', function() { return redirect('/news');})->name('home');
Route::get('/', function() { return redirect('/news');});


//Route::group(['middleware' => 'auth'], function() {
//});

