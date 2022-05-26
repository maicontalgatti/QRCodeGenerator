<?php 

session_start();
include "conectadb.php";
$nome =   $_SESSION["nome"];
$senha_atual = $_POST["senhaatual"];
$senha_nova = $_POST["senhanova"];
$senha_nova2 = $_POST["senhanova2"];

$senha_nova_md5 = md5($senha_nova);
$senha_nova2_md5 = md5($senha_nova2);
$senha_atual_md5 = md5($senha_atual);

if ($senha_nova_md5 === $senha_nova2_md5){
echo $nome;
    $sql = 'SELECT * FROM login WHERE nome_login="'.$nome.'"';
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);
    $senha_atual_bd = $row["senha"];
    
    if ($senha_atual_md5 == $senha_atual_bd){
        //faz o update
        $sql='UPDATE login SET senha="'.$senha_nova2_md5.'" WHERE nome_login="'.$nome.'"';
        $con->query($sql);
        // mysqli_query($con, $sql);

        

        $ip = $_SERVER['REMOTE_ADDR'];
        // '201.159.85.1';
        $json = file_get_contents('http://api.ipstack.com/'.$ip.'?access_key=7627be486652d6300b7afa84ef5d3fd3');
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



        $ip = $_SERVER['REMOTE_ADDR'];  
        $user_log = $_SESSION["nome_completo"];
        $data_mod = Date('d/m/y-H:i:s');
        $acao_mod = "alterou sua senha";
        $status_mod = "Sucesso";
        $info_mod = "null";
        $sql = 'INSERT INTO log(usuario, data_mod, acao, status_mod, local_mod, info,local_desc ) VALUES ("'.$user_log.'","'.$data_mod.'","'.$acao_mod.'","'.$status_mod.'","'.$ip.'","'.$info_mod.'","'.$msg.'")';
        $con->query($sql);


        Header('Location: index.php?erro=senhaaatualizada');
    }else{
        //criar erro de senha atual inserida não corresponde com a averdadeira
        echo $senha_atual_md5." - ".$senha_atual_bd;
        Header('Location: index.php?erro=senhaatualincorreta');
    }

}else{
    //criar erro de senha incorreta
    Header('Location: index.php?erro=senhaatualincorreta');
}


?>