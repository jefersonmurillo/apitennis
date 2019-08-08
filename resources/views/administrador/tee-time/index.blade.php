@extends('administrador.index')

@section('contenido')
    <section class="content">

        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-body">
                        <h3 style="display: inline;">Tee-Time Escenenarios</h3>
                        <button type="button" class="btn bg-olive btn-flat margin" style="float: right;margin-top: 0px; margin-bottom: 0px;" onclick="cargarModalEscenario()">
                            Registrar Escenario
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <!-- Widget: user widget style 1 -->
                <div class="box box-widget widget-user-2">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header bg-green" style="padding: 5px !important;">
                        <a href="#" style="color: white; margin-right: 5px;"><i class="fa fa-remove" style="font-size: 20px;"></i></a>
                        <a href="#" style="color: white; margin-right: 5px;"><i class="fa fa-pencil-square-o" style="font-size: 20px;"></i></a>
                        <a href="#" style="color: white; margin-right: 5px;"><i class="fa fa-tripadvisor" style="font-size: 20px;"></i></a>

                        <!-- /.widget-user-image -->
                        <h3 class="widget-user-username" onclick="alert('click')">Cancha de Golf</h3>
                        <h5 class="widget-user-desc" onclick="alert('click')">Disciplina: Golf</h5>
                    </div>
                    <div class="box-footer no-padding">
                        <ul class="nav nav-stacked">
                            <li><a href="#">Horas programadas esta semana <span class="pull-right badge bg-blue">31</span></a></li>
                            <li><a href="#">Reservaciones Aprobadas <span class="pull-right badge bg-aqua">5</span></a></li>
                            <li><a href="#">Reservaciones Pendientes <span class="pull-right badge bg-green">12</span></a>
                            </li>
                            <li><a href="#">Reservaciones Desaprobadas <span class="pull-right badge bg-red">842</span></a></li>
                        </ul>
                    </div>
                </div>
                <!-- /.widget-user -->
            </div>
        </div>

        <div id="modal">
            <div class="modal fade" id="modalRegistro" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form id="form-registrar-escenario" role="form" enctype="multipart/form-data">
                        <div class="modal-content">
                            <div class="modal-header">
                                <div><h5 class="modal-title" id="exampleModalLabel">Registrar Escenario</h5></div>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Nombre:</label>
                                    <input type="text" class="form-control" id="nombre">
                                    <input type="hidden" class="form-control" id="id">
                                </div>

                                <div class="form-group" id="disciplinas"></div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                <input type="submit" class="btn btn-primary" value="Actualizar">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script src="{{ asset('js/tee-time.js') }}"></script>
@endsection