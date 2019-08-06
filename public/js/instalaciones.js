$(function () {
    $('#form-registro-instalacion').submit(function (e) {
        e.preventDefault();
        alert('para');
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
                let descripcion = $('#description').val();

                if(nombre === '' || tipo === '0' || descripcion === ''){
                    Swal.fire('Error..', 'Datos incorrectos, intentalo nuevamente', 'warning');
                    return false;
                }
            }
        });

        return true;
    });

});