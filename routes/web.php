<?php

Route::get('/', function () {
    return view('administrador.index');
});

Route::resource('afiliados', 'AfiliadoController');
