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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/subscription/{name}', 'HomeController@subscription')->name('subscription');
Route::group(['prefix' => 'dashbord','middleware' => ['auth']], function () {
       Route::get('/','HR\HrController@index');
      Route::get('/database','HR\HrController@createDB');

//    Route::get('/edit/{id}','AdminController@index')
});
