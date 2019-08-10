<?php

namespace App\Http\Controllers;

use App\Models\Escenario;
use App\Models\ProgramadorEscenario;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Integer;

class TeeTimeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $escenarios = Escenario::with(['disciplina', 'programador'])->get()->toArray();
        $data = [];

        foreach ($escenarios as $escenario) {
            $disponibles = [];
            $aprobadas = [];
            $desaprobadas = [];
            $pendientes = [];
            foreach ($escenario['programador'] as $dia) {
                if ($dia['estado'] == 'RESERVADO') array_push($pendientes, $dia);
                elseif ($dia['estado'] == 'DESAPROBADO') array_push($desaprobadas, $dia);
                elseif ($dia['estado'] == 'APROBADO') array_push($aprobadas, $dia);
                elseif ($dia['estado'] == 'DISPONIBLE') array_push($disponibles, $dia);
            }

            $escenario['disponibles'] = $disponibles;
            $escenario['aprobados'] = $aprobadas;
            $escenario['desaprobados'] = $desaprobadas;
            $escenario['pendientes'] = $pendientes;

            array_push($data, $escenario);
        }

        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $escenario = Escenario::where(['id' => $id])->with([
            'programador.grupoJugadoresGolf.jugador1',
            'programador.grupoJugadoresGolf.jugador2',
            'programador.grupoJugadoresGolf.jugador3',
            'programador.grupoJugadoresGolf.jugador4',
        ])->get()->toArray()[0];
        \JavaScript::put([
            'escenario' => $escenario
        ]);

        return view('administrador.tee-time.programador', [
            'escenario' => $escenario
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function registrarEscenario(Request $request)
    {
        if (!$request->has('nombre') OR !$request->has('disciplina'))
            return response()->json(['respuesta' => 'Datos Invalidos', 'status' => 400, 'data' => [
                $request->toArray()
            ]], 400);

        $nombre = $request->get('nombre');
        $disciplina = $request->get('disciplina');

        if ($request->has('id')) {
            $result = Escenario::where(['id' => $request->get('id')])->update(['nombre' => $nombre, 'disciplina_id' => $disciplina]);
        } else {
            $escenario = new Escenario(['nombre' => $nombre, 'disciplina_id' => $disciplina]);
            $result = $escenario->save();
        }

        return $result ? response()->json([
            'respuesta' => 'Información guardada',
            'status' => 200,
            'data' => [$request->toArray()]], 200)
            : response()->json(['respuesta' => 'Error', 'data' => $request->toArray(), 'status' => 500], 500);
    }

    public function fechasProgramadasEscenario($id)
    {
        return response()->json(ProgramadorEscenario::where(['escenario_id' => $id])->groupBy('fecha')->get(['fecha'])->toArray());
    }

    public function reservacionesEscenarioFecha($id, $fecha)
    {
        $reservaciones = ProgramadorEscenario::where(['escenario_id' => $id, 'fecha' => $fecha])
            ->with([
                'grupoJugadoresGolf' => function ($query) {
                    $query->with(['jugador1', 'jugador2', 'jugador3', 'jugador4'])->get();
                }
            ])->get()->toArray();

        $data = [];

        foreach ($reservaciones as $reservacion) {
            $item = $reservacion;
            if ($reservacion['grupo_jugadores_golf'] != null) {
                $item['grupo_jugadores_golf']['jugador1'] = [
                    'id' => $reservacion['grupo_jugadores_golf']['jugador1']['id'],
                    'nombres' => $reservacion['grupo_jugadores_golf']['jugador1']['nombres'],
                    'apellidos' => $reservacion['grupo_jugadores_golf']['jugador1']['apellidos']
                ];

                $item['grupo_jugadores_golf']['jugador2'] = [
                    'id' => $reservacion['grupo_jugadores_golf']['jugador2']['id'],
                    'nombres' => $reservacion['grupo_jugadores_golf']['jugador2']['nombres'],
                    'apellidos' => $reservacion['grupo_jugadores_golf']['jugador2']['apellidos']
                ];

                $item['grupo_jugadores_golf']['jugador3'] = [
                    'id' => $reservacion['grupo_jugadores_golf']['jugador3']['id'],
                    'nombres' => $reservacion['grupo_jugadores_golf']['jugador3']['nombres'],
                    'apellidos' => $reservacion['grupo_jugadores_golf']['jugador3']['apellidos']
                ];

                if ($item['grupo_jugadores_golf']['jugador4'] != null){
                    $item['grupo_jugadores_golf']['jugador4'] = [
                        'id' => $reservacion['grupo_jugadores_golf']['jugador4']['id'],
                        'nombres' => $reservacion['grupo_jugadores_golf']['jugador4']['nombres'],
                        'apellidos' => $reservacion['grupo_jugadores_golf']['jugador4']['apellidos']
                    ];
                }

                array_push($data, $item);
            }
        }
        return response()->json($data);
    }

    public function obtenerDiasEstado($id, $estado)
    {
        if ($estado == 'TODOS') {
            $escenario = Escenario::where(['id' => $id])->with(['disciplina', 'programador' => function ($query) {
                $query->orderBy('fecha', 'desc')->get();
            }])->get()->toArray()[0];
        } else {
            $escenario = Escenario::where(['id' => $id])->with(['disciplina', 'programador' => function ($query) use ($estado) {
                $query->where(['estado' => $estado])->orderBy('fecha', 'desc')
                    ->get(['id', 'fecha', 'hora', 'estado', 'grupo_jugadores_golf']);
            }])->get()->toArray()[0];
        }

        return response()->json($escenario);
    }

    public function registrarProgramacionEscenario(Request $request){
        if (!$request->has('id') OR !$request->has('fecha') OR !$request->has('hora'))
            return response()->json(['respuesta' => 'Datos Invalidos', 'status' => 400, 'data' => [
                $request->toArray()
            ]], 400);

        $hora = $request->get('hora');

        $hora = explode(' ', $hora);
        if($hora[1] == 'PM'){
            $min = explode(':', $hora[0]);

        }

        $programa = new ProgramadorEscenario([
            'escenario_id' => $request->get('id'),
            'fecha' => $request->get('fecha'),
        ]);
    }
}
