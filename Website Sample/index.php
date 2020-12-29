<!DOCTYPE html>
<html>
<link type="text/css" id="dark-mode" rel="stylesheet" href="">
<style type="text/css" id="dark-mode-custom-style"></style>
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<title>Projeto Global</title>
	 <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
	<meta name="description" content="">
	<meta name="keywords" content="">
	<link rel="stylesheet" type="text/css" href="site_files/bootstrap.css" >
	<link rel="stylesheet" type="text/css" href="site_files/font-awesome.css" >
	<link rel="stylesheet" type="text/css" href="site_files/common.css" >
	<link rel="stylesheet" type="text/css" href="site_files/estilos.css">
	<script type="text/javascript" src="site_files/jquery-3.1.1.min.js"></script>
	<script type="text/javascript" src="site_files/bootstrap.js"></script>
	<script type="text/javascript" src="site_files/main.js"></script>
	<script type="text/javascript">var currLang = 'en';</script>
</head>
<body>
	<?php 
	session_start();
	if((!isset ($_SESSION['nome']) == true) and (!isset ($_SESSION['password']) == true))
	{
		unset($_SESSION['nome']);
		unset($_SESSION['password']);

		require 'navbarDisconnect.php';
	}else{
		$logado = $_SESSION['nome'];

		require 'navbarConnect.php';
	}
	?>
	
	<div class="big-margin container" >
		<div>
			<h1 class="wb-stl-heading1" style="margin-top: 5%;">Projeto Global</h1>
		</div>

		<div style="margin-top: 2%; margin-left: 2%; margin-right: 2%;">
			<p class="wb-stl-normal" style="text-align: justify;  margin-bottom: 2%;">
				O Projeto Global foi a ativação de Autenticação de Dois Fatores.
				<br/>
				Para ativar a Autenticação de Dois Fatores deve-se fazer o registo, instalar a app no smartphone, e proceder à confirmação.
			</p>
			<div>
				<div class="moreinfo">
					<img src="site_files/PG/images.png" style=" width: 100%; height: 100%;">
					<div>
						<h1 class="wb-stl-headingWhite" style="text-align: center; margin-top: 5%; margin-bottom: 5%; margin-left: 5%; text-align: left;">Registo no Site</h1>
					</div>
				</div>

				<div class="moreinfo">
					<img src="site_files/PG/index1.png" style=" width: 100%; height: 100%;">
					<div>
						<h1 class="wb-stl-headingWhite" style="text-align: center; margin-top: 5%; margin-bottom: 5%; margin-left: 5%; text-align: left;">Instalar a App</h1>
					</div>
				</div>

				<div class="moreinfo">
					<img src="site_files/PG/index2.png" style=" width: 100%; height: 100%;">
					<div>
						<h1 class="wb-stl-headingWhite" style="text-align: center; margin-top: 5%; margin-bottom: 5%; margin-left: 5%; text-align: left;">Ativar a Autenticação</h1>
					</div>
				</div>
			</div>

			<div class="wb-stl-heading3"><a href="registar_utilizador.php">Registo</a></div>
			<div class="wb-stl-heading3"><a href="login.php">Login</a></div>
		</div>
	</div>

	<?php include 'footer.php' ?>

</body>
</html>