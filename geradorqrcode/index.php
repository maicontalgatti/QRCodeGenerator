<?php
include "mostrarerros.php";
session_start();
include "conectadb.php";
if ($_SESSION["logado_site"] == 'true') {
    $nome_sess = $_SESSION["nome"];
    $data_e = Date('d/m/y-H:i:s');
    $sql = 'UPDATE login SET ultimo_acesso="' . $data_e . '" WHERE nome_login="' . $nome_sess . '"';
    $con->query($sql);
?>
    <!DOCTYPE html>
    <html lang="pt-br">

    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="author" content="Ampla ind. Maicon Talgatti" />
        <link rel="icon" type="image/png" href="imgs/qrcode.png" />
        <title>QR code generator</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous">
        </script>
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Alfa+Slab+One&family=Pattaya&display=swap" rel="stylesheet">
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <link href="css/classes.css" rel="stylesheet" />
        <link href="index.css" rel="stylesheet" />
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
        </script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
        </script>
        <style>
            .modal-backdrop {
                display: none !important;
            }
        </style>
        <?php
        if ($_GET["erro"] == "senhaatualincorreta") {
            echo '<script>
            alert("Senha atual/nova senha incorreta");
            </script>';
        } elseif ($_GET["erro"] == "senhanaocorresponde") {
            echo '<script>
          alert("Os campos de "nova senha" não correspondem ");
          </script>';
        } elseif ($_GET["erro"] == "senhaaatualizada") {
            echo '<script>
          alert("Senha atualizada com sucesso ");
          </script>';
        } elseif ($_GET["erro"] == "naodeletado") {
            echo '<script>
          alert("Não foi possível deletar o projeto pois há arquivos dentro do mesmo");
          </script>';
        }
        ?>
    </head>

    <body>
        <?php
        $nome_user = $_SESSION['nome_completo'];


        $aux_ = $_SESSION["avisado"];
        // echo "aqui" . $aux . "aaaa";
        if ($aux_ == 0) {
            echo '<script>
            alert("atenção! Os CLIENTES estão ordenados em ordem alfabética, entretanto o mecanismo do php não é perfeito, podendo não ordenar alguns arquivos.")
            </script>';
            $sql = 'UPDATE login set Locall="1" WHERE nome_completo = "' . $nome_user . '"';
            $con->query($sql);
        }


        $link_completo_atual =  $_SERVER["REQUEST_URI"];
        $sql = 'SELECT * FROM login WHERE nome_completo="' . $nome_user . '"';
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($result);
        $senha = $row["senha"];
        $normal = '712e807d9d185750fb7697478023869d';
        if ($senha === $normal) {
            echo '<script>
        alert("Atualize sua senha imediatamente! Ao lado esquerdo encontrará um quadro com o nome ALTERAR SENHA ");
        </script>';
        };
        ?>
        <script>
        </script>
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
                <div class="box-tela" style="width:90%; margin: auto;margin-top:20px;">
                    <div class="padding">
                        <div class="interno">
                            <div class="row" style="border-bottom:solid #ededed 1px;">
                                <div class="col-12">
                                    <div class="row vintepad">

                                        <h1>Gerenciador de Manuais </h1>
                                    </div>
                                    <div class="row vintepad" style="font-size: 17px;">
                                        <p>
                                            Selecione e altere os dados cadastrados sobre clientes,
                                            Organizado em CLIENTE -> PROJETO -> ARQUIVO -> QRCODE.
                                        </p>
                                    </div>
                                    <!-- <div class="row vintepad" style="font-size: 17px;">
                                        <p>
                                        
                                        </p>
                                    </div> -->
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-2" style="border-right: solid #ededed 1px;">
                                    <div class="row">
                                        <a id="myBtn" class="hover" style="border: solid #dee2e6 2px;border-radius: 10px;margin-left: auto;margin-right:auto;margin-top:20px;padding-right: 5px;padding-left: 5px;">
                                            <img src='imgs/folder+_blue.png' class='icons' style='margin-right:10px;'>NOVO CLIENTE</a>
                                        <div id="myModal" class="modal">
                                            <div class="modal-content" style='height:200px;width:250px;'>
                                                <span class="close">&times;</span>
                                                <form action="upload.php" method="post">
                                                    <div>
                                                        <h2>Novo Cliente</h2>
                                                        <h5>Não utilize caracteres especiais (Acentos e símbolos)</h5>
                                                        <input type="text" id="nomecliente" name="cliente" placeholder=" Nome do cliente " required="required" pattern="[a-zA-Z0-9-ç-^]+">
                                                        <input type="submit" id="enviarcliente" value="ok">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='row'>
                                        <div class='col-12'>
                                            <br>
                                            <h5>ATENÇÃO!</h5>
                                            <br>
                                            <ul style='padding-right:5px;padding-left:20px!important;'>
                                                <li>
                                                    Realize o upload de apenas um arquivo por vêz.
                                                </li>
                                                <li>
                                                    Não é possível excluir diretórios que ainda contenham subpastas ou arquivos.
                                                </li>
                                                <li>
                                                    Não é possível renomear clientes/projeto/arquivos. Apenas seu respectivo ID.
                                                </li>

                                            </ul>
                                        </div>
                                    </div>
                                    <div class='row'>
                                        <div class='col-1'>
                                        </div>
                                        <div class='col-10' style='border:1px solid black;text-align:center '>
                                            <form action='altera_senha.php' method='POST'>
                                                <h3>Alterar senha</h3><br>
                                                <input type='hidden' name='nome' value='' style='width:90%'>
                                                <h5>senha atual</h5>
                                                <input type='password' name='senhaatual' style='width:90%'><br><br>
                                                <h5>nova senha</h5>
                                                <input type='password' name='senhanova' style='width:90%'><br><br>
                                                <h5>repetir nova senha</h5>
                                                <input type='password' name='senhanova2' style='width:90%'><br><br>
                                                <input type='submit' name='ok' value='Alterar'><br><br>
                                            </form>
                                        </div>
                                        <div class='col-1'>
                                        </div>
                                    </div>
                                    <?php
                                    if ($_SESSION["adm_lvl"] === "yes") {
                                        echo "
                                        <br>
                                        <div class='row aligncenter '>
                                        <div class='col-1'>
                                        </div>
                                        <div class='col-10'> 
                                            <form  action='cadastra_usuario.php' method='POST'>
                                                <h5>Novos usuarios</h5>
                                                <h7>nome_completo</h7><br>
                                                <input type='text' name='nome_completo' style='width:90%'><br>
                                                <h7>nome</h7><br>
                                                <input type='text' name='nome' style='width:90%'><br>
                                                <h7>senha</h7><br>
                                                <input type='password' name='senha' style='width:90%' value='senhatemporaria' readonly ><br>
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
                                <div class="col-10" style="padding-left:20px">
                                    <?php

                                    $i = 0;
                                    $path = "arquivos/";

                                    $diretorio = dir($path);



                                    // Selecionar tudo exceto arquivos ocultos                     

                                    $files = array();
                                    $dir = opendir('arquivos'); // open the cwd..also do an err check.
                                    while (false != ($file = readdir($dir))) {
                                        if (($file != ".") and ($file != "..") and ($file != "index.php")) {
                                            $files[] = $file; // put in array.
                                        }
                                    }
                                    natsort($files); // sort.
                                    // print.
                                    foreach ($files as $file) {
                                        // echo("<a href='$file'>$file</a> <br />\n");

                                        echo "
                                    <div class='row hoverrow' id='comeco' style='border:solid 1px #c9cdd1;border-radius:7px;margin-top:1px;margin-bottom:1px;'>
                                        <div class='col-10'>
                                            <a id='max-height' href='projeto.php?cliente=" . $file . "' >                                    
                                                <div id='max-height' class='row vintepad pad fonte '>                                        
                                                    <img src='imgs/cliente_blue.ico' class='icons'>" . $file . "                                            
                                                </div>                                        
                                            </a>                                    
                                        </div>
                                        <div class='col-2'> 

                                            <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#exampleModal' data-whatever='" . $file . "' method='post' style='margin-top:5px;background-color: white;border: white;'>
                                                <img  data-placement='top' data-toggle='tooltip' title='Opções do cliente ' src='imgs/trashq.ico' class='icons ' style='margin:auto;height:auto;'>
                                            </button>         

                                            <div class='modal fade' id='exampleModal' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                                                <div class='modal-dialog' role='document'>
                                                    <div class='modal-content'>
                                                        <div class='modal-header'>
                                                            <h5 class='modal-title' id='exampleModalLabel' id='fontenome'>Nova mensagem</h5>
                                                                <button type='button' class='close' data-dismiss='modal' aria-label='Fechar'>
                                                                    <span aria-hidden='true'>&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class='modal-body'> 
                                                                <form action='_del_client.php' id='fexcluir' method='post'>
                                                                    <input class='hidden' name='confirmacao' value='ok'>
                                                                    <input class='hidden' name='cliente' id='cliente' value='" . $file . "'> 
                                                                    <h5 class='modal-title2' id='exampleModalLabel2' id='fontenome2'>Exclusão</h5>
                                                                    <input type='submit' value='Excluir Cliente' class=''>
                                                                </form>  
                                                            </div>
                                                        <!-- <div class='modal-body'> 
                                                                <form action='_renomeia_cliente.php' id='frenomear' method='post'>
                                                                    <input class='hidden' name='confirmacao' value='ok'>
                                                                    <input class='hidden' name='cliente2' id='cliente2' value='" . $file . "'> 
                                                                    <h5 class='modal-title3' id='exampleModalLabel3' id='fontenome3'>Renomear</h5>
                                                                    <input type='text' name='newname' id='newname' value='' required='required' pattern='[a-zA-Z0-9+--- -]+'> 
                                                                    <input type='submit' value='Renomear Cliente' class=''>
                                                                </form>                                                              
                                                            </div>-->
                                                            <div class='modal-footer'>
                                                            <button type='button' class='btn btn-secondary' data-dismiss='modal' >cancelar</button>
                                                        </div> 
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>";
                                    }


                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>

    </body>
    <script>
        var z = ''
        var modal = document.getElementById("myModal");
        var btn = document.getElementById("myBtn");
        var span = document.getElementsByClassName("close")[0];

        btn.onclick = function() {
            modal.style.display = "block";
        }
        span.onclick = function() {
            modal.style.display = "none";
        }
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

        $('#exampleModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var recipient = button.data('whatever')
            var modal = $(this)

            modal.find('.modal-title').text(recipient)

            z = button.data('whatever')

        })
        $('#fexcluir').on("click", function(event) {
            var x = document.getElementById("cliente")
            x.value = z;
        })
        $('#frenomear').on("click", function(event) {
            var t = document.getElementById("cliente2")
            t.value = z;
        })
    </script>

    </html>
<?php
} else {
    header("Location: login.php?erro=acessonegado");
};
?>