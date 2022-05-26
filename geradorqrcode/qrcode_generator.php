<?php
// session_start();
// AND ($_SESSION["authenticator"]==='1')

// if ($_SESSION["logado_site"]===true) {
    include "conectadb.php";
    include('phpqrcode/qrlib.php');
    $tokeres = $_POST["tokenarquivo"];
    
    $token_arquivo_pagina= $_POST["tokenarquivo"];
    $cliente= $_POST["nomecliente"];
    $sql = 'SELECT * FROM arquivos WHERE token="'.$token_arquivo_pagina.'"';
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);
    $token = $row["token"];
    $caminho_arquivo_banco = ("?arquivo=".$token);
    
    if ($caminho_arquivo_banco != "") {
    //     include('phpqrcode/qrlib.php');
    //     $token = $row["token"];
    // $caminho_arquivo_banco = ("?arquivo=".$token);
    QRcode::png("documentos.ampla.ind.br/geradorqrcode/final.php".$caminho_arquivo_banco."");
    /*  

documentos.ampla.ind.br/geradorqrcode/final.php?arquivo=

    */
    };                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      
?>