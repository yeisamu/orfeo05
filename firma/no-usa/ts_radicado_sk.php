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


/**
* Administrador de firmas digitales
* Sistema de gestion Documental ORFEO.
* Permite poner timestamp a un documento 
*/

    session_start(); 
    $ruta_raiz = ".."; 
    
    $krd = $_SESSION["krd"];
    $dependencia = $_SESSION["dependencia"];
    $usua_doc = $_SESSION["usua_doc"];
    $codusuario = $_SESSION["codusuario"];
    
    //valido sesion
     if(!$_SESSION['dependencia'])        include "$ruta_raiz/rec_session.php";

    //traigo el radicado y la contrasena
    if($_REQUEST["valRadio"]) $valRadio=$_REQUEST["valRadio"];
    if($_REQUEST["contra"]) $contra=$_REQUEST["contra"];

    require_once("$ruta_raiz/include/db/ConnectionHandler.php");
    $db = new ConnectionHandler($ruta_raiz);
    //$db->conn->debug=true;

    $encabezado = "".session_name()."=".session_id()."";
    $linkPagina = "$PHP_SELF?$encabezado&orderTipo=$orderTipo&orderNo=";

   //genero una solicitud ts y la envio con curl
   $cmdt="openssl ts -query -data $document -no_nonce -out diff2.tsq | cat $document.tsq | curl -s -S -H 'Content-Type: application/timestamp-query' --data-binary @- http://timestamp.verisign.com/ -o $document.tsr";
   exec($cmdt,$exec_outputt,$exec_returnt);
?>
