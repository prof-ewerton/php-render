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
                ['title' => 'Administrar grupos...', 'href' => '#' ],
                ['bar' => true],
                ['title' => 'Outra ação sobre cursos...',  'href' => '#' ],
                ['title' => 'Outra ação sobre cursos...',  'href' => '#' ],
                ['title' => 'Outra ação sobre cursos...',  'href' => '#' ],
            ]],
            ['title' => 'Sobre',  'href' => '/sobre'  ],
        ];
    }

    public function dashboardUser() {
        if (! GateKeeper::isLoggedIn()) {
            header('Location: /');
            exit;
        }

        $t = new Template();


        $html = $t->topbar([
            'brand' => ['title' => 'Cody ;D', 'href' => '/' ],
            'menu' => $this->getMenu(),
            'end' => 'Logout',
        ]);
        
        $html .= $t->grid([
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
                    'content' => '',
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
            'content' => $html
        ]);

        $t->out($html);
    }

    public function teste() {
        $t = new Template();

        $top = $t->card([
            'content' => "<h3>CODY ;D</h3>",
        ]);
        
        $right = $t->card([
            'content' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed convallis egestas ante quis commodo. Fusce consequat leo enim. Cras ac tortor at ex malesuada dictum vel in turpis. Proin sollicitudin at nisl in convallis. Aenean vestibulum sagittis molestie. Vestibulum maximus, orci et volutpat pretium, tellus sem malesuada dui, sed molestie augue ligula in enim. Ut sit amet leo at odio efficitur accumsan. Curabitur molestie velit id ultricies ullamcorper. Mauris vestibulum varius arcu cursus sollicitudin.",
        ]);
        
        $center = $t->card([
            'content' => "Morbi volutpat varius odio a mattis. Integer tempus purus ex, non congue neque varius in. Duis quam eros, pulvinar in nulla quis, gravida lobortis urna. Nulla mattis sapien a lorem consequat, in placerat mauris egestas. Duis consequat id diam lobortis tincidunt. Nam molestie, eros sit amet tristique gravida, dui diam tristique purus, nec mollis neque ante vitae ex. Duis vel imperdiet purus. Fusce ac tempus odio. Curabitur faucibus elit sit amet neque ullamcorper efficitur. Proin dui lorem, consequat nec libero pulvinar, suscipit scelerisque leo. Praesent lectus leo, lacinia non blandit et, tempus in ipsum. In vel varius felis, nec blandit turpis. Integer volutpat lectus eget lacinia malesuada. Mauris sed odio sed tellus sodales lacinia in nec felis.",
        ]);
        
        $left = $t->card([
            'content' => "Pellentesque auctor facilisis lectus, sed venenatis nunc feugiat ut. Fusce blandit consectetur lacinia. Phasellus dignissim lacus erat, at tristique diam ullamcorper et. Donec vitae feugiat ex, vitae finibus nisi. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Ut fringilla finibus leo ac scelerisque. Sed eu dolor in arcu rhoncus porta nec id tellus. Vestibulum ac aliquet purus.",
        ]);
        
        $html = $t->grid([
            [
                [
                    'content' => $top,
                ],
            ],
            [
                [
                    'content' => $left,
                    'width'   => '3',
                ],
                [
                    'content' => $center,
                    'width'   => '6',
                ],
                [
                    'content' => $right,
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
}