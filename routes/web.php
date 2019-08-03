<?php

Route::get('/', function () {
    return view('administrador.index');
});

Route::resource('afiliados', 'AfiliadoController');
Route::resource('disciplinas', 'DisciplinaController');
Route::resource('instalaciones', 'InstalacionController');