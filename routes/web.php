<?php

Route::get('/', function () { return view('administrador.index'); });

Route::group(['prefix' => 'afiliados'], function () {
    Route::resource('/', 'AfiliadoController');
});
