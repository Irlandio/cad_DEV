<?php 
	require_once('functions.php'); 
	view($_GET['id']);
?>

<?php include(HEADER_TEMPLATE); ?>

<h2>Candidato <?php echo $candidato['id']; ?></h2>
<hr>

<?php if (!empty($_SESSION['message'])) : ?>
	<div class="alert alert-<?php echo $_SESSION['type']; ?>"><?php echo $_SESSION['message']; ?></div>
<?php endif; ?>

<dl class="dl-horizontal">
	<dt>Nome:</dt>
	<dd><?php echo $candidato['nome']; ?></dd>

	<dt>Idade:</dt>
	<dd><?php echo $candidato['idade']; ?></dd>
	
	<dt>E-mail:</dt>
	<dd><?php echo $candidato['email']; ?></dd>

	<dt>Linkedin:</dt>
	<dd><?php echo $candidato['Url_linkedin']; ?></dd>	
</dl>

<dl class="dl-horizontal">

	<dt>Tecnologias:</dt>
	<dd><?php echo $candidato['tecnologias']; ?></dd>
</dl>


<div id="actions" class="row">
	<div class="col-md-12">
	  <a href="edit.php?id=<?php echo $candidato['id']; ?>" class="btn btn-primary">Editar</a>
	  <a href="index.php" class="btn btn-default">Voltar</a>
	</div>
</div>

<?php include(FOOTER_TEMPLATE); 
