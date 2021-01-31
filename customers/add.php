
<style>
.badgebox{ opacity: 0;}.badgebox + .badge{text-indent: -999999px;width: 27px;}
.badgebox:focus + .badge{ box-shadow: inset 0px 0px 5px;}
.badgebox:checked + .badge{text-indent: 0;}
</style>
<?php 

  require_once('functions.php'); 
    
if (session_status() !== PHP_SESSION_ACTIVE) {//Verificar se a sessão não já está aberta.
session_start();
}
   if(isset ($_POST['nome']))
   verificacamposPOST("add");

$nome = $email = $datNasc = $linkedin = $idade = $tec = "";
$c = $javascript = $nodejs = $angular = $react = $ionic = $mensageria = $pHP = $laravel = " ";
   if(isset ($_SESSION['nome']))    $nome      = $_SESSION['nome'];
   if(isset ($_SESSION['email']))   $email     = $_SESSION['email'];
   if(isset ($_SESSION['datNasc'])) $datNasc   = $_SESSION['datNasc'];
   if(isset ($_SESSION['linkedin']))$linkedin  = $_SESSION['linkedin'];
   if(isset ($_SESSION['idade']))   $idade     = $_SESSION['idade'];
   if(isset ($_SESSION['tecno']))   $tec       = $_SESSION['tecno'];

    if (strpos($tec, 'C#')          !== false) {$c          = 'checked';}
    if (strpos($tec, 'Javascript')  !== false) {$javascript = 'checked';}
    if (strpos($tec, 'Nodejs')      !== false) {$nodejs     = 'checked';}
    if (strpos($tec, 'Angular')     !== false) {$angular    = 'checked';}
    if (strpos($tec, 'React')       !== false) {$react      = 'checked';}
    if (strpos($tec, 'Ionic')       !== false) {$ionic      = 'checked';}
    if (strpos($tec, 'Mensageria')  !== false) {$mensageria = 'checked';}
    if (strpos($tec, 'PHP')         !== false) {$pHP        = 'checked';}
    if (strpos($tec, 'Laravel')     !== false) {$laravel    = 'checked';}

//C#,Javascript,Nodejs,Angular,React,Ionic,Mensageria,PHP,Laravel
?>
<?php include(HEADER_TEMPLATE); ?>

    <head>
    <title>Candidato</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    </head>

<form action="add.php"  name="NForm"  method="post" >
    <!-- Inicio do formulario POST (CADASTRO)-->
  
<div class="row col-md-10" >    
<h2>Novo Cadastro</h2>
  <!-- area de campos do form -->
  <hr />
  <div class="row" >
    <div class="form-group col-md-11">
      <label for="name"> Nome Completo</label>
      <input id="nome" type="text" class="form-control"  value="<?php echo $nome ?>" name="nome" autofocus onblur="verificanome(this);">
    </div>	  
    <div class="form-group col-md-11" id="myModal">
      <label for="email"> E-mail</label>
      <input id="email1" type="email" class="form-control" value="<?php echo $email ?>" name="email1" required  onblur="verificaemail(this,1);" Placeholder="fulano@email.com">
    </div>
    <div class="form-group col-md-11">
      <input id="email2" type="email" class="form-control" value="<?php echo $email ?>" name="email2" required Placeholder="Repita seu E-mail"  onblur="verificaemail(this,2);">
    </div>
 
    <div class="form-group col-md-2">
      <label for="campo3">Data de Nasc.</label>
      <input type="date" class="form-control" name="datNasc" id="datNasc" value="<?php echo $datNasc ?>" onblur="calculaIdade(this.value);" min="1920-01-01" max="<?php echo date('Y-m-d', strtotime('-15 year')); ?>" required> <span class="validity"></span>
    </div>     
    <div class="form-group col-md-7">
      <label for="campo3"> Likedin</label><br>
           <input type="text" class="form-control" name="linkedin" value="<?php echo $linkedin ?>" Placeholder="www.linkedin.com/in/www.linkedin.com/in/Fulano-De-Tal-999990025/">
    </div>       
    <div class="form-group col-md-1">
      <label for="campo3">Idade</label>
      <input type="text" class="form-control" readonly name="idade" id="idade" value="<?php echo $idade ?>" >
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
    <!-- Adicionando Javascript -->
    <script>
    function verificanome(input){
        if(input.value=="" || input.value==" " || input.value.indexOf(' ')==-1 ){
                alert( "Por favor, informe seu nome completo!" );
                document.getElementById("nome").style.background  = "#f0b9b9";
    }else       document.getElementById("nome").style.background  = "#a7f5bf";
    }
    function calculaIdade(dataNasc){
         var dataAtual = new Date();
         var anoAtual = dataAtual.getFullYear();
         var anoNascParts = dataNasc.split('-');
         var diaNasc =anoNascParts[2];
         var mesNasc =anoNascParts[1];
         var anoNasc =anoNascParts[0];
         var idade = anoAtual - anoNasc;
         var mesAtual = dataAtual.getMonth() + 1; 
         //Se mes atual for menor que o nascimento, nao fez aniversario ainda; 
         if(mesAtual < mesNasc){ idade--; 
         } else {
         //Se estiver no mes do nascimento, verificar o dia
         if(mesAtual == mesNasc){ 
         if(new Date().getDate() < diaNasc ){ 
         //Se a data atual for menor que o dia de nascimento ele ainda nao fez aniversario
         idade--; 
         }} }
        if(idade < 105)
        document.getElementById("idade").value= idade;          
        // return idade; 
        }
    
    function verificaemail(input,campo){
         var outroCampo = 3- campo;
          var email = document.getElementById("email"+outroCampo).value;        
         if(input.value.length == 0 ){ //Se o campo estiver limpo
                alert( "Por favor, informe seu E-MAIL!" );
                document.getElementById("email"+campo).style.background  = "#f0b9b9";
              }else
            if(input.value=="" || input.value.indexOf('@')==-1 || input.value.indexOf('.')==-1 ){
                         alert( "Por favor, informe um E-MAIL válido!" );
                document.getElementById("email"+campo).style.background  = "#f0b9b9";
              } else 
                if( email != "" && input.value != email){
                     alert( "Por favor, Preencha os dois campos com o mesmo E-MAIL!" );
                    document.getElementById("email"+campo).style.background  = "#f0b9b9";

              } else {
                document.getElementById("email"+campo).style.background  = "#a7f5bf";
              }
        }
    </script>
    