/**
 * Validaciones para el registro de afiliados
 */

let user = undefined;
try {
    user = afiliado;
} catch (e) {
    user = undefined;
}

$(function () {

    $(document).ready(function () {
        $('#table-afiliados_wrapper .dataTables_filter').append(' <a href="/afiliados/create"><input type="button" value="Registrar Nuevo" class="btn btn-block btn-success"></a>');
        cargarDatosGolfista();
    });


    $('#form-registro-afiliados').submit(function (e) {
        e.preventDefault();
        let nombres = $('#nombres').val();
        let apellidos = $('#apellidos').val();
        let tipo_documento = $('#tipo-documento').val();
        let documento = $('#documento').val();
        let email = $('#email').val();
        let fecha_nacimiento = $('#fecha-nacimiento').val();
        let genero = $('#genero').val();
        let telefono = $('#telefono').val();
        let tipo_usuario = $('#tipo-usuario').val();
        let codigo_afiliado = $('#codigo-afiliado').val();
        let categoria_golfista = $('#categoria-golfista').val();
        let codigo_golfista = $('#codigo-golfista').val();
        let direccion = $('#direccion').val();

        if (nombres.length < 1 || apellidos.length < 1 || parseInt(tipo_documento) === 0 || documento.length < 1 ||
            email.length < 1 || fecha_nacimiento.length < 1 || parseInt(genero) === 0 ||
            telefono.length < 1 || parseInt(tipo_usuario) === 0) {

        }

        let data = {
            '_token': $("input:hidden[name='_token']").val(),
            nombres: nombres,
            apellidos: apellidos,
            tipo_documento: tipo_documento,
            documento: documento,
            email: email,
            fecha_nacimiento: fecha_nacimiento,
            genero: genero,
            telefono: telefono,
            tipo_usuario: tipo_usuario,
            codigo_afiliado: codigo_afiliado,
            categoria_golfista: categoria_golfista,
            codigo_golfista: codigo_golfista,
            direccion: direccion,
            id: user !== undefined ? user['id'] : null
        };

        let url = user === undefined ? '/afiliados' : '/afiliados/' + user['id'];
        let method = user === undefined ? 'post' : 'put';

        console.log(url);
        console.log(method);
        console.log(data);
        $.ajax({
            type: method,
            url: url,
            data: data,
            success: function (res) {
                console.log(res);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(thrownError, xhr);
            }
        });

        return false;
    });

    $('#tipo-usuario').change(() => {
        cargarDatosGolfista();
    });
});

function cargarDatosGolfista() {
    if (parseInt($('#tipo-usuario').val()) === 3) {
        let html = '<select id="categoria-golfista" name="categoria-golfista" class="form-control" required>\n' +
            '                <option value="0">Seleccione</option>';

        for (let i = 0; i < categoriasGolfista.length; i++) {
            if (user !== undefined && user['categoria_golfista_id'] === categoriasGolfista[i]['id'])
                html += '<option value="' + categoriasGolfista[i]['id'] + '" selected>' + categoriasGolfista[i]['categoria'] + '</option>';
            else html += '<option value="' + categoriasGolfista[i]['id'] + '">' + categoriasGolfista[i]['categoria'] + '</option>';
        }

        html += '</select>';

        $('#campos-golfista')
            .empty()
            .append('' +
                '<div class="col-sm-6">\n' +
                '    <div class="form-group">\n' +
                '        <div class="form-group">\n' +
                '            <label>Codigo de afiliado</label>\n' +
                '            <input id="codigo-afiliado" name="codigo-afiliado" type="text" class="form-control"\n' +
                '                   placeholder="Ingrese el codigo de afiliado ..." value="' + (user !== undefined ? user['codigo_afiliado'] : '') + '" required>\n' +
                '        </div>\n' +
                '    </div>\n' +
                '</div>\n' +
                '<div class="col-sm-6">\n' +
                '    <div class="form-group">\n' +
                '        <div class="form-group">\n' +
                '            <label>Categoria de golfista</label>\n' +
                html +
                '        </div>\n' +
                '    </div>\n' +
                '</div>\n' +
                '\n' +
                '<div class="col-sm-6">\n' +
                '    <div class="form-group">\n' +
                '        <div class="form-group">\n' +
                '            <label>Codigo de golfista</label>\n' +
                '            <input id="codigo-golfista" name="codigo-golfista" type="text" class="form-control"\n' +
                '                   placeholder="Ingrese el codigo de golfista ..." value="' + (user !== undefined ? user['codigo_golfista'] : '') + '" required>\n' +
                '        </div>\n' +
                '    </div>\n' +
                '</div>'
            );
    } else if (parseInt($('#tipo-usuario').val()) === 1) {
        $('#campos-golfista').empty()
            .append('<div class="col-sm-6">\n' +
                '    <div class="form-group">\n' +
                '        <div class="form-group">\n' +
                '            <label>Codigo de afiliado</label>\n' +
                '            <input id="codigo-afiliado" name="codigo-afiliado" type="text" class="form-control"\n' +
                '                   placeholder="Ingrese el codigo de afiliado ..." value="' + (user !== undefined ? user['codigo_afiliado'] : '') + '" required>\n' +
                '        </div>\n' +
                '    </div>\n' +
                '</div>\n'
            );
    } else $('#campos-golfista').empty();

    if (user !== undefined) {
        $('#campos-golfista').append('<input type="hidden" id="id" name="id" value="' + user['id'] + '">');
    }
}

function eliminarAfiliado(id) {
    $.ajax({
        type: 'delete',
        url: '/afiliados/' + id,
        data: {'_token': $("input:hidden[name='_token']").val()},
        success: function (res) {
            console.log(res);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError, xhr);
        }
    });
    return false;
}