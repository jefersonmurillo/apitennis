<?php

Route::get('/', function () {
    return view('administrador.index');
});

Route::resource('afiliados', 'AfiliadoController');
Route::resource('disciplinas', 'DisciplinaController');

Route::get('/x', function(){return \App\User::updateOrCreate(['id' => 1]);});