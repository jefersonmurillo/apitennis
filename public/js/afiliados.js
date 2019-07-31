/**
 * Validaciones para el registro de afiliados
 */

$(function () {

    $(document).ready(function () {
        $('#table-afiliados_wrapper .dataTables_filter').append(' <a href="/afiliados/create"><input type="button" value="Registrar Nuevo" class="btn btn-block btn-success"></a>');
    });


    $('#form-registro-afiliados').submit(function (e) {
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

        console.log($('input:hidden[name=_token]').val());

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
            direccion: direccion
        };

        $.ajax({
            type: 'post',
            url: 'afiliados',
            data: data,
            success: function (res) {
                console.log(res);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr);
            }
        });


        return false;
    });
});
