<!DOCTYPE html>
<html>
<head>
	<title>Autenticação de utilizadores</title>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
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
	if((!isset ($_SESSION['nome']) == true) and (!isset ($_SESSION['password']) == true)){
		unset($_SESSION['nome']);
		unset($_SESSION['password']);
		
		require 'navbarDisconnect.php';
	}else{
		$logado = $_SESSION['nome'];
		
		require 'navbarConnect.php';
	}

	if (!empty($_POST) AND (empty($_POST['nomeConta']) OR empty($_POST['password']) )) {
		header("Location: login.php");
	}

	$ligacao = mysqli_connect("localhost","davidric_root","~g?X_?BXq!Eq","davidric_database0") or die("Could not connect to MySql"); //conectar ao servidor


	$accname = $_POST['nomeConta'];
	$password = $_POST['password'];

	// prepara o comando para confirmar password
	$stmt = mysqli_prepare($ligacao, "SELECT NomeConta, Password, Regkey FROM utilizadores WHERE NomeConta='$accname'");
	mysqli_stmt_execute($stmt);
	mysqli_stmt_bind_result($stmt, $accname, $hashed_password, $regkey);
	mysqli_stmt_fetch($stmt);

	if(password_verify($password, $hashed_password)){//confirma password
		mysqli_stmt_close($stmt);

		//atualiza S1 para 1 // a password é a correta
		$sql= "UPDATE utilizadores set S1 = '1' WHERE NomeConta = '$accname' AND Regkey='$regkey' ";
		mysqli_query($ligacao, $sql);

		//verifica se tem a Autenticação de 2 Fatores Ativada
		$sql = "SELECT NomeConta from utilizadores where NomeConta='$accname' AND Aut='1' AND Regkey='$regkey'";
		$consulta = mysqli_query($ligacao, $sql);

		if(mysqli_num_rows($consulta) == 1){
			$sql = "SELECT NomeConta from utilizadores where NomeConta='$accname' AND S1='1' and S2='1'AND Regkey='$regkey'";
			$consulta = mysqli_query($ligacao, $sql);

			//Aut = 1 && S2 = 1 // Autenticação 2 Fatores ativada & Aplicação em contagem decrescente?
			if (mysqli_num_rows($consulta) == 1){
				$sql= "UPDATE utilizadores set S1 = '0' WHERE NomeConta = '$accname' AND Regkey='$regkey' ";
				mysqli_query($ligacao, $sql);
				$_SESSION['nome'] = $accname;
				$_SESSION['password'] = $password;
				echo "</P> Login feito com Sucesso!";
				echo "</P> Bem vindo " . $_SESSION['nome'];
				echo ('</P><a href=index.php>Clique para continuar</a>');
			}else{//Aut = 1 && S2 = 0 // Autenticação 2 Fatores ativada & Aplicação não está em contagem decrescente?
				$sql= "UPDATE utilizadores set S1 = '0' WHERE NomeConta = '$accname' AND Regkey='$regkey'";
				mysqli_query($ligacao, $sql);
				echo "<p>Conta protegida pela autenticação de dois fatores.</p>";
				echo "</P>Certifique-se de usar o seu smartphone.";
				echo "</P><a href=login.php> Tentar novamente</a>";
				session_destroy();
			}

		}else{//Aut = 0 //Autenticação de 2 Fatores Não Ativada
			$sql= "UPDATE utilizadores set S1 = '0' WHERE NomeConta = '$accname' AND Regkey='$regkey' ";
			mysqli_query($ligacao, $sql);
			$_SESSION['nome'] = $accname;
			$_SESSION['password'] = $password;
			echo "</P> Login feito com Sucesso!";
			echo "</P> Bem vindo " . $_SESSION['nome'];
			echo ('</P><a href=index.php>Clique para continuar</a>');
		}
	}else{//Password Incorreta
		echo "</P> Nome da Conta ou Palavra-Passe incorretos.";
		echo "</P><a href=login.php> Tentar novamente</a>";
	}
?>
</body>
</html>