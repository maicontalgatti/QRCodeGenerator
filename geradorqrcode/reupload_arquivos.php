<?php
// include "mostrarerros.php";
session_start();
include "conectadb.php";
include "mostrarerros.php";
if ($_SESSION["logado_site"] === 'true') {
    $projeto = $_POST["nomeprojeto"];
    $cliente = $_POST["nomecliente"];
    $arquivo = $_POST["nomearquivo"];
    $data = $_POST["dataarquivo"];
    $token = $_POST["token"];

    $dir = "arquivos/".$cliente."/".$projeto."/";
    $deletar = ($dir.$arquivo);
    unlink($deletar);

    $sql= 'SELECT * FROM arquivos WHERE nome_exibicao="'.$arquivo.'"';
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);
    $deleta_esse = $row["arquivo_atual"];

    $file = $_FILES["arquivo"];
    // $sql= 'SELECT * FROM arquivos WHERE nome_exibicao="'.$arquivo.'"';
    // $result = mysqli_query($con, $sql);
    // $row = mysqli_fetch_array($result);
    // $arquivo_del = $row["arquivo_atual"];

    $arquivo_atual = ("arquivos/".$cliente."/".$projeto."/".$file["name"]);
    // $caminhotira= ("arquivos/".$cliente."/".$projeto."/");
    // $arquivo_del_2 = str_replace($arquivo_del,("arquivos/".$cliente."/".$projeto."/"),"");

    // echo $arquivo;
    // echo $arquivo_del2;
    // echo '<br>';

    
    // echo $deletar;
    echo '<br>';
    if (move_uploaded_file($file["tmp_name"], "$dir/".$file["name"])) {
        $nome_limpo = $file["name"];
        $caminho = $file["tmp_name"];
        $nome_exibicao = $file["tmp_name"];
    
        $ip = $_SERVER['REMOTE_ADDR'];  
        $user_log = $_SESSION["nome_completo"];
        $data_mod = Date('d/m/y-H:i:s');
        $acao_mod = "manual atualizado";
        $status_mod = "Sucesso";
        $info_mod = "Manual ".$arquivo." substituido por ".$nome_limpo;
        $sql = 'INSERT INTO log(usuario, data_mod, acao, status_mod, local_mod, info ) VALUES ("'.$user_log.'","'.$data_mod.'","'.$acao_mod.'","'.$status_mod.'","'.$ip.'","'.$info_mod.'")';
        $con->query($sql);
// echo "deletar = ".$deletar;

        $sql='UPDATE arquivos SET arquivo_atual="'.$arquivo_atual.'" WHERE token="'.$token.'"';
        mysqli_query($con, $sql);
        $sql='UPDATE arquivos SET ultima_versao="'.$nome_limpo.'" WHERE token="'.$token.'"';
        mysqli_query($con, $sql);
        $sql='UPDATE arquivos SET data_att="'.$data.'" WHERE token="'.$token.'"';
        mysqli_query($con, $sql);
        
        header("location: projeto.php?cliente=".$cliente);
       









    // echo $arquivo_atual;
    
    // echo $projeto, " - projeto";
    // echo '<br>';
    // echo $cliente, " - cliente";
    // echo '<br>';
    // echo $arquivo ," - arquivo";
    // echo '<br>';
    // echo $file , " - file";
    // echo '<br>';
    // echo $nome_limpo , " - nome limpo";
    // echo '<br>';
    // echo $caminho,  " - caminho";
    // echo '<br>';
    // echo $nome_exibicao , " - nome exibicao";
    // echo '<br>';
    // echo $arquivo_atual ," - arquivo atual";
    // echo '<br>';
    // echo $deleta_esse ," - deleta esse";

    //aqui funciona tudo ,só descomentar
// UPDATE Customers
    // SET ContactName='Juan'
    // WHERE Country='Mexico';
    // $con->query($sql);
    } else {
        echo "Erro, o arquivo nao pode ser enviado.";
    }
}else{
    header("Location: login.php?erro=acessonegado");
};

?>