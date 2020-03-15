<meta charset="UTF-8">
<?php
header("Content-type: text/html; charset=utf-8");
define ('HOST', '127.0.0.1');
define ('USUARIO', 'root');
define ('SENHA', '');
define ('DB', 'phpmvc');

$conexao = mysqli_connect(HOST, USUARIO, SENHA, DB) or die ('Não foi possível conectar ao banco de dados!');

mysqli_query($conexao, "SET NAMES 'utf8'");
mysqli_query($conexao, 'SET character_set_connection=utf8');
mysqli_query($conexao, 'SET character_set_client=utf8');
mysqli_query($conexao, 'SET character_set_results=utf8');

$sql = "SELECT * FROM postagem";
$result = mysqli_query($conexao, $sql);

while($dados = mysqli_fetch_assoc($result)){
    echo $dados['titulo']."<br>";
    echo $dados['conteudo']."<br><br>";
}

?>