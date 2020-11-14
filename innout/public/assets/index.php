<?php
define(DIRECTORY_SEPARATOR,';');

require_once(dirname(__FILE__,2) .DIRECTORY_SEPARATOR. '..\src\config\database.php');
//require_once(dirname(__FILE__,2) .DIRECTORY_SEPARATOR. '..\src\views\login.php');

require_once(MODEL_PATH .DIRECTORY_SEPARATOR. '\Login.php');

$login = new Login([
   'email' => 'admin@cod3r.com.br',
   'password' => 'a' 
]);

try{
    $login->checkLogin();
    echo "Logado com sucesso!";
}catch(Exception $e){
    echo "Problema de login:";
}