@extends('administrador.index')

@section('css')

@endsection

@section('contenido')
    <section class="content">
        <form id="form-registro-instalacion" role="form" enctype="multipart/form-data" method="post" action="{{ route('instalaciones.store') }}">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-warning">
                        <div class="box-header with-border">
                            <h3 class="box-title">{{ isset($instalacion) ? $instalacion['nombre']: 'Registro de instalación' }}</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body" id="box-body">

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Nombres</label>
                                    <input id="nombre" type="text" name="nombre" class="form-control"
                                           placeholder="Ingrese el nombre de la instalación..."
                                           value="{{ isset($instalacion) ? $instalacion['nombres'] : '' }}" required>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Tipo de instalación</label>
                                    <select id="tipo-instalacion" class="form-control" name="tipo-instalacion" required>
                                        <option value="0">Seleccione</option>
                                        @foreach($tiposInstalacion as $tipo)
                                            @if(isset($instalacion) and $tipo['id'] == $instalacion['tipo_instalacion_id'])
                                                <option value="{{ $tipo['id'] }}" selected>{{ $tipo['tipo'] }}</option>
                                            @else
                                                <option value="{{ $tipo['id'] }}">{{ $tipo['tipo'] }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Descripciónes</label>
                                    <textarea class="form-control" rows="3"
                                              placeholder="Ingrese una breve descripción de la instalación ..."></textarea>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="exampleInputFile">Imagen destacada</label>
                                    <input accept="image/*" onchange="loadFile(event)" type="file" id="imagenDesatacada"
                                           name="img-destacada" required>

                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <a class="btn btn-app" style="padding-top: 1px; padding-bottom: 1px; height: 37px;" onclick="$('#modalPreview').modal().show();">
                                        <i class="fa fa-play"></i> Vista Previa
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        {{--<div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-body">
                        <div class="col-sm-4">
                            <div class="alert alert-info alert-dismissible"
                                 style="background-color: #ecf0f561 !important;
                                        border-color: #ffffff00;
                                        border-radius: 0px;
                                        color: #31708f00 !important;">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"
                                        style="color: #000;
                                        opacity: .6;
                                        font-size: 30px;">×
                                </button>
                                <img src="http://localhost:8000/storage/1.jpg" alt=""
                                     style="width: 100%; height: 100%;">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="alert alert-info alert-dismissible"
                                 style="background-color: #ecf0f561 !important;
                                        border-color: #ffffff00;
                                        border-radius: 0px;
                                        color: #31708f00 !important;">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"
                                        style="color: #000;
                                        opacity: .6;
                                        font-size: 30px;">×
                                </button>
                                <img src="http://localhost:8000/storage/1.jpg" alt=""
                                     style="width: 100%; height: 100%;">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="alert alert-info alert-dismissible"
                                 style="background-color: #ecf0f561 !important;
                                        border-color: #ffffff00;
                                        border-radius: 0px;
                                        color: #31708f00 !important;">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"
                                        style="color: #000;
                                        opacity: .6;
                                        font-size: 30px;">×
                                </button>
                                <img src="http://localhost:8000/storage/1.jpg" alt=""
                                     style="width: 100%; height: 100%;">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="alert alert-info alert-dismissible"
                                 style="background-color: #ecf0f561 !important;
                                        border-color: #ffffff00;
                                        border-radius: 0px;
                                        color: #31708f00 !important;">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"
                                        style="color: #000;
                                        opacity: .6;
                                        font-size: 30px;">×
                                </button>
                                <img src="http://localhost:8000/storage/1.jpg" alt=""
                                     style="width: 100%; height: 100%;">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="alert alert-info alert-dismissible"
                                 style="background-color: #ecf0f561 !important;
                                        border-color: #ffffff00;
                                        border-radius: 0px;
                                        color: #31708f00 !important;">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"
                                        style="color: #000;
                                        opacity: .6;
                                        font-size: 30px;">×
                                </button>
                                <img src="http://localhost:8000/storage/1.jpg" alt=""
                                     style="width: 100%; height: 100%;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>--}}

        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-body">
                        <form role="form">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <input type="submit"
                                               value="{{ isset($afiliado) ? 'Actualizar' : 'Registrar'}}"
                                               class="btn btn-block btn-success">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- Modal preview imagen principal --}}
        <div class="modal fade" id="modalPreview" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Imagen destacada</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="box">
                                    <div class="box-body">
                                        <img id="output" src="" alt="" width="100%" height="100%">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        {{-- Modal FileUpload --}}
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Actualizar Disciplina</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="box">
                                    <div class="box-body">
                                        <p>
                                            Haga click y selecione las imagenes de las instalaciones, cada uno no mayor
                                            a 2.5MB de
                                            tamaño.
                                        </p>
                                        <form action="../certificacion/upload" method="post" class="dropzone"
                                              id="dropzone_example">
                                            {{ csrf_field() }}
                                            <input id="id_instalacion" type="hidden" name="id_instalación">
                                            <div class="fallback">
                                                <input accept=".pdf" name="file" type="file" multiple/>
                                            </div>
                                        </form>

                                        <div id="dze_info" class="hidden">
                                            <br/>
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <div class="panel-title">Información de carga de archivos</div>
                                                </div>

                                                <table class="table table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th width="40%">Nombres</th>
                                                        <th width="15%">Tamaño</th>
                                                        <th width="15%">Tipo</th>
                                                        <th>Estado</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <td colspan="4"></td>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                        <br/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <input type="submit" class="btn btn-primary" value="Actualizar">
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <link rel="stylesheet" href="{{ asset('plugins/dropzone/dropzone.css') }}">
    <script src="{{ asset('plugins/dropzone/dropzone.js') }}"></script>
    <script>
        function loadFile(event) {
            $('#output').attr('src', URL.createObjectURL(event.target.files[0]));
            $('#modalPreview').modal().show();
        }
    </script>
    <script src="{{ asset('js/instalaciones.js') }}"></script>
@endsection