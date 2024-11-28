<?php
/*
* Project Cody
* Autor: Ewerton Mendonça
* Descrição: 
*/
require_once('addons/Autentication/views/notRegistredPage.php');

function registerController() {
    $params = Router::$POST;

    echo json_encode($params);

    if (isset($params['email']) && isset($params['password'])) {

    }
}