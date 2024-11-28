<?php
/*
* Project Cody
* Autor: Ewerton Mendonça
* Descrição: Addon que cria páginas estáticas como Erro 404 sem utilização de Template.
*/
require_once('addons/Addon.class.php');
require_once('modules/Template.class.php');

class StaticPages extends Addon {
    
    public function __construct($router) {
        $router->addRoute('/about', array($this, "about"));
        $router->addRoute('/404', array($this, "error"));
        $router->addRoute('/container', array($this, "container"));
        $router->addRoute('/fluid', array($this, "fluid"));
        $router->addRoute('/grid', array($this, "grid"));
        $router->addRoute('/cards', array($this, "cards"));
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

    public function grid() {
        $t = new Template();
        $options = [
            [
               [
                    'align' => 'start', /* ou 'center' ou 'end',*/
                    'content' => 'Linha 1, coluna 1',
                    'width'   => '2',
                ],
                [
                    'align' => 'start', /* ou 'center' ou 'end',*/
                    'content' => 'Linha 1, coluna 2',
                    'width'   => '4',
                ],
                [
                    'align' => 'start', /* ou 'center' ou 'end',*/
                    'content' => 'Linha 1, coluna 3',
                    'width'   => '6',
                ],
            ],
            [
               [
                    'align' => 'start', /* ou 'center' ou 'end',*/
                    'content' => 'Linha 2, coluna 1',
                    'width'   => '6',
                ],
                [
                    'align' => 'center', /* ou 'center' ou 'end',*/
                    'content' => 'Linha 2, coluna 2',
                    'width'   => '4',
                ],
                [
                    'align' => 'end', /* ou 'center' ou 'end',*/
                    'content' => 'Linha 2, coluna 3',
                    'width'   => '2',
                ],
            ],
        ];
        $html = $t->grid($options);

        $options = [
            'title' => 'Cody ;D',
            'content' => $html,
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


        $html = $t->page([
            'title' => 'Cody :D',
            'content' => $html,
        ]);
        $t->out($html);
    }
}