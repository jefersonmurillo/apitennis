@extends('administrador.index')

@section('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('template/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('contenido')
    <section class="content">
        <form id="form-registro-afiliados" role="form" action="afiliados" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-warning">
                        <div class="box-header with-border">
                            <h3 class="box-title">Registro de afiliados</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Nombres</label>
                                    <input id="nombres" type="text" name="nombres" class="form-control"
                                           placeholder="Ingrese los nombres...">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Apellidos</label>
                                    <input id="apellidos" type="text" name="apellidos" class="form-control"
                                           placeholder="Ingrese los apellidos ...">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Tipo de documento</label>
                                    <select id="tipo-documento" class="form-control" name="tipo-documento">
                                        <option value="0">Seleccione</option>
                                        @foreach($tiposDocumento as $tipo)
                                            <option value="{{ $tipo['id'] }}">{{ $tipo['tipo'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Documento</label>
                                    <input id="documento" name="documento" type="number" class="form-control"
                                           placeholder="Ingrese el documento de identidad ...">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Correo electronico</label>
                                    <input id="email" name="email" type="email" class="form-control"
                                           placeholder="Ingrese el correo electronico ...">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Fecha de nacimiento</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input id="fecha-nacimiento" name="fecha-nacimiento" type="text"
                                               class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Genero</label>
                                    <select id="genero" name="genero" class="form-control">
                                        <option>Masculino</option>
                                        <option>Femenino</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Teléfono</label>
                                    <input id="telefono" name="telefono" type="number" class="form-control"
                                           placeholder="Ingrese numero de telefono ...">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label>Dirección</label>
                                        <input id="direccion" name="direccion" type="text" class="form-control"
                                               placeholder="Ingrese la dirección ...">
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Tipo de usuario</label>
                                    <select id="tipo-usuario" name="tipo-documento" class="form-control" required>
                                        <option value="0">Seleccione</option>
                                        @foreach($tiposUsuario as $tipo)
                                            <option value="{{ $tipo['id'] }}">{{ $tipo['tipo'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label>Codigo de afiliado</label>
                                        <input id="codigo-afiliado" name="codigo-afiliado" type="text" class="form-control"
                                               placeholder="Ingrese el codigo de afiliado ...">
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label>Categoria de golfista</label>
                                        <select id="categoria-golfista" name="categoria-golfista" class="form-control" required>
                                            <option value="0">Seleccione</option>
                                            @foreach($categoriasGolfista as $categoria)
                                                <option value="{{ $categoria['id'] }}">{{ $categoria['categoria'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label>Codigo de golfista</label>
                                        <input id="codigo-golfista" name="codigo-golfista" type="text" class="form-control"
                                               placeholder="Ingrese el codigo de golfista ...">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-body">
                            <form role="form">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <input type="submit" value="Registrar" class="btn btn-block btn-success">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Data Table With Full Features</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Rendering engine</th>
                        <th>Browser</th>
                        <th>Platform(s)</th>
                        <th>Engine version</th>
                        <th>CSS grade</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Trident</td>
                        <td>Internet
                            Explorer 4.0
                        </td>
                        <td>Win 95+</td>
                        <td> 4</td>
                        <td>X</td>
                    </tr>
                    <tr>
                        <td>Trident</td>
                        <td>Internet
                            Explorer 5.0
                        </td>
                        <td>Win 95+</td>
                        <td>5</td>
                        <td>C</td>
                    </tr>
                    <tr>
                        <td>Trident</td>
                        <td>Internet
                            Explorer 5.5
                        </td>
                        <td>Win 95+</td>
                        <td>5.5</td>
                        <td>A</td>
                    </tr>
                    <tr>
                        <td>Trident</td>
                        <td>Internet
                            Explorer 6
                        </td>
                        <td>Win 98+</td>
                        <td>6</td>
                        <td>A</td>
                    </tr>
                    <tr>
                        <td>Trident</td>
                        <td>Internet Explorer 7</td>
                        <td>Win XP SP2+</td>
                        <td>7</td>
                        <td>A</td>
                    </tr>
                    <tr>
                        <td>Trident</td>
                        <td>AOL browser (AOL desktop)</td>
                        <td>Win XP</td>
                        <td>6</td>
                        <td>A</td>
                    </tr>
                    <tr>
                        <td>Gecko</td>
                        <td>Firefox 1.0</td>
                        <td>Win 98+ / OSX.2+</td>
                        <td>1.7</td>
                        <td>A</td>
                    </tr>
                    <tr>
                        <td>Gecko</td>
                        <td>Firefox 1.5</td>
                        <td>Win 98+ / OSX.2+</td>
                        <td>1.8</td>
                        <td>A</td>
                    </tr>
                    <tr>
                        <td>Gecko</td>
                        <td>Firefox 2.0</td>
                        <td>Win 98+ / OSX.2+</td>
                        <td>1.8</td>
                        <td>A</td>
                    </tr>
                    <tr>
                        <td>Gecko</td>
                        <td>Firefox 3.0</td>
                        <td>Win 2k+ / OSX.3+</td>
                        <td>1.9</td>
                        <td>A</td>
                    </tr>
                    <tr>
                        <td>Gecko</td>
                        <td>Camino 1.0</td>
                        <td>OSX.2+</td>
                        <td>1.8</td>
                        <td>A</td>
                    </tr>
                    <tr>
                        <td>Gecko</td>
                        <td>Camino 1.5</td>
                        <td>OSX.3+</td>
                        <td>1.8</td>
                        <td>A</td>
                    </tr>
                    <tr>
                        <td>Gecko</td>
                        <td>Netscape 7.2</td>
                        <td>Win 95+ / Mac OS 8.6-9.2</td>
                        <td>1.7</td>
                        <td>A</td>
                    </tr>
                    <tr>
                        <td>Gecko</td>
                        <td>Netscape Browser 8</td>
                        <td>Win 98SE+</td>
                        <td>1.7</td>
                        <td>A</td>
                    </tr>
                    <tr>
                        <td>Gecko</td>
                        <td>Netscape Navigator 9</td>
                        <td>Win 98+ / OSX.2+</td>
                        <td>1.8</td>
                        <td>A</td>
                    </tr>
                    <tr>
                        <td>Gecko</td>
                        <td>Mozilla 1.0</td>
                        <td>Win 95+ / OSX.1+</td>
                        <td>1</td>
                        <td>A</td>
                    </tr>
                    <tr>
                        <td>Gecko</td>
                        <td>Mozilla 1.1</td>
                        <td>Win 95+ / OSX.1+</td>
                        <td>1.1</td>
                        <td>A</td>
                    </tr>
                    <tr>
                        <td>Gecko</td>
                        <td>Mozilla 1.2</td>
                        <td>Win 95+ / OSX.1+</td>
                        <td>1.2</td>
                        <td>A</td>
                    </tr>
                    <tr>
                        <td>Gecko</td>
                        <td>Mozilla 1.3</td>
                        <td>Win 95+ / OSX.1+</td>
                        <td>1.3</td>
                        <td>A</td>
                    </tr>
                    <tr>
                        <td>Gecko</td>
                        <td>Mozilla 1.4</td>
                        <td>Win 95+ / OSX.1+</td>
                        <td>1.4</td>
                        <td>A</td>
                    </tr>
                    <tr>
                        <td>Gecko</td>
                        <td>Mozilla 1.5</td>
                        <td>Win 95+ / OSX.1+</td>
                        <td>1.5</td>
                        <td>A</td>
                    </tr>
                    <tr>
                        <td>Gecko</td>
                        <td>Mozilla 1.6</td>
                        <td>Win 95+ / OSX.1+</td>
                        <td>1.6</td>
                        <td>A</td>
                    </tr>
                    <tr>
                        <td>Gecko</td>
                        <td>Mozilla 1.7</td>
                        <td>Win 98+ / OSX.1+</td>
                        <td>1.7</td>
                        <td>A</td>
                    </tr>
                    <tr>
                        <td>Gecko</td>
                        <td>Mozilla 1.8</td>
                        <td>Win 98+ / OSX.1+</td>
                        <td>1.8</td>
                        <td>A</td>
                    </tr>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Rendering engine</th>
                        <th>Browser</th>
                        <th>Platform(s)</th>
                        <th>Engine version</th>
                        <th>CSS grade</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
    </section>
@endsection

@section('js')

    <!-- date-range-picker -->
    <script src="{{ asset('template/bower_components/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('template/bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <!-- InputMask -->
    <script src="{{ asset('template/plugins/input-mask/jquery.inputmask.js') }}"></script>
    <script src="{{ asset('template/plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
    <script src="{{ asset('template/plugins/input-mask/jquery.inputmask.extensions.js') }}"></script>

    <!-- date-range-picker -->
    <script src="{{ asset('template/bower_components/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('template/bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>

    <script src="{{ asset('template/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('template/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>

    <script src="{{ asset('js/afiliados.js') }}"></script>

    <script>
        $(function () {
            $('#example1').DataTable();

            //Datemask dd/mm/yyyy
            $('#datemask').inputmask('dd/mm/yyyy', {
                'placeholder': 'dd/mm/yyyy'
            })
        })
    </script>
@endsection