$(function () {

    $(document).ready(function () {

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