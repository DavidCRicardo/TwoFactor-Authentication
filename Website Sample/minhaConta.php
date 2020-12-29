<!DOCTYPE html>
<html>
<head>
  <title>Minha Conta</title>
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
<?php
session_start();
if((!isset ($_SESSION['nome']) == true) and (!isset ($_SESSION['password']) == true))
{
  header('Location: index.php');
}else{
  $logado = $_SESSION['nome'];
  echo "tá logado";

  require 'navbarConnect.php';
}
?>
<body>

  <div style="margin-top: 2%; margin-left: 2%; margin-right: 2%;">
    <p class="wb-stl-normal" style="text-align: justify;  margin-bottom: 2%;">
      Para descarregar a aplicação para o smartphone: <a href="https://drive.google.com/open?id=1fbFwl-jYXhSvBMk0lqvQM-HVjoVuJ6ux">Download</a>
    </p>
  </div>

  <form id="form_registo" name="form_registo" method="POST" action="processar_conta.php">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="left" valign="top" ><font face="Arial" size="3">Minha Conta</font></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td align="left" valign="top" width="200"><font face="Arial" size="2">Nome da Conta:</td>
          <td><?php echo " ".$_SESSION['nome'] ?></font></td>
      </tr>

      <!--<tr>
        <td align="left" valign="top" width="200"><font face="Arial" size="2">Telemóvel:</td><td><input type="text" name="telemovel" id="telemovel" /></font></td>
      </tr>
      <tr>
        <td><input type="submit" name="enviar" id="enviar" value="Guardar" /></td>
       </tr>-->
     </table>
     <?php echo ('<P><a href=index.php>Voltar ao Site</a>'); ?>
   </form>
 </body>
 </html>