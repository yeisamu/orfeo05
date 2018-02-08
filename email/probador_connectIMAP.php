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

//error_reporting(E_ERROR | E_PARSE);
error_reporting(E_ALL);

        /********************************************************
        *          Encabezados de librerias estandares          *
        ********************************************************/

include '../config.php';
require_once "Mail/IMAPv2.php";
include  "Mail/IMAPv2/Debug/Debug.php";

        /********************************************************
        *                   Programa Principal                  *
        ********************************************************/

$usuario="orfeo@sht.com.co";
$contrasena="hotel12345678";
$servidor_mail = $servidor_mail_imap;
$puerto_mail = $puerto_mail_imap;
// Primero se prueba con php-imap
//$puerto_mail="143";
if(imap_open ('{'.$servidor_mail.':'.$puerto_mail.'/imap/ssl/novalidate-cert/norsh}INBOX', $usuario, $contrasena)) {
    echo 'Connection success! with imap_open';
} else {
    echo 'Connection failed with imap_open
 ';
//print_r(imap_errors());
 }

exit(0);

// ----- ahora usamos IMAPv2 para conectarse

//$connection="imaps://$usuario:$contrasena@$servidor_mail:$puerto_mail/INBOX#notls";
$connection="imaps://$usuario:$contrasena@$servidor_mail:$puerto_mail/INBOX#novalidate-cert";
$msg =& new Mail_IMAPv2_Debug();

if (!$msg->connect($connection)) {
    if ($msg->error->hasErrors()) {
    //    $msg->dump($msg->error->getErrors(FALSE));
    }
    echo "Error: MSG_NO_CONNECT with IMAPv2
";
}else{
    echo 'Connection success! with IMAPv2
' ;
}
 //print_r($msg);
?>
