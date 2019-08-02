$(function () {
    $(document).ready(function () {
        $('#table-disciplinas_wrapper .dataTables_filter').append(' <a href="/disciplinas/create"><input type="button" value="Registrar Nueva   " class="btn btn-block btn-success"></a>');
    });

    $('#form-actualizar').submit((e) => {
        alert('aaa');
        e.preventDefault();
        let disciplina = $('#disciplina').val();
        let id = $('#id').val();
        let token = $("input:hidden[name='_token']").val();
        let data = {
            '_token': token,
            id: id,
            disciplina: disciplina
        };


        console.log(data);

        if (disciplina === '' || id === '') return alert('Datos Invalidos!');

        $.ajax({
            type: 'put',
            url: '/disciplinas/' + id,
            data: data,
            success: function (res) {
                console.log(res);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(thrownError, xhr);
            }
        });

        return false;
    })
});

function modalActualizarDisciplina(id, disciplina) {
    var html = '<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">\n' +
        '  <div class="modal-dialog" role="document">\n' +
        '        <form id="form-actualizar" role="form" enctype="multipart/form-data">\n' +
        '    <div class="modal-content">\n' +
        '      <div class="modal-header">\n' +
        '        <h5 class="modal-title" id="exampleModalLabel">Actualizar Disciplina</h5>\n' +
        '        <button type="button" class="close" data-dismiss="modal" aria-label="Close">\n' +
        '          <span aria-hidden="true">&times;</span>\n' +
        '        </button>\n' +
        '      </div>\n' +
        '      <div class="modal-body" >\n' +
        '          <div class="form-group">\n' +
        '            <label for="recipient-name" class="col-form-label">Disciplina:</label>\n' +
        '            <input type="text" class="form-control" id="disciplina" value="' + disciplina + '">\n' +
        '            <input type="hidden" class="form-control" id="id" value="' + id + '">\n' +
        '          </div>\n' +
        '      </div>\n' +
        '      <div class="modal-footer">\n' +
        '        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>\n' +
        '        <input type="submit" class="btn btn-primary" value="Actualizar">\n' +
        '      </div>\n' +
        '    </div>\n' +
        '        </form>\n' +
        '  </div>\n' +
        '</div>';

    $('#modal').empty().append(html);
    $('#exampleModal').modal().show();
}

