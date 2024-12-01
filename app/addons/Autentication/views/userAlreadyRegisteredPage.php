<?php
/*
* Project Cody
* Autor: Ewerton Mendonça
* Descrição: Módulo com uma função que gera uma página inicial para o sistema de autenticação.
*/
require_once('modules/Template.class.php');

function userAlreadyRegisteredPage() {
    $t = new Template();

    // TODO: Criação de um link (ou bottão de link)
    
    $html = $t->card([
        'header' => 'CODY :0',
        'content' => 'Você já faz parte da nossa turma. Este e-mail já está cadastrado no sistema.',
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
    ]);

    $t->out($html);
}