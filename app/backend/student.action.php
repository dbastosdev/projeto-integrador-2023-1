<?php
/* 
 * arquivo de configuração das ações relacionadas a login
 */

// inicia a sessão
session_start();

// REQUISIÇÕES DE ARQUIVOS DO ACTION. SEMPRE SERÁ ASSIM. 
// Faz a requisição da configuração do banco de dados com conexão ao mysql
// Faz a requisição da classe que contém todos os métodos relacionados ao login
require_once('db-config.php');
require_once('Student.class.php');

// Instancia um objeto da classe login para usar seus métodos.
$student = new Student($pdo);

// ACTION DE CREATE NEW STUDENT:
if(!empty($_REQUEST['action_type']) && $_REQUEST['action_type'] == 'create'){
   
    // Segurança básica - filtra os inputs
    $name = filter_input(INPUT_POST, 'inputName', FILTER_SANITIZE_SPECIAL_CHARS); 
    $email = filter_input(INPUT_POST, 'inputEmail', FILTER_SANITIZE_SPECIAL_CHARS); 
    $sport = filter_input(INPUT_POST, 'inputSport', FILTER_SANITIZE_SPECIAL_CHARS); 
    $paymentDate = filter_input(INPUT_POST, 'inputStart', FILTER_SANITIZE_SPECIAL_CHARS); 
    $paymentStatus = filter_input(INPUT_POST, 'inputPayment', FILTER_SANITIZE_SPECIAL_CHARS); 
    
    $student->create($name, $email, $paymentDate, $paymentStatus, $sport);
}

// ACTION DE EDIT STUDENT:
if(!empty($_REQUEST['action_type']) && $_REQUEST['action_type'] == 'edit'){
   
    // Segurança básica - filtra os inputs
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT); 

    $student->edit($id);
}

// ACTION DE UPDATE STUDENT:
if(!empty($_REQUEST['action_type']) && $_REQUEST['action_type'] == 'update'){
  
    // Segurança básica - filtra os inputs
    $name = filter_input(INPUT_POST, 'inputName', FILTER_SANITIZE_SPECIAL_CHARS); 
    $email = filter_input(INPUT_POST, 'inputEmail', FILTER_SANITIZE_SPECIAL_CHARS); 
    $sport = filter_input(INPUT_POST, 'inputSport', FILTER_SANITIZE_SPECIAL_CHARS); 
    $paymentDate = filter_input(INPUT_POST, 'inputStart', FILTER_SANITIZE_SPECIAL_CHARS); 
    $paymentStatus = filter_input(INPUT_POST, 'inputPayment', FILTER_SANITIZE_SPECIAL_CHARS); 
    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT); 
    
    $student->update($name, $email, $paymentDate, $paymentStatus, $sport, $id);
}

// ACTION DE DELETE STUDENT:
if(!empty($_REQUEST['action_type']) && $_REQUEST['action_type'] == 'delete'){
    
    // Segurança básica - filtra os inputs
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT); 

    $student->delete($id);
}



