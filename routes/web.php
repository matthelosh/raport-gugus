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
    return view('umum.beranda');
});
Route::get('/dashboard', 'DashController@index')->middleware('auth');
Route::get('/home', function(){
    return view('welcome');
});


Route::get('/login', function(){
    return redirect('/');
})->name('login');
Route::post('/login', 'LoginController@authenticate')->name('postlogin');
Route::post('/logout', function(){
    Auth::logout();
    return redirect('/');
});
Route::get('/logout', function(){
    Auth::logout();
    return redirect('/');
});