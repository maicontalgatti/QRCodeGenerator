<?php 

session_cache_expire(1);    
session_start();
include 'conectadb.php';

//$login = ;
//$cripsenha = 
// $_POST["nome"];

$nome = isset($_POST["nome"]) ? addslashes($_POST["nome"]) : "veio nada";
$senhaencryp = isset($_POST["senha"]) ? addslashes($_POST["senha"]) : FALSE;
$senha = md5($senhaencryp);

if ($nome == NULL){
    header("Location: login.php?erro=preenchaoscampos");
}

$sql = 'SELECT * FROM login WHERE nome_login="'.$nome.'"';
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_array($result);
$nomebd = $row["nome_login"];
$senhabd = $row["senha"];
$nomeexibicao = $row["nome_completo"];
$avisado = $row["Locall"];
 
if ($nome != $nomebd){
    header("Location: login.php?erro=nomeincorreto");
}elseif($senha !== $senhabd){
    header("Location: login.php?erro=senhaincorreta");
}else{
    $data = Date('d/m/y-H:i:s');
    $_SESSION["logado_site"] = 'true';
    $_SESSION["nome"] = $nome;
    $_SESSION["nome_completo"] = $nomeexibicao;
    $_SESSION["avisado"] = $avisado;
   
   if ($row["nivel"] === '777') {
        $_SESSION["adm_lvl"] = 'yes';
    }
    // $_SESSION["nome"] = $nome;
    //$data = Date('d/m/y-H:i:s');
    $sql='UPDATE login SET ultimo_acesso="'.$data.'" WHERE nome_login="'.$nomebd.'"';
    // mysqli_query($con, $sql);
    $con->query($sql);

    header("Location: index.php");
};




?>