
 <?php 
  require_once('functions.php');  
  require_once('modal.php');
  edit();

if (session_status() !== PHP_SESSION_ACTIVE) {//Verificar se a sessão não já está aberta.
session_start();
}
    $dNasc = date('Y-m-d', strtotime($candidato['dNasc']));
    
    $c = $javascript = $nodejs = $angular = $react = $ionic = $mensageria = $pHP = $laravel = " ";
    $tec = $candidato['tecnologias'];

    if (strpos($tec, 'C#')          !== false) {$c          = 'checked';}
    if (strpos($tec, 'Javascript')  !== false) {$javascript = 'checked';}
    if (strpos($tec, 'Nodejs')      !== false) {$nodejs     = 'checked';}
    if (strpos($tec, 'Angular')     !== false) {$angular    = 'checked';}
    if (strpos($tec, 'React')       !== false) {$react      = 'checked';}
    if (strpos($tec, 'Ionic')       !== false) {$ionic      = 'checked';}
    if (strpos($tec, 'Mensageria')  !== false) {$mensageria = 'checked';}
    if (strpos($tec, 'PHP')         !== false) {$pHP        = 'checked';}
    if (strpos($tec, 'Laravel')     !== false) {$laravel    = 'checked';}

include(HEADER_TEMPLATE); 

?> 
    <head>
    <title>Candidato</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    </head>

<form action="edit.php?id=<?php echo $candidato['id']; ?>"  name="NForm"  method="post" >
    <!-- Inicio do formulario POST (CADASTRO)-->
  
<h2>Atualizar Cadastro</h2>
<!-- Campo que exibe os valores em Edição   -->
<div class="row col-md-10" >
  <!-- area de campos do form -->
  <hr />
  <div class="row" >
    <div class="form-group col-md-11">
      <label for="name"> Nome Completo</label>
      <input id="nome" type="text" class="form-control"  value="<?php echo $candidato['nome'] ?>" name="nome"  onblur="verificanome(this);">
    </div>	  
    <div class="form-group col-md-11" id="myModal">
      <label for="email"> E-mail</label>
      <input id="email1" type="email" class="form-control" value="<?php echo $candidato['email']  ?>" name="email1" required  onblur="verificaemail(this,1);" Placeholder="fulano@email.com">
    </div>
    <div class="form-group col-md-11">
      <input id="email2" type="email" class="form-control" value="<?php echo $candidato['email']  ?>" name="email2" required Placeholder="Repita seu E-mail"  onblur="verificaemail(this,2);">
    </div>
 
    <div class="form-group col-md-2">
      <label for="campo3">Data de Nasc.</label>
      <input type="date" class="form-control" name="datNasc" id="datNasc" autofocus
      value="<?php echo $dNasc  ?>" onblur="calculaIdade(this.value);" min="1920-01-01" max="<?php echo date('Y-m-d', strtotime('-15 year')); ?>" required> <span class="validity"></span>
    </div>     
    <div class="form-group col-md-7">
      <label for="campo3"> Likedin</label><br>
           <input type="text" class="form-control" name="linkedin" value="<?php echo $candidato['Url_linkedin']  ?>" Placeholder="www.linkedin.com/in/www.linkedin.com/in/Fulano-De-Tal-999990025/">
    </div>       
    <div class="form-group col-md-1">
      <label for="campo3">Idade</label>
      <input type="text" class="form-control" readonly name="idade" id="idade" value="<?php echo $candidato['idade']  ?>" >
    </div>        
  </div>    
  </div> 
  <div class="row" >  
    <div class="form-group col-md-8">
      <label for="campo3"> Tecnologias</label><br/>
    <div class="form-group col-md-3">
       <label class="btn btn-default" submit><input name="tec[]" type="checkbox" value="C#" class="badgebox" 
       <?php echo $c ?> style="margin-top:5px;"/> <span class="badge" >&check;</span> C#:</label><br/>
       <label class="btn btn-default" submit><input name="tec[]" type="checkbox" value="Javascript" class="badgebox" 
       <?php echo $javascript ?> style="margin-top:5px;"/> <span class="badge" >&check;</span> Javascript:</label><br/>
       <label class="btn btn-default" submit><input name="tec[]" type="checkbox" value="Nodejs" class="badgebox" 
       <?php echo $nodejs ?> style="margin-top:5px;"/> <span class="badge" >&check;</span> Nodejs:</label><br/>
    </div> 
    <div class="form-group col-md-3">
       <label class="btn btn-default" submit><input name="tec[]" type="checkbox" value="Angular" class="badgebox" 
       <?php echo $angular ?> style="margin-top:5px;"/> <span class="badge" >&check;</span> Angular:</label><br/>
       <label class="btn btn-default" submit><input name="tec[]" type="checkbox" value="React" class="badgebox" 
       <?php echo $react ?> style="margin-top:5px;"/> <span class="badge" >&check;</span> React:</label><br/>
       <label class="btn btn-default" submit><input name="tec[]" type="checkbox" value="Ionic" class="badgebox" 
       <?php echo $ionic ?> style="margin-top:5px;"/> <span class="badge" >&check;</span> Ionic:</label><br/>
    </div> 
    <div class="form-group col-md-3">  
       <label class="btn btn-default" submit><input name="tec[]" type="checkbox" value="Mensageria" class="badgebox" 
       <?php echo $mensageria ?> style="margin-top:5px;"/> <span class="badge" >&check;</span> Mensageria:</label><br/>
       <label class="btn btn-default" submit><input name="tec[]" type="checkbox" value="PHP" class="badgebox" 
       <?php echo $pHP ?> style="margin-top:5px;"/> <span class="badge" >&check;</span> PHP:</label><br/>
       <label class="btn btn-default" submit><input name="tec[]" type="checkbox" value="Laravel" class="badgebox" 
       <?php echo $laravel ?> style="margin-top:5px;"/> <span class="badge" >&check;</span> Laravel:</label><br/>
  </div> 
  </div> 
  </div> 
    
  <div id="actions" class="row">
    <div class="col-md-12">
      <button type="submit" id="salvar"    class="btn btn-primary">Salvar</button>
      <a href="index.php" class="btn btn-default">Cancelar</a>
    </div>
  </div>
</form>

<?php include(FOOTER_TEMPLATE); ?>