<?php
/*
* Project Cody
* Autor: Ewerton Mendonça
* Descrição: Verifica se a página pode ou não ser exibida.
* Também verifica se o conteúdo pode ou não ser exibido, dependendo do nível de acesso da entidade.
*/
require_once("modules/persistence/entities/CodyUser.class.php");

class GateKeeper {

    public function logout() {
        if (session_status() == PHP_SESSION_NONE) 
            die("<h1>LOGOUT</h1><p>Session status: PHP_SESSION_NONE</p>");

        if (isset($_SESSION['logged_in'])) {
            $_SESSION['logged_in'] = "";
            unset($_SESSION['logged_in']);
        }

        header('Location: /');
    }

    public function login(CodyUser $user) {
        if (session_status() == PHP_SESSION_NONE) 
            die("<h1>LOGIN</h1><p>Session status: PHP_SESSION_NONE</p>");

        if (!isset($_SESSION['logged_in'])) {
            $_SESSION['logged_in'] = $user->getUUID();
        }
    }

    public function guard() {
        if (session_status() == PHP_SESSION_NONE)
            die("<h1>GUARD</h1><p>Session status: PHP_SESSION_NONE</p>");
        if (!isset($_SESSION['logged_in'])) {
            header('Location: /?msg=acesso-negado');
            exit;
        }
    }

    public function isLoggedIn(): bool {
        if (session_status() == PHP_SESSION_NONE) 
            die("<h1>ISLOGGEDIN</h1><p>Session status: PHP_SESSION_NONE</p>");

        return isset($_SESSION['logged_in']);
    }

    public function getLoggedInUserUUID(): string {
        if (session_status() == PHP_SESSION_NONE)
            session_start();

        if (isset($_SESSION['logged_in'])) {
            return $_SESSION['logged_in'];
        } else {
            throw new Exception("Nenhum usuário logado!");
        }
    }
}