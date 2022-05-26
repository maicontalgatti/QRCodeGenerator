<?php
include 'conectadb.php';
// include 'mostrarerros.php';

$url_bruta = $_SERVER["REQUEST_URI"];

$token_arquivo = substr($_SERVER["REQUEST_URI"], strpos($_SERVER["REQUEST_URI"], '/')+33);
// $url2 = str_replace($url_bruta,"","/geradorqrcode/final.php?arquivo=");

// echo $url2;
// echo '<br>';

$sql= 'SELECT * FROM arquivos WHERE token="'.$token_arquivo.'"';
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_array($result);
$caminho = $row["arquivo_atual"];

echo "caminho - ".$caminho;
echo '<BR>';
echo "caminho - ".$caminho;
echo '<br>';
echo "url branca - ".$url_bruta;
echo '<br>';
echo "token arquivo - ".$token_arquivo;
echo '<br>';
// $diretorio = dir($caminho);

// echo'<button href="'.$caminho.'">:'

Header("Location:".$caminho."");



?>