<?php
/*
* Project Cody
* Autor: Ewerton Mendonça
* Descrição: Addon que cria uma página inicial (padrão do sistema) e a página de erro 404.
*/
require_once('addons/Addon.class.php');
require_once('modules/Template.class.php');

class Test extends Addon {
    
    public function __construct($router) {
        $router->addRoute('/test', array($this, "index"));
    }

    public function index() {
        $t = new Template();
        
        $html = $t->view('topbar', [
            'title' => 'Cody ;D',
        ]);

        $html = $t->view('page', [ 
            'title' => 'Teste =-=-=-=-=-=',
            'content' => $html,
        ]);
        $t->out($html);
    }
}