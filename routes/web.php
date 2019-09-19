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
// Route::get('/home', function(){
//     return view('welcome');
// });

// Route Dashboard Admin
    // Users Route for Admin
    Route::get('/dashboard/users', 'UserController@index')->name('indexusers');
    Route::get('/ajax/allusers', 'UserController@allUsers')->name('getallusers');
    Route::post('/dashboard/import-users', 'UserController@import')->name('importusers');
    Route::get('/dashboard/unduh-users', 'UserController@export')->name('exportusers');
    // Delete One user
    Route::delete('/delete/user', 'UserController@deleteOne')->name('deleteoneuser');
    Route::put('/ajax/updateuser', 'UserController@updateOne')->name('updateoneuser');


    // Siswa Route for Admin
    Route::get('/dashboard/siswas', 'SiswaController@index')->name('indexsiswas');
    Route::get('/ajax/allsiswas', 'SiswaController@allSiswas')->name('getallsiswas');
    Route::post('/dashboard/import-siswas', 'SiswaController@import')->name('importsiswas');
    Route::put('/ajax/updateonesiswa', 'SiswaController@updateOne')->name('updateonesiswa');
    Route::post('/dashboard/import-ortu', 'OrtuController@import')->name('importortu');
    Route::post('/ajax/create-ortu', 'OrtuController@create')->name('createortu');
    Route::put('/ajax/update-ortu', 'OrtuController@updateOne')->name('updateoneortu');

    Route::delete('/delete/siswa', 'SiswaController@deleteOne')->name('deleteonesiswa');

    // Rombel Route for admin
    Route::get('/dashboard/rombels', 'RombelController@index')->name('indexrombel');
    Route::post('/ajax/create-rombel', 'RombelController@create')->name('createrombel');
    Route::get('/ajax/allrombels', 'RombelController@allRombels')->name('getallrombels');
    Route::get('/ajax/allgurus', 'UserController@getgurus')->name('getgurus');



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