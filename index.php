<?php

header("Content-type: text/html; charset=utf-8");

require_once 'vendor/autoload.php';

require_once 'lib/Database/Connection.php';

require_once 'app/Core/Core.php';

require_once 'app/Controller/HomeController.php';
require_once 'app/Controller/Postcontroller.php';
require_once 'app/Controller/ErroController.php';

require_once 'app/Model/Postagem.php';

// require_once 'app/Template/estrutura.html';

$template = file_get_contents('app/Template/estrutura.html');

// Pega todo o conteúdo entre o start e o end
ob_start();
    $core = new Core;
    $core->start($_GET);
    $saida = ob_get_contents();
ob_end_clean();

// Modifica o template, substituindo o {{area_dinamica}} pelo conteudo pego pelo ob
$templatePronto = str_replace('{{area_dinamica}}', $saida, $template);
echo $templatePronto;

?>