<?php

Auth::routes(['verify' => true]);
Auth::routes(['register' => false]);
Auth::routes();

Route::get('/', function () {
    return view('administrador.index');
});

Route::get('home', 'HomeController@index')->name('home');
Route::post('login', 'Auth\LoginController@login')->name('login');

Route::resource('afiliados', 'AfiliadoController');/*->middleware('verified');;*/
Route::resource('disciplinas', 'DisciplinaController');
Route::resource('instalaciones', 'InstalacionController');
Route::group(['prefix' => 'instalaciones'], function(){
    Route::post('upload', 'InstalacionController@cargarImagenesInstalacion');
    Route::get('images/{id}', 'InstalacionController@obtenerImagenesInstalacion');
    Route::delete('images/{id}', 'InstalacionController@eliminarImagenInstalacion');
});

Route::group(['prefix' => 'tee-time'], function(){
    Route::get('/', function(){return view('administrador.tee-time.index');})->name('tee-time.index');
});



