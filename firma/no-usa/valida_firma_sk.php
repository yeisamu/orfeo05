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
* Permite validar un certificado pkc12 para su posterior uso 
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

   //valido el certificado vs password 
   $cmdv="openssl pkcs12 -in $certificate -noout -passin pass:$contra";
   exec($cmdv,$exec_outputv,$exec_returnv);

    //Si la validacion fue exitosa verifico crl, de lo contrdario no       
    if($exec_returnv==0){	
	//convierto a x509 para obtener serial
	$cmdc="openssl pkcs12 -in $certificate -out $certificate.pem -nodes -passin pass:$contra";	
   	exec($cmdc,$exec_outputc,$exec_returnc);
	
	//SI la conversion estuvo OK obtengo serial
    	if($exec_returnc==0){	
		$cmds= "openssl x509 -in $certificate.pem -serial -noout";	
   		exec($cmds,$exec_outputs,$exec_returns);
		$serial = substr($exec_outputs[0],7) ;
		//echo "serial $serial";
		//valido en listado de CRL
		$file = file("/bodega/crl/full.crl");
		foreach($file as $line)
		{
		  if(strpos($line, $serial) !== false)
		  {	
			$valida= "ER - CRL";
		  }
		}
	}else $valida= "ER - SERIAL";
    }else $valida= "ER - PASSWORD";
?>
