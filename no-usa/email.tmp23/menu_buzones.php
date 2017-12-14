<?php
/************************************************************************
# PROYECTO: Orfeo    MODULO: Email - menu_buzones.php FECHA: Oct 2012   *
#~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*
#                                                                       *
# Muestra los buzones de la cuente de correo                            *
#                                                                       *
#  Una vez se ha proveido la contrasena,  este programa es llamado en   *
#  marco izquierdo y despliega las carpetas del buzon.                  *
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
// error_reporting(E_ERROR | E_PARSE);

session_start();
if(!isset($_SESSION['krd'])) include "../rec_session.php";

foreach ($_GET as $key => $valor)  ${$key} = $valor;
foreach ($_POST as $key => $valor) ${$key} = $valor;

set_include_path(".:/usr/share/php:/usr/share/pear");


?>
<html>
<body>
<?

        /********************************************************
        *          Encabezados de librerias estandares          *
        ********************************************************/

include "connectIMAP.php";  

        /********************************************************
        *           Constantes del archivo                      *
        ********************************************************/

$TIT_Recargar_Carpetas="Recargar Carpetas";

        /********************************************************
        *                   Programa Principal                  *
        ********************************************************/


if($msg->getMailboxes($host)) {
    $listMailBoxes = $msg->getMailboxes($host);
    foreach($listMailBoxes as $name) {
?>
-<font size=1>
 <a href='emailinbox.php?inboxEmail=<?=$name?>' target='formulario'>
<?=$name?></a></font><br>
<?
    }
}else {
?>
<br>
<font size=1>
<a href='login_email.php?inboxEmail=<?=$name?>' target='formulario'> Inbox</a>
</font>
<br><br><br>
<a href='menu_buzones.php?inboxEmail=<?=$name?>'><?echo $TIT_Recargar_Carpetas ?></a></font><br>    
<?
}
?>

</body>
</html>
