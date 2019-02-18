$('body').on('click', '[data-action="modal-show"]', showModal);

function showModal(e) 
{
    $("#modal").modal('show');
    $("#titleMod").text($(this).data('title'));
    $('#form-delete').attr({action: $(this).data('route'), method:'POST'});
}