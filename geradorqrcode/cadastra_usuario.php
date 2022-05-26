<?php
session_start();
include "conectadb.php";
// include "mostrarerros.php";
// $_SESSION["logado_site"] = 'true';
if ($_SESSION["adm_lvl"] == 'yes') {


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
        //  incluir local_desc no comnado SQL;,"'.$msg.'"
    $msg = 'Acessado em '.$continente.', pais: '.$pais.', estado: '.$estado.', cidade: '.$cidade.', latitude: '.$latitude.', longitude: '.$longitude.'';

    $nome_completo = $_POST["nome_completo"];
    $nome = $_POST["nome"];
    $senha = $_POST["senha"];
    $senhabd = md5($senha);
    $sql = 'INSERT INTO login(nome_completo, nome_login, senha) VALUES ("'.$nome_completo.'","'.$nome.'","'.$senhabd.'")';
    $con->query($sql);


        $ip = $_SERVER['REMOTE_ADDR'];  
        $user_log = $_SESSION["nome_completo"];
        $data_mod = Date('d/m/y-H:i:s');
        $acao_mod = "Cadastrar usuário";
        $status_mod = "Sucesso";
        $info_mod = "usuario ".$nome_completo." cadastrado";
        $sql = 'INSERT INTO log(usuario, data_mod, acao, status_mod, local_mod, info,local_desc ) VALUES ("'.$user_log.'","'.$data_mod.'","'.$acao_mod.'","'.$status_mod.'","'.$ip.'","'.$info_mod.'"local_desc)';
        $con->query($sql);

        

    Header('Location: index.php');
}

?>