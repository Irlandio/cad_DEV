<?php

require_once('../config.php');
require_once(DBAPI);
$candidatos = null;
$candidato = null;
/**
 *  Listagem de Clientes
 */
function index() {
	global $candidatos;
  if (isset($_GET['ord']))  {
    $ord = $_SESSION['ord'] = $_GET['ord'];
      if (isset($_GET['tec'])){
          $tec = $_GET['tec']; 
            if(!empty($_GET['tec'])){
               $tecno = " WHERE ";
                foreach ($_GET['tec'] as $te=>$value)
                    {if($tecno != " WHERE ") $tecno .= " OR "; else $tecno .= "";
                        $tecno .= "LOCATE('".$value."',tecnologias) ";                
                    }  
            }
                }else        
               $tecno = " ";
     
	$candidatos = find_all('candidatos',$ord,$tecno);
    }else
	$candidatos = find_all('candidatos');
}
/**
 *  Cadastro de Clientes
 */
function add($dados) {
       
    if(isset ($dados))
        {

      if (!empty($dados)) {

          save('candidatos', $dados);
        header('location: index.php');
      }
    }
   
}
/**
 *	Atualizacao/Edicao de Cliente
 */
function edit() {

  if (isset($_GET['id'])) {
    $id = $_GET['id'];      
    if (isset($_POST['nome'])) 
    {
        verificacamposPOST("edt");
      $nome = $_POST['nome'];
                    ?>                
               <script>              
                alert("POST Encontrado.");
               // limpa_formulario_cep(campo);  
                </script> 
                <?php 
      update('candidatos', $id, $_SESSION['dados']);
      header('location: edit.php?id='.$id);
    } else {  ?>                
           <script>              
          //  alert("Post Não Encontrado.");
           // limpa_formulario_cep(campo);  
            </script> 
            <?php
      global $candidato;
      $candidato = find('candidatos', $id);
    } 
  } else {
    header('location: edit.php'.$id);
  }
}
/**
 *  Visualização de um Cliente
 */
function view($id = null) {
  global $candidato;
  $candidato = find('candidatos', $id);
}
/**
 *  Exclusão de um Cliente
 */
function delete($id = null) {

  global $candidatos;
  $candidatos = remove('candidatos', $id);
 // if( remove('ceps', $id))

 // header('location: add.php');
//else
  header('location: index.php');
}

function clear_messages(){
    unset($_SESSION['message']);
}

function verificacamposPOST($adouEdit){
    {
       $nome        = $_POST['nome'];
       $email       = $_POST['email1'];
       $datNasc     = $_POST['datNasc'];
       $linkedin    = $_POST['linkedin'];       
       $idade       = $_POST['idade'];
       $tec         = $_POST['tec'];
        
       $tecno = "";
        if(!empty($_POST['tec'])){
        foreach ($_POST['tec'] as $te=>$value)
                {if($tecno != "") $tecno .= ",";
                    $tecno .= $value;                
                }}
        else $tecno = "Sem seleção;";
      global $dados;
       $dados = array(
                     'nome'         => $nome,
                     'email'        => $email,
                     'dNasc'        => $datNasc,
                     'Url_linkedin' => $linkedin,
                     'idade'        => $idade,
                     'tecnologias'  => $tecno
                     );      
        if($adouEdit == "add"){
       $_SESSION['nome']    = $nome;
       $_SESSION['datNasc'] = $datNasc;
       $_SESSION['email']   = $email;
       $_SESSION['linkedin']= $linkedin;
       $_SESSION['idade']   = $idade;  
       $_SESSION['tecno']   = $tecno;  
       add($dados);  
   } else $_SESSION['dados'] = $dados;
   }
}

    

