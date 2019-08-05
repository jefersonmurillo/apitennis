@extends('administrador.index')

@section('css')

@endsection

@section('contenido')
    <section class="content">
        <form id="form-registro-afiliados" role="form" enctype="multipart/form-data">
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
                                    <input type="file" id="imagenDesatacada" name="img-destacada" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        {{-- Se usa para cargar las imagenes de las instalaciones --}}
        <div id="imagenesIntalacion"></div>

        <div class="row">
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
        </div>

        {{-- Se usa para mostar la zona de carga de imagenes solo cuando se ha registrado la instalación --}}
        <div id="zoneFilesUlpoad"></div>

        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-body">
                        <p>
                            Haga click y selecione los certificados, cada uno no mayor a 2.5MB de tamaño. Cada
                            archivo debe tener como nombre el documento de indentidad del participante sin comas ni
                            puntos.
                        </p>
                        <form action="../certificacion/upload" method="post" onload="alert('Hola')" class="dropzone"
                              id="dropzone_example">
                            {{ csrf_field() }}
                            <input id="id_evento" type="hidden" name="id">
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

    </section>
@endsection

@section('js')
    <link rel="stylesheet" href="{{ asset('plugins/dropzone/dropzone.css') }}">
    <script src="{{ asset('plugins/dropzone/dropzone.js') }}"></script>
    <script src="{{ asset('js/instalaciones.js') }}"></script>
@endsection