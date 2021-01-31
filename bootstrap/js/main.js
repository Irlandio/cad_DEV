/**
 * Passa os dados do cliente para o Modal, e atualiza o link para exclusão
 */
$('#delete-modal').on('show.bs.modal', function (event) {
  
  var button = $(event.relatedTarget);
  var id = button.data('id');
  var cadN = button.data('nome');
  
  var modal = $(this);
  modal.find('.modal-title').text('Excluir Cadastro #' + id + ' | #: ' + cadN );
  modal.find('#confirm').attr('href', 'delete.php?id=' + id);
})
$('#filtrar-modal').on('show.bs.modal', function (event) {
  
  var button = $(event.relatedTarget);
  var id = button.data('id');
  var cadN = button.data('nome');
  
  var modal = $(this);
  modal.find('.modal-title').text('Filtrar os Cadastros #' + id + ' | #: ' + cadN );
})