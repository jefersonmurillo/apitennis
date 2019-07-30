/**
 * Validaciones para el registro de usuarios
 */

$(function () {
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

        let data = {
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

        /*$.ajax({
            type: 'POST',
            url: 'afiliados/create',
            data: data,
            success: function(data){
                console.log(data);
            },
        });*/

        $.ajax({
            url: "http://32e6b5bf.ngrok.io/api/v1/tipoUsuario",
            method: 'get',
            contentType: 'application/json',
            headers: {
                "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3Q6ODAwMFwvYXBpXC9hdXRoXC9sb2dpbiIsImlhdCI6MTU2NDUxMDQ2MSwiZXhwIjoxNTY0NTE0MDYxLCJuYmYiOjE1NjQ1MTA0NjEsImp0aSI6IkY2bDNvUUIyd3pWWEdDTXciLCJzdWIiOjEsInBydiI6Ijg3ZTBhZjFlZjlmZDE1ODEyZmRlYzk3MTUzYTE0ZTBiMDQ3NTQ2YWEifQ.5pdXrY3jVWi45lZPSwfevqG5WFeb7aj0SD9ExXYCY74"
            },
            success: function (result) {
                console.log(result)
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr)
            }
        });

        return false;
    });
});
