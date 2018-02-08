<?php
/************************************************************************
# PROYECTO: Orfeo   MODULO: Email - connectIMAP.php  FECHA: Octubre 2012*
#~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*
#                                                                       *
#  Conexion al servidor de Correo electronico                           *
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

// error_reporting(E_ERROR | E_PARSE);
error_reporting(E_ALL);

session_start();
if(!isset($_SESSION['krd'])) include "../rec_session.php";

set_include_path(".:/usr/share/php:/usr/share/pear");

        /********************************************************
        *          Encabezados de librerias estandares          *
        ********************************************************/

require_once "Mail/IMAPv2.php";

        /********************************************************
        *           Constantes del archivo                      *
        ********************************************************/

$MSG_NO_CONNECT="No se pudo realizar la conexion al serv. de correo.";

        /********************************************************
        *           Variables  del archivo                      *
        ********************************************************/

$protocolo_mail = $_SESSION['protocolo_mail'];
$servidor_mail = $_SESSION['servidor_mail'];

$passwdEmail=$_SESSION['passwdEmail'];
$usuaEmail = $_SESSION['usua_email'];
$usuaDoc = $_SESSION['usua_doc'];
$puerto_mail = $_SESSION['puerto_mail'];
$tmpNameEmail = "tmpEmail_".$usuaDoc."_".md5(date("dmy hms")).".html";
$_SESSION['tmpNameEmail'] = $tmpNameEmail;

// var_dump($_SESSION); 
//echo $usuaEmail,"-",$dominioEmail,"-",$passwdEmail,"+" ;


        /********************************************************
        *                   Programa Principal                  *
        ********************************************************/

if(!$_SESSION['eMailPid']) {
    $_SESSION['eMailAmp']=$_GET['mid'];
    $_SESSION['eMailPid']=$_GET['pid'];
    $eMailPid = $_GET['pid'];
    $eMailMid = $_GET['mid'];
}else{
    $eMailPid = $_SESSION['eMailPid'];
    $eMailMid = $_SESSION['eMailMid'];
    $eMailAmp = $_SESSION['eMailAmp'];
}
list($a,$b)=split("@",$usuaEmail);
$usuaEmail1=$a;

$buzon_mail = $_SESSION['buzon_mail'];
$connection = "$protocolo_mail://$usuaEmail:$passwdEmail@$servidor_mail:$puerto_mail/$buzon_mail#notls"; 
// print_r($connection);

if (!isset($_GET['dump_mid'])) {
    $msg =& new Mail_IMAPv2();
} else {
    include  "Mail/IMAPv2/Debug/Debug.php";
    $msg =& new Mail_IMAPv2_Debug($connection);
}
// Open up a mail connection
if (!$msg->connect($connection)) {
    if ($msg->error->hasErrors()) {
         // print_r($msg->error->getErrors(FALSE));
    }
    // echo "<span style='font-weight: bold;'>Error:</span> $MSG_NO_CONNECT";
}
// print_r($msg);
?>
