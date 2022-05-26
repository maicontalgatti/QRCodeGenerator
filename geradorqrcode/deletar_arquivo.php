<?php
include 'conectadb.php';
session_start();
$projeto = $_POST["nomeprojeto"];
$cliente = $_POST["nomecliente"];
$arquivo = $_POST["nomearquivo"];
$arquivo_del = $_POST["nomearquivo"];

$dir = "arquivos/".$cliente."/".$projeto."/".$arquivo;
// echo $dir;
unlink($dir);
$sql='DELETE FROM arquivos WHERE nome_exibicao="'.$arquivo.'"';
$con->query($sql);

    $ip = $_SERVER['REMOTE_ADDR'];  
    $user_log = $_SESSION["nome_completo"];
    $data_mod = Date('d/m/y-H:i:s');
    $acao_mod = "Deletar arquivo";
    $status_mod = "Sucesso";
    $info_mod = "Arquivo ".$arquivo." deletado";
    $sql = 'INSERT INTO log(usuario, data_mod, acao, status_mod, local_mod, info ) VALUES ("'.$user_log.'","'.$data_mod.'","'.$acao_mod.'","'.$status_mod.'","'.$ip.'","'.$info_mod.'")';
    $con->query($sql);
    header("location: projeto.php?cliente=".$cliente);
?> 