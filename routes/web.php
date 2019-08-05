<?php

Auth::routes(['verify' => true]);
Auth::routes(['register' => false]);

Route::get('/', function () {
    return view('administrador.index');
});

Route::post('login', 'Auth\LoginController@login')->name('login');

Route::resource('afiliados', 'AfiliadoController');/*->middleware('verified');;*/
Route::resource('disciplinas', 'DisciplinaController');
Route::resource('instalaciones', 'InstalacionController');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
