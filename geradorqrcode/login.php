<!DOCTYPE html>
<html lang="pt-br">

<head>

	<title>Bem vindo!</title>
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
	<script src="/codigo/script.php"></script>
	<link href="../codigo/css/styles.css" rel="stylesheet" />
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
	</script>
	<script src="../codigo/includes/js/scripts.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
	<script src="assets/demo/chart-area-demo.js"></script>
	<script src="assets/demo/chart-bar-demo.js"></script>
	<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
	<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
	<script src="assets/demo/datatables-demo.js"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
	</script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
	</script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
	</script>
	<link href="css/main.css" rel="stylesheet" />
	<link href="css/util.css" rel="stylesheet" />


	<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="includes/images/icons/favicon.ico" />
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="includes/vendor/bootstrap/css/bootstrap.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="includes/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="includes/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="includes/vendor/animate/animate.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="includes/vendor/css-hamburgers/hamburgers.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="includes/vendor/select2/select2.min.css">
	<!--===============================================================================================-->

	<style>
		body {
			background-color: white !important;
		}

		#backwhite {
			margin-top: 100px;
			background-color: white;
			opacity: 0.9;
			border: black solid 2px;
			border-radius: 10px;
		}

		#quadrado {
			background-color: #d3d3d3;
		}
	</style>
</head>

<body>
<?php
	session_start();
	include "conectadb.php";
	$ip = $_SERVER['REMOTE_ADDR'];

	if ($_SESSION["logado_site"] === 'true') {
		echo "<script>
	window.location.href = 'index.php';
	</script>
	";

	} elseif ($_GET["erro"] == "preenchaoscampos") {
		echo '<script>
				alert("Preencha os campos");
				</script>';
	} elseif ($_GET["erro"] == "nomeincorreto") {
		echo '<script>
  			alert(" Nome incorreto ou não cadastrado");
  			</script>';
	} elseif ($_GET["erro"] == "acessonegado") {
		echo '<script>
  			alert("Você precisa fazer login");
  			</script>';
	} elseif ($_GET["erro"] == "senhaincorreta") {

		$aux = $_SESSION["num_error"];
		
		$_SESSION["num_error"] = $aux + 1; 
		if ($_SESSION["num_error"]>4){
			$_SESSION["bloq"] = 's';
			$_SESSION["hora_error"] = date('i');
		}
		echo '<script>
  			alert(" Senha incorreta ");
  			</script>';
	}

	$numero_erros = $_SESSION["num_error"];
	$sess_err = $_SESSION["hora_error"];
	$err = $_SESSION["num_error"];
	$hragr = date('i');
	

	//função para desbloquear os usuario que estavam bloqueados*****


    if ($_SESSION["bloq"] == 'n') {	
	//se usuarrio nao estiver bloqueado, não faz nada
    }else{
		//se estiver, então fazer este teste
        if (($hragr - $_SESSION["hora_error"]) > 10) {
		
			//se tempo de bloqueio for maior que 10 minutos
            
			//usuario nao bloqueado
			$_SESSION["bloq"] = 'n';
			//numero de erros 0
			$_SESSION["num_error"] = 0;
		//  *RESET DE ERROS* 
		}
    }


	//função para marcar usuario como "bloqueados"******

	//teste se o numero de erros é maior que 4
	if ($_SESSION["num_error"] > '4'){
		$_SESSION["bloq"] = 's';
		//se for, então  = usuario bloqueado
	}


	//função para exibir mensagemd e erro ou para mostrar page******
	if($_SESSION["bloq"] == 's'){

	//mensagem quando usuário bloqueado
	echo "
	<div class='row' style='margin-top:200px;'>
	<div class='col-4'></div>
	<div class='col-4' style='background-color:white;text-align:center; padding-left:50px; padding-right:50px;border-radius:10px;border:solid black 1px;'>
	<p style='color:black; font-size:25px'>Usuário bloqueado</p>
	<br>
	<p>Você excedeu o limite de erros consecutivos de sua senha</p>
	<p>retorne em 10 minutos <a href='https://documentos.ampla.ind.br'>neste link</a></p>
	</div>
	<div class='col-4'></div>
	</div>
	";
	echo '<br>';
	

	}else{
	//run forest run!	

    ?>
	<div class="limiter">
		<div class="container-login100" style="background-image: url('includes/images/img-01.jpg');">
			<div class="wrap-login100 p-t-190 p-b-30">
				<form class="login100-form validate-form" action='valida_login.php' method='POST'>
					<div class="" style="text-align:center">
						<img  style="width:390px;height: 120px;" src="imgs/Ampla - Novo Logo - Alta Resolução.png" alt="">
					</div>

					<span class="login100-form-title p-t-20 p-b-45">
						Gerenciador de manuais PDF
					</span>

					<div class="wrap-input100 validate-input m-b-10" data-validate = "Username is required">
						<input class="input100" type="text" name='nome' placeholder="Username">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input m-b-10" data-validate = "Password is required">
						<input class="input100" type="password" name="senha" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock"></i>
						</span>
					</div>
					<!-- <input type='password' name='senha' style='width:100%;height:30px;font-size:20px'> -->
								<!-- <br><br> -->
								<!-- <input   style='width:70px;height:35px;font-size:20px'> -->
					<div class="container-login100-form-btn p-t-10">
						<input class="login100-form-btn" type='submit' value='Entrar'>
						
						</input>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	

	
<!--===============================================================================================-->	
	<script src="includes/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="includes/vendor/bootstrap/js/popper.js"></script>
	<script src="includes/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="includes/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="includes/js/main.js"></script>

</body>

<?php
    };

?>



</html>