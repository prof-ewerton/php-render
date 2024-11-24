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
    *  TODO: Outro ponto é decidir se envia em HTML ou JSON pelo out.
    * $options = [
    *   'type' => 'container' ou 'fluid',
    *   'title' => 'título da página',
    *   'favicon => 'source do favicon',
    *   'css' => 'lista de links css acrescentados a página';
    *   'scripts-top => 'lista de scripts adicionados ao início da página';
    *   'scripts-botton => 'lista de scripts adicionados ao final da página';
    *   'content' => 'Conteúdo dentro da tag body',
    * ]
    */
    public function page(array $options): string {
        $opt = [];

        if (isset($options['content'])) {
            $value = $options['content'];
            $opt['content'] = "<div class='container'>$value</div>";
        } else { exit(); }

        if (isset($options['type'])) {
            $value = $options['type'];
            if ($options['type'] == 'fluid') {
                $opt['content'] = "<div class='container-fluid'>$value</div>";
            }
        }

        if (isset($options['title'])) {
            $value = $options['title'];
            $opt['title'] = "<title>$value</title>";
        } else { $opt['title'] = ''; }

        if (isset($options['favicon'])) {
            $value = $options['favicon'];
            $opt['favicon'] = "<link rel='icon' href='$value' type='image/x-icon' >";
        } else { $opt['favicon'] = '<link rel="icon" href="template/assets/favicon_io/favicon.ico" type="image/x-icon">'; }
/*
        // TODO: CSS
        if (isset($options['favicon'])) {
            $value = $options['favicon'];
            $opt['favicon'] = "<link rel='icon' href='$value' type='image/x-icon' >";
        } else { $opt['favicon'] = '<link rel="icon" href="template/assets/favicon_io/favicon.ico" type="image/x-icon">'; }
        
        // TODO: Scripts no header
        if (isset($options['favicon'])) {
            $value = $options['favicon'];
            $opt['favicon'] = "<link rel='icon' href='$value' type='image/x-icon' >";
        } else { $opt['favicon'] = '<link rel="icon" href="template/assets/favicon_io/favicon.ico" type="image/x-icon">'; }
        
        // TODO: Scripts no footer
        if (isset($options['favicon'])) {
            $value = $options['favicon'];
            $opt['favicon'] = "<link rel='icon' href='$value' type='image/x-icon' >";
        } else { $opt['favicon'] = '<link rel="icon" href="template/assets/favicon_io/favicon.ico" type="image/x-icon">'; }
*/
        return $this->view('page', $opt);
    }

    /* TODO: Talvez a page seja já o out, porque mesmo que o out seja chamado sem nada, gera um html com body vazio, mas com o css e o js do bootstrap.
    *  TODO: Outro ponto é decidir se envia em HTML ou JSON pelo out.
    * $options = [
    *    [
    *        [
    *            'align' => 'start' ou 'center' ou 'end',
    *            'content' => 'Conteúdo da célula',
                 'width' => '1' ou '2' ou '3' ou '4' ou '5' ou '6' ou '7' ou '8' ou '9' ou '10' ou '11' ou '12',
    *        ],
    *    ],
    * ]
    */
    public function grid(array $options): string {
        $html = '';
        foreach ($options as $row) {
            $html .= '<div class="row">';
            foreach ($row as $col) {

                if(isset($col['align'])) {
                    $align = $col['align'];
                } else { $align = 'center'; }

                if(isset($col['content'])) {
                    $content = $col['content'];
                } else { $content = ''; }

                if(isset($col['width'])) {
                    $width = '-' . $col['width'];
                } else { $width = ''; }


                $html .= "<div class='col{$width} text-{$align}'>{$content}</div>";
            }
            $html .= '</div>';
        }
        
        return $html;
    }

    /*
    * $options = [
    *    'header' => 'Título do card',
    *   'title' => 'Título do conteúdo do card',
    *   'subtitle' => 'Subtítulo do card',
    *   'content' => 'Conteúdo do card',
    *   'image' => [
    *       'src' => 'src da imagem',
    *       'alt' => 'descrição da imagem',
    *    ],
    *    'button' => [
    *        'text' => 'Google',
    *        'href' => 'https://www.google.com',
    *    ],
    *    'others' => 'Qualquer outro conteúdo personalizado',
    * ]
    */
    public function card(array $options): string {
        $opt = [];

        if (isset($options["content"])) {
            $value = $options["content"];
            $opt["card-text"] = "<p class='card-text'>$value</p>";
        } else { $opt["card-text"] = ''; }


        if (isset($options["header"])) {
            $value = $options["header"];
            $opt["card-header"] = "<div class='card-header'>$value</div>";
        } else { $opt["card-header"] = ''; }


        if (isset($options["title"])) {
            $value = $options["title"];
            $opt["card-title"] = "<h5 class='card-title'>$value</h5>";
        } else { $opt["card-title"] = ''; }


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

    /*
    * $options = [
    *    'email' => [
    *        'email' => 'email@email.com',
    *    ]
    * ]
    */
    public function form(array $options): string {
        $opt = [];

        return $this->view('form', $opt);
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