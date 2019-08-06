<?php

namespace App\Http\Controllers\Services;

use App\Models\Disciplina;
use App\Models\Evento;
use App\Models\Instalacion;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Services extends Controller
{

    /* *************************************** INSTALACIONES ****************************************/

    public function obtenerInstalaciones()
    {
        return response()->json([
            'status' => 'ok',
            'data' => Instalacion::with(['disciplina', 'tipoInstalacion', 'imagenesInstalacions'])->get()->toArray(),
            'message' => 'Consulta Exitosa'
        ]);
    }

    public function obtenerTipoInstalacion()
    {
        return response()->json(Disciplina::with([''])->get()->toArray());
    }

    /* *************************************** EVENTOS ************************************/

    public function obtenerEventos()
    {
        $eventos = Evento::with(['prioridad', 'tipoEvento', 'imagenesEventos'])->get()->toArray();
        $data = [];

        /**
         * Cambio el formado de la fecha ejemplo: Jul. 31 2019
         */
        foreach ($eventos as $evento) {
            $evento['fecha_inicio'] = date("M. j Y", strtotime($evento['fecha_inicio']));
            $evento['fecha_fin'] = date("M. j Y", strtotime($evento['fecha_fin']));
            array_push($data, $evento);
        }

        return response()->json([
            'status' => 'ok',
            'data' => $data,
            'message' => 'Consulta Exitosa'
        ]);
    }

    /* ************************************ JUGADORES ***********************************/

    public function obtenerJugadorGolf(Request $request)
    {
        $jugador = User::where(['codigo_golfista' => $request->get('codigo_golfista'), 'estado_users_id' => 1])->get()->toArray();
        if (count($jugador) < 1){
            return response()->json([
                'status' => 'error',
                'data' => [],
                'message' => 'No se encontro el jugador'
            ], 404);
        }

        return response()->json([
            'status' => 'ok',
            'data' => $jugador[0],
            'message' => 'Consulta Exitosa'
        ], 200);
    }

}
