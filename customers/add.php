	
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
if(isset ($_GET['cepOrigID']))
    verificaCamposGET();

   if(isset ($_POST['cepOrig']))
   verificacamposPOST();
?>
<?php include(HEADER_TEMPLATE); ?>

    <head>
    <title>CEP da Rota</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <!-- Adicionando Javascript -->
    <script>
    
    function limpa_formulario_cep(campo) {
          //  Limpa valores do formulário de cep.
                document.getElementById("latitude"+campo).value="";
                document.getElementById("longitude"+campo).value="";
                document.getElementById("rua"+campo).value="";
                document.getElementById("cidade"+campo).value="";
                document.getElementById("uf"+campo).value="";              
    }
    function pesquisacep1(valor,campo) {
        //Nova variável "cep" somente com dígitos.
        var cep = valor.replace(/\D/g, '');
        //Verifica se campo cep possui valor informado.
        if (cep != "") {
            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;
            //Valida o formato do CEP.
            if(validacep.test(cep)) {
                if(campo == 1)
                    {
                    document.getElementById("cepOrigID").value=document.getElementById("cepOrig").value;
                    document.getElementById("cepDID").value="0";
                    }
                    else  
                        if(campo == 2)
                    {
                    document.getElementById("cepDID").value=document.getElementById("cepD").value;
                    document.getElementById("cepOrigID").value="0";
                    }                
                
                
                //Preenche os campos com "..." enquanto consulta webservice.
                document.getElementById("latitude"+campo).value="Aguard...";
                document.getElementById("longitude"+campo).value="...";
                document.getElementById("rua"+campo).value="...";
                document.getElementById("cidade"+campo).value="...";               
                //Executa um submit de botão.
                document.NomedoForm.submit(); 
                //Cria um elemento javascript.
                var script = document.createElement('script');
                      
            } 
            else {                
            alert("CEP invalido.");
            limpa_formulario_cep(campo);
            }
        } 
        else {              
            alert("CEP invalido.");
            limpa_formulario_cep(campo);
        }
    };
      function submitform() {
        document.NomedoForm.submit();
    }
    </script>
    
    </head>
<?php
        $calc = 1; 
        $distancia =  "0";
            $end1 = "";   $end2 = "";
// Condição para calcular a distância. Caso algum dado não tenha então recebe zero(0) e não calcula
     if(isset ($_SESSION['cepOrigID'])) { $cepOrigID = $_SESSION['cepOrigID']; }
     if(isset ($_SESSION['cepOrig']))   
         { $cepOrig  = $_SESSION['cepOrig']; 
         if(isset ($_SESSION['longt1']))  { $longt1   = $_SESSION['longt1']; }    else { $longt1  = "";    $calc = 0;}
         if(isset ($_SESSION['lat1']))    { $lat1     = $_SESSION['lat1']; }      else { $lat1    = "";    $calc = 0;}
         if(isset ($_SESSION['logra1']))  { $rua1     = $_SESSION['logra1']; }    else  $rua1     = "..";
         if(isset ($_SESSION['cidade1'])) { $cidade1  = $_SESSION['cidade1']; }   else  $cidade1  = ".";
       //  if(isset ($_SESSION['estado1'])) { $estado1  = $_SESSION['estado1']; }else  $estado1 = "";
          $end1 = ";";
          if(($cidade1 != "."))
            $end1 = $rua1.', '.$cidade1;

         if(isset ($_SESSION['cepDID']))  { $cepDID   = $_SESSION['cepDID']; } else  $cepDID  = "0";
         if(isset ($_SESSION['cepD']))    { $cepD     = $_SESSION['cepD']; }   else  $cepD    = "";
        if(isset ($_SESSION['longt2']))   { $longt2   = $_SESSION['longt2']; } else { $longt2 = "";    $calc = 0;}
         if(isset ($_SESSION['lat2']))    { $lat2     = $_SESSION['lat2']; }   else { $lat2   = "";     $calc = 0;}
         if(isset ($_SESSION['logra2']))  { $rua2     = $_SESSION['logra2']; } else  $rua2    = "..";
         if(isset ($_SESSION['cidade2'])) { $cidade2  = $_SESSION['cidade2']; }else  $cidade2 = "..";
        // if(isset ($_SESSION['estado2'])) { $estado2  = $_SESSION['estado2']; }else  $estado2 = "";
          
        $end2 = $rua2.', '.$cidade2;

        if (!is_numeric($lat1) || !is_numeric($longt1) || !is_numeric($lat2) || !is_numeric($longt2)) $calc = 0;
        }else 
         { $cepOrigID = "0";$cepOrig  = $lat1    =$longt1  = $rua1  = $cidade1  = $estado1 = ""; $calc = 0;
         $cepDID = "0";$cepD  = $lat2    =$longt2  = $rua2  = $cidade2  = "";
         }
         if($lat1 != "" && $lat2 != "" ) $desabled = ""; else $desabled = "disabled";

        if( $calc == 1)
         $distancia =   calcDistancia($lat1, $longt1, $lat2, $longt2);
    ?>
