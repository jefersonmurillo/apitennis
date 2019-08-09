<?php

namespace App\Http\Controllers;

use App\Models\Escenario;
use Illuminate\Http\Request;

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
     * @param $estado
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id, $estado)
    {
        if($estado == 'TODOS'){
            $escenario = Escenario::where(['id' => $id])->with(['disciplina', 'programador'])->get()->toArray()[0];
        }else{
            $escenario = Escenario::where(['id' => $id])->with(['disciplina', 'programador' => function($query) use ($estado){
                $query->where(['estado' => $estado])->get(['id', 'fecha', 'hora', 'estado', 'grupo_jugadores_golf']);
            }])->get()->toArray()[0];
        }

        return response()->json($escenario);
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
}
