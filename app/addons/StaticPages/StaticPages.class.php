<?php
/*
* Project Cody
* Autor: Ewerton Mendonça
* Descrição: Addon que cria uma página inicial (padrão do sistema) e a página de erro 404.
*/
require_once('addons/Addon.class.php');
require_once('modules/Template.class.php');

class StaticPages extends Addon {
    
    public function __construct($router) {
        $router->addRoute('/', array($this, "index"));
        $router->addRoute('/about', array($this, "about"));
        $router->addRoute('/404', array($this, "error"));
    }

    public function index() {
        $t = new Template();
        
        $html = $t->view('topbar', [
            'title' => 'Cody ;D',
            'icon' => BASE_PATH . 'template\assets\robot.svg',
        ]);

        $html = $t->view('page', [ 
            'title' => 'Teste =-=-=-=-=-=',
            'content' => $html,
        ]);
        $t->out($html);
    }

    public function error() {
        echo <<<EOL
        <html lang="pt-br">
        <body>
        <h1>Cody :'(</h1>
        <p>Ocorreu um erro no sistema.</p>
        <p>Entre em contato com o administrador.</p>
        </body>
        EOL;
    }
    
    public function about() {
        echo <<<EOL
        <html lang="pt-br">
        <body>
        <h1>Cody :'(</h1>
        <p>ABOUT</p>
        </body>
        EOL;
    }
}