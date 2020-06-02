<?php

Route::get('/dashboard', function () {
      return view('admin.dashboard');
})->name('admin.index');

Route::resource('/tim','TimController');
Route::get('/getDataJson/tim','TimController@getData');
Route::get('/delete/tim/{id}','TimController@deleteData');

Route::resource('/pemain','PemainController');
Route::get('/getDataJson/pemain','PemainController@getData');
Route::get('/delete/pemain/{id}','PemainController@deleteData');

Route::resource('/tim-pemain','TimPemainController');
Route::get('/getDataJson/tim-pemain/{id}','TimPemainController@getData');
Route::get('/getDataJson/cari-pemain','TimPemainController@cariPemain');
Route::get('/delete/pemain/{id}','PemainController@deleteData');

Route::resource('/pertandingan','PertandinganController');
Route::get('/getDataJson/pertandingan','PertandinganController@getData');
Route::get('/getDataJson/tim-pertandingan','PertandinganController@getTim');
Route::get('/delete/pertandingan/{id}','PertandinganController@deleteData');

Route::post('/pertandingan-skor','PertandinganController@inputSkor');

Route::get('/pertandingan-selesai','PertandinganController@pertandinganSelesai')->name('pertandingan-selesai.index');
Route::get('/pertandingan-selesai/{id}','PertandinganController@pertandinganSelesaiDetail')->name('pertandingan-selesai.detail');
// Route::get('/getDataJson/pertandingan-selesai','PertandinganController@getData');