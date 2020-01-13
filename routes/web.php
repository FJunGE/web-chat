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
    return view('auth.login');
});


Route::group(['middleware'=>'auth'], function () use ($router){
    $router->get('chat', 'ChatController@index')->name('chat.index');
});

Route::post('register', 'AuthController@register')->name('register.store');
Route::get('register', 'AuthController@register')->name('register.index');

//Route::redirect('login', '/', 301);
Route::post('login', 'AuthController@login')->name('login.store');
Route::get('login', 'AuthController@login')->name('login');
Route::get('logout', 'AuthController@logout')->name('logout');
