<?php 
	require_once('functions.php'); 
	view($_GET['id']);
?>

<?php include(HEADER_TEMPLATE); ?>

<h2>Cliente <?php echo $cep['id']; ?></h2>
<hr>

<?php if (!empty($_SESSION['message'])) : ?>
	<div class="alert alert-<?php echo $_SESSION['type']; ?>"><?php echo $_SESSION['message']; ?></div>
<?php endif; ?>

<dl class="dl-horizontal">
	<dt>CEP Origem:</dt>
	<dd><?php echo $cep['cepOrig']; ?></dd>

	<dt>Endereço:</dt>
	<dd><?php echo $cep['endOrig']; ?></dd>
	
</dl>

<dl class="dl-horizontal">
	
	<dt>CEP Destino:</dt>
	<dd><?php echo $cep['cepDest']; ?></dd>

	<dt>Endereço:</dt>
	<dd><?php echo $cep['endDest']; ?></dd>
	
</dl>

<dl class="dl-horizontal">
	<dt>Distância Km:</dt>
	<dd><?php echo $cep['dist']; ?></dd>

	<dt>Data de cadastro:</dt>
	<dd><?php echo date("d/m/Y H:i", strtotime( $cep['criado'])); ?></dd>

	<dt>Data de modificação:</dt>
	<dd><?php echo date("d/m/Y H:i", strtotime( $cep['modificado'])); ?></dd>

</dl>


<div id="actions" class="row">
	<div class="col-md-12">
	  <a href="edit.php?id=<?php echo $cep['id']; ?>" class="btn btn-primary">Editar</a>
	  <a href="index.php" class="btn btn-default">Voltar</a>
	</div>
</div>

<?php include(FOOTER_TEMPLATE); 
