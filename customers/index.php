<?php
    require_once('functions.php');
    index();
if (session_status() !== PHP_SESSION_ACTIVE) {//Verificar se a sessão não já está aberta.
session_start();}
if(isset ($_SESSION['cepOrig'])) unset($_SESSION['cepOrig']);
if(isset ($_SESSION['cepD'])) unset($_SESSION['cepD']);
?>

<?php include(HEADER_TEMPLATE); ?>

<header>
	<div class="row">
		<div class="col-sm-6">
			<h2>Distâncias de CEPs</h2>
		</div>
		<div class="col-sm-6 text-right h2">
	    	<a class="btn btn-primary" href="add.php"><i class="fa fa-plus"></i> Nova Distância</a>
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
		<th>ID</th>
		<th >Origem</th>
		<th>Destino</th>
		<th>Distância Km</th>
		<th>Criado em</th>
		<th>Modificado em</th>
		<th>Opções</th>
	</tr>
</thead>
<tbody>
<?php if ($ceps) : ?>
<?php foreach ($ceps as $cep) : ?>
	<tr>
		<td><?php echo $cep['id']; ?></td>
		<td><?php echo $cep['cepOrig']; ?></td>
		<td><?php echo $cep['cepDest']; ?></td>
		<td><?php echo number_format($cep['dist'], 2, ',', '.'); ?></td>
		<td><?php echo date("d/m/Y H:i", strtotime( $cep['criado'])); ?></td>
		<td><?php echo date("d/m/Y H:i", strtotime( $cep['modificado'])); ?></td>
		<td class="actions text-right">
			<a href="view.php?id=<?php echo $cep['id']; ?>" class="btn btn-sm btn-success"><i class="fa fa-eye"></i> Visualizar</a>
			<a href="edit.php?id=<?php echo $cep['id']; ?>" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i> Editar</a>
			<a href="#" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete-modal" data-cep="<?php echo $cep['id']; ?>" data-cep1="<?php echo $cep['cepOrig']; ?>" data-cep2="<?php echo $cep['cepDest']; ?>">
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
<?php 
/*
*/
  //  include('modal.php'); 
?>
<!-- Modal de Delete-->
<div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="modalLabel">Excluir Cadastro</h4>
      </div>
      <div class="modal-body">
        Deseja realmente excluir este Cadastro?
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