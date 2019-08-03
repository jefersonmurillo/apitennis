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
                                    <label>Disciplina</label>
                                    <select id="disciplina" class="form-control" name="disciplina" required>
                                        <option value="0">Seleccione</option>
                                        @foreach($disciplinas as $disciplina)
                                            @if(isset($instalacion) and $disciplina['id'] == $instalacion['tipo_instalacion_id'])
                                                <option value="{{ $disciplina['id'] }}"
                                                        selected>{{ $disciplina['nombre'] }}</option>
                                            @else
                                                <option value="{{ $disciplina['id'] }}">{{ $disciplina['nombre'] }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Descripciónes</label>
                                    <textarea class="form-control" rows="3" placeholder="Ingrese una breve descripción de la instalación ..."></textarea>
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
        </form>
    </section>
@endsection

@section('js')

@endsection