<?php
/*
* Project Cody
* Autor: Ewerton Mendonça
* Descrição: 
*/
require_once('addons/Autentication/views/notRegisteredPage.php');

function loginController() {
    $params = Router::$POST;

    echo json_encode($params);

    if (isset($params['email']) && isset($params['password'])) {

    }

    if (false) {

    } else {
        notRegisteredPage();
    }
    // TODO: Verifica se o usuário está cadastrado no banco.
    // TODO: Caso esteja: Exibe a página de dashboard. (Qual delas??? Qualquer usuário pode fazer uma turma ou apenas usuários autorizados?)
    // TODO: Caso não esteja: Exibir uma página de usuário não cadastrado com um link para realizar o cadastro.
}