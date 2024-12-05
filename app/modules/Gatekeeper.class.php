<?php
/*
* Project Cody
* Autor: Ewerton Mendonça
* Descrição: Verifica se a página pode ou não ser exibida.
* Também verifica se o conteúdo pode ou não ser exibido, dependendo do nível de acesso da entidade.
*/
require_once("modules/persistence/entities/CodyUser.class.php");

class GateKeeper {

    public static function login(CodyUser $user) {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (isset($_SESSION['logged_in'])) {
            $_SESSION['logged_in'] = $user;
        }
    }

    public static function logout() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (isset($_SESSION['logged_in'])) {
            $_SESSION['logged_in'] = "";
        }
    }

    public static function isLoggedIn(): bool {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (isset($_SESSION['logged_in'])) {
            return true;
        }
        return false;
    }

    public static function getLoggedInUserEntity(): CodyUser {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (isset($_SESSION['logged_in'])) {
            return $_SESSION['logged_in'];
        }
        throw new Exception("Nenhum usuário logado!");
    }
}