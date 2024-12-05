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
        // TODO: Alterar addRoute para receber outra parâmetro com o método (GET, POST etc.)
        $router->addRoute('/',              [$this, "login"]); // TODO: Transformar em Classe
        $router->addRoute('/autentication', [$this, "autentication"]); // Verficar se Pages também podem ser transformadas em classes
        $router->addRoute('/register-form', [$this, "registerForm"]);
        $router->addRoute('/register',      [new RegisterController(), "registerUser"]);
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