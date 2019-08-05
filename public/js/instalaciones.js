$(function () {
    $('#form-registro-afiliados').submit(function (e) {
        e.preventDefault();
        alert('para');
        Swal.fire({
            title: 'Seguro que desea guardar esta información?',
            text: 'Se guardarán datos personales del usaurio',
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Si, guardar!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.value) {

                let nombre = $('#nombre').val();
                let tipo = $('#tipo-instalacion').val();
                let disciplina = null;

                if(nombre === '' || tipo === '0'){
                    Swal.fire('Error..', 'Datos incorrectos, intentalo nuevamente', 'warning');
                    return false;
                }

                if(tipo === '3') disciplina = $('#disciplina');

                Swal.fire(
                    'Operación Exitosa!',
                    'Inforamación guardada.',
                    'success'
                );
            }
        });

        return false;
    });

    /*$('#tipo-instalacion').change(() => {
        if ($('#tipo-instalacion').val() === '3') {
            let selects = '';

            for (let i = 0; i < disciplinas.length; i++) {
                selects += '<option value="' + disciplinas[i]['id'] + '">' + disciplinas[i]['nombre'] + '</option>';
            }
            console.log(selects);
            let html = '' +
                '<div class="col-sm-6">\n' +
                '    <div class="form-group">\n' +
                '        <label>Disciplina</label>\n' +
                '        <select id="disciplina" class="form-control" name="disciplina" required>\n' +
                '            <option value="0">Seleccione</option>\n' +
                selects +
                '        </select>\n' +
                '    </div>\n' +
                '</div>'

            $('#deporte').empty().append(html);
        } else $('#deporte').empty();
    });*/
});