<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <title>Registo de utilizadores</title>
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

<?php
session_start();
if((!isset ($_SESSION['nome']) == true) and (!isset ($_SESSION['password']) == true))
{
  unset($_SESSION['nome']);
  unset($_SESSION['password']);

  require 'navbarDisconnect.php';
}else{
  header('Location: index.php');
}
?>

<body>
  <form id="form_registo" name="form_registo" method="POST" action="processar_registo.php">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="left" valign="top" ><font face="Arial" size="3">Registo de utilizadores</font></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td align="left" valign="top" width="200"><font face="Arial" size="2">Nome da Conta:</td><td><input type="text" name="nomeConta" id="nomeConta" />*</font></td>
      </tr>
      <tr>
        <td align="left" valign="top" width="200"><font face="Arial" size="2">Nome:</td><td><input type="text" name="nome" id="nome" />*</font></td>
      </tr>
      <tr>
        <td align="left" valign="top" width="200"><font face="Arial" size="2">Apelido:</td><td><input type="text" name="apelido" id="apelido" />*</font></td>
      </tr>
      <tr>
        <td align="left" valign="top" width="200"><font face="Arial" size="2">Palavra-passe:</td><td><input type="password" name="password" id="password" />*</font></td>
      </tr>
      <tr>
        <td align="left" valign="top" width="200"><font face="Arial" size="2">Email:</td><td><input type="text" name="email" id="email" />*</font></td>
      </tr>
      <tr>
        <td>* Campo obrigatório</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><input type="submit" name="enviar" id="enviar" value="Registar" />
         <input type="reset" name="apagar" id="apagar" value="Apagar" /></td>
       </tr>
     </table>
     <?php echo ('<P><a href=index.php>Voltar ao Site</a>'); ?>
   </form>
 </body>
 </html>