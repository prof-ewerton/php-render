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
        $router->addRoute('/grid', array($this, "grid"));
        $router->addRoute('/cards', array($this, "cards"));
        $router->addRoute('/form', array($this, "form"));
        $router->addRoute('/formpost', array($this, "formpost"));
    }

    public function formpost() {
        $t = new Template();

        $params = Router::$POST;

        $html = $t->card([
            'header' => 'CODY ;D',
            'content' => "<code>" . json_encode($params) . "</code>",
        ]);

        $html = $t->grid([
            [
                [
                    'content' => '',
                    'width'   => '3',
                 ],
                 [
                    'align' => 'start',
                    'content' => $html,
                    'width'   => '6',
                 ],
                 [
                    'content' => '',
                    'width'   => '3',
                 ],
             ],
        ]);        

        $html = $t->page([
            'title' => 'Cody :D',
            'content' => $html,
            'button' => [
                'type' => 'submit',
                'value' => 'Enviar',
            ]
        ]);

        $t->out($html);
    }

    public function index() {
        $t = new Template();

        $form = $t->form([
           'method' => 'POST',
           'action' => '/formpost',
           'description' => 'Autenticação necessária para acessar o sistema.',
           'button' => [
                'value' => 'Autenticar',
           ],
           'email' => [
               'placeholder' => 'Digite seu e-mail',
           ],
           'password' => [
               'placeholder' => 'Digite sua senha',
           ],
        ]);

        
        $html = $t->card([
            'header' => 'CODY ;D',
            'content' => 'Bem vindo ao Cody, o sistema de gerenciamento de conteúdo educacional com learning analytics e gamificação.',
        ]);

        $html .= $t->card([
            'header' => 'AUTENTICAÇÃO DE USUÁRIO',
            'content' => $form,
        ]);


        $html = $t->grid([
            [
                [
                    'content' => '',
                    'width'   => '3',
                 ],
                 [
                    'align' => 'start',
                    'content' => $html,
                    'width'   => '6',
                 ],
                 [
                    'content' => '',
                    'width'   => '3',
                 ],
             ],
        ]);


        $html = $t->page([
            'title' => 'Cody :D',
            'content' => $html,
            //'content' => 'Bem vindo ao Cody, o sistema de gerenciamento de conteúdo educacional com learning analytics e gamificação.',
            'css' => '<link rel="stylesheet" href="template/assets/css/bootstrap.min.css">',
            'scripts-top' => '<script src="template/assets/js/bootstrap.bundle.min.js"></script>',
            'scripts-botton' => '<script src="template/assets/js/bootstrap.bundle.min.js"></script>',
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

    public function form() {
        $t = new Template();


        $options = [];
        $html = $t->form($options);




        $options = [
            'header' => 'Fomulário de autenticação',
            'others' => $html,
        ];
        $html = $t->card($options);

        $html = $t->page([
            'title' => 'Cody :D',
            'content' => $html,
        ]);
        $t->out($html);
    }
}