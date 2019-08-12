<?php

use App\Models;
use App\Models\ProgramadorEscenario;

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', 'AuthJWTController@login');
    Route::post('logout', 'AuthJWTController@logout');
    Route::post('refresh', 'AuthJWTController@refresh');
    Route::post('me', 'AuthJWTController@me');
    Route::post('payload', 'AuthJWTController@payload');
});

Route::get('/', function(){
    $turno = ProgramadorEscenario::where(['fecha' => '2019-08-12']);
    return response()->json($turno);
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
     *********************** DISCIPLINAS *************************
     */

    Route::get('disciplinas', 'Services\Services@obtenerDisciplinas');

    /**
     *********************** TIPOS DE INSTALACION *************************
     */
    Route::get('tipoInstalacion', function () {
        return ['status' => 'ok', 'data' => Models\TipoInstalacion::with(['instalacions.imagenesInstalacions'])->get()->toArray(), 'message' => 'Consulta Exitosa'];
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

Route::group(['prefix' => 'v1/tee-time'], function () {
    Route::post('/obtenerGolfistas', 'Services\Services@obtenerJugadoresGolf');
    Route::get('obtenerDiasDisponibles', 'Services\Services@obtenerDiasDisponibles');

    Route::post('registrarTurno', 'Services\Services@registrarTurno');

    Route::post('obtenerReservacionesGolfista', 'Services\Services@obtenerReservacionesGolfista');
});


Route::group(['prefix' => 'v1/instalaciones'], function () {
    Route::get('/', 'Services\Services@obtenerInstalaciones');
});

Route::group(['prefix' => 'v1/eventos'], function () {
    Route::get('/', 'Services\Services@obtenerEventos');
});
