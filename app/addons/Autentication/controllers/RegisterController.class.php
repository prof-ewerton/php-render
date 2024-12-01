<?php
/*
* Project Cody
* Autor: Ewerton Mendonça
* Descrição: 
*/
require_once('addons/Autentication/views/userAlreadyRegisteredPage.php');

require_once('modules/persistence/postgres/CodyUserDAO.class.php');

class registerController {

    function registerUser() {
        $params = Router::$POST;
        //echo json_encode($params);
        //exit();
        
        if (isset($params['email']) && isset($params['password']) && isset($params['nome'])) {
            $email = $params['email'];
            $password = $params['password'];
            $name = $params['nome'];
            $dao = new CodyUserDAO();

            if ($dao->searchUserByEmail($email)) {
                userAlreadyRegisteredPage();
            } else {
                $user = new CodyUser();
                $user->setEmail($email);
                $user->setPassword($password);
                $user->setName($name);
                $user->save();

                header("Location: /");
                exit();
            }
        }
    }
}