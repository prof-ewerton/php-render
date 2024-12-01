<?php
/*
* Project Cody
* Autor: Ewerton Mendonça
* Descrição: Módulo com uma função que gera uma página inicial para o sistema de autenticação.
*/
require_once('modules/Template.class.php');

function notRegisteredPage() {
    $t = new Template();

    // TODO: Criação de um link (ou bottão de link)
    
    $html = $t->card([
        'header' => 'CODY :0',
        'content' => 'Infelizmente não achamos este usuário. Verifique se você digitou corretamente a senha e o e-mail. Você também pode se cadastrar gratuitamente. utilizando o link abaixo.',
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