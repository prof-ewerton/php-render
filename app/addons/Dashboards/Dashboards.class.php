<?php
/*
* Project Cody
* Autor: Ewerton Mendonça
* Descrição: Dashboards para usuário, estudante e professor.
*/
require_once('addons/Addon.class.php');
require_once('modules/Template.class.php');
require_once('modules/GateKeeper.class.php');

class Dashboards extends Addon {

    public function __construct($router) {
        $router->addRoute('/dashboard/user', array($this, "dashboardUser"));
        $router->addRoute('/dashboard/group', array($this, "dashboardGroup"));
    }

    public function getMenu() {
        return [
            ['title' => 'Home',   'href' => '/'       ],
            ['title' => 'Cursos', 'submenu' => [
                ['title' => 'Administrar cursos...', 'href' => '#' ],
                ['bar' => true],
                ['title' => 'Outra ação sobre cursos...',  'href' => '#' ],
                ['title' => 'Outra ação sobre cursos...',  'href' => '#' ],
                ['title' => 'Outra ação sobre cursos...',  'href' => '#' ],
            ]],
            ['title' => 'Grupos', 'submenu' => [
                ['title' => 'Administrar grupos...', 'href' => '/dashboard/group' ],
                ['bar' => true],
                ['title' => 'Outra ação sobre cursos...',  'href' => '#' ],
                ['title' => 'Outra ação sobre cursos...',  'href' => '#' ],
                ['title' => 'Outra ação sobre cursos...',  'href' => '#' ],
            ]],
            ['title' => 'Sobre',  'href' => '/sobre'  ],
        ];
    }

    public function getPage(string $content = '', array $menu = []) {
        $t = new Template();

        $html = $t->topbar([
            'brand' => ['title' => 'Cody ;D', 'href' => '/' ],
            'menu' => $menu,
            'end' => 'Logout',
        ]);
        
        $html = $t->page([
            'title' => 'Cody :D',
            'content' => $html . $content,
        ]);

        $t->out($html);
    }

    public function dashboardUser() {
        (new GateKeeper)->guard();

        try {
            $userUUID = (new GateKeeper)->getLoggedInUserUUID();



            $content = "<h3>Bem vindo, " . $userUUID . "!</h3>";
        } catch (Exception $e) {
            $content = "<h3>Erro ao buscar usuário logado!</h3>";
        }

        $t = new Template();
        $grid = $t->grid([
            [
                [
                    'content' => '',
                ],
            ],
            [
                [
                    'content' => '',
                    'width'   => '3',
                ],
                [
                    'content' => $content,
                    'width'   => '6',
                ],
                [
                    'content' => '',
                    'width'   => '3',
                ],
            ],
        ]);

        $this->getPage($grid, $this->getMenu());
    }

    public function dashboardGroup() {
        echo "Dashboard de grupos";
        (new GateKeeper)->isLoggedIn();
        exit;



        if (! (new GateKeeper)->isLoggedIn()) {
            header('Location: /');
            exit;
        }

        $t = new Template();
        $grid = $t->grid([
            [
                [
                    'content' => '',
                ],
            ],
            [
                [
                    'content' => '',
                    'width'   => '3',
                ],
                [
                    'content' => '<h3>Administração de grupos</h3>',
                    'width'   => '6',
                ],
                [
                    'content' => '',
                    'width'   => '3',
                ],
            ],
        ]);

        $this->getPage($grid, $this->getMenu());        
    }
}