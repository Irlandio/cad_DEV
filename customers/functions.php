<?php

require_once('../config.php');
require_once(DBAPI);
$ceps = null;
$cep = null;
/**
 *  Listagem de Clientes
 */
function index() {
	global $ceps;
	$ceps = find_all('ceps');
}
/**
 *  Cadastro de Clientes
 */
function add($cePs) {
       
    if(isset ($cePs))
        {

      if (!empty($cePs)) {

        $today = date_create('now', new DateTimeZone('America/Sao_Paulo'));

     //   $cePs = $_POST['cePs'];
        $cePs['modificado'] = $cePs['criado'] = $today->format("Y-m-d H:i:s");

          save('ceps', $cePs);
        header('location: index.php');
      }
    }
   
}
/**
 *	Atualizacao/Edicao de Cliente
 */
function edit() {

  $now = date_create('now', new DateTimeZone('America/Sao_Paulo'));

  if (isset($_GET['id'])) {

    $id = $_GET['id'];
      verificaCamposGET();
      
    if (isset($_POST['cep'])) {

      $cep = $_POST['cep'];
      $cep['modificado'] = $now->format("Y-m-d H:i:s");

                    ?>                
               <script>              
                alert("POST Encontrado.");
               // limpa_formulario_cep(campo);  
                </script> 
                <?php 
      update('ceps', $id, $cep);
      header('location: edit.php?id='.$id);
    } else {

                    ?>                
               <script>              
              //  alert("Post Não Encontrado.");
               // limpa_formulario_cep(campo);  
                </script> 
                <?php 
      global $cep;
      $cep = find('ceps', $id);
    } 
  } else {
    header('location: edit.php'.$id);
  }
}
/**
 *  Visualização de um Cliente
 */
function view($id = null) {
  global $cep;
  $cep = find('ceps', $id);
}
/**
 *  Exclusão de um Cliente
 */
function delete($id = null) {

  global $cep;
  $cep = remove('ceps', $id);
 // if( remove('ceps', $id))

 // header('location: add.php');
//else
  header('location: index.php');
}
function calcDistancia($lat_inicial, $long_inicial, $lat_final, $long_final)
{
    $d2r = 0.017453292519943295769236;

    $dlong = ($long_final - $long_inicial) * $d2r;
    $dlat = ($lat_final - $lat_inicial) * $d2r;

    $temp_sin = sin($dlat/2.0);
    $temp_cos = cos($lat_inicial * $d2r);
    $temp_sin2 = sin($dlong/2.0);

    $a = ($temp_sin * $temp_sin) + ($temp_cos * $temp_cos) * ($temp_sin2 * $temp_sin2);
    $c = 2.0 * atan2(sqrt($a), sqrt(1.0 - $a));

    return 6368.1 * $c;
}

function clear_messages(){
    unset($_SESSION['message']);
}
function verificaCamposGET(){
    
   if(isset ($_GET['cepOrigID'])) 
   {//Verifica se o primeiro ou o segundo Cep foi solicitado
       if( 0 != $_GET['cepOrigID'] )
       {//Se não existe variavel global ou se consulta CEP difernte faz consulta no site e alimenta as variaveis
                
                     
      if(!isset ($_SESSION['cepOrig']) || (isset($_SESSION['cepOrig']) && ( $_SESSION['cepOrig'] != $_GET['cepOrigID'] || 'Não encontrado.' == $_SESSION['lat1'] ||  '' == $_SESSION['lat1']) ))
           {
               //Alimenta variavel global
               $_SESSION['cepOrigID']   = $_GET['cepOrigID'];
               $_SESSION['cepOrig']     = $_GET['cepOrigID']; 
                
                consultaSite($_SESSION['cepOrig']);
          
               $_SESSION['lat1']    = $_SESSION['lat'];
               $_SESSION['longt1']  = $_SESSION['longt'];
               $_SESSION['logra1']  = $_SESSION['logra'];
               $_SESSION['cidade1'] = $_SESSION['cidade'];
                $_SESSION['endOrig'] = $_SESSION['ender'];
            }
        }else
           {  //*** Se esse CEP não foi solicitado os campos recebem o mesmo anterior
               $_SESSION['cepOrigID']   = $_GET['cepOrigID'];
               $_SESSION['cepOrig']     = $_GET['cepOrig'];         

                if( isset($_GET['latitude1'] )){
                   $_SESSION['lat1']    = $_GET['latitude1'];
                   $_SESSION['longt1']  = $_GET['longitude1'];
                   $_SESSION['logra1']  = $_GET['rua1'];
                   $_SESSION['cidade1'] = $_GET['cidade1'];
                   $_SESSION['endOrig'] = $_GET['endOrig'];
                }

       }
       if(isset ($_GET['cepDID']))
       //Verifica se o primeiro ou o segundo Cep foi solicitado
       if( 0 != $_GET['cepDID']){
           
               {
                   //Alimenta variavel global
                   $_SESSION['cepDID']  = $_GET['cepDID'];
                   $_SESSION['cepD']    = $_GET['cepDID'];
               
                    consultaSite($_SESSION['cepD']);
               
                   $_SESSION['lat2']    = $_SESSION['lat'];
                   $_SESSION['longt2']  = $_SESSION['longt'];
                   $_SESSION['logra2']  = $_SESSION['logra'];
                   $_SESSION['cidade2'] = $_SESSION['cidade'];
                    $_SESSION['endDest'] = $_SESSION['ender'];
                } }else
                   {//*** Se esse CEP não foi solicitado os campos recebem o mesmo anterior
                       $_SESSION['cepDID'] = $_GET['cepDID'];
                       $_SESSION['cepD'] = $_GET['cepD'];  

                        if( isset($_GET['latitude2'] )){
                           $_SESSION['lat2']    = $_GET['latitude2'];
                           $_SESSION['longt2']  = $_GET['longitude2'];
                           $_SESSION['logra2']  = $_GET['rua2'];
                           $_SESSION['cidade2'] = $_GET['cidade2'];
                           $_SESSION['endDest'] = $_GET['endDest'];
                        }
                    }
   }
}
function verificacamposPOST(){
    {
       $cepOrig    = $_POST['cepOrig'];
       $latd1      = $_POST['latd1'];
       $longd1     = $_POST['longd1'];
       
       $cepDest = $_POST['cepDest'];
       $latd2  = $_POST['latd2'];
       $longd2 = $_POST['longd2'];
       
       $dist   = $_POST['dist'];
       $criado = $_POST['criado'];
       
       $_SESSION['cepOrigID']   = $cepOrig;
       $_SESSION['cepOrig']     = $cepOrig;
       $_SESSION['lat1']        = $latd1;
       $_SESSION['longt1']      = $longd1;
       
       $_SESSION['cepDID']  = $cepOrig;
       $_SESSION['cepD']    = $cepOrig;
       $_SESSION['lat2']    = $latd2;
       $_SESSION['longt2']  = $longd2;       
       $cePs = array(
                     'cepOrig' => $cepOrig,
                     'cepDest' => $cepDest,
                     'dist'     => $dist,
                     'criado'   => $criado,
                     'modificado' => $criado,
                     'endOrig'  => $_SESSION['logra1'].', '.$_SESSION['cidade1'].' - '.$_SESSION['estado1'],
                     'endDest'  => $_SESSION['logra2'].', '.$_SESSION['cidade2'].' - '.$_SESSION['estado2'],
                     'latO'     => $_SESSION['lat1'],
                     'longO'    => $_SESSION['longt1'],
                     'latD'     => $_SESSION['lat2'],
                     'longD'    => $_SESSION['longt2']
                     );      
    add($cePs);  
   }
}
function validaCep($cep) {
    $token =  "1b3b95b1f7ceccd9bdcec4fd1205cd03";
	// Recebe o CEP
    $curl = curl_init( 'https://www.cepaberto.com/api/v3/cep?cep='.$cep);
	// Adiciona o token no cabeçalho
	curl_setopt( $curl, CURLOPT_HTTPHEADER, array( 'Authorization: Token token="'.$token.'"' ) );
    
	// Não imprime na tela
	curl_setopt( $curl, CURLOPT_RETURNTRANSFER, true );
	// Executa
	$latlng = curl_exec( $curl );
	// Fecha pra economizar memória
	curl_close( $curl );
	// Converte para Array
	$row_set = json_decode( $latlng );
    
  return $row_set;
}
function viacep($cep){


  // formatar o cep removendo caracteres nao numericos
  $cep = preg_replace("/[^0-9]/", "", $cep);
  $url = "http://viacep.com.br/ws/$cep/xml/";

  $xml = simplexml_load_file($url);
  return $xml;
}
//Alternativa pelo Google Maps. Ainda sem chave.
function getTomtom($address)
{
?>
<script src="http://maps.google.com/maps/api/js"></script>
<?php
//$address = str_replace(" ", "+", $address);
 $key = 'EUGFcRRt49sSGMQPtK3aVZGAqI9rw3ZF';
    $Addr = $address;
  //  "https://maps.googleapis.com/maps/api/geocode/json?address=$address&key=$key"
$json = file_get_contents("https://api.tomtom.com/geofencing/2/json?key=<$key>&address=$Addr");
$json = json_decode($json);
 if( !empty($json) && 1==12){
//$lat = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
//$long = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};
     $lat = $json->latitude;
     $long = $json->longetude;
     
 }else {$lat = 0; $long = 0; }
$coord = array('latitude'=>$lat,'longitude'=>$long);
return $json;
}

    
function consultaSite($getCep) {
    
    //Verifica se o primeiro ou o segundo Cep foi solicitado
       {
               $row_set                = validaCep($getCep);  

               if( !empty($row_set) ){
                   $_SESSION['lat']    = $row_set->latitude;
                   $_SESSION['longt']  = $row_set->longitude;
                   $_SESSION['logra']  = $row_set->logradouro;
                   $_SESSION['cidade'] = $row_set->cidade->nome.'-'.$row_set->estado->sigla;
                   $_SESSION['ender'] = $row_set->logradouro.', '.$row_set->cidade->nome.'-'.$row_set->estado->sigla;
               } else 
               {   
                    ?>                
               <script>              
             //   alert("CEP Não Encontrado ou sem resposta do site (Validacep).\n Exibir localização pelo Viacep.");
                 
                </script> 
                <?php 
                   if(1==1){
                 //  viacep($getCep);
                  $xml = viacep($getCep); 
                   
                   //Opção de pesquisa pelo google maps. Chave desativada ainda.
                    $geo= array();
                    $a = "$xml->logradouro, 10 - $xml->bairro - $xml->localidade - $xml->uf"; // Pega parâmetro
                    $addr = str_replace(" ", "+", $a); 
                   // Substitui os espaços por + "Rua+Paulo+Guimarães,+São+Paulo+-+SP" conforme padrão 'maps.google.com'
                    $address = utf8_encode($addr); // Codifica para UTF-8 para não dar 'pau' no envio do parâmetro
                    //Opção de pesquisa pelo google maps. Chave desativada ainda.
                  //  $xy = getLatLong($address);
                    // $exibe = print_r ($xy);
                    // $exibe = print_r ($xml);
                if( !empty($xml) ){
                   $_SESSION['lat']    = 0.00;
                   $_SESSION['longt']  = 0.00;
                   $_SESSION['logra']  = $xml->logradouro;
                   $_SESSION['cidade'] = $xml->localidade.'-'.$xml->uf;
                   $_SESSION['ender'] = $xml->logradouro.', '.$xml->localidade.', Santa Catarina, Brasil';
                    
                }
                      
                    $xy = getTomtom($_SESSION['ender']);
                 //   $exibe = print_r ($xy);
                    
                    
               }else
                {               
                ?>                
                   <script>              
                    alert("CEP Não Encontrado ou sem resposta dos sites (Validacep) e (Viacep)");
                
                    </script> 
                    <?php 
                    if(1 ==1){
                           $_SESSION['lat']    = 'Não encontrado.';
                           $_SESSION['longt']  = 'Não encontrado.';
                           $_SESSION['logra']  = 'Não encontrado.';
                           $_SESSION['cidade'] = 'Não encontrado.';
                           $_SESSION['ender'] = 'Não encontrado.';
                        } 
                }
                    ?>         
                <?php 
                    }
       }
    }

