<?php
/*
* Project Cody
* Autor: Ewerton Mendonça
* Descrição: Módulo que gera HTML baseados no Bootstrap
*/


class Template {


    /*
    * Recebe a localização relativa do template a partir da pasta components 'Page' e
    * um array correspondente as chaves e valores substitutos.
    */
    public function view(string $tpl, array $vars): string {
        $path = getcwd() . DIRECTORY_SEPARATOR . 'template' . DIRECTORY_SEPARATOR . 'components' . DIRECTORY_SEPARATOR;

        $html = file_get_contents($path . strtolower($tpl) . '.tpl');

        // Generate tokens for your variable keys;
        $keys = array_map(fn($key) => '{{' . $key . '}}', array_keys($vars));

        // Substitute tokens:
        $html = str_replace($keys, $vars, $html);
        
        return $html;
    }

    public function out(string $content) {
        echo $content;
        // exit();
    }

}