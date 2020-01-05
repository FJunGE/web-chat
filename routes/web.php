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

Route::group(['middleware'=>'login'], function () use ($router){
    $router->get('chat', function () {
        return view('pages.chat');
    });
});

Route::post('register', 'AuthController@register')->name('register.store');
Route::get('register', 'AuthController@register')->name('register.index');

Route::post('login', 'AuthController@login')->name('auth.login');
