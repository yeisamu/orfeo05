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
foreach ($_GET as $key => $valor)   ${$key} = $valor;
foreach ($_POST as $key => $valor)   ${$key} = $valor;

$krd = $_SESSION["krd"];
$dependencia = $_SESSION["dependencia"];
$depe_nomb = $_SESSION["depe_nomb"];
$usua_nomb = $_SESSION["usua_nomb"];
$usua_doc = $_SESSION["usua_doc"];
$codusuario = $_SESSION["codusuario"];

$ruta_raiz = "..";
if(!isset($_SESSION['dependencia']) or !isset($_SESSION['nivelus'])) include "$ruta_raiz/rec_session.php";
error_reporting(0);
/*  REALIZAR TRANSACCIONES^M
 *  Este archivo realiza las transacciones de radicados en Orfeo.^M
 */
?>
<html>
<head>
<title>Realizar Transaccion - Orfeo </title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="../estilos/orfeo.css">
</head>
<?
/**^M
  * Inclusion de archivos para utiizar la libreria ADODB^M
  *^M
  */
include_once "$ruta_raiz/include/db/ConnectionHandler.php";
$db = new ConnectionHandler("$ruta_raiz");
 
include "skn_srm_prueba.php";
$db->conn->debug=true;
$rs = new webservice($db);

$file ='TXV5IGJpZW4uIEVsIHRleH RvIGVzdGFiYSBjb2RpZmlj YWRvIGVuIGJhc2UgNjQuDQ pMYSByZXNwdWVzdGEgcXVl IGRlYmVzIGNvbG9jYXIgcG FyYSBwYXNhciBkZSBuaXZl bCBlcyBlbCBh8W8gZGUgbm FjaW1pZW50byBkZWwgZXNj cml0b3IgSG93YXJkIFBoaW xsaXBzIExvdmVjcmFmdC4';
$filename = 'prueba.pdf';
$destinatario ='Empresa XRM';
$direccion = 'calle pepito 123';
$telefono = '123';
$tdoc= '0';
$no_rm = '63000SD';
//$no_rm = '';
$no_tran = '2456';

$a = $rs->radicarDocumento($file,$filename,$destinatario,$direccion,$telefono,$tdoc,$no_rm,$no_tran);
/*$noRad = '20118000000702';
//$b = $rs->crearAnexo($noRad,$file,$filename,$tdoc,$no_tran);
//$c = $rs->consultarDocumento($noRad,'','','','');
//$c = $rs->consultarDocumento('','SOUND','','','');
//$c = $rs->consultarDocumento('','','63000SD','','');
//$c = $rs->consultarDocumento('','','','','2456');
$email='empresaxrm@empresaxrm.com';
$status='en problema';
$d = $rs->actualizarDocumento($noRad,$destinatario,$direccion,$telefono,$email,$status,$no_rm);*/
print_r($a);
?>
