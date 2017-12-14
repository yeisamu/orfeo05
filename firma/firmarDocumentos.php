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
/**
 * Programa invoca el applet que firma los documentos correspondientes a los radicados seleccionados
 * @author      Sixto Angel Pinz�n
 * @version     1.0
 */
include_once "$ruta_raiz/class_control/firmaRadicado.php";
require_once("$ruta_raiz/include/db/ConnectionHandler.php");
include_once "$ruta_raiz/class_control/usuario.php";
include_once "$ruta_raiz/class_control/Radicado.php";

?>
<html>
<head>
<title>Registro de Solicitud de Firma</title>
<link rel="stylesheet" href="../estilos_totales.css">
</head>
<body>
<?
include "../config.php";
if (!$dependencia || !$usua_doc )   
	include "../rec_session.php";
$db = new ConnectionHandler($ruta_raiz);
$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
$objRadicado = new Radicado($db);

//Almacena la cantidad de radicados para firma
$num = count($checkValue);
//Iterador 
$i=0;
//Almacena la cadena de radicados que ha de ser enviada al applet
$radicados = "";
//Almacena la cadena de paths de los radicados que se han de firmar
$paths = "";
while ($i < $num) { 
	//Almacena temporalmente la solicitud de firma
	$record_id = key($checkValue); 
	if (strlen(trim ($radicados)) > 0){
		$radicados = $radicados . ",";
		$paths = $paths . ",";
	}
	$radicados = $radicados .  $record_id;
	
	$objRadicado->radicado_codigo($record_id);
	$paths = $paths . $objRadicado->getRadi_path();
	next($checkValue); 
	$i++;
}

?>
<APPLET  
CODEBASE="<?=$ruta_raiz?>/firma"
CODE=ap.Firma.class
archive=prueba.jar 
width=400 height=400>
<param 	name="radicados" value="<?=$radicados?>" />
<param 	name="usua_doc" value="<?=$usua_doc?>" />
<param 	name="paths" value="<?=$paths?>" />
<param 	name="servidor" value="<?=$servFirma?>" />
<param 	name="servweb" value="<?=$servWebOrfeo."/bodega/"?>" />
<param 	name="usuario" value="<?="java:".$usuario?>" />

</APPLET>

</body>
</html>