<form action="add.php" method="post" >
    <!-- Inicio do formulario POST (CADASTRO)-->
  
<div class="row col-md-10" >    
<h2>Nova Distância</h2>
  <!-- area de campos do form -->
  <hr />
  <div class="row" >
    <div class="form-group col-md-11">
      <label for="name"> Nome Completo</label>
      <input id="cepOrig" type="text" class="form-control"  value="" name="nome">
    </div>
 
    <div class="form-group col-md-3">
      <label for="campo3">Data de Nascimento</label>
      <input type="dateTimepiker" class="form-control" name="datNasc" value="<?php echo date("d/m/Y"); ?>">
    </div>        
    
    <div class="form-group col-md-8">
      <label for="campo3"> Likedin</label>
      <input type="text" class="form-control" name="linkedin" value="" >
    </div>
  </div>    
  </div> 
  <div class="row" >  
    <div class="form-group col-md-8">
      <label for="campo3"> Tecnologias</label><br/>
    <div class="form-group col-md-3">
       <label class="btn btn-default" submit><input name="tec" type="checkbox" value="tec" class="badgebox" style="margin-top:5px;"/> <span class="badge" >&check;</span> C#:</label><br/>
       <label class="btn btn-default" submit><input name="tec" type="checkbox" value="tec" class="badgebox" style="margin-top:5px;"/> <span class="badge" >&check;</span> Javascript:</label><br/>
       <label class="btn btn-default" submit><input name="tec" type="checkbox" value="tec" class="badgebox" style="margin-top:5px;"/> <span class="badge" >&check;</span> Nodejs:</label><br/>
       <label class="btn btn-default" submit><input name="tec" type="checkbox" value="tec" class="badgebox" style="margin-top:5px;"/> <span class="badge" >&check;</span> Angular:</label><br/>
       <label class="btn btn-default" submit><input name="tec" type="checkbox" value="tec" class="badgebox" style="margin-top:5px;"/> <span class="badge" >&check;</span> React:</label><br/>
    </div> 
    <div class="form-group col-md-3">  
       <label class="btn btn-default" submit><input name="tec" type="checkbox" value="tec" class="badgebox" style="margin-top:5px;"/> <span class="badge" >&check;</span> Ionic:</label><br/>
       <label class="btn btn-default" submit><input name="tec" type="checkbox" value="tec" class="badgebox" style="margin-top:5px;"/> <span class="badge" >&check;</span> Mensageria:</label><br/>
       <label class="btn btn-default" submit><input name="tec" type="checkbox" value="tec" class="badgebox" style="margin-top:5px;"/> <span class="badge" >&check;</span> PHP:</label><br/>
       <label class="btn btn-default" submit><input name="tec" type="checkbox" value="tec" class="badgebox" style="margin-top:5px;"/> <span class="badge" >&check;</span> Laravel:</label><br/>
  </div> 
  </div> 
  </div> 
    
  <div id="actions" class="row">
    <div class="col-md-12">
      <button type="submit" id="salvar"  <?php echo $desabled ?>  class="btn btn-primary">Salvar</button>
      <a href="index.php" class="btn btn-default">Cancelar</a>
    </div>
  </div>
</form>

  

<?php include(FOOTER_TEMPLATE); ?>