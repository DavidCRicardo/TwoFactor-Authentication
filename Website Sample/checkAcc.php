<?php 

//$con = mysqli_connect("localhost","davidric_root","~g?X_?BXq!Eq","davidric_database0") or die("Could not connect to MySql"); //conectar ao servidor
	$con = mysqli_connect("localhost","root","password","davidric_database0") or die("Could not connect to MySql"); //conectar ao localhost

if (mysqli_connect_errno()){
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

if (isset($_POST['UserName'])) {
	$UserName = $_POST['UserName'];
} else {
	$UserName = null;
}
if (isset($_POST['Passe'])) {
	$Passe = $_POST['Passe'];
} else {
	$Passe = null;
}

//prepara o comando para confirmar password
$stmt = mysqli_prepare($con, "SELECT NomeConta, Password, Regkey FROM utilizadores WHERE NomeConta='$UserName'");
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $UserName, $hashed_password, $regkey);
mysqli_stmt_fetch($stmt);

if(password_verify($Passe, $hashed_password)){
	mysqli_stmt_close($stmt);

	//Seleciona o email do utilizador enviando o código para confirmaçãp
	$sql= "SELECT Email from utilizadores WHERE NomeConta ='$UserName' AND Regkey ='$regkey' " ;
	$consulta = mysqli_query($con, $sql) or die(mysqli_error($con));

	if (mysqli_num_rows($consulta) == 1) {
		echo "Success!!";

		$row = mysqli_fetch_array($consulta);
		$max= $row['Email'];
		$random = rand(0,99999);
		$msg = "Autenticação de Dois Fatores\nDigite este código na app\n$random\n\n\n\ndavidricardo.x10host.com";
		$msg = wordwrap($msg,70);
		echo "$msg";
		mail("$max","Confirmação da Ativação",$msg);

		mysqli_query($con, "UPDATE utilizadores set Codigo = $random WHERE NomeConta = '$UserName' AND Regkey = '$regkey' ");
	}
}else{
echo "Something went wrong";
}
	
?>