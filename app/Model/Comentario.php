<?php

class Comentario{
    public static function selecionarComentarios($idPost){
        $con = Connection::getConn();
        $sql = "SELECT * FROM comentario WHERE id_postagem = :id ORDER BY id DESC";
        $sql = $con->prepare($sql);
        $sql->bindValue(':id', $idPost, PDO::PARAM_INT);
        $sql->execute();

        $resultado = array();

        while($row = $sql->fetchObject('Comentario')){
            $resultado[] = $row;
        }

        return $resultado;
    }

    public static function inserir($reqPost){
        $id = $reqPost['id'];
        $nome = $reqPost['nome'];
        $comentario = $reqPost['comentario'];

        if(empty($nome) || empty($comentario)){
            throw new Exception("Preencha todos os campos!");
            return false;
        }

        $nome = htmlspecialchars($nome);
        $comentario = htmlspecialchars($comentario);

        $con = Connection::getConn();
        $sql = "INSERT INTO comentario (nome, mensagem, id_postagem) VALUES (:nome, :msg, :idpost)";
        $sql = $con->prepare($sql);
        $sql->bindValue(':idpost', $id);
        $sql->bindValue(':nome', $nome);
        $sql->bindValue(':msg', $comentario);
        $res = $sql->execute();

        if($res == 0){
            throw new Exception("Falha ao alterar publicação.");
            return false;
        }

        return true;
    }
}