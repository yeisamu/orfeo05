<?php
/************************************************************************
# PROYECTO: Orfeo    MODULO: Email - index.php     FECHA: Octubre 2012  *
#~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*
#                                                                       *
#  Inicio del lector de Correo electronico                              *
#                                                                       *
#************************************************************************
# AUTOR DE ESTE MODULO:  Orfeo                                          *
#************************************************************************
# AUTORES DEL Superintendencia de Servicios Publicos D. de Colombia     *
#  PROYECTO:  Infometrika, Iyunxi y SkinaTech                           *
#             Comunidades Correlibre y Orfeolibre                       *
#************************************************************************
# LICENCIA: GNU/GPL                                                     *
#***********************************************************************/

// Ultima Modificacion Kasandra 2012-10    Agregamos templates documentacion

error_reporting(E_ALL);
//error_reporting(E_ERROR | E_PARSE);

session_start();
if(!isset($_SESSION['krd'])) include "../rec_session.php";

foreach ($_GET as $key => $valor)  ${$key} = $valor;
foreach ($_POST as $key => $valor) ${$key} = $valor;

if (!$ruta_raiz) $ruta_raiz = "..";

$encabezado = session_name()."=".session_id()."";

        /********************************************************
        *           Constantes del archivo                      *
        ********************************************************/

$TIT_Vista_Previa="..Vista Previa..";
$TIT_MSG_No_Servidor="No se pudo establecer coneccion con el Servidor."; 
$TIT_Ingrese_Contra="Ingrese su Clave de Correo para: ";
$TIT_Ingresar="Ingresar";

        /********************************************************
        *           Variables  del archivo                      *
        ********************************************************/

        /********************************************************
        *                   Programa Principal                  *
        ********************************************************/


// obtengo los datos del usuario de la sesion
$krd =  $_SESSION["krd"];
$usuaEmail =  $_SESSION["usua_email"];
$imagenes =  $_SESSION["imagenes"];
$dependencia =  $_SESSION["dependencia"];
if($passwd_mail) {
    $passwdEmail=$passwd_mail;
    $usuaEmail=$_SESSION['usuaEmail'];
    $dominioEmail=$_SESSION['dominioEmail']; 
}

// Si hay password ya en la sesion
if($_SESSION['passwdEmail']) {
    $passwdEmail =$_SESSION['passwdEmail'];
}

if($passwdEmail) {                 // Ya logueado
   include "emailinbox.php";
}else{                             // Show login box
?>

<html>
<head>
    <title><? echo $TIT_Vista_Previa ?></title>
    <link href="../estilos/orfeo.css" rel="stylesheet" type="text/css">
</head>
<body>

<h2 align="center">
<?php
   if($err==1) echo $TIT_MSG_No_Servidor; 
?>
</h2>
<!-- table border="1"  align="center" background="../<?=$imagenes?>/orfeopasswd.jpg" -->
<table border="1"  align="center" bgcolor="#B5B5B5">
<tr><td width="360">
<form action="login_email.php?<?php echo $encabezado; ?>">
<table width="350" border="0" align="center">
     <tr> 
          <td colspan="2" align="right"><font color="#FFFFFF">
             <? echo $TIT_Ingrese_Contra ?><br><?=$usuaEmail?><br></font>
          </td>
     </tr>
     <tr> 
          <td width="182" align="center" ><p>&nbsp; </p> <p>&nbsp; </p></td>
          <td width="144" align="center" >
               <input type="password" name="passwd_mail" />
          </td>
     </tr>
     <tr> 
         <td colspan="2" align="center" >
             <input name="Submit" type="submit" class="botones" value="<? echo $TIT_Ingresar ?>">
         </td>
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
