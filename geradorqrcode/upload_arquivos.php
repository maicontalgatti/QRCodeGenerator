<?php
// include "mostrarerros.php";
session_start();
include "conectadb.php";
include "mostrarerros.php";
if ($_SESSION["logado_site"] === 'true') {

    $projeto = $_POST["nomeprojeto"];
    $cliente = $_POST["nomecliente"];

    $dir = "arquivos/".$cliente."/".$projeto."/";

    $id_equipamento = $_POST["id_equipamento"];


    // recebendo o arquivo multipart
    $file = $_FILES["arquivo"];
    // Move o arquivo da pasta temporariaa     de upload para a pasta de destino
    



//tentar
    /*$filee = $file["name"];
    $nome_tratado = str_replace(',','-',$filee);
    
    if (move_uploaded_file($file["tmp_name"], "$dir/".$nome_tratado)) {
*/




    if (move_uploaded_file($file["tmp_name"], "$dir/".$file["name"])) {
        echo "Arquivo(s) enviado(s) com sucesso!";
        $nome_limpo = $file["name"];
    
        $caminho = $file["tmp_name"];
        $nome_exibicao = $file["tmp_name"];
        $arquivo_atual = ("arquivos/".$cliente."/".$projeto."/".$nome_limpo);
        $token = md5(Date('d/m/y-H:i:s'));
        $hoje = Date('d/m/y-H:i:s');

        $sql = 'INSERT INTO arquivos( id_equipamento,cliente, projeto, token, nome_exibicao, ultima_versao, arquivo_atual, data_att) VALUES ("'.$id_equipamento.'","'.$cliente.'","'.$projeto.'","'.$token.'","'.$nome_limpo.'","'.$nome_limpo.'","'.$arquivo_atual.'","'.$hoje.'")';
        $con->query($sql);

        $ip = $_SERVER['REMOTE_ADDR'];  
        $user_log = $_SESSION["nome_completo"];
        $data_mod = Date('d/m/y-H:i:s');
        $acao_mod = "Upload de novo arquivo";
        $status_mod = "Sucesso";
        $info_mod = "Arquivo ".$nome_limpo." Enviado";
        $sql = 'INSERT INTO log(usuario, data_mod, acao, status_mod, local_mod, info ) VALUES ("'.$user_log.'","'.$data_mod.'","'.$acao_mod.'","'.$status_mod.'","'.$ip.'","'.$info_mod.'")';
        $con->query($sql);


        header("location: projeto.php?cliente=".$cliente);
    } else {
        echo "Erro, o arquivo nao pode ser enviado.";
    }
}else{
    header("Location: login.php?erro=acessonegado");
};

// <?
// function tratar_arquivo_upload($string){
//    // pegando a extensao do arquivo
//    $partes 	= explode(".", $string);
//    $extensao 	= $partes[count($partes)-1];	
//    // somente o nome do arquivo
//    $nome	= preg_replace('/\.[^.]*$/', '', $string);	
//    // removendo simbolos, acentos etc
//    $a = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûüýýþÿŔŕ?';
//    $b = 'aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuuyybyRr-';
//    $nome = strtr($nome, utf8_decode($a), $b);
//    $nome = str_replace(".","-",$nome);
//    $nome = preg_replace( "/[^0-9a-zA-Z\.]+/",'-',$nome);
//    return utf8_decode(strtolower($nome.".".$extensao));
// }
// $file = $_FILES['arquivo'];
// $filename = tratar_arquivo_upload(utf8_decode($file['name']));
// ?>

?>
