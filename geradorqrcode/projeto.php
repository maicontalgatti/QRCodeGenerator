<?php
// include "mostrarerros.php";
session_cache_expire(1);
session_start();
include "conectadb.php";
include "phpqrcode/qrlib.php";
// include "mostrarerros.php";
// $_SESSION["logado_site"] = 'true';
if ($_SESSION["logado_site"] == 'true') {
    $nome_sess = $_SESSION["nome"];
    $data_e = Date('d/m/y-H:i:s');
    $sql='UPDATE login SET ultimo_acesso="'.$data_e.'" WHERE nome_login="'.$nome_sess.'"';
    // mysqli_query($con, $sql);
    $con->query($sql);
?>
    <!DOCTYPE html>
    <html lang="pt-br">

    <head>
        <?php
        include "includes.php";
        // include "conectadb.php";
        ?>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src='https://code.jquery.com/jquery-2.2.4.min.js'></script>
        <script src='https://s3-us-west-2.amazonaws.com/s.cdpn.io/130527/qrcode.js'></script>
        <style>
            .vintepad {
                padding-left: 20px;
                padding-right: 20px;
            }

            /* Style the button that is used to open and close the collapsible content */
            .collapsible {
                background-color: #eee;
                color: #444;
                cursor: pointer;
                padding: 10px;
                width: 100%;
                border: none;
                text-align: left;
                outline: none;
                font-size: 15px;
            }

            /* Add a background color to the button if it is clicked on (add the .active class with JS), and when you move the mouse over it (hover) */
            .active,
            .collapsible:hover {
                background-color: #ccc;
            }

            .content {
                padding: 0 100px;
                background-color: white;
                max-height: 0;
                overflow: hidden;
                transition: max-height 0.2s ease-out;
            }

            .backcolor {
                background-color: #eee;
            }

            .back1 {
                background-color: #e4e6e7;
                padding: 15px 15px 15px 15px;
            }

            .back2 {
                background-color: #ffffff;

                padding: 20px 20px 20px 20px;
            }

            #nomeproj {
                font-size: 20px;
            }

            .close-modal {
                margin-top: 20px !important;
                margin-right: 20px !important;
            }
        </style>
    </head>

    <body>
        <?php
        $link_completo_atual =  $_SERVER["REQUEST_URI"];
        $tcliente = str_replace("/geradorqrcode/projeto.php?cliente=", "", $link_completo_atual);

        ?>
        <div class="row">
            <div class='col-9' style='text-align:right'></div>
            <div class='col-2' style='text-align:right;padding-right:0px!important;'>
                <?php
                $nome = $_SESSION["nome"];
                $nome_completo = $_SESSION["nome_completo"];
                ?>
                <p style='margin-top:35px;color:white;size:0px;'><strong style='border:2px solid black;padding-left:10px;padding-right:10px;border-radius:3px;background-color:black;padding-top:3px;padding-bottom:4px;'><?php echo $nome_completo; ?></strong></p>
            </div>
            <div class='col-1' style='text-align:right;padding-left:0px!important;'>
                <a href='sair.php'>
                    <img src='imgs/exit02.png' style='float:left;width:30px;height:30px;margin-right:30px;margin-top:30px; '>
                </a>
            </div>
        </div>
        <div class="row">
            <div class='col-12'>
                <div style="width:90%; margin: auto;margin-top:20px;">
                    <div class="back1">
                        <div class="back2">
                            <div class="row" style="border-bottom:solid #ededed 1px;">
                                <div class="col-12">
                                    <div class="row vintepad">
                                        <h5>Gerenciador de Manuais </h5>
                                    </div>
                                    <div class="row vintepad" style="font-size: 17px;">
                                        <p>
                                            Selecione e altere os dados cadastrados sobre clientes,
                                            Organizado em CLIENTE -> PROJETO -> ARQUIVO -> QRCODE.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-2" style="border-right: solid #ededed 1px;">
                                    <div class='row'>
                                        <div class='col-12' style="margin-top:5px">
                                            <a href='index.php' style='margin-left:90%'><img style='width:20px' src='imgs/back.ico'></a>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <!--  -->

                                        <a id="myBtn" class="hover" href='#addfoldermodal' rel="modal:open" style="border: solid #dee2e6 2px;border-radius: 10px;margin-left: auto;margin-right:auto;margin-top:15px;margin-bottom:5px;padding-right: 5px;padding-left: 5px;">
                                            <img src='imgs/folder+_blue.png' class='icons' style='margin-right:10px;'> NOVO PROJETO</a>
                                        </a>


                                        <!-- ADICIONAR PROJETO -->


                                        <div id="addfoldermodal" class="modal" style='height:200px;width:250px;'>
                                            <form action="uploadprojeto.php" method="post">
                                                <div>
                                                    <h5>Cadastrar novo projeto</h5>
                                                    <?php
                                                    $t_cliente = str_replace("%20", " ", $tcliente);
                                                    $path = ("arquivos/" . $t_cliente);
                                                    ?>
                                                    <input type="text" class="hidden" name="cliente" value="<?php echo $t_cliente; ?>">
                                                    <input type="text" class="hidden" name="path" value="<?php echo $path; ?>">
                                                    <input type="text" id="nomecliente" name="projeto" placeholder=" Nome do projeto ">
                                                    <br><br>
                                                    <input type="submit" id="enviarcliente" value="ok" style='margin-left:30px'>
                                                    <a href="#" rel="modal:close"><button type="submit">CANCELAR</button></a>
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                    <div class='row'>
                                        <div class='col-12'>
                                            <br>
                                            <h5>ATENÇÃO!!</h5>
                                            <br>
                                            <ul style='padding-right:5px;padding-left:20px!important;'>
                                                <li>
                                                    Realize o upload de apenas um arquivo por vez.
                                                </li>
                                                <li>
                                                    Acesse configurações de cada arquivo no icone de uma engranagem à direita.
                                                </li>
                                                <li>
                                                    Não é possível excluir diretórios com subpastas ou arquivos.
                                                </li>
                                                </table>
                                        </div>
                                    </div>



                                    <?php
                                    if ($_SESSION["adm_lvl"] === "1") {
                                        echo "
                                        <div class='row'>
                                        <div class='col-1'>
                                        </div>
                                        <div class='col-10'>
                                            <form  action='cadastra_usuario.php' method='POST' style='text-align:center'>
                                                <h5>Novos usuarios</h5>
                                                <h7>nome_completo</h7><br>
                                                <input type='text' name='nome_completo' style='width:100%'><br>
                                                <h7>nome</h7><br>
                                                <input type='text' name='nome'  style='width:100%'><br>
                                                <h7>senha</h7><br>
                                                <input type='password' name='senha'  style='width:100%'><br>
                                                <input type='submit' name='ok' value='cadastrar'> 
                                            </form>
                                        </div>
                                        <div class='col-1'>
                                        </div>
                                        </div>
                                        
                                        
                                        ";
                                    }

                                    ?>
                                </div>

                                <div class="col-10">

                                    <div class='row'>
                                        <div class='col-12' style='margin-top:5px'>
                                            <?php
                                            echo "
                                <h6 id='caminhox'><a href='index.php'>CLIENTES </a> > " . $t_cliente . "</h6>
                                "
                                            ?>
                                        </div>
                                    </div>
                                    <?php

                                    $t_cliente = str_replace("%20", " ", $tcliente);
                                    $path = ("arquivos/" . $t_cliente);
                                    $diretorio = dir($path);
                                    $i = 0;

                                    while ($projeto = $diretorio->read()) {
                                        if (($projeto == ".") || ($projeto == "..")) {
                                        } else {
                                            echo "
                                <div class='row vintepad hoverrowb ' >
                                    <div class='col-12'style='border:solid 1px #c9cdd1;border-radius:7px;margin-top:2px;margin-left:10px;'>
                                        <div class='row '>
                                            <div class='col-10 '> 
                                                <div class='row '><button type='button back ' id='demo" . $i . "' style='background-color:#ffffff;border:none;width:100%;'>
                                                    <div style='margin-top: 10px!important;margin-left: 10px!important;'>
                                                        <img src='imgs/folder_blue.ico' class='icons' style='float:left;'>
                                                    </div>
                                                    
                                                        <div >
                                                           <P id='nomeproj' class='' style='text-align:left;'>" . $projeto . " </P>
                                                        </div>
                                                    
                                                </div> </button>  
                                                <div class='row'>
                                                    <div class='col-12 collapse' id='toaqui" . $i . "' styles='padding-left:0px!important;padding-right:0px!important'>
                                                    ";
                                    ?>
                                            <script>
                                                $("#demo<?php echo $i; ?>").click(function() {
                                                    var a = $('#toaqui<?php echo $i; ?>').css("display");
                                                    if (a == "none") {
                                                        $('#toaqui<?php echo $i; ?>').css("display", "block");
                                                    } else {
                                                        $('#toaqui<?php echo $i; ?>').css("display", "none");
                                                    }
                                                    // console.log(a);
                                                    // console.log("alooo");
                                                    // console.log(<?php //echo $i; ?>);
                                                });
                                            </script>
                                            <?php

                                            $sql = "SELECT * FROM arquivos";
                                            $result = mysqli_query($con, $sql);
                                            $j = 0;
                                            echo '
                                        <div style="border: none; border-radius: 5px; margin-top: 5px; margin-bottom: 5px;padding-left:12px;padding-right:12px;">
                                            <div class="row" >                                                                  
                                                <div class="col-2 quebralinha" name="#"><h6>ID equipamento</h6></div>                                                                    
                                                <div class="col-3 quebralinha" name="ultima_versao"><h6>Nome Arquivo</h6></div>                                                                  
                                                <div class="col-2 quebralinha" name="arquivo_atual"><h6>Caminho do arquivo</h6></div>
                                                <div class="col-2 quebralinha" name="qrcode"><h6>QRCODE</h6></div>
                                                <div class="col-3 quebralinha" name="data_att"><h6>Data atualização</h6></div>
                                              
                                            </div> 
                                            ';
                                            while ($row = mysqli_fetch_array($result)) {
                                                if ($row["projeto"] == $projeto && $row["cliente"] == $t_cliente) {

                                                    echo '
                                        <form href="#manipulaarquivomodal' . $j . '" method="post">
                                            <div class="row hoverrow" style="border: solid #c9cdd1 2px; border-radius: 10px; margin-top: 1px; margin-bottom: 1px;">                                                                  
                                                <div class="col-2 quebralinha" name="#">' . $row["id_equipamento"] . '</div>                                                                    
                                                <div class="col-3 quebralinha" name="ultima_versao">' . $row["ultima_versao"] . '</div>                                                                  
                                                <div class="col-2 quebralinha" id="copy' . $j . '" style="text-align:center;" name="arquivo_atual"><a href="https://documentos.ampla.ind.br/geradorqrcode/final.php?arquivo=' . $row["token"] . '" target="_blank">https://documentos.ampla.ind.br/geradorqrcode/final.php?arquivo=' . $row["token"] . '</a>
                                                <input type="hidden" id="link' . $j . '" name="link" value="https://documentos.ampla.ind.br/geradorqrcode/final.php?arquivo=' . $row["token"] . '""> 
                                                <br>
                                                <button class="btn" style="border:1px black solid;margin-bottom:5px" data-clipboard-text="https://documentos.ampla.ind.br/geradorqrcode/final.php?arquivo=' . $row["token"] . '">Copiar Link</button>
                                                </div>                
                                                '; ?>
                                                    <script>
                                                        const clipboard = new ClipboardJS('.btn')

                                                        clipboard.on('success', function(e) {
                                                            alert("Texto copiado")
                                                        });

                                                        clipboard.on('error', function(e) {
                                                            alert("Falha ao copiar texto")
                                                        });
                                                    </script>
                                                    <?php
                                                    echo '
                                                
                                                <div class="col-2 quebralinha" name="#">
                                                
                                                <input type="hidden" id="qr-url' . $j . '" value="https://documentos.ampla.ind.br/geradorqrcode/final.php?arquivo=' . $row["token"] . '">
                                                <input type="hidden" id="qr-size' . $j . '" value="120">
                                                <a id="generate-qr-code' . $j . '" class="hover" 
                                                style="border:1px black solid;border-radius:5px;background-color:#e5e5e5;margin-top:10px;margin-bottom:10px;,
                                                padding-top:6px;padding-bottom:6px;padding-right:5px;padding-left:5px;white-space: nowrap;overflow: hidden;">
                                                
                                                Mostrar QRCODE
                                                </a>
                                                
                                                <br>
                                                <div id="qrcode' . $j . '" style="margin-top:10px;margin-bottom:10px"></div>
                                                '; ?>
                                                    <script>
                                                        $('#generate-qr-code<?php echo $j; ?>').on('click', function() {

                                                            // Clear Previous QR Code
                                                            $('#qrcode<?php echo $j; ?>').empty();

                                                            // Set Size to Match User Input
                                                            $('#qrcode<?php echo $j; ?>').css({
                                                                'width': $('#qr-size<?php echo $j; ?>').val(),
                                                                'height': $('#qr-size<?php echo $j; ?>').val(),
                                                            })
                                                            // Generate and Output QR Code
                                                            $('#qrcode<?php echo $j; ?>').qrcode({
                                                                width: $('#qr-size<?php echo $j; ?>').val(),
                                                                height: $('#qr-size<?php echo $j; ?>').val(),
                                                                text: $('#qr-url<?php echo $j; ?>').val()
                                                            });
                                                        });
                                                    </script>
                                                    <?php
                                                    echo '
                                                </div>
                                                <div class="col-2 quebralinha" name="data_att">' . $row["data_att"] . '</div>
                                                <a class="col-1 hover quebralinha" style="text-align:right;" id="enviaarquivo"  href="#manipulaarquivomodal' . $j . '" rel="modal:open"><img  class="tamanho" src="imgs/config.ico"></a>
                                            </div>
                                        </form>    
                                            ';
                                                    ?>
                                                    <div id='manipulaarquivomodal<?php echo $j; ?>' class='modal' style='width:440px;height:800px;'>
                                                        <span>
                                                            <h5 class='modal-title'><?php echo $projeto; ?></h5>
                                                            <div class='modal-body'>

                                                                <form action='reupload_arquivos.php' method='post' enctype="multipart/form-data" class="border" style="background-color:#e5e5e5;border: #565656 solid 1px!important; border-radius: 10px; margin-top: 5px; margin-bottom: 5px;">
                                                                    <!--////////////////////-->
                                                                    <h5>Atualizar arquivo</h5>
                                                                    <input class='hidden' name='submit' value='submit'>
                                                                    <input class='hidden' name='nomecliente' value='<?php echo $t_cliente; ?>'>
                                                                    <input class='hidden' name='nomeprojeto' value='<?php echo $projeto; ?>'>
                                                                    <input class='hidden' name='token' value='<?php echo $row["token"]; ?>'>
                                                                    <input class='hidden' name='dataarquivo' value='<?php echo Date('d/m/y-h:i:s') ?>'>
                                                                    <input class='hidden' id='valueee' name='nomearquivo' value='<?php echo $row["nome_exibicao"]; ?>'>
                                                                    <h6 class='modal-title2' id='exampleModalLabel3' id='fontenome3'>Selecione um arquivo</h6>
                                                                    <input type="file" name="arquivo" multiple>
                                                                    <br><br>
                                                                    <div class='aligncenter'><input type='submit' class='tiraefeito border2' name='submit' value='Enviar'></div>
                                                                </form>
                                                                <!-- <form action='qrcode_generator.php' method='post' enctype="multipart/form-data" class="border" style="border: #565656 solid 1px!important; border-radius: 10px; margin-top: 5px; margin-bottom: 5px;">
                                                                    ////////////////////
                                                                    <h6>QRCODE</h6>
                                                                    <?php
                                                                    //$tokee = $row["token"];
                                                                    ?>
                                                                    <input class='hidden' name='submit' value='submit'>
                                                                    <input class='hidden' name='nomecliente' value='<?php //echo $t_cliente; 
                                                                                                                    ?>'>
                                                                    <input class='hidden' name='nomeprojeto' value='<?php //echo $projeto; 
                                                                                                                    ?>'>
                                                                    <input class='hidden' name='tokenarquivo' value='<?php //echo $tokee; 
                                                                                                                        ?>'>
                                                                    <input class='hidden' name='nomearquivo' value='<?php //echo $row["nome_exibicao"]; 
                                                                                                                    ?>'>
                                                                    <br>
                                                                    <div class='aligncenter'><input type='submit' class='tiraefeito border2' name='submit' value='Gerar QRCODE'></div>
                                                                </form> -->


                                                                <form action='novo_id.php' method='post' enctype="multipart/form-data" class="border" style="background-color:#e5e5e5;border: #565656 solid 1px!important; border-radius: 10px; margin-top: 5px; margin-bottom: 5px;">
                                                                    <h6>Novo ID do arquivo</h6>
                                                                    <br>
                                                                    <input class='hidden' name='tokenarquivo' value='<?php echo $row["token"]; ?>'>
                                                                    <input class='hidden' name='nomecliente' value='<?php echo $t_cliente; ?>'>
                                                                    <input class='hidden' name='nomeprojeto' value='<?php echo $projeto; ?>'>
                                                                    <p style='margin-bottom:0px'>Insira um novo id</p>
                                                                    <input type='text' name='novo_id'>
                                                                    <br><br>
                                                                    <div class='aligncenter'><input type='submit' class='tiraefeito border2' name='submit' value='Renomear ID'></div>
                                                                </form>
                                                                <form action='#' method='post' enctype="multipart/form-data" class="border" style="background-color:#e5e5e5;border: #565656 solid 1px!important; border-radius: 10px; margin-top: 5px; margin-bottom: 5px;">
                                                                    <h6>Download do arquivo</h6>
                                                                    <br>
                                                                    <?php
                                                                    $arq = $row["arquivo_atual"];
                                                                    $link = 'arquivos/' . $t_cliente . '/' . $projeto . '/' . $arq;
                                                                    ?>
                                                                    <div class='aligncenter'><a href="<?php echo $arq; ?>" class='border2' style='padding-left:5px;padding-right:5px;'>Fazer download</a></div>
                                                                </form>
                                                                <form action='deletar_arquivo.php' method='post' enctype="multipart/form-data" class="border" style="background-color:#e5e5e5;border: #565656 solid 1px!important; border-radius: 10px; margin-top: 5px; margin-bottom: 5px;">
                                                                    <!--////////////////////-->
                                                                    <h6>EXCLUIR</h6>
                                                                    <input class='hidden' name='submit' value='submit'>
                                                                    <input class='hidden' name='nomecliente' value='<?php echo $t_cliente; ?>'>
                                                                    <input class='hidden' name='nomeprojeto' value='<?php echo $projeto; ?>'>
                                                                    <input class='hidden' name='nomearquivo' value='<?php echo $row["nome_exibicao"]; ?>'>
                                                                    <br>
                                                                    <div class='aligncenter'><input type='submit' class='tiraefeito border2' name='submit' value='Excluir'></div>
                                                                </form>
                                                            </div>
                                                    </div>

                                                <?php
                                                } else {
                                                    echo
                                                    '<div></div>';
                                                }
                                                $j++;
                                                ?>

                                            <?php
                                            }
                                            echo '</br>';

                                            ?>
                                </div>
                            </div>
                            <div class='col-1'></div>
                        </div>
                    </div>
                    <div class='col-1'>
                        <!-- <div class="onoff" onclick="window.location.href = 'onoff.php?token=<?php echo $projeto ?>'">
                            <input type="checkbox" class="toggle" id="onoff1<?php echo $i; ?>">
                            <label for="onoff1<?php echo $i; ?>"></label>    
                        </div> -->
                        <a id='myBtn addfolder' data-placement='top' data-toggle='tooltip' title="Enviar novo arquivo para o projeto " href='#adicionaarquivo<?php echo $i; ?>' rel='modal:open' class='hover ' style='float:right;'>
                            <img src='imgs/folder+_blue.png' class='hover icondiv'>
                        </a>
                    </div>
                    <div class='col-1' style='padding-top:10px;'>
                        <a class='hover' data-placement='top' data-toggle='tooltip' title="Excluir projeto" href='#manipulaprojetomodal<?php echo $i; ?>' rel='modal:open'>
                            <img src='imgs/trashq.ico' class='icons' style='margin:auto;height:auto;float:left;'>
                        </a>
                    </div>
                </div>
            </div>
            <div class='content row backcolor sback' style='width:100%'>
            </div>
        </div>

        <!-- MANIPULA ARQUIVO -->

        <!-- ADICIONA ARQUIVO (UPLOAD) -->


        <div id='adicionaarquivo<?php echo $i; ?>' class='modal' style='width:700px;height:350px;'>
            <h5 class='modal-title'>Enviar novo arquivo para o projeto '<?php echo $projeto; ?>'</h5>
            <div class='modal-body'>
                <form action='upload_arquivos.php' method='post' enctype="multipart/form-data" style='text-align:center'>
                    <input class='hidden' name='submit' value='submit'>
                    <input class='hidden' name='nomeprojeto' value='<?php echo $projeto; ?>'>
                    <input class='hidden' name='nomecliente' value='<?php echo $t_cliente; ?>'>
                    <h5 class='modal-title2' id='exampleModalLabel3' id='fontenome3'>Selecione um arquivo</h5>
                    <input type="file" name="arquivo" multiple="multiple" name="arquivo[]">
                    <br><br>
                    <h5>ID equipamento</h5>
                    <input type='text' name='id_equipamento'>
                    <br><br><br>
                    <input type='submit' class='tiraefeito border2' name='submit' value='Enviar'>
                </form>
            </div>
            </span>
        </div>


        <!-- MANIPULA PROJETO -->


        <div id='manipulaprojetomodal<?php echo $i; ?>' class='modal' style='width:440px;height:250px;'>
            <h5 class='modal-title'><?php echo $projeto; ?></h5>
            <div class='modal-body'>
                <form action='_del_projeto.php' method='post'>
                    <input class='hidden' name='confirmacao' value='ok'>
                    <input class='hidden' name='projeto' id='projetoexcluir' value='<?php echo $projeto; ?>'>
                    <input class='hidden' name='cliente' id='clientecaminho' value='<?php echo $t_cliente; ?>'>
                    <h5 class='modal-title2' id='exampleModalLabel2' id='fontenome2'>Exclusão</h5>
                    <input type='submit' name='confirmacao2' value='Excluir Projeto' id='xexcluir' class='tiraefeito border2'>
                </form>
            </div>
            
            </span>
        </div>

<?php
    }
    $i++;
}
$diretorio->close();
?>
</div>
</div>
<script>
</script>

    </html>
<?php
} else {
    header("Location: login.php?erro=acessonegado");
};
?>