<? 
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

error_reporting(E_ERROR | E_PARSE);
//error_reporting(E_ALL);


session_start();
if(!isset($_SESSION['krd'])) include "../rec_session.php";

foreach ($_GET as $key => $valor)  ${$key} = $valor;
foreach ($_POST as $key => $valor) ${$key} = $valor;

if (!$ruta_raiz) $ruta_raiz = "..";

set_include_path(".:/usr/share/php:/usr/share/pear");


        /********************************************************
        *          Encabezados de librerias estandares          *
        ********************************************************/

include($ruta_raiz.'/config.php');
include "connectIMAP.php";
include "email.inc.php";

        /********************************************************
        *           Constantes del archivo                      *
        ********************************************************/

        /********************************************************
        *                   Programa Principal                  *
        ********************************************************/
?>
<html>
<HEAD>
  <STYLE TYPE="text/css">
    #flotante { position: absolute; top:100; left: 550px; visibility: visible;}
  </STYLE>
</HEAD>
<BODY>
<?
//$encabezado = session_name()."=".session_id()."&krd=$krd&fechah=$fechah";

// Email exists
if( isset($_GET['eMailMid']) && isset($_GET['eMailPid']) ) {
    $eMailMid=$_GET['eMailMid'];   // ID del mail
    $eMailPid=$_GET['eMailPid'];
    $body =$msg->getBody($_GET['eMailMid'], $_GET['eMailPid']);
    //lectura cabeceras----
    $msg->getHeaders($eMailMid);
    if($body['ftype']=="text/html")
        $nl="</br>"; 
    else
        $nl="<br>";
        

    //---Imprimo el email a borrar -------------------------------//
    $contenidoEmail = $head;
    $contenidoEmail .= $body['message'];
    $headRadicado = "<b>Fecha:</b> ".$msg->header[$eMailMid]['Date']."<br>";

    $head="<b>De:</b> ". sup_tilde($msg->header[$eMailMid]['fromaddress']).
                    " <".sup_tilde($msg->header[$eMailMid]['from']).">$nl";
    $head .="<b>Para:</b> ". sup_tilde($msg->header[$eMailMid]['toaddress']).
                    " <".sup_tilde($msg->header[$eMailMid]['to']).">$nl";
    $head .="<b>Asunto:</b> ". sup_tilde($msg->header[$eMailMid]['Subject'])."<BR>";
    $iMail = 0;
    if(count($msg->header[$eMailMid]['to_personal'])>=1) {
        foreach($msg->header[$eMailMid]['to_personal'] as $key => $value) {
            if($iMail==0) 
                $head.="Para: ";
            else
                $head.=", ";
            $head.="".sup_tilde($msg->header[$eMailMid]['to_personal'][$iMail])."";
            $head.="< ".$msg->header[$eMailMid]['to'][$iMail]." >";
            $iMail++;
        }
    }
    $head.="$nl    <b>Enviado Desde Serv:</b> ". $msg->header[$eMailMid]['sender_host'][0]."$nl$nl";

    $reeContent = $head . "\r\n". $body['message'];
    $head =$headRadicado . $head;


    //--- Procedo a borrar con la confirmacion --------------------------------//
    if($borrar=='ok') { // estoy ejecutando el envio
        $envioMail = $msg->delete($eMailMid);
        $envioMail = $msg->expunge();
        echo "<hr>";
        if(!$envioMail) {
            echo "<br>Fall&oacute; borrando correo ";
        }else{
            echo "<br>Se borr&oacute; el correo indicado <hr><br><br>";
        }
    }else{
?>
<form method='GET' action='deleteMail.php'>
<input type=hidden name=eMailMid value='<?=$eMailMid?>'>
<input type=hidden name=eMailPid value='<?=$eMailPid?>'>
<input type=hidden name=borrar value='ok'>

<input type=submit value="Confirme Borrar . . . ">
</form>
<hr>
<?    
    }
    echo $head;
    echo str_replace("\n","<br>",$body['message']);
}
else{
     print("No hay Correo disponible");
}
$fn=$body['fname'];
//--Variable con la Cabecera en formato html----------------------------------//
$nl="<br>";
$msg->close();
?>
</BODY>
</html>
