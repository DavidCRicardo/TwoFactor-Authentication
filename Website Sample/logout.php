<?php

//	logout.php

// iniciar sessуo
session_start();

// destruir a sessуo
session_destroy();

echo "Sessуo terminada com sucesso!";

 
// enviar o utilizador para pсgina de autenticaчуo
header('Location: login.php');
?>