<?php
/*
* Project Cody
* Autor: Ewerton Mendonça
* Descrição: Módulo com uma função que gera uma página inicial para o sistema de autenticação.
*/
require_once('modules/Template.class.php');

function registerUserPage() {
    $t = new Template();

// TODO: Deixar o formulário com verificação antes do envio.

    $form = $t->form([
       'method' => 'POST',
       'action' => '/registerController',
       'description' => 'Precisamos de algumas informações. Não se preocupe, não compartilhamos qualquer informações com terceiros.',
       'form' => [
            'email' => [
                'placeholder' => 'Digite seu e-mail',
                'label' => 'E-mail:',
                'variable' => 'email',
            ],
            'password' => [
                'placeholder' => 'Digite sua senha',
                'label' => 'Password:',
                'variable' => 'password',
            ],
            'submit' => [
                'style' => 'primary',
                'text' => 'Submit',
            ],
        ],
    ]);

    
    $html = $t->card([
        'header' => 'CODY >D',
        'content' => 'Que bom que você quer fazer parte do Cody!',
    ]);

    $html .= $t->card([
        'header' => 'CADASTRO DE USUÁRIO',
        'others' => $form,
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