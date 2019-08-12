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
                    'data' => [],
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

        $result = $this->validarJugadoresTurnoDia($turno->get()->toArray()[0]['fecha'], $codigos_jugadores);

        if (!$result['ok'])
            return response()->json([
                'status' => 'error',
                'data' => $result,
                'message' => 'Hay jugadores con reservaciones disponibles para esta fecha'
            ], 402);

        $datos = [
            'jugador1' => $codigos_jugadores[0],
            'jugador2' => $codigos_jugadores[1],
            'jugador3' => $codigos_jugadores[2],
            'estado' => 'RESERVADO'
        ];

        count($codigos_jugadores) > 3 ? $datos['jugador4'] = $codigos_jugadores[3] : false;

        $update = $turno->update($datos);
        if ($update) {
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

    private function validarJugadoresTurnoDia($fecha, $codigos)
    {
        $turnos = ProgramadorEscenario::where(['fecha' => $fecha])->with(['jugador1', 'jugador2', 'jugador3', 'jugador4'])->get()->toArray();
        $data = ['ok' => true, 'jugadores' => []];

        foreach ($codigos as $codigo) {
            foreach ($turnos as $turno) {
                if ($turno['jugador1']['codigo_afiliado'] == $codigo OR $turno['jugador2']['codigo_afiliado'] == $codigo OR $turno['jugador3']['codigo_afiliado'] == $codigo) {
                    $data['ok'] = false;
                    array_push($data['jugadores'], $codigo);
                } else if ($turno['jugador4'] != null AND $turno['jugador4']['codigo_afiliado'] == $codigo)
                    array_push($data['jugadores'], $codigo);
            }
        }

        return $data;
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

    public function obtenerReservacionesGolfista(Request $request)
    {
        if (!$request->has('codigo_golfista') OR empty($request->get('codigo_golista')) OR is_null($request->get('codigo_golfista')))
            response()->json([
                'status' => 'error',
                'data' => [],
                'message' => 'Faltan datos'
            ], 402);

        $codigo_golfista = $request->get('codigo_golfista');

        $reservaciones = ProgramadorEscenario::where(['jugador1' => $codigo_golfista])
            ->orWhere(['jugador2' => $codigo_golfista])
            ->orWhere(['jugador3' => $codigo_golfista])
            ->orWhere(['jugador4' => $codigo_golfista])
            ->with(['jugador1', 'jugador2', 'jugador3', 'jugador4'])->get()->toArray();

        return response()->json($reservaciones);
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
