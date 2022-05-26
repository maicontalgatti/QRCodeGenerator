<?php 
include 'conectadb.php';
session_start();
include "conectadb.php";
$token = $_POST["tokenarquivo"];
$cliente = $_POST["nomecliente"];
$projeto = $_POST["nomeprojeto"];
$id = $_POST["novo_id"];

// echo $token." - ".$cliente." - ".$projeto." - ".$id;

// $horaagora = Date('d/m/y-h:i:s');

$sql='UPDATE arquivos SET id_equipamento="'.$id.'" WHERE token="'.$token.'"';

if (mysqli_query($con, $sql)){
    //http://documentos.ampla.ind.br/geradorqrcode/projeto.php?cliente=binatural%202

    $ip = $_SERVER['REMOTE_ADDR'];  
    $user_log = $_SESSION["nome_completo"];
    $data_mod = Date('d/m/y-H:i:s');
    $acao_mod = "renomear ID";
    $status_mod = "Sucesso";
    $info_mod = "ID ".$id." cadastrador para token ".$token;
    $sql = 'INSERT INTO log(usuario, data_mod, acao, status_mod, local_mod, info ) VALUES ("'.$user_log.'","'.$data_mod.'","'.$acao_mod.'","'.$status_mod.'","'.$ip.'","'.$info_mod.'")';
    $con->query($sql);

    Header("Location: projeto.php?cliente=".$cliente."");
}
