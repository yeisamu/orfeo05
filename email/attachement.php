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

//error_reporting(E_ALL);
error_reporting(E_ERROR | E_PARSE);

session_start();
if(!isset($_SESSION['krd'])) include "../rec_session.php";

foreach ($_GET as $key => $valor)  ${$key} = $valor;
foreach ($_POST as $key => $valor) ${$key} = $valor;

if (!$ruta_raiz) $ruta_raiz = "..";

set_include_path(".:/usr/share/php:/usr/share/pear");

        /********************************************************
        *           Constantes del archivo                      *
        ********************************************************/

$MSG_NO_CORREO="No hay Correo disponible";

        /********************************************************
        *          Encabezados de librerias estandares          *
        ********************************************************/

include $ruta_raiz.'/config.php' ;   // configuracion general
include 'email.inc.php' ;
include 'connectIMAP.php';           // Conecta a servidor correo

       /********************************************************
        *                   Programa Principal                  *
        ********************************************************/

// $encabezado = session_name()."=".session_id()."&krd=$krd&fechah=$fechah";
//echo $encabezado;
//$krd = $_SESSION['krd'];
//$tmpNameEmail = $_SESSION['tmpNameEmail'];
//echo var_dump($_SESSION);

//$usuaDoc = $_SESSION['usua_doc'];
//$tmpNameEmail = "tmpEmail_".$usuaDoc."_".md5(date("dmy hms")).".html";
//$_SESSION['tmpNameEmail'] = $tmpNameEmail;

if(isset($_GET['mid'])&&isset($_GET['pid'])){
    // Cargo el correo
    $body =$msg->getBody($_GET['mid'], $_GET['pid']);
    $msg->getHeaders($mid);
    header('Content-Type: '.$body['ftype']);
//  $eMailRemitente = $_SESSION['eMailRemitente'];
//  $eMailNombreRemitente = $_SESSION['eMailNombreRemitente'];
    if($body['ftype']=="text/html") $nl="</br>"; else $nl="\n";
    
    echo $head;
    echo $body['message'];

    // lo mando a un archivo temporal binario
//    $content = "". $head . $body['message'];
//    $file = "correoEj";
//    $dirTmp = "../bodega/tmp/";
//    $fd = fopen($dirTmp.$file . ".html", "a+");
//    fwrite($fd, "$content");
//    fclose($fd);
}else{
   print($MSG_NO_CORREO);
}
$fn=$body['fname'];
$msg->close();    // esto lo abrio el connectIMAP

//-----Almacena temporalmente el archivo en formato html-----//
//$fileEmailMsg = $ruta_raiz."/bodega/tmp/".$tmpNameEmail;
//$file1=fopen($fileEmailMsg,'w');
//fputs($file1,$head);
//--Adiciona el mensage--------//
//fwrite($file1,$body['message']);
//fclose($file1);
//-----------------------------//

?>
