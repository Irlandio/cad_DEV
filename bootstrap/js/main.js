/**
 * Passa os dados do cliente para o Modal, e atualiza o link para exclusão
 */
$('#delete-modal').on('show.bs.modal', function (event) {
  
  var button = $(event.relatedTarget);
  var id = button.data('cep');
  var cep1 = button.data('cep1');
  var cep2 = button.data('cep2');
  
  var modal = $(this);
  modal.find('.modal-title').text('Excluir Cadastro de distância #' + id + ' | Ceps: ' + cep1 + ' e ' + cep2);
  modal.find('#confirm').attr('href', 'delete.php?id=' + id);
})