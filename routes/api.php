<?php

use App\Models;

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
    Route::post('payload', 'AuthController@payload');
});

Route::group(['prefix' => 'v1', 'middleware' => ['auth']], function () {
    Route::get('tipoDocumento', function(){return Models\TipoDocumento::all()->toArray();});
    Route::get('tipoUsuario', function(){return Models\TipoUsuario::all()->toArray();});
    Route::get('tipoEvento', function(){return Models\TipoEvento::all()->toArray();});
    Route::get('tipoInstalacion', function(){return Models\TipoInstalacion::all()->toArray();});
    Route::get('disciplinas', function(){return Models\Disciplina::all()->toArray();});
    Route::get('categoriasGolfista', function(){return Models\CategoriaGolfista::all()->toArray();});

    Route::resource('instalaciones', 'InstalacionController');
    Route::resource('eventos', 'EventoController');
});
