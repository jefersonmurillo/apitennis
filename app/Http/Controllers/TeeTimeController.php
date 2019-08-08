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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function registrarEscenario(Request $request){
        if(!$request->has('nombre') OR !$request->has('disciplina'))
            return response()->json(['respuesta' => 'Datos Invalidos', 'status' => 400, 'data' => [
                $request->toArray()
            ]], 400);

        $nombre = $request->get('nombre');
        $disciplina = $request->get('disciplina');

        if($request->has('id')){
            $result = Escenario::where(['id' => $request->get('id')])->update(['nombre' => $nombre, 'disciplina_id' => $disciplina]);
        }else {
            $escenario = new Escenario(['nombre' => $nombre, 'disciplina_id' => $disciplina]);
            $result = $escenario->save();
        }

        return $result ? response()->json([
            'respuesta' => 'Información guardada',
            'status' => 200,
            'data' => [$request->toArray()]], 200)
            : response()->json(['respuesta' => 'Error', 'data' => $request->toArray(),'status' => 500], 500);
    }
}
