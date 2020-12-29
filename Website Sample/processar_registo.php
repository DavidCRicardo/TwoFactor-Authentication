<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<title>Registo de Utilizadores</title>
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
	
	// verificar se o campo de utilizador e palavra-passe foram preenchidos
	if (!empty($_POST) AND (empty($_POST['nome']) OR empty($_POST['password']) OR empty($_POST['email']))) {
		header("Location: registar_utilizador.php");
		echo "Preencher todos com campos"; exit;
	}

	//Estabelecer a conexão à base de dados do servidor e guardar como variável os dados introduzidos pelo utilizador
	
	$ligacao = mysqli_connect("localhost","davidric_root","~g?X_?BXq!Eq","davidric_database0") or die("Could not connect to MySql"); //conectar ao servidor

	$accname = $_POST['nomeConta'];
	$username = $_POST['nome'];
	$apelido = $_POST['apelido'];
	$password = $_POST['password'];
	$email = $_POST['email'];

	//verificar se o email é válido
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		echo("$email não é um email válido"); 	
		echo ('<BR><BR><a href=registar_utilizador.php>Clique para tentar de novo</a>');
		echo ('<P><a href=index.php>Voltar ao Site</a>');	
		exit();
	}
	else{
		//verificar se o email já existe
		$duperaw = mysqli_query($ligacao, "SELECT * FROM utilizadores WHERE (Email = '$email')");
		if(mysqli_num_rows($duperaw) > 0) {
			echo ('Email encontra-se registado! ');
			echo ('<a href=registar_utilizador.php>Clique para tentar de novo</a>');
			echo ('<P><a href=index.php>Voltar ao Site</a>');
		}
		else{
			//verificar se o nome da Conta já existe
			$duperaw = mysqli_query($ligacao, "SELECT * FROM utilizadores WHERE (NomeConta = '$accname')");
			if(mysqli_num_rows($duperaw) > 0) {
				echo ('Nome da Conta já se encontra registado! ');
				echo ('<a href=registar_utilizador.php>Clique para tentar de novo</a>');
				echo ('<P><a href=index.php>Voltar ao Site</a>');
			}
			else{
				//Encripta a password usando um hash
				$new_password = password_hash($password, PASSWORD_DEFAULT);
				$RandomKey = mt_rand(1,50);
				$RegKey = hash_hmac('sha512', $password, $RandomKey);
				//Insere na base de dados os novos dados
				$sql = "INSERT INTO utilizadores (NomeConta, Nome, Apelido, Password, Regkey, Email) 
				VALUES ( '$accname', '$username', '$apelido', '$new_password', '$RegKey', '$email')";
				$consulta = mysqli_query($ligacao, $sql);

				// mensagem de confirmação de registo inserido caso seja realizado com sucesso
				if (($consulta) != 1) {
					echo "Ocorreu um erro durante o processo de registo! "; 
					header("Location: registar_utilizador.php"); exit;
				} else {
					echo "O registo foi efetuado com sucesso! "; 
					echo ('</P><a href=index.php>Voltar ao Menu</a');
				}
			}
		}
	}
	?>
</body>
</html>
