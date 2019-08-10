$(function () {
    $(document).ready(function () {
        cargarTablaDiasEscenario();
        $('#table-reservaciones').DataTable({
            "scrollY": 370,
            "columns": [
                { "width": "15%" },
                { "width": "10%" },
                { "width": "10%" },
                { "width": "60%" },
                { "width": "5%" },
            ],
        });
    });
});

function cargarTablaDiasEscenario() {
    let id = $('#id-escenario').val();
    $.ajax({
        type: 'get',
        url: '/tee-time/fechasProgramadasEscenario/' + id,
        success: function (res) {
            console.log(res, id);

            $('#body-table-fechas').empty().append('<center>' +
                '<table id="table-fechas" class="table table-bordered table-striped">\n' +
                '    <thead>\n' +
                '    <tr>\n' +
                '        <th>Fecha</th>\n' +
                '        <th>Acciones</th>\n' +
                '    </tr>\n' +
                '    </thead>\n' +
                '    <tbody id="table-fechas-rows" style="font-size: 12px;">\n' +
                '\n' +
                '    </tbody>\n' +
                '</table>' +
                '</center>');

            let t = $('#table-fechas').DataTable({
                "destroy": true,
                "lengthMenu": [[5, 10, 15, -1], [5, 10, 15, "Todos"]],
                language: {
                    "decimal": "",
                    "emptyTable": "No hay información",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                    "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                    "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "Mostrar _MENU_ ",
                    "loadingRecords": "Cargando...",
                    "processing": "Procesando...",
                    "search": "Buscar:",
                    "zeroRecords": "Sin resultados encontrados",
                    "paginate": {
                        "first": "Primero",
                        "last": "Ultimo",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                },
                "scrollY": 370,
            }).clear().draw();

            for (let i = 0; i < res.length; i++) {
                t.row.add([
                    res[i].fecha,
                    '<div class="btn-group">\n' +
                    '  <button type="button" class="btn btn-default">Opciones</button>\n' +
                    '  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">\n' +
                    '    <span class="caret"></span>\n' +
                    '    <span class="sr-only">Toggle Dropdown</span>\n' +
                    '  </button>\n' +
                    '  <ul class="dropdown-menu" role="menu" style="min-width: 0px;">\n' +
                    '    <li><a href="#" onclick="cargarTablaReservaciones(\'' + id + '\', \'' + res[i].fecha + '\')">Ver</a></li>\n' +
                    '    <li class="divider"></li>\n' +
                    '    <li><a href="#">Eliminar</a></li>\n' +
                    '  </ul>\n' +
                    '</div>'
                ]).draw();
            }

            $('#table-fechas_filter label').remove();
            $('#table-fechas_filter').append(' <a href="#" onclick="abrirModal()"><input type="button" value="Registrar Nueva   " class="btn btn-block btn-success"></a>');

        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(xhr);
        }
    });
}

function cargarTablaReservaciones(id, fecha) {
    $.ajax({
        type: 'get',
        url: '/tee-time/reservacionesEscenarioFecha/' + id + '/' + fecha,
        success: function (res) {
            console.log(res, id);

            $('#body-table-reservaciones').empty().append('' +
                '<table id="table-reservaciones" class="table table-bordered table-striped">\n' +
                '    <thead>\n' +
                '    <tr>\n' +
                '        <th>Fecha</th>\n' +
                '        <th>Hora</th>\n' +
                '        <th>Estado</th>\n' +
                '        <th>Jugadores</th>\n' +
                '        <th>Acciones</th>\n' +
                '    </tr>\n' +
                '    </thead>\n' +
                '    <tbody>\n' +
                '\n' +
                '    </tbody>\n' +
                '</table>');

            let t = $('#table-reservaciones').DataTable({
                "destroy": true,
                "lengthMenu": [[5, 10, 15, -1], [5, 10, 15, "Todos"]],
                language: {
                    "decimal": "",
                    "emptyTable": "No hay información",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                    "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                    "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "Mostrar _MENU_ ",
                    "loadingRecords": "Cargando...",
                    "processing": "Procesando...",
                    "search": "Buscar:",
                    "zeroRecords": "Sin resultados encontrados",
                    "paginate": {
                        "first": "Primero",
                        "last": "Ultimo",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                },
                "scrollY": 370,
                "columns": [
                    { "width": "15%" },
                    { "width": "10%" },
                    { "width": "10%" },
                    { "width": "60%" },
                    { "width": "5%" },
                ],
            }).clear().draw();

            for (let i = 0; i < res.length; i++) {
                let estado = '';
                if (res[i].estado === 'DISPONIBLE')
                    estado = '<span class="badge bg-red;" style="background-color: #00a65a !important">DISPONIBLE</span>';
                else if (res[i].estado === 'APROBADO')
                    estado = '<span class="badge bg-red;" style="background-color: #00c0ef !important;">DISPONIBLE</span>';
                else if (res[i].estado === 'DESAPROBADO')
                    estado = '<span class="badge bg-red;" style="background-color: #dd4b39 !important;">DISPONIBLE</span>';
                else if (res[i].estado === 'RESERVADO')
                    estado = '<span class="badge bg-red;" style="background-color: #f39c12 !important;">DISPONIBLE</span>';

                let grupo = '';

                if (res[i].grupo_jugadores_golf !== null) {
                    grupo += res[i].grupo_jugadores_golf.jugador1.nombres + ' ' + res[i].grupo_jugadores_golf.jugador1.apellidos + ' - ';
                    grupo += res[i].grupo_jugadores_golf.jugador2.nombres + ' ' + res[i].grupo_jugadores_golf.jugador2.apellidos + ' - ';
                    if (res[i].grupo_jugadores_golf.jugador4 !== null) {
                        grupo += res[i].grupo_jugadores_golf.jugador3.nombres + ' ' + res[i].grupo_jugadores_golf.jugador3.apellidos + ' - ';
                        grupo += res[i].grupo_jugadores_golf.jugador4.nombres + ' ' + res[i].grupo_jugadores_golf.jugador4.apellidos + ' ';
                    } else {
                        grupo += res[i].grupo_jugadores_golf.jugador3.nombres + ' ' + res[i].grupo_jugadores_golf.jugador3.apellidos + '  ';
                    }
                }

                t.row.add([
                    res[i].fecha,
                    res[i].hora,
                    estado,
                    grupo,
                    '<div class="btn-group">\n' +
                    '  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">\n' +
                    '    <span class="caret"></span>\n' +
                    '    <span class="sr-only">Toggle Dropdown</span>\n' +
                    '  </button>\n' +
                    '  <ul class="dropdown-menu" role="menu" style="min-width: 0px;">\n' +
                    '    <li><a href="#">Aprobar</a></li>\n' +
                    '    <li class="divider"></li>\n' +
                    '    <li><a href="#">Desaprobar</a></li>\n' +
                    '  </ul>\n' +
                    '</div>'
                ]).draw();
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(xhr);
        }
    });
}

function registrarProgramacion(){
    Swal.fire({
        title: 'Seguro que desea guardar esta información?',
        text: 'Se guardarán datos del escenario',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Si, guardar!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.value) {

            let fecha = $('#fecha_programacion').val();
            let hora = $('#hora_programacion').val();
            let escenario = $('#id-escenario').val();

            if(fecha === '' || hora === '' || escenario === '' || escenario === undefined){
                Swal.fire('Error..', 'Datos incorrectos, intentalo nuevamente', 'warning');
                return false;
            }

            let data = {
                '_token': $("input:hidden[name='_token']").val(),
                id: escenario,
                fecha: fecha,
                hora: hora
            };

            $.ajax({
                type: 'post',
                url: '/tee-time/registrarProgramacionEscenario',
                data: data,
                success: function (res) {
                    console.log(res);
                    Swal.fire(
                        'Operación Exitosa!',
                        'Inforamación guardada.',
                        'success'
                    );

                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(thrownError, xhr);
                    Swal.fire('Error..', 'Algo salío mal, intentalo nuevamente', 'error');
                }
            });
        }

    });

    return false;
}

function abrirModal() {
    $('#exampleModal').modal().show();
}