<?php

namespace App\Http\Controllers\Services;

use App\Models\Disciplina;
use App\Models\Evento;
use App\Models\GrupoJugadoresGolf;
use App\Models\Instalacion;
use App\Models\ProgramadorEscenario;
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

    /* ************************************ TEE TIME ***********************************/

    public function obtenerJugadoresGolf(Request $request)
    {
        $codigos = $request->get('codigos');
        $codigos = json_decode($codigos);
        if (count($codigos) < 3)
            return response()->json([
                'status' => 'error',
                'data' => [],
                'message' => 'Jugadores incompletos'
            ], 402);

        $data = [];

        foreach ($codigos as $codigo) {
            $jugador = User::where(['codigo_golfista' => $codigo, 'estado_users_id' => 1])->get()->toArray();
            if (count($jugador) < 1) {
                array_push($data, [
                    'status' => 'error',
                    'data' => [$jugador, $codigo],
                    'message' => 'No se encontro el jugador'
                ]);
            } else {
                array_push($data, [
                    'status' => 'ok',
                    'data' => $jugador[0],
                    'message' => 'Consulta Exitosa'
                ]);
            }
        }

        return response()->json([
            'status' => 'ok',
            'data' => $data,
            'message' => 'Consulta Exitosa'
        ], 200);
    }

    public function registrarTurno(Request $request)
    {
        if (!$request->has('codigos_jugadores') OR !$request->has('codigo_turno')) {
            response()->json([
                'status' => 'error',
                'data' => [],
                'message' => 'Faltan datos'
            ], 402);
        }

        $turno = ProgramadorEscenario::where(['id' => $request->get('codigo_turno')]);

        if (count($turno->get()->toArray()) < 1) {
            return response()->json([
                'status' => 'error',
                'data' => [],
                'message' => 'Turno no encontrado'
            ], 404);
        }

        $codigos_jugadores = json_decode($request->get('codigos_jugadores'));



        $grupo =  new GrupoJugadoresGolf();

        $grupo->jugador1 = $codigos_jugadores[0];
        $grupo->jugador2 = $codigos_jugadores[1];
        $grupo->jugador3 = $codigos_jugadores[2];

        if(count($codigos_jugadores) == 4)
            $grupo->jugador4 = $codigos_jugadores[3];

        $grupo->save();

        $update = $turno->update(['grupo_jugadores_golf' => $grupo->getKey(), 'estado' => 'RESERVADO']);
        if($update){
            return response()->json([
                'status' => 'ok',
                'data' => [],
                'message' => 'Reservación realizada'
            ], 200);
        }

        return response()->json([
            'status' => 'error',
            'data' => [],
            'message' => 'Ocurrió un error'
        ], 500);
    }

    private function validarJugadoresTurnoDia($fecha, $codigos){
        $programadores = ProgramadorEscenario::where(['fecha' => $fecha])->with([
            'jugador1', 'jugador2', 'jugador3', 'jugador4'
        ])->get()->toArray();

        foreach ($programadores as $programador) {
            
        }
    }

    public function obtenerDiasDisponibles()
    {
        $dias = ProgramadorEscenario::where('fecha', '>=', date('Y-m-d'))->groupBy('fecha')->get(['fecha'])->toArray();

        $programador = ProgramadorEscenario::where('fecha', '>=', date('Y-m-d'))
            ->orWhere('estado', ['DISPONIBLE', 'DESAPROBADO'])->orderBy('fecha', 'ASC')->orderBy('hora', 'ASC')
            ->with(['escenario.disciplina'])->get()->toArray();

        $data = [];

        foreach ($dias as $dia) {
            $var = ['fecha' => $dia['fecha'], 'dias' => []];
            foreach ($programador as $p) {
                if ($p['fecha'] == $dia['fecha']) {
                    array_push($var['dias'], $p);
                }
            }
            array_push($data, $var);
        }

        return response()->json([
            'status' => 'ok',
            'data' => $data,
            'message' => 'Consulta Exitosa'
        ], 200);

    }

    /* ************************************ DISCIPLINAS ***********************************/

    public function obtenerDisciplinas()
    {
        return response()->json([
            'status' => 'ok',
            'data' => Disciplina::all()->toArray(),
            'message' => 'Consulta Exitosa'
        ], 200);
    }

}
