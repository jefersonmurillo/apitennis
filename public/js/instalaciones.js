let instalacion = undefined;
try {
    instalacion = insta;
} catch (e) {
    instalacion = undefined;
}

$(function () {
    $('#form-registro-instalacion').submit(function (e) {
        e.preventDefault();

        Swal.fire({
            title: 'Seguro que desea guardar esta información?',
            text: 'Se guardará la información de la instalación',
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Si, guardar!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.value) {

                let nombre = $('#nombre').val();
                let tipo = $('#tipo-instalacion').val();
                let descripcion = $('#descripcion').val();
                let imagenDestacada = $('#imgdestacada').val();

                if (nombre === '' || tipo === '0' || descripcion === '' || imagenDestacada === '') {
                    Swal.fire('Error..', 'Datos incorrectos, intentalo nuevamente', 'warning');
                    return false;
                }

                let data = {
                    '_token': $("input:hidden[name='_token']").val(),
                    'nombre': nombre,
                    'tipo': tipo,
                    'descripcion': descripcion,
                    'imgDestacada': imagenDestacada
                };

                let url = instalacion === undefined ? '/instalaciones' : '/instalaciones/' + instalacion['id'];
                let method = instalacion === undefined ? 'post' : 'put';

                console.log(url, method);

                $.ajax({
                    type: instalacion === undefined ? '/instalaciones' : '/instalaciones/' + instalacion['id'],
                    url: instalacion === undefined ? 'post' : 'put',
                    data: data,
                    success: function (res) {
                        $('#alerta').empty().append('' +
                            '<div class="alert alert-success alert-dismissible">\n' +
                            '    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>\n' +
                            '    <h4><i class="icon fa fa-check"></i> Operación Exitosa!, información guardada</h4>\n' +
                            '</div>');

                        Swal.fire(
                            'Operación Exitosa!',
                            'Inforamación guardada.',
                            'success'
                        );

                        if (instalacion === undefined) limpiarFormulario();
                        console.log(res);
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        console.log(xhr);
                        $('#alerta').empty().append('' +
                            '<div class="alert alert-danger alert-dismissible">\n' +
                            '    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>\n' +
                            '    <h4><i class="icon fa fa-ban"></i> Error... Algo salío mal, intentalo nuevamente</h4>\n' +
                            '    Danger alert preview. This alert is dismissable. A wonderful serenity has taken possession of my entire\n' +
                            '    soul, like these sweet mornings of spring which I enjoy with my whole heart.\n' +
                            '</div>');
                        Swal.fire('Error..', 'Algo salío mal, intentalo nuevamente', 'error');
                    }
                });
            }
        });

        return false;
    });

    $('#imagenDesatacada').change((event) => {
        var file = event.target.files[0];
        var reader = new FileReader();

        if (file) {
            reader.readAsDataURL(file);
        }

        setTimeout(function () {
            $('#output').attr('src', URL.createObjectURL(event.target.files[0]));
            $('#imgdestacada').val(reader.result);
            $('#modalPreview').modal().show();
        }, 100);
    })

});

function limpiarFormulario() {
    $('#nombre').val('');
    $('#tipo-instalacion').val('');
    $('#descripcion').val('');
    $('#imgdestacada').val('');
}