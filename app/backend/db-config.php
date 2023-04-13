<?php
/* 
 * classe de configuração do banco de dados via pdo 
 */

$bdServidor	=	'localhost'; 
$bdUsuario	=	'root';
$bdSenha	=	'root';
$bdBanco	=	'sistema-fit';

try{ 
    $pdo = new PDO("mysql:host=".$bdServidor.";dbname=".$bdBanco, $bdUsuario, $bdSenha);  
    // debug: teste de conexão via pdo
    //echo "conexão realizada com sucesso";
}catch(PDOException $e){ 
    echo "Falha	na	conexão	com	o	banco	de	dados:	".	$e->getMessage();
    die();
} 
