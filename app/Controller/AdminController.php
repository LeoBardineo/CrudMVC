<?php

class AdminController{
    public function index(){
        $loader = new \Twig\Loader\FilesystemLoader('.\app\View');
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('admin.html');

        $objPostagens = Postagem::selecionaTodos();

        $parametros = array();
        $parametros['postagens'] = $objPostagens;

        $conteudo = $template->render($parametros);
        echo $conteudo;
    }

    public function create(){
        $loader = new \Twig\Loader\FilesystemLoader('.\app\View');
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('create.html');

        $parametros = array();

        $conteudo = $template->render($parametros);
        echo $conteudo;
    }

    public function insert(){
        try {
            Postagem::insert($_POST);
            header('Location: http://localhost/CrudMVC/admin/index');
        } catch (\Exception $e) {
            echo "<script>alert('".$e->getMessage()."')</script>";
            echo "<script>location.href='http://localhost/CrudMVC/admin/create'</script>";
        }
    }

    public function change($paramId){
        $loader = new \Twig\Loader\FilesystemLoader('.\app\View');
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('update.html');

        $post = Postagem::selecionaPorId($paramId);
        
        $parametros = array();
        $parametros['id'] = $post->id;
        $parametros['titulo'] = $post->titulo;
        $parametros['conteudo'] = $post->conteudo;

        $conteudo = $template->render($parametros);
        echo $conteudo;
    }

    public function update(){
        try {
            Postagem::update($_POST);
            header('Location: http://localhost/CrudMVC/admin/index');
        } catch (\Exception $e) {
            echo "<script>alert('".$e->getMessage()."')</script>";
            echo "<script>location.href='http://localhost/CrudMVC/admin/change/".$_POST[id]."'</script>";
        }
    }

    public function delete($paramId){
        try {
            Postagem::delete($paramId);
            header('Location: http://localhost/CrudMVC/admin/index');
        } catch (\Exception $e) {
            echo "<script>alert('".$e->getMessage()."')</script>";
            echo "<script>location.href='http://localhost/CrudMVC/admin/index'</script>";
        }

    }
}