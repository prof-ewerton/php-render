<?php
/*
* Project Cody
* Autor: Ewerton Mendonça
* Descrição: 
*/
require_once('addons/Autentication/views/notRegisteredPage.php');
require_once('modules/persistence/postgres/CodyUserDAO.class.php');
require_once('modules/GateKeeper.class.php');

function loginController() {
    $params = Router::$POST;

    if (
        isset($params['email']) && 
        isset($params['password']) &&
        $params['email'] != '' &&
        $params['password'] != ''
        ) {

        $email = $params['email'];
        $password = $params['password'];
        
        $_SESSION['TESTE'] = 'okk';

        try {
            $dao = new CodyUserDAO();
            $user = $dao->searchUser($email, $password);

            (new GateKeeper)->login($user);
        } catch (Exception $e) {
            echo "Erro email e/ou password não encontrado no banco. " . $e->getMessage();
            exit;
        }

        header('Location: /dashboard/user');
        exit;
        
    }
    header('Location: /?msg=preencha-o-formulário');
    exit;
}