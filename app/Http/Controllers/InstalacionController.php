<?php

namespace App\Http\Controllers;

use App\Models\Disciplina;
use App\Models\Instalacion;
use App\Models\TipoInstalacion;
use Illuminate\Http\Request;

use Image;

class InstalacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        \JavaScript::put([
            'disciplinas' => Disciplina::all()->toArray(),
        ]);

        return view('administrador.instalaciones.registro', [
            'tiposInstalacion' => TipoInstalacion::all()->toArray(),
            'disciplinas' => Disciplina::all()->toArray(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('administrador.instalaciones.registro');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!$request->has('imgDestacada') OR !$request->has('nombre') OR !$request->has('tipo') OR !$request->has('descripcion'))
            return response()->json(['respuesta' => 'Datos Invalidos', 'status' => 200, 'data' => [
                $request->toArray()
            ]], 200);

        $img = $request->get('imgDestacada');
        $info = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $img));

        $imgp = Image::make($info);
        $imgp->save(public_path('storage/instalaciones/' . $request->get('nombre') . '.png'));

        $nombres = $request->get('nombre');
        $tipo = $request->get('tipo');
        $descripcion = $request->get('descripcion');

        $instalacion = new Instalacion([
            'nombre' => $nombres,
            'tipo_instalacion_id' => $tipo,
            'descripcion' => $descripcion,
            'imagen_destacada' => 'storage/instalaciones/' . $request->input('nombre') . '.png'
        ]);

        return $instalacion->save() ?
            response()->json(['respuesta' => 'Información guardada', 'status' => 200], 200)
            : response()->json(['respuesta' => 'Error', 'status' => 500], 500);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
}
