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
        $router->addRoute('/container', array($this, "container"));
        $router->addRoute('/fluid', array($this, "fluid"));
        $router->addRoute('/cards', array($this, "cards"));
        $router->addRoute('/form', array($this, "form"));
        
    }

    public function index() {
        $t = new Template();

        $html = $t->view('topbar', [
            'title' => 'Cody ;D',
            'content' => 'Bem vindo ao Cody, o sistema de gerenciamento de conteúdo educacional com learning analytics e gamificação.',
        ]);

        // TODO: Precisa fazer um container de grade para o conteúdo

        // TODO: Fazer uma funcionalidade no template que receba um array e monte, com os templates, um formulário.


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

    public function container() {
        $t = new Template();

        $options = [
            'title' => 'Cody ;D',
            'content' => 'Bem vindo ao Cody, o sistema de gerenciamento de conteúdo educacional com learning analytics e gamificação.',
        ];
        $html = $t->page($options);

        $t->out($html);
    }

    public function fluid() {
        $t = new Template();

        $options = [
            'title' => 'Cody ;D',
            'content' => 'Bem vindo ao Cody, o sistema de gerenciamento de conteúdo educacional com learning analytics e gamificação.',
            'type' => 'fluid',
        ];
        $html = $t->page($options);

        $t->out($html);
    }

    public function cards() {
        $t = new Template();

        // Cria um card vazio.
        $options = [];
        $html = $t->card($options);

        // Criação de mais um card, com conteúdo e cabeçalho.
        $options = [
            'header' => 'Teste de cabeçalho',
            'content' => 'Teste de conteúdo de um card.',
        ];
        $html .= $t->card($options);

        // Criação de mais um card, com título e conteúdo.
        $options = [
            'title' => 'Teste de título de um card',
            'content' => 'Teste de conteúdo de um card.',
        ];
        $html .= $t->card($options);

        // Criação de mais um card, com título, legenda e conteúdo.
        $options = [
            'title' => 'Teste de título de um card',
            'subtitle' => 'Legenda do card',
            'content' => 'Teste de conteúdo de um card.',
        ];
        $html .= $t->card($options);

        // Criação de mais um card, imagem e conteúdo.
        $options = [
            'image' => [
                'src' => 'https://placebear.com/300/200',
                'alt' => 'Descrição da imagem',
            ],
            'content' => 'Teste de conteúdo de um card.',
        ];
        $html .= $t->card($options);
        
        // Criação de mais um card com título, legenda, botão e conteúdo.
        $options = [
            'title' => 'Teste de título de um card',
            'subtitle' => 'Legenda do card',
            'content' => 'Teste de conteúdo de um card.',
            'button' => [
                'text' => 'Google',
                'href' => 'https://www.google.com',
            ]
        ];
        $html .= $t->card($options);

        // Criação de mais um card com apenas conteúdo personalizado.
        $options = [
            'others' => 'Conteúdo personalizado',
        ];
        $html .= $t->card($options);


        $html = $t->view('page', [ 
            'title' => 'Teste cards',
            'content' => $html,
        ]);
        $t->out($html);
    }

    public function form() {
        $t = new Template();


        $options = [];
        $html = $t->form($options);




        $options = [
            'header' => 'Fomulário de autenticação',
            'others' => $html,
        ];
        $html = $t->card($options);

        $html = $t->view('page', [ 
            'title' => 'Teste cards',
            'content' => $html,
        ]);
        $t->out($html);
    }
}