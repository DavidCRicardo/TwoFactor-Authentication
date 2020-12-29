<?php 

$ligacao = mysqli_connect("localhost","davidric_root","~g?X_?BXq!Eq","davidric_database0") or die("Could not connect to MySql"); //conectar ao servidor

if ($ligacao) { echo "Conectado!!";	}
if (mysqli_connect_errno())
{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

if (isset($_POST['UserName'])) {
	$UserName = $_POST['UserName'];
} else {
	$UserName = null;
}	

//Confirmação pelo smartphone é desbloqueada
$sql= "UPDATE utilizadores set S2 = '1' WHERE NomeConta ='$UserName' ";
mysqli_query($ligacao, $sql);

?>