<?php
/************************************************************************
# PROYECTO: Orfeo MODULO: Email - probador_conexionIMAP FECHA: Oct2012  *
#~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*
#                                                                       *
#  Un simple archivo para probar la conectividad del servidor correo    *
#  puede ser llamado usando cli:   php probador_conexionIMAP.php        *
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

error_reporting(E_ERROR | E_PARSE);
//error_reporting(E_ALL);

        /********************************************************
        *          Encabezados de librerias estandares          *
        ********************************************************/

include '../config.php';
require_once "Mail/IMAPv2.php";
include  "Mail/IMAPv2/Debug/Debug.php";

        /********************************************************
        *                   Programa Principal                  *
        ********************************************************/

$usuario="skina";
$contrasena="";

// Primero se prueba con php-imap
$puerto_mail="143";
if(imap_open ('{'.$servidor_mail.':'.$puerto_mail.'/novalidate-cert}INBOX', $usuario, $contrasena)) {
    echo 'Connection success! with imap_open
';
} else {
    echo 'Connection failed with imap_open
 ';
 }


// ----- ahora usamos IMAPv2 para conectarse

$connection="imap://$usuario:$contrasena@$servidor_mail:$puerto_mail/INBOX#notls";
$msg =& new Mail_IMAPv2_Debug();

if (!$msg->connect($connection)) {
    if ($msg->error->hasErrors()) {
        $msg->dump($msg->error->getErrors(FALSE));
    }
    echo "Error: MSG_NO_CONNECT with IMAPv2
";
}else{
    echo 'Connection success! with IMAPv2
' ;
}
// print_r($msg);
?>
