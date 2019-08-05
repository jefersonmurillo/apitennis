@extends('administrador.index')

@section('css')
    <link rel="stylesheet"
          href="{{ asset('template/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('contenido')
    <section class="content">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Usuarios y afiliados</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="table-afiliados" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Codigo Afiliado</th>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Telefono</th>
                        <th>Correo</th>
                        <th>Tipo</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>


                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Codigo Afiliado</th>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Telefono</th>
                        <th>Correo</th>
                        <th>Tipo</th>
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

    <script src="{{ asset('js/afiliados.js') }}"></script>

    <script>
        $(function () {
            $('#table-afiliados').DataTable();
        });
    </script>
@endsection