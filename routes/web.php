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

// use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Route;

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
    Route::get('/unduh/allsiswas', 'SiswaController@exportAll')->name('exportallsiswas');
    Route::delete('/delete/siswa', 'SiswaController@deleteOne')->name('deleteonesiswa');


// Rombel Route for admin
    Route::get('/dashboard/rombels', 'RombelController@index')->name('indexrombel');
    Route::post('/ajax/create-rombel', 'RombelController@create')->name('createrombel');
    Route::get('/ajax/allrombels', 'RombelController@allRombels')->name('getallrombels');
    Route::get('/ajax/allgurus', 'UserController@getgurus')->name('getgurus');
    Route::delete('/ajax/del/rombel', 'RombelController@deleteOne')->name('deleteonerombel');
    Route::put('/ajax/update/rombel', 'RombelController@updateOne')->name('updateonerombel');
    Route::get('/ajax/selrombel', 'RombelController@selRombel')->name('select2rombel');
    Route::get('/dashboard/unduh/rombels', 'RombelController@export')->name('exportrombels');
    // Route dor select2 guru
    Route::get('/ajax/gurus', 'UserController@search')->name('searchguru');
    // get Members of rombel
    Route::get('/ajax/getmembers', 'SiswaController@getMembers')->name('getmembers');
    Route::get('/ajax/getnonmembers', 'SiswaController@getNonMembers')->name('getnonmembers');
    Route::put('/ajax/pindahrombel', 'SiswaController@pindahRombel')->name('pindahrombel');
    Route::put('/ajax/keluarkansiswa', 'SiswaController@keluarkan')->name('keluarkansiswa');
    Route::put('/ajax/masukkansiswa', 'SiswaController@masukkan')->name('masukkansiswa');
    // Data Sekolah 
    Route::get('/dashboard/settings/data-sekolah', 'SekolahController@index')->name('indexSekolah');
    Route::get('/ajax/datasekolah', 'SekolahController@getData')->name('getdatasekolah');
    Route::put('/ajax/updatesekolah', 'SekolahController@update')->name('updatedatasekolah');
    // Data Tematik
    Route::get('/dashboard/settings/tema', 'TemaController@index')->name('indextematik')->middleware('auth');
    Route::post('/import/tema', 'TemaController@import')->name('importtema');
    Route::get('/export/tema', 'TemaController@export')->name('exporttema');
    Route::get('/ajax/alltemas', 'TemaController@allTemas')->name('getalltemas');
    Route::post('/import/subtema', 'SubtemaController@import')->name('importsubtema');
    Route::get('/ajax/subtema', 'SubtemaController@show')->name('getsubtemas');
    // Route Mapel
    Route::get('/dashboard/settings/mapel', 'MapelController@index')->name('indexmapel');
    Route::get('/ajax/mapels', 'MapelController@show')->name('showmapels');
    Route::get('/ajax/mapel/rombel/{rombel}', 'MapelController@showByRombel')->name('showmapelsbyrombel');
    Route::post('/import/mapels', 'MapelController@import')->name('importmapel');
    Route::get('/ajax/kds', 'KdController@getByKelas')->name('getkdbykelas');

    // Admin Tematik
    Route::get('/dashboard/settings/tematik', 'TematikController@index')->name('indextematik');
    Route::get('/ajax/getmapelsby/{tingkat}', 'TematikController@map')->name('maptematik');


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