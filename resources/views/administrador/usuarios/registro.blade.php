@extends('administrador.index')

@section('contenido')
    <section class="content">
        <form id="form-registro-afiliados" role="form" action="afiliados" method="post" enctype="multipart/form-data">
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

    <script src="{{ asset('js/afiliados.js') }}"></script>

    <script>
        $(function () {
            //Datemask dd/mm/yyyy
            $('#datemask').inputmask('dd/mm/yyyy', {
                'placeholder': 'dd/mm/yyyy'
            })
        })
    </script>
@endsection