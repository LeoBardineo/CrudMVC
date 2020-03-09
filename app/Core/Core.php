<?php

class Core{
    public function start($urlGet){
        // Se não tiver sido definido o GET pagina, então por padrão vai ser home
        if(!isset($urlGet['pagina'])){
            $urlGet['pagina'] = 'home';
        }

        // Deixa a primeira letra em maiúsculo e adiciona Controller no final, para poder acessar a classe pelo nome, o ação define qual metodo do controller vai ser executado
        $controller = ucfirst($urlGet['pagina'].'Controller');
        $acao = 'index';

        // Se a classe não existir, ele vai exibir a pagina de erro 
        if(!class_exists($controller)){
            $controller = 'ErroController';
        }

        // Executa o metodo index do controller, sem parametros
        call_user_func_array(
            array(new $controller, $acao), array()
        );
        
    }
}