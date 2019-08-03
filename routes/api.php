<?php

use App\Models;

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
    Route::post('payload', 'AuthController@payload');
});

Route::group(['prefix' => 'v1'], function () {
    Route::get('tipoDocumento', function () {
        return ['status' => 'ok', 'data' => Models\TipoDocumento::all()->toArray(), 'message' => 'Consulta Exitosa'];
    });
    Route::get('tipoUsuario', function () {
        return ['status' => 'ok', 'data' => Models\TipoUsuario::all()->toArray(), 'message' => 'Consulta Exitosa'];
    });
    Route::get('tipoEvento', function () {
        return ['status' => 'ok', 'data' => Models\TipoEvento::all()->toArray(), 'message' => 'Consulta Exitosa'];
    });

    /**
     *********************** TIPOS DE INSTALACION *************************
     */
    Route::get('tipoInstalacion', function () {
        return ['status' => 'ok', 'data' => Models\TipoInstalacion::with(['instalacions'])->get()->toArray(), 'message' => 'Consulta Exitosa'];
    });
    Route::get('tipoInstalacion/{id}', function ($id) {
        return ['status' => 'ok', 'data' => Models\TipoInstalacion::where(['id' => $id])->with(['instalacions.imagenesInstalacions'])->get()->toArray()[0], 'message' => 'Consulta Exitosa'];
    });

    Route::get('disciplinas', function () {
        return ['status' => 'ok', 'data' => Models\Disciplina::all()->toArray(), 'message' => 'Consulta Exitosa'];
    });
    Route::get('categoriasGolfista', function () {
        return ['status' => 'ok', 'data' => Models\CategoriaGolfista::all()->toArray(), 'message' => 'Consulta Exitosa'];
    });
});

Route::group(['prefix' => 'v1/instalaciones'], function () {
    Route::get('/', 'Services\Services@obtenerInstalaciones');
});

Route::group(['prefix' => 'v1/eventos'], function () {
    Route::get('/', 'Services\Services@obtenerEventos');
});

Route::get('x', function () {
    return date("M. j Y", strtotime("2019-08-02"));
});