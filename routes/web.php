<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Models;

Route::get('/', function () {
    return view('administrador.index');
});

Route::group(['prefix' => 'administrador'], function () {

    Route::get('usuarios', function (){
        return view('administrador.usuarios.registro');
    });
});

Route::resource('afiliados', 'AfiliadoController');
