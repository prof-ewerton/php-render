<?php
/*
* Project Cody
* Autor: Ewerton Mendonça
* Descrição: 
*/
require_once('addons/Autentication/views/notRegisteredPage.php');
require_once('modules/persistence/postgres/CodyUserDAO.class.php');

function loginController() {
    $params = Router::$POST;

    //echo json_encode($params);
    //exit();

    if (isset($params['email']) && isset($params['password'])) {
        $email = $params['email'];
        $password = $params['password'];
        
        try {
            $dao = new CodyUserDAO();
            $user = $dao->searchUser($email, $password);
        
            // TODO: registra a sessão no 
            
            echo $user->json();

            //header('Location: /dashboard/user');
        } catch (Exception $e) {
            echo "Erro ao buscar usuário ou email e/ou password não encontrado no banco. " . $e->getMessage();
        }
        exit();
    }
    // TODO: Verifica se o usuário está cadastrado no banco.
    // TODO: Caso esteja: Exibe a página de dashboard. (Qual delas??? Qualquer usuário pode fazer uma turma ou apenas usuários autorizados?)
    // TODO: Caso não esteja: Exibir uma página de usuário não cadastrado com um link para realizar o cadastro.
}