$(function () {

    $(document).ready(function () {
        $('#table-dias').DataTable();
        $('#modalDias').modal().show();
        cargarEscenarios();
    });

    $('#form-registrar-escenario').submit((e) => {
        e.preventDefault();

        Swal.fire({
            title: 'Seguro que desea guardar esta información?',
            text: 'Se guardarán datos del escenario',
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Si, guardar!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.value) {
                let disciplina = $('#disciplina').val();
                let nombre = $('#nombre').val();
                let id = $('#id').val();

                let token = $("input:hidden[name='_token']").val();
                let data = {};

                if (id !== '') {
                    data = {
                        '_token': token,
                        id: id,
                        disciplina: disciplina,
                        nombre: nombre
                    }
                } else {
                    data = {
                        '_token': token,
                        disciplina: disciplina,
                        nombre: nombre
                    }
                }

                if (disciplina === '0') {
                    Swal.fire('Error..', 'Datos incorrectos', 'error');
                    return false;
                }

                if (id !== undefined) console.log('post'); else console.log('put');

                $.ajax({
                    type: 'post',
                    url: '/tee-time/registrarEscenario',
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
    })

});

function cargarModalEscenario(registrar = true, id = undefined, nombre = undefined, disciplina_id = undefined) {
    let disciplinas = [];
    $.ajax({
        type: 'get',
        url: 'http://localhost:8000/api/v1/disciplinas',
        success: function (res) {
            console.log(res)
            disciplinas = res.data;
            let html = '' +
                '    <label>Disciplina</label>\n' +
                '    <select id="disciplina" class="form-control" name="disciplina" required>\n' +
                '        <option value="0">Seleccione</option>\n';

            for (let i = 0; i < disciplinas.length; i++) {
                if (!registrar && disciplina_id === disciplinas[i].id)
                    html += '<option value="' + disciplinas[i].id + '" selected>' + disciplinas[i].nombre + '</option>';
                else html += '<option value="' + disciplinas[i].id + '">' + disciplinas[i].nombre + '</option>';
            }

            html += '' +
                '    </select>\n';

            if (!registrar) {
                $('#id').val(id);
                $('#nombre').val(nombre);
            }

            $('#disciplinas').empty().append(html);
            $('#modalRegistro').modal().show();

        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(xhr);
        }
    });
}

function cargarEscenarios(){
    let html = '';
    $.ajax({
        type: 'get',
        url: '/tee-time/escenarios',
        success: function (res) {
            console.log(res);
            for (let i = 0; i < res.length; i++) {
                html += '' +
                    '<div class="col-md-4">\n' +
                    '    <div class="box box-widget widget-user-2">\n' +
                    '        <!-- Add the bg color to the header using any of the bg-* classes -->\n' +
                    '        <div class="widget-user-header bg-green" style="padding: 5px !important;">\n' +
                    '            <a href="#" style="color: white; margin-right: 5px;"><i class="fa fa-remove" style="font-size: 20px;"></i></a>\n' +
                    '            <a href="#" style="color: white; margin-right: 5px;"><i class="fa fa-pencil-square-o" style="font-size: 20px;"></i></a>\n' +
                    '            <a href="#" onclick="cargarTabla('+res[i].programador+')" style="color: white; margin-right: 5px;"><i class="fa fa-tripadvisor" style="font-size: 20px;"></i></a>\n' +
                    '\n' +
                    '            <a href="" style="text-decoration: none; color: white"><h3 class="widget-user-username" onclick="">'+res[i].nombre+'</h3></a>\n' +
                    '            <a href="" style="text-decoration: none; color: white"><h5 class="widget-user-desc" onclick="">Disciplina: '+res[i].disciplina.nombre+'</h5></a>\n' +
                    '        </div>\n' +
                    '        <div class="box-footer no-padding">\n' +
                    '            <ul class="nav nav-stacked">\n' +
                    '                <li><a href="#" onclick="cargarTabla('+res[i].disponibles+')">Reservaciones Disponibles <span class="pull-right badge bg-green">'+res[i].disponibles.length+'</span></a></li>\n' +
                    '                <li><a href="#" onclick="cargarTabla('+res[i].aprobados+')">Reservaciones Aprobadas <span class="pull-right badge bg-aqua">'+res[i].aprobados.length+'</span></a></li>\n' +
                    '                <li><a href="#" onclick="cargarTabla('+res[i].desaprobados+')">Reservaciones Desaprobadas <span class="pull-right badge bg-red">'+res[i].desaprobados.length+'</span></a></li>\n' +
                    '                <li><a href="#" onclick="cargarTabla('+res[i].pendientes+')">Reservaciones Pendientes <span class="pull-right badge bg-yellow">'+res[i].pendientes.length+'</span></a>\n' +
                    '                </li>\n' +
                    '            </ul>\n' +
                    '        </div>\n' +
                    '    </div>\n' +
                    '</div>';
            }

            $('#escenarios').empty().append(html);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(xhr);
        }
    });

}

function cargarTabla(dias){
    console.log(dias);

}