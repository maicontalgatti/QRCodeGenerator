
<?php
// include "mostrarerros.php";
session_start();
include "conectadb.php";
include "mostrarerros.php";
if ($_SESSION["logado_site"] === 'true') {
    $projeto = $_POST["nomeprojeto"];
    $cliente = $_POST["nomecliente"];
    $arquivo = $_POST["nomearquivo"];
    echo $projeto;
    echo '<BR>';
    echo $cliente;
    echo '<BR>';
    echo $arquivo;
    echo '<BR>';
}
?>