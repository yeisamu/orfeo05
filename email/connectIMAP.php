<?php
/**
 * En este frame se van cargado cada una de las funcionalidades del sistema
 *
 * Descripcion Larga
 *
 * @category
 * @package      SGD Orfeo
 * @subpackage   Main
 * @author       Community
 * @author       Skina Technologies SAS (http://www.skinatech.com)
 * @license      GNU/GPL <http://www.gnu.org/licenses/gpl-2.0.html>
 * @link         http://www.orfeolibre.org
 * @version      SVN: $Id$
 * @since
 */

        /*---------------------------------------------------------+
        |                     INCLUDES                             |
        +---------------------------------------------------------*/


        /*---------------------------------------------------------+
        |                    DEFINICIONES                          |
        +---------------------------------------------------------*/


        /*---------------------------------------------------------+
        |                       MAIN                               |
        +---------------------------------------------------------*/



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
if ( $protocolo_mail == "imaps" ){
  $connection = "$protocolo_mail://$usuaEmail:$passwdEmail@$servidor_mail:$puerto_mail/$buzon_mail#novalidate-cert";
} else {
  $connection = "$protocolo_mail://$usuaEmail:$passwdEmail@$servidor_mail:$puerto_mail/$buzon_mail#notls";
}
if (!isset($_GET['dump_mid'])) {
   $msg =& new Mail_IMAPv2();
  // print_r($msg);
} else {
    include  "Mail/IMAPv2/Debug/Debug.php";
    $msg =& new Mail_IMAPv2_Debug($connection);
}
?>
<!--<div style='display:none;'>-->
<div style='display:none'>
<?php
// Open up a mail connection
if (!$msg->connect($connection)) {
    if ($msg->error->hasErrors()) {
    //    print_r($msg->error->getErrors(FALSE));
    }
  // echo "<span style='font-weight: bold;'>Error:</span> $MSG_NO_CONNECT";
}
// print_r($msg);
?>
</div>
