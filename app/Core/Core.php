<?php

class Core{
    public function start($urlGet){
        // Se não tiver sido definido o GET pagina, então por padrão vai ser home
        if(!isset($urlGet['pagina'])){
            $urlGet['pagina'] = 'home';
        }

        if(substr($urlGet['pagina'], -1) == '/'){
            $urlGet['pagina'] = substr($urlGet['pagina'], 0, -1);
        }

        // Deixa a primeira letra em maiúsculo e adiciona Controller no final, para poder acessar a classe pelo nome, o ação define qual metodo do controller vai ser executado
        $controller = ucfirst($urlGet['pagina'].'Controller');
        
        if(isset($urlGet['metodo'])){
            $acao = $urlGet['metodo'];
        }else{
            $acao = 'index';
        }

        // Se a classe não existir, ele vai exibir a pagina de erro 
        if(!class_exists($controller)){
            $controller = 'ErroController';
        }

        if(isset($urlGet['id']) && $urlGet['id'] != null){
            $id[] = $urlGet['id'];
        }else{
            $id = array();
        }

        // Executa o metodo index do controller, com parametros id
        call_user_func_array(
            array(new $controller, $acao), $id
        );
        
    }
}