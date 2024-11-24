<?php
/*
* Project Cody
* Autor: Ewerton Mendonça
* Descrição: Módulo que gera HTML baseados no Bootstrap
*/


class Template {

    /*
    * Métodos que geram um html a partir de um array de opções e um template completo do componente do bootstrap.
    */

    /* TODO: Talvez a page seja já o out, porque mesmo que o out seja chamado sem nada, gera um html com body vazio, mas com o css e o js do bootstrap.
    * $options = [
    *   
    * ]
    */
    public function page(array $options): string {

        return "";
    }

    public function grid(array $options): string {

        return "";
    }

    /*
    * $options = [
    *   'title' => 'Título do card',
    *   'subtitle' => 'Subtítulo do card',
    *   'content' => 'Conteúdo do card',
    *   'image' => [
    *       'src' => 'src da imagem',
    *       'alt' => 'descrição da imagem',
    *    ],
        'button' => [
            'text' => 'Google',
            'href' => 'https://www.google.com',
        ],
        'others' => 'Qualquer outro conteúdo personalizado',
    * ]
    */
    public function card(array $options): string {
        $opt = [];

        if (isset($options["content"])) {
            $value = $options["content"];
            $opt["card-text"] = "<p class='card-text'>$value</p>";
        } else { $opt["card-text"] = ''; }


        if (isset($options["title"])) {
            $value = $options["title"];
            $opt["card-header"] = "<h5 class='card-title'>$value</h5>";
        } else { $opt["card-header"] = ''; }


        if (isset($options["subtitle"])) {
            $value = $options["subtitle"];
            $opt["card-subtitle"] = "<h6 class='card-subtitle mb-2 text-body-secondary'>$value</h6>";
        } else { $opt["card-subtitle"] = ''; }


        if (isset($options["image"]["src"])) {
            $src = $options["image"]["src"];

            if (isset($options["image"]["alt"])) {
                $alt = $options["image"]["alt"];
            } else { $alt = ''; }

            $opt["card-img"] = "<img src='$src' class='card-img-top' alt='$alt'>";
        } else { $opt["card-img"] = ''; }


        if (isset($options["button"]["text"]) && isset($options["button"]["href"])) {
            $text = $options["button"]["text"];
            $href = $options["button"]["href"];

            $opt["card-button"] = "<a href='$href' class='btn btn-primary'>$text</a>";
        } else { $opt["card-button"] = ''; }

        if (isset($options["others"])) {
            $value = $options["others"];
            $opt["others"] = $value;
        } else { $opt["others"] = ''; }

        
        return $this->view('card', $opt);
    }

    public function form(array $options): string {

        return "";
    }


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