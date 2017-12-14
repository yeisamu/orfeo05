<?php
session_start();
//require_once '../config.php';
//if(!$dependencia or !$krd) include "../rec_session.php";
$usuaEmail =  $_SESSION["usua_email"];
$krd =  $_SESSION["krd"];
$imagenes =  $_SESSION["imagenes"];
$dependencia =  $_SESSION["dependencia"];
$encabezado = session_name()."=".session_id()."";
if($passwd_mail) {
	$passwdEmail=$passwd_mail;
	$usuaEmail=$_SESSION['usuaEmail'];
	$dominioEmail=$_SESSION['dominioEmail']; 
}
if($_SESSION['passwdEmail'])
{
 $passwdEmail =$_SESSION['passwdEmail'];
 
}

if($passwdEmail)
{
   include "emailinbox.php";
	 
}else
{
?>
<html>
<head>
<title>..Vista Previa..</title>
<link href="../estilos/orfeo.css" rel="stylesheet" type="text/css">
</head>
<body>

<h2 align="center">
<?php
if($err==1)
echo "No se pudo establecer coneccion con el Servidor."; 
?>
</h2>
<table border="1"  align="center" background="../<?=$imagenes?>/orfeopasswd.jpg">
<tr><td width="360">
<form action="login_email.php?<?php echo $encabezado; ?>" >
<table width="350" border="0" align="center">
        <tr> 
          <td colspan="2" align="right"><font color="#FFFFFF">Ingrese su Clave de Correo para: <br><?=$usuaEmail?><br></font></td>
        </tr>
        <tr> 
          <td width="182" align="center" ><p>&nbsp; </p>
            <p>&nbsp; </p></td>
          <td width="144" align="center" ><input type="password" name="passwd_mail" /></td>
        </tr>
        <tr> 
          <td colspan="2" align="center" ><input name="Submit" type="submit" class="botones" value="INGRESAR"></td>
        </tr>
      </table>
</td></tr>

</table>
</form>
</body>
</html>
<?
}
?>
