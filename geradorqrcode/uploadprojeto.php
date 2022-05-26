<?php
// include "mostrarerros.php";
session_start();
include "conectadb.php";
include "mostrarerros.php";
if ($_SESSION["logado_site"] === 'true') {
    $dir = $_POST["path"]."/";
    $cliente = $_POST["cliente"];
    $name = $_POST["projeto"];
    $cria = ($dir.$name);
    mkdir($cria, 0777);

    $ip = $_SERVER['REMOTE_ADDR'];  
    $user_log = $_SESSION["nome_completo"];
    $data_mod = Date('d/m/y-H:i:s');
    $acao_mod = "Projeto cadastrado";
    $status_mod = "Sucesso";
    $info_mod = "Projeto ".$name." cadastrado";
    $sql = 'INSERT INTO log(usuario, data_mod, acao, status_mod, local_mod, info ) VALUES ("'.$user_log.'","'.$data_mod.'","'.$acao_mod.'","'.$status_mod.'","'.$ip.'","'.$info_mod.'")';
    $con->query($sql);

    header('location:projeto.php?cliente='.$cliente);
}else{
    header("Location: login.php?erro=acessonegado");
};
?>