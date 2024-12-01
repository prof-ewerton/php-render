<?php
/*
* Project Cody
* Autor: Ewerton Mendonça
* Descrição: Módulo com uma função que gera uma página inicial para o sistema de autenticação.
*/
require_once('modules/Template.class.php');

function initialPage() {
    $t = new Template();

// TODO: Deixar o formulário com verificação antes do envio.

    $linkRegister = $t->link([
        'url' => '/register-form',
        'text' => 'Fazer parte do Cody :D (Cadastro de usuários)',
    ]);

    $form = $t->form([
       'method' => 'POST',
       'action' => '/autentication',
       'description' => 'Autenticação necessária para acessar o sistema.',
       'others' => "<p class='form-text'>$linkRegister</p>",
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
        'header' => 'CODY ;D',
        'content' => 'Bem vindo ao Cody, o sistema de gerenciamento de conteúdo educacional com learning analytics e gamificação.',
    ]);

    $html .= $t->card([
        'header' => 'AUTENTICAÇÃO DE USUÁRIO',
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
        'css' => '<link rel="stylesheet" href="template/assets/css/bootstrap.min.css">',
        'scripts-top' => '<script src="template/assets/js/bootstrap.bundle.min.js"></script>',
        'scripts-botton' => '<script src="template/assets/js/bootstrap.bundle.min.js"></script>',
    ]);

    $t->out($html);
}