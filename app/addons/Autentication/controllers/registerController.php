<?php
/*
* Project Cody
* Autor: Ewerton Mendonça
* Descrição: 
*/
require_once('addons/Autentication/views/notRegistredPage.php');

function registerController() {
    $params = Router::$POST;
    echo $params;
    //echo json_encode($params);
    
        // TODO: Pesquisa se já está cadastrado.
        // TODO: Se estiver, redireciona para a página de mensagem de usuário já cadastrado.
        // TODO: Senão, realiza o cadastro.
    
}