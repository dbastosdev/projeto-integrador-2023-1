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
require_once('Login.class.php');

// Instancia um objeto da classe login para usar seus métodos.
$login = new Login($pdo);

// ACTION DE LOGIN:
if(!empty($_REQUEST['action_type']) && $_REQUEST['action_type'] == 'login'){
   
    // Segurança básica - filtra os inputs
                        // método     // name do input    // método de filtro
    $email = filter_input(INPUT_POST, 'inputEmail', FILTER_SANITIZE_SPECIAL_CHARS); 
    $password = filter_input(INPUT_POST, 'inputPassword', FILTER_SANITIZE_SPECIAL_CHARS); 
    
    $login->login($email, $password);
}

// ACTION DE LOGOUT:
if(!empty($_REQUEST['action_type']) && $_REQUEST['action_type'] == 'logout'){ 

    $login->logout();
}

// ACTION DE CREATE NEW USER:
if(!empty($_REQUEST['action_type']) && $_REQUEST['action_type'] == 'create'){
   
    // Segurança básica - filtra os inputs
    $cnpj = filter_input(INPUT_POST, 'inputCnpj', FILTER_SANITIZE_SPECIAL_CHARS); 
    $user = filter_input(INPUT_POST, 'inputUser', FILTER_SANITIZE_SPECIAL_CHARS); 
    $companyName = filter_input(INPUT_POST, 'inputCompanyName', FILTER_SANITIZE_SPECIAL_CHARS); 
    $email = filter_input(INPUT_POST, 'inputEmail', FILTER_SANITIZE_SPECIAL_CHARS); 
    $password = filter_input(INPUT_POST, 'inputPassword', FILTER_SANITIZE_SPECIAL_CHARS); 
    
    $login->create($cnpj, $email,  $password, $user, $companyName);
}

