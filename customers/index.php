<?php
    require_once('functions.php');
require_once('modal.php');
    index();
$ord = "id";
if(isset($_SESSION['ord'])) $ord = $_SESSION['ord'];

 include(HEADER_TEMPLATE); ?>

<header>
	<div class="row">
		<div class="col-sm-4">
			<h2>Cadastro de candidatos</h2>
		</div>
		<div class="col-sm-8 text-right h2">
        <form action="index.php"  name="NForm"  method="get" >
            <!-- Inicio do formulario POST (CADASTRO)-->
            <div class="form-group col-md-2">
                   <button type="submit" class="btn btn-primary">Ordenar</button>
                </div>
            <div class="form-group col-md-4">
                   <select name="ord" id="ord" class="form-control">
                        <option value="<?php echo $ord; ?>"> <?php echo $ord; ?></option>
                        <option value="id"> Por Cadastro</option>
                        <option value="nome"> Por Nome</option>
                        <option value="tecnologias"> Por Tecnologias</option>
                        </select> 
            </div>
        </form>
        
        <a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#filtrar-modal" data-id="<?php echo $ord; ?>"  data-nome="Teste" ><i class="fa fa-filter"></i> Filtrar</a>
        
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

<?php 
include(FOOTER_TEMPLATE); ?>