<?php

class Postagem{
    public static function selecionaTodos(){
        $con = Connection::getConn();
        $sql = "SELECT * FROM postagem ORDER BY id DESC";
        $sql = $con->prepare($sql);
        $sql->execute();

        $resultado = array();

        while($row = $sql->fetchObject('Postagem')){
            $resultado[] = $row;
        }

        if(!$resultado){
            throw new Exception("Não foi encontrado nenhum registro no banco!");
        }

        return $resultado;
    }

    public static function selecionaPorId($idPost){
        $con = Connection::getConn();
        $sql = "SELECT * FROM postagem WHERE id = :id";
        $sql = $con->prepare($sql);
        $sql->bindValue(':id', $idPost, PDO::PARAM_INT);
        $sql->execute();

        $resultado = $sql->fetchObject('Postagem');

        if(!$resultado){
            throw new Exception("Não foi encontrado nenhum registro no banco!");
        }else{
            $resultado->comentarios = Comentario::selecionarComentarios($resultado->id);
        }

        return $resultado;
    }

    public static function insert($dadosPost){
        $titulo = $dadosPost['titulo'];
        $conteudo = $dadosPost['conteudo'];

        if(empty($titulo) || empty($conteudo)){
            throw new Exception("Preencha todos os campos!");
            return false;
        }

        $titulo = htmlspecialchars($titulo);
        $conteudo = htmlspecialchars($conteudo);

        $con = Connection::getConn();
        $sql = "INSERT INTO postagem (titulo, conteudo) VALUES (:tit, :cont)";
        $sql = $con->prepare($sql);
        $sql->bindValue(':tit', $titulo);
        $sql->bindValue(':cont', $conteudo);
        $res = $sql->execute();

        if($res == 0){
            throw new Exception("Falha ao inserir publicação.");
            return false;
        }

        return true;
    }

    public static function update($dadosPost){
        $id = $dadosPost['id'];
        $titulo = $dadosPost['titulo'];
        $conteudo = $dadosPost['conteudo'];

        if(empty($titulo) || empty($conteudo)){
            throw new Exception("Preencha todos os campos!");
            return false;
        }

        $titulo = htmlspecialchars($titulo);
        $conteudo = htmlspecialchars($conteudo);

        $con = Connection::getConn();
        $sql = "UPDATE postagem SET titulo = :tit, conteudo = :cont WHERE id = :id";
        $sql = $con->prepare($sql);
        $sql->bindValue(':id', $id);
        $sql->bindValue(':tit', $titulo);
        $sql->bindValue(':cont', $conteudo);
        $res = $sql->execute();

        if($res == 0){
            throw new Exception("Falha ao alterar publicação.");
            return false;
        }

        return true;
    }

    public static function delete($id){
        $con = Connection::getConn();
        $sql = "DELETE FROM comentario WHERE id_postagem = :id";
        $sql = $con->prepare($sql);
        $sql->bindValue(':id', $id);
        $res = $sql->execute();

        if($res == 0){
            throw new Exception("Falha ao deletar publicação.");
            return false;
        }

        $sql = "DELETE FROM postagem WHERE id = :id";
        $sql = $con->prepare($sql);
        $sql->bindValue(':id', $id);
        $res = $sql->execute();

        if($res == 0){
            throw new Exception("Falha ao deletar publicação.");
            return false;
        }

        return true;
    }
}