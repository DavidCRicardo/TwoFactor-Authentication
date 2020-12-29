<?php 

//$con = mysqli_connect("localhost","davidric_root","~g?X_?BXq!Eq","davidric_database0") or die("Could not connect to MySql"); //conectar ao servidor
	$con = mysqli_connect("localhost","root","password","davidric_database0") or die("Could not connect to MySql"); //conectar ao localhost

if (mysqli_connect_errno())
{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

if (isset($_POST['Code'])) { //Verificar se o campo do Código foi preenchido
	$Code = $_POST['Code'];
} else {
	$Code = null;
}

$sql= "SELECT NomeConta from utilizadores WHERE Codigo ='$Code' " ;
$consulta = mysqli_query($con, $sql) or die(mysqli_error($con));

if (mysqli_num_rows($consulta) == 1) {
	mysqli_query($con, "UPDATE utilizadores set Aut = 1 AND Codigo = $Code ");
	echo "Ativado com Sucesso";
}else{
	echo "Something went wrong";
}
?>