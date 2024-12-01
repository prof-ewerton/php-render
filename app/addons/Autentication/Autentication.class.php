<?php
/*
* Project Cody
* Autor: Ewerton Mendonça
* Descrição: Classe inicial com rotas e chamadas para outros módulos.
*/
require_once('addons/Addon.class.php');
require_once('addons/Autentication/views/initialPage.php');
require_once('addons/Autentication/views/registerUserPage.php');
require_once('addons/Autentication/controllers/loginController.php');
require_once('addons/Autentication/controllers/RegisterController.class.php');

class Autentication extends Addon {

    public function __construct($router) {
        $router->addRoute('/', array($this, "login"));
        $router->addRoute('/autentication', array($this, "autentication"));
        $router->addRoute('/register-form', array($this, "registerForm"));
        $router->addRoute('/register', array(new RegisterController(), "registerUser"));
    }

    public function login() {
        initialPage();
    }

    public function autentication() {
        loginController();
    }

    public function registerForm() {
        registerUserPage();
    }
}