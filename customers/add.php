
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
<form action="add.php" name="NomedoForm" method="get" action=".">
  <div class="row col-md-6" >
  <div class="row" >
      
    <h4>Cep Origem</h4>
 </div>
    <body>
    <!-- Inicio do formulario GET (CONSULTA)-->
       
        <label>Latitude:
        <input name="latitude1" type="text" id="latitude1" size="20" value="<?php echo $lat1 ?>" readonly/></label><br />
        <label>Longitude:
        <input name="longitude1" type="text" id="longitude1" size="20" value="<?php echo $longt1 ?>" readonly/></label><br />
        <label>Logradouro:
        <input name="rua1" type="text" id="rua1" size="30"  value="<?php echo $rua1 ?>" readonly/></label><br />
        <label>Cidade:
        <input name="cidade1" type="text" id="cidade1" size="30" value="<?php echo $cidade1 ?>" readonly/></label><br />
        <input name="endOrig" type="text" id="endOrig" size="30" value="<?php echo $end1 ?>" />
      
    </body>
 </div>

  <div class="row col-md-6" >
  <div class="row" >
      
    <h4>Cep Destino</h4>
 </div>
    <body>
    <!-- Inicio do formulario -->
       
        <label>Latitude:
        <input name="latitude2" type="text" id="latitude2" size="20"  value="<?php echo $lat2 ?>" readonly/><span class="required">*</span></label><br />
        <label>Longitude:
        <input name="longitude2" type="text" id="longitude2" size="20" value="<?php echo $longt2 ?>"  readonly/></label><br />
        <label>Logradouro:
        <input name="rua2" type="text" id="rua2" size="30" value="<?php echo $rua2 ?>" readonly/></label><br />
        <label>Cidade:
        <input name="cidade2" type="text" id="cidade2" size="30" value="<?php echo $cidade2 ?>" readonly /></label>
        <br />
        <input name="endDest" type="text" id="endDest" size="30" value="<?php echo $end2 ?>" />
      
    </body>
 </div>    
<h2>Nova Distância</h2>
  <!-- area de campos do form -->
  <hr />
  <div class="row" >
    <div class="form-group col-md-2">
      <label for="name">CEP de Origem</label>
      <input id="cepOrig" type="text" class="form-control"  value="<?php echo $cepOrig ?>" size="10" maxlength="9" onblur="pesquisacep1(this.value,1);" name="cepOrig">
      <input id="cepOrigID"  name="cepOrigID"  type="hidden" class="form-control"   value="<?php echo $cepOrigID ?>"/>
      <input id="cepDID"     name="cepDID"     type="hidden" class="form-control"   value="<?php echo $cepDID ?>" />
    </div>

    <div class="form-group col-md-2">
      <label for="campo2">CEP de Destino</label>
      <input id="cepD" type="text" class="form-control"  value="<?php echo $cepD ?>" size="10" maxlength="9"
               onblur="pesquisacep1(this.value,2);"  name="cepD">
    </div>

    <div class="form-group col-md-2">
      <label for="campo3">Distância em Km</label>
      <input type="text" class="form-control" name="distancia" readonly value="<?php echo number_format($distancia, 2, ',', '.'); ?>" >
    </div>
  </div>  
  <div class="row">  
    <div class="form-group col-md-2">
      <label for="campo3">Data de Cadastro</label>
      <input type="dateTimepiker" class="form-control" name="criado" value="<?php echo date("d/m/Y H:i:s"); ?>" disabled>
    </div>    
  </div>  
  
</form>

<form action="add.php" method="post" >
    <!-- Inicio do formulario POST (CADASTRO)-->
  <hr />
  <div class="row" >
      <input id="cepO" type="hidden" class="form-control" name="cepOrig" value="<?php echo $cepOrig ?>"/>
      <input id="latd1" type="hidden" class="form-control" name="latd1" value="<?php echo $lat1 ?>" />
      <input id="longd1" type="hidden" class="form-control" name="longd1" value="<?php echo $longt1 ?>"/>
      <input id="end1" type="hidden" class="form-control" name="end1" value="<?php echo $end1 ?>"/>
      
      <input id="cepD" type="hidden" class="form-control" name="cepDest" value="<?php echo $cepD ?>" />
      <input id="latd2" type="hidden" class="form-control" name="latd2" value="<?php echo $lat2 ?>"/>
      <input id="longd2" type="hidden" class="form-control" name="longd2" value="<?php echo $longt2 ?>" />
      <input id="end2" type="hidden" class="form-control" name="end2" value="<?php echo $end2 ?>"/>
      <input type="hidden" class="form-control" name="dist"   value="<?php echo $distancia; ?>" />
      <input type="hidden" class="form-control" name="criado" value="<?php echo date("d/m/Y H:i"); ?>" >
  </div>  
  
  <div id="actions" class="row">
    <div class="col-md-12">
      <button type="submit" id="salvar"  <?php echo $desabled ?>  class="btn btn-primary">Salvar</button>
      <a href="index.php" class="btn btn-default">Cancelar</a>
    </div>
  </div>
</form>

  

<?php include(FOOTER_TEMPLATE); ?>