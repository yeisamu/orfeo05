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


session_start();
$ruta_raiz = ".";
if($_SESSION["colorFondo"])  $_SESSION["colorFondo"] = "8cacc1";
$imagenes=$_SESSION["imagenes"];
include_once "$ruta_raiz/include/db/ConnectionHandler.php";
$db = new ConnectionHandler($ruta_raiz);
error_reporting(7);
$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);	
$fecha = "'FIN  ".date("Y:m:d H:mi:s")."'";
//$db->conn->debug=true;
$isql = "update usuario 
		set usua_sesion=".$fecha." 
		where USUA_SESION like '%".session_id()."%'";
//echo "Fecha $fecha "; // --- Session ->".substr(session_id(),0,29);
if (!$db->conn->Execute($isql))
{
	echo "<p><center>No pude actualizar<p><br>";
}
//  fin cierre session
session_destroy();
$PHPSESSID = "";
   
session_id("CorreLibre".date("YMDIS"));
session_start("dasdfadf");
//echo "-->".session_id();
include "./paginaError.php"
?>
