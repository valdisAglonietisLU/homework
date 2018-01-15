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

//if (in_array(Request::segment(1), Config::get('application.languages'))) {
//    $lang = Request::segment(1);
//} else {
//    $lang = Config::get('application.language');
//}
//App::setLocale($lang);

Route::get('/home', function($lang = null) { return redirect('/');})->name('home');
Route::get('/', function($lang = null) { return redirect(Config::get('application.language').'/news');});

Route::group(['middleware' => 'App\Http\Middleware\setLocale','prefix' => '/{lang}'], function() {
    Auth::routes();


    Route::get('/news', 'NewsController@index');
    Route::get('/news/create','NewsController@create');
    Route::post('/news/create/','NewsController@store');
    Route::get('/news/show/{id}','NewsController@show');
    Route::get('/news/edit/{id}','NewsController@edit');
    Route::post('/news/edit/{id}','NewsController@update');
    Route::get('/news/delete/{id}','NewsController@destroy');
    Route::get('/news/renew/{id}','NewsController@renew');
    Route::post('/news/comment/{id}', 'NewsController@comment');
    Route::get('/profile/','ProfileController@index');
    Route::get('/profile/edit','ProfileController@edit');
    Route::post('/profile/edit','ProfileController@update');

//    Route::resource('/news', 'NewsController');
});



