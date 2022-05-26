<?php
// include "mostrarerros.php";
session_start();
include "conectadb.php";
include "mostrarerros.php";
if ($_SESSION["logado_site"] === 'true') {


$cliente = $_POST["cliente"]; 
$ok = $_POST["confirmacao"];
// echo $cliente;   
// echo '<BR>';
// echo $ok;

    $ip_loc = $_SERVER['REMOTE_ADDR'];
    // '201.159.85.1';
    $json = file_get_contents('http://api.ipstack.com/'.$ip_loc.'?access_key=7627be486652d6300b7afa84ef5d3fd3');
    $obj = json_decode($json);
    ini_set("allow_url_fopen", 1);
    $estado = $obj->region_name;
    $pais = $obj->country_name;
    $cidade = $obj->city;
    $latitude = $obj->latitude;
    $longitude = $obj->longitude;
    $continente = $obj->continent_name;
        //  incluir local_desc no comnado SQL;
    $msg = 'Acessado em '.$continente.', pais: '.$pais.', estado: '.$estado.', cidade: '.$cidade.', latitude: '.$latitude.', longitude: '.$longitude.'';

        
if ($ok){
    $pasta = 'arquivos/'.$cliente;
    if (rmdir($pasta)) {
        $ip = $_SERVER['REMOTE_ADDR'];
        $user_log = $_SESSION["nome_completo"];
        $data_mod = Date('d/m/y-h:i:s');
        $acao_mod = "Deletar cliente";
        $status_mod = "Sucesso";
        $info_mod = "Cliente ".$cliente." deletado";
        $sql = 'INSERT INTO log(usuario, data_mod, acao, status_mod, local_mod, info,local_desc ) VALUES ("'.$user_log.'","'.$data_mod.'","'.$acao_mod.'","'.$status_mod.'","'.$ip.'","'.$info_mod.'","'.$msg.'")';
        $con->query($sql);

        header('location:index.php?erro=clientedeletado');
    }else{
        $ip = $_SERVER['REMOTE_ADDR'];  
    $user_log = $_SESSION["nome_completo"];
    $data_mod = Date('d/m/y-H:i:s');
    $acao_mod = "Deletar cliente";
    $status_mod = "Fracasso";
    $info_mod = "cliente ".$cliente." não foi deletado, RMdir não foi possivel";
    $sql = 'INSERT INTO log(usuario, data_mod, acao, status_mod, local_mod, info,local_desc ) VALUES ("'.$user_log.'","'.$data_mod.'","'.$acao_mod.'","'.$status_mod.'","'.$ip.'","'.$info_mod.'","'.$msg.'")';
    $con->query($sql);
    }
}else{

    $ip = $_SERVER['REMOTE_ADDR'];  
    $user_log = $_SESSION["nome_completo"];
    $data_mod = Date('d/m/y-H:i:s');
    $acao_mod = "Deletar cliente";
    $status_mod = "Fracasso";
    $info_mod = "cliente ".$cliente." não foi deletado, OK não foi recebido";
    $sql = 'INSERT INTO log(usuario, data_mod, acao, status_mod, local_mod, info,local_desc ) VALUES ("'.$user_log.'","'.$data_mod.'","'.$acao_mod.'","'.$status_mod.'","'.$ip.'","'.$info_mod.'","'.$msg.'")';
    $con->query($sql);
}
// echo $cliente;
// echo '<BR>';
// echo $ok;
}else{
    header("Location: login.php?erro=acessonegado");
};
?>