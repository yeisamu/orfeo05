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


/* Creo el parametro que permite ponerle nombre a los expedientes

* Ing. Isabel Rodriguez
* SkinaTech
* Fecha: 5-Junio-2012
* Sistema de gestion Documental ORFEO.
*
*/
session_start();
$ruta_raiz = "..";
include_once("$ruta_raiz/include/db/ConnectionHandler.php");
if(!isset($_SESSION['dependencia']))        include "$ruta_raiz/rec_session.php";
$db = new ConnectionHandler( "$ruta_raiz" );
    $db->conn->debug = true;



  $query  = "SELECT DEPE_CODI";
    $query .= " FROM dependencia";
    // print "query: ".$query;

    $db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
    $rs = $db->query($query);
    while( !$rs->EOF )
    {
	$depe_codi=$rs->fields["DEPE_CODI"];
	//$sql="insert into sgd_parexp_paramexpediente(depe_codi,sgd_parexp_tabla,sgd_parexp_etiqueta,sgd_parexp_orden,sgd_parexp_editable) values ('$depe_codi','','Nombre carpeta',1,1)";
	$sql="insert into sgd_parexp_paramexpediente(sgd_parexp_codigo,depe_codi,sgd_parexp_tabla,sgd_parexp_etiqueta,sgd_parexp_orden,sgd_parexp_editable) values ($depe_codi,'$depe_codi','','Nombre carpeta',1,1)";
    	$rss = $db->query($sql);
	if(!$rss->EOF) echo" Creo parametro para $depe_codi <br>";
	else echo"No creo el parametro para $depe_codi";
	  $rs->MoveNext();
	}
?>
