<?php

header("Content-type: text/html; charset=utf-8");

require_once 'vendor/autoload.php';

require_once 'lib/Database/Connection.php';

require_once 'app/Core/Core.php';

require_once 'app/Controller/HomeController.php';
require_once 'app/Controller/PostController.php';
require_once 'app/Controller/AdminController.php';
require_once 'app/Controller/SobreController.php';
require_once 'app/Controller/ErroController.php';

require_once 'app/Model/Postagem.php';
require_once 'app/Model/Comentario.php';

$template = file_get_contents('app/Template/estrutura.html');

// Pega todo o conteúdo entre o start e o end
ob_start();
$core = new Core;
$core->start($_GET);
$saida = ob_get_contents();
ob_end_clean();

// Modifica o template, substituindo o {{area_dinamica}} pelo conteudo pego pelo ob
$templatePronto = str_replace('{{area_dinamica}}', $saida, $template);

// Carrega apenas o .css necessário
if(isset($_GET['pagina'])){
    if(substr($_GET['pagina'], -1) == '/'){
        $_GET['pagina'] = substr($_GET['pagina'], 0, -1);
    }
    $css = $_GET['pagina'];
}else{
    $css = 'home';
}

$style = "<link rel='stylesheet' href='http://localhost/CrudMVC/asset/css/$css.css'>";
$templatePronto = str_replace('{{style_dinamico}}', $style, $templatePronto);

echo $templatePronto;