<?php
    require_once('functions.php');
    index();
if (session_status() !== PHP_SESSION_ACTIVE) {//Verificar se a sessão não já está aberta.
session_start();}
if(isset ($_SESSION['candidatoOrig'])) unset($_SESSION['candidatoOrig']);
if(isset ($_SESSION['candidatoD'])) unset($_SESSION['candidatoD']);
?>

<?php include(HEADER_TEMPLATE); ?>

<header>
	<div class="row">
		<div class="col-sm-6">
			<h2>Cadastro de candidatos</h2>
		</div>
		<div class="col-sm-6 text-right h2">
	    	<a class="btn btn-primary" href="add.php"><i class="fa fa-plus"></i> Novo Cadastro</a>
	    	<a class="btn btn-default" href="index.php"><i class="fa fa-refresh"></i> Atualizar</a>
	    </div>
	</div>
</header>

<?php if (!empty($_SESSION['message'])) : ?>
	<div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<?php echo $_SESSION['message']; ?>
	</div>
	<?php clear_messages(); /// verificar?>
<?php endif; ?>

<hr>

<table class="table table-hover">
<thead>
	<tr>
		<th> # </th>
		<th style=" width: 15%;">Nome</th>
		<th>idade</th>
		<th>Linkedin</th>
		<th style=" width: 25%;">Aptidões</th>
		<th style=" width: 25%;">Opções</th>
	</tr>
</thead>
<tbody>
<?php if ($candidatos) : ?>
<?php foreach ($candidatos as $candidato) : ?>
	<tr>
		<td><?php echo $candidato['id']; ?></td>
		<td><?php echo $candidato['nome'];  ?></td>
		<td><?php echo $candidato['idade']; ?></td>
		<td><?php echo $candidato['Url_linkedin'];    ?></td>
		<td><?php echo $candidato['tecnologias'];     ?></td>
		<td class="actions text-right">
			<a href="view.php?id=<?php echo $candidato['id']; ?>" class="btn btn-sm btn-success"><i class="fa fa-eye"></i> Visualizar</a>
			<a href="edit.php?id=<?php echo $candidato['id']; ?>" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i> Editar</a>
			<a href="#" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete-modal" data-id="<?php echo $candidato['id']; ?>"  data-nome="<?php echo $candidato['nome']; ?>" >
				<i class="fa fa-trash"></i> Excluir
			</a>
		</td>
	</tr>
<?php endforeach; ?>
<?php else : ?>
	<tr>
		<td colspan="6">Nenhum registro encontrado.</td>
	</tr>
<?php endif; ?>
</tbody>
</table>
<!-- Modal de Delete-->
<div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="modalLabel">Excluir Cadastro</h4>
      </div>
      <div class="modal-body">
        Deseja realmente excluir este Cadastross?
      </div>
      <div class="modal-footer">
        <a id="confirm" class="btn btn-primary" href="#">Sim</a>
        <a id="cancel" class="btn btn-default" data-dismiss="modal">N&atilde;o</a>
      </div>
    </div>
  </div>
</div> <!-- /.modal -->
<?php 
include(FOOTER_TEMPLATE); ?>