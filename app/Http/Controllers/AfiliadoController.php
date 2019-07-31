<?php

namespace App\Http\Controllers;

use App\Models\CategoriaGolfista;
use App\Models\TipoDocumento;
use App\Models\TipoUsuario;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AfiliadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('administrador.afiliados.index', [
            'afiliados' => User::with(['categoriaGolfista', 'estadoUser', 'tipoDocumento', 'tipoUsuario'])->get()->toArray()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('administrador.afiliados.registro', [
            'tiposDocumento' => TipoDocumento::all()->toArray(),
            'tiposUsuario' => TipoUsuario::all()->toArray(),
            'categoriasGolfista' => CategoriaGolfista::all()->toArray()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Illuminate\Http\Response $response
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Response $response){
        //return response()->json($request->toArray(), 200);

        $nombres = $request->get('nombres');
        $apellidos = $request->get('apellidos');
        $email = $request->get('email');
        $tipo_documento = $request->get('tipo_documento');
        $categoria_golfista = $request->get('categoria_golfista');
        $documento = $request->get('documento');
        $fecha_nacimiento = $request->get('fecha_nacimiento');
        $telefono = $request->get('telefono');
        $direccion = $request->get('direccion');
        $genero = $request->get('genero');
        $codigo_afiliado = $request->get('codigo_afiliado');
        $codigo_golfista = $request->get('codigo_golfista');
        $tipo_usuario = $request->get('tipo_usuario');



        $usuario = new User([
            'email' => $email,
            'password' => Hash::make('CC'.$documento),
            'name' => $nombres,
            'tipo_documento_id' => $tipo_documento,
            'categoria_golfista_id' => $categoria_golfista,
            'estado_users_id' => 1,
            'documento' => $documento,
            'nombres' => $nombres,
            'apellidos' => $apellidos,
            'fecha_naci' => $fecha_nacimiento,
            'telefono' => $telefono,
            'direccion' => $direccion,
            'genero' => $genero,
            'codigo_afiliado' => $codigo_afiliado,
            'codigo_golfista' => $codigo_golfista,
            'tipo_usuario_id' => $tipo_usuario
        ]);

        return response()->json([$usuario->save()], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
