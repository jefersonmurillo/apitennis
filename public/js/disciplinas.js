$(function () {
    $(document).ready(function () {
        $('#table-disciplinas_wrapper .dataTables_filter').append(' <a href="#" onclick="abrirModal()"><input type="button" value="Registrar Nueva   " class="btn btn-block btn-success"></a>');
    });

    $('#form-actualizar').submit((e) => {
        e.preventDefault();

        let disciplina = $('#nombre_disciplina').val();
        let id = $('#id_disciplina').val();
        let token = $("input:hidden[name='_token']").val();
        let data = {
            '_token': token,
            id: id,
            disciplina: disciplina
        };

        if (disciplina === '') return alert('Datos Invalidos!');
        console.log(data);
        console.log(id);

        if(id !== undefined) console.log('post'); else console.log('put');

        $.ajax({
            type: id === undefined  || id === '' ? 'post' : 'put',
            url: '/disciplinas/' + id,
            data: data,
            success: function (res) {
                console.log(res);
                alert(res.message);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(thrownError, xhr);
            }
        });

        return false;
    })
});

function abrirModal(id, disciplina) {
    if(id !== undefined && disciplina !== undefined){
        $('#nombre_disciplina').val(disciplina);
        $('#id_disciplina').val(id);
    }

    $('#exampleModal').modal().show();
}

function eliminarDisciplina(id) {
    $.ajax({
        type: 'delete',
        url: '/disciplinas/' + id,
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