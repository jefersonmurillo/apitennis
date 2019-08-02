@extends('administrador.index')

@section('css')
    <link rel="stylesheet"
          href="{{ asset('template/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('contenido')
    <section class="content">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Disciplinas</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="table-disciplinas" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Disciplina</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($disciplinas as $disciplina)
                        <tr>
                            <th>{{$disciplina['nombre']}}</th>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-warning">Opciones</button>
                                    <button type="button" class="btn btn-warning dropdown-toggle"
                                            data-toggle="dropdown">
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="{{ env('APP_URL') }}/disciplinas/{{ $disciplina['id'] }}">Ver
                                                datos</a></li>
                                        <li class="divider"></li>
                                        <li><a href="#" onclick="eliminarAfiliado('{{$disciplina['id']}}')">Eliminar</a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Disciplina</th>
                        <th>Acciones</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
    </section>
@endsection

@section('js')
    <script src="{{ asset('template/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('template/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>

    <script src="{{ asset('js/disciplinas.js') }}"></script>

    <script>
        $(function () {
            $('#table-disciplinas').DataTable();
        });
    </script>
@endsection