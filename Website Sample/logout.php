<?php

//	logout.php

// iniciar sess�o
session_start();

// destruir a sess�o
session_destroy();

echo "Sess�o terminada com sucesso!";

 
// enviar o utilizador para p�gina de autentica��o
header('Location: login.php');
?>