<?php 
  require_once('functions.php'); 
  edit();

if (session_status() !== PHP_SESSION_ACTIVE) {//Verificar se a sessão não já está aberta.
session_start();
}

if(isset ($_GET['cepOrigID']))
    verificaCamposGET();

include(HEADER_TEMPLATE); 
{
        if(isset ($_SESSION['cepOrig']) ){
            
               $cepOrigID   = $_SESSION['cepOrigID'];
               $cepOrig     = $_SESSION['cepOrig']; 
               $latO        = $_SESSION['lat1'];
               $longO       = $_SESSION['longt1'];
               $logra1      = $_SESSION['logra1'];
               $endOrig     = $_SESSION['endOrig'];
        }else{            
               $cepOrigID   = $cep['cepOrig'];
               $cepOrig     = $cep['cepOrig'];
               $latO        = $cep['latO'];
               $longO       = $cep['longO'];
               $logra1      = $cep['endOrig'];
               $cidade1     = $cep['endOrig'];
               $endOrig     = $cep['endOrig'];
             
        }
        if(isset ($_SESSION['cepD']) ){
            
               $cepDD      = $_SESSION['cepDID'];
               $cepD       = $_SESSION['cepD']; 
               $latD       = $_SESSION['lat2'];
               $longD      = $_SESSION['longt2'];
               $logra2     = $_SESSION['logra2'];
               $cidade2    = $_SESSION['cidade2'];
               $endDest    = $_SESSION['endDest'];
        }else{            
               $cepDID    = $cep['cepDest'];
               $cepD      = $cep['cepDest'];
               $latD      = $cep['latD'];
               $longD     = $cep['longD']; 
               $logra2    = $cep['endDest'];
               $cidade1   = $cep['endDest'];
               $endDest   = $cep['endDest'];
        }
        $distancia =   0.00;
        if(is_numeric($latO) && is_numeric($longO) && is_numeric($latD) && is_numeric($longD))
         $distancia =   calcDistancia($latO, $longO, $latD, $longD);
}
?>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- Adicionando Javascript -->
    <script>
    
    function limpa_formulario_cep(campo) {
          //  Limpa valores do formulário de cep.
                document.getElementById("latitude"+campo).value="";
                document.getElementById("longitude"+campo).value="";
                document.getElementById("end"+campo).value="";              
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
              //  document.getElementById("latitude"+campo).value="Carregando...";
             //   document.getElementById("longitude"+campo).value="Carregando...";
             //   document.getElementById("end"+campo).value="Carregando...";               
                //Executa um submit de botão.
                document.formedit.submit(); 
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
        document.formedit.submit();
    }
    </script>
    
<h2>Atualizar Cadastro</h2>
<!-- Campo que exibe os valores em Edição   -->
<form action="edit.php?id=<?php echo $cep['id']; ?>"  name="formedit"  method="GET">
  <hr />
      <input type="hidden" name="id" value="<?php echo $cep['id']; ?>"  id="id">
  <div class="row">
    <div class="form-group col-md-2">
      <label for="name">Atualizar CEP 1</label>
        
      <input id="cepOrig"  type="text" class="form-control" name="cepOrig" value="<?php echo $cepOrig; ?>" onblur="pesquisacep1(this.value,1);">
      <input type="hidden" class="form-control" name="cepOrigID" value="<?php echo $cepOrig; ?>" id="cepOrigID">
    </div>

    <div class="form-group col-md-3">
      <label for="campo2">Endereço 1</label>
      <input type="text" class="form-control" name="endOrig" value="<?php echo $endOrig; ?>" readonly id="end1">
      <input type="hidden" class="form-control" name="rua1" value="<?php echo $logra1; ?>" readonly id="rua1">
      <input type="hidden" class="form-control" name="cidade1" value="<?php echo $cidade1; ?>" readonly id="cidade1">
    </div>
    
    <div class="form-group col-md-3">
      <label for="campo2">Coordenadas( Latitude / Longitude)</label>
      <div class="row">

        <dl class="dl-horizontal">
            <dt><input type="text" class="form-control" name="latitude1" readonly value="<?php echo $latO; ?>" id="latitude1"></dt>
            <dd><input type="text" class="form-control" name="longitude1" readonly value="<?php echo $longO; ?>" id="longitude1"></dd>
        </dl>


      </div>
    </div>
  </div>
  <div class="row">
    <div class="form-group col-md-2">
      <label for="campo2">Atualizar CEP 2</label>
      <input  id="cepD" type="text" class="form-control" name="cepD" value="<?php echo $cepD ?>" onblur="pesquisacep1(this.value,2);" >
      <input type="hidden" class="form-control" name="cepDID" value="<?php echo $cepD; ?>" id="cepDID">
    </div>

    <div class="form-group col-md-3">
      <label for="campo2">Endereço 2</label>
      <input type="text" class="form-control" name="endDest" value="<?php echo $endDest; ?>" readonly id="end2">
      <input type="hidden" class="form-control" name="rua2" value="<?php echo $endDest; ?>" readonly id="rua2">
      <input type="hidden" class="form-control" name="cidade2" value="<?php echo $endDest; ?>" readonly id="cidade2">
    </div>

    <div class="form-group col-md-3">
      <label for="campo2">Coordenadas( Latitude / Longitude)</label>
      <div class="row">

        <dl class="dl-horizontal">
            <dt><input type="text" class="form-control" name="latitude2" readonly value="<?php echo $latD; ?>"  id="latitude2"></dt>
            <dd><input type="text" class="form-control" name="longitude2" readonly value="<?php echo $longD; ?>"  id="longitude2"></dd>
        </dl>
      </div>
    </div>
   
    <div class="form-group col-md-2">
      <label for="campo1">Distância Km</label>
      <input type="text" class="form-control" name="cep['dist']" readonly value="<?php echo $distancia; ?>">
      <input type="hidden" class="form-control" name="cep['criado']" disabled value="<?php echo $cep['criado']; ?>">
      <input type="hidden" class="form-control" name="cep['modificado']" disabled value="<?php echo $cep['modificado']; ?>">
    </div>

  </div>
    
</form>

<!-- Campo que exibe os valores Já cadastrados   -->
  <hr />
  <div class="row">
    <div class="form-group col-md-2">
      <label for="name">CEPs Cadastrados</label>
        
      <input id="cepOrigem"  type="text" class="form-control" name="cep0['cepOrig']" value="<?php echo $cep['cepOrig']; ?>" disabled>
      <input type="text" class="form-control" name="cep0['cepDest']" value="<?php echo $cep['cepDest']; ?>"  disabled>
    </div>

    <div class="form-group col-md-3">
      <label for="campo2">Endereço Cadastrados</label>
      <input type="text" class="form-control" name="cep0['endOrig']" value="<?php echo $cep['endOrig']; ?>" disabled id="end1">
      <input type="text" class="form-control" name="cep0['endDest']" value="<?php echo $cep['endDest']; ?>" disabled id="end2">
    </div>
    
    <div class="form-group col-md-3">
      <label for="campo2">Coordenadas( Lat / Long)</label>
      <div class="row">

        <dl class="dl-horizontal">
            <dt><input type="text" class="form-control" name="cep0['latO']" disabled value="<?php echo $cep['latO']; ?>" id="latitude1"></dt>
            
            <dd><input type="text" class="form-control" name="cep0['longO']" disabled value="<?php echo $cep['longO']; ?>" id="longitude1"></dd>
        </dl>
      </div>
      <div class="row">

        <dl class="dl-horizontal">
            <dt><input type="text" class="form-control" name="cep0['latD']" disabled value="<?php echo $cep['latD']; ?>"  id="latitude2"></dt>
            <dd><input type="text" class="form-control" name="cep0['longD']" disabled value="<?php echo $cep['longD']; ?>"  id="longitude2"></dd>
        </dl>
      </div>
    </div>
  </div>
    
  <div class="row">
   
    <div class="form-group col-md-2">
      <label for="campo1">Distância Cadastrada</label>
      <input type="text" class="form-control" name="cep0['dist']" disabled value="<?php echo $cep['dist']; ?>">
    </div>

    <div class="form-group col-md-2">
      <label for="campo3">Data de cadastro</label>
      <input type="text" class="form-control" name="cep0['criado']" disabled value="<?php echo $cep['criado']; ?>">
    </div>
    <div class="form-group col-md-2">
      <label for="campo3">Ultima modificação</label>
      <input type="text" class="form-control" name="cep0['modificado']" disabled value="<?php echo $cep['modificado']; ?>">
    </div>
  </div>


<!-- Campo que Guarda os valores em edição e à cadastrar   -->
<form action="edit.php?id=<?php echo $cep['id']; ?>"  name="formedite"  method="post">
  <hr />
  <div class="row">
      <input type="hidden" class="form-control" name="cep['cepOrig']"   value="<?php echo $cepOrig; ?>" >
      <input type="hidden" class="form-control" name="cep['cepDest']"   value="<?php echo $cepD; ?>"  >
      <input type="hidden" class="form-control" name="cep['endOrig']"   value="<?php echo $endOrig; ?>" >
      <input type="hidden" class="form-control" name="cep['endDest']"   value="<?php echo $endDest; ?>" >
      <input type="hidden" class="form-control" name="cep['latO']"      value="<?php echo $latO; ?>" >
      <input type="hidden" class="form-control" name="cep['longO']"     value="<?php echo $longO; ?>" >
      <input type="hidden" class="form-control" name="cep['latD']"      value="<?php echo $latD; ?>" >
      <input type="hidden" class="form-control" name="cep['longD']"     value="<?php echo $longD; ?>"  >
      <input type="hidden" class="form-control" name="cep['dist']"      value="<?php echo $distancia; ?>">
      <input type="hidden" class="form-control" name="cep['criado']"    value="<?php echo $cep['criado']; ?>">
      <input type="hidden" class="form-control" name="cep['modificado']"value="<?php echo $cep['modificado']; ?>">
  </div>
  <!--  -->
  <div id="actions" class="row">
    <div class="col-md-12">
      <button type="submit" class="btn btn-primary">Salvar Alterações</button>
      <a href="index.php" class="btn btn-default">Cancelar</a>
    </div>
  </div>
</form>

<?php include(FOOTER_TEMPLATE); ?>



