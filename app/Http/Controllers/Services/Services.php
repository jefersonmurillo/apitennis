<?php

namespace App\Http\Controllers\Services;

use App\Models\Evento;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Services extends Controller
{

    /* *************************************** INSTALACIONES ****************************************/

    public function obtenerInstalaciones()
    {
        return response()->json([
            'status' => 'ok',
            'data' => Evento::with(['prioridad', 'tipoEvento', 'imagenesEventos'])->get()->toArray(),
            'message' => 'Consulta Exitosa'
        ]);
    }


    /* *************************************** EVENTOS ************************************/

    public function obtenerEventos(){
        return response()->json([
            'status' => 'ok',
            'data' => Evento::with(['prioridad', 'tipoEvento', 'imagenesEventos'])->get()->toArray(),
            'message' => 'Consulta Exitosa'
        ]);
    }

}
