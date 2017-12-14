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
* Permite buscar un radicado para su posterior firma
*/

    session_start();
    $ruta_raiz = "..";
    if(!isset($_SESSION['dependencia']))	include "$ruta_raiz/rec_session.php";
    $krd = $_SESSION["krd"];
    $dependencia = $_SESSION["dependencia"];
    $usua_doc = $_SESSION["usua_doc"];
    $codusuario = $_SESSION["codusuario"];

    if($_GET["orderNo"]) $orderNo=$_GET["orderNo"];
    if($_REQUEST["orderTipo"]) $orderTipo=$_GET["orderTipo"];
    if($_REQUEST["busqRadicados"]) $busqRadicados=$_REQUEST["busqRadicados"];
    if($_REQUEST["Buscar"]) $Buscar=$_REQUEST["Buscar"];
    if($_REQUEST["$busq_radicados_tmp"]) $$busq_radicados_tmp=$_REQUEST["$busq_radicados_tmp"];

    require_once("$ruta_raiz/include/db/ConnectionHandler.php");
    $db = new ConnectionHandler($ruta_raiz);

    $encabezado = "".session_name()."=".session_id()."&busqRadicados=$busqRadicados&busq_radicados_tmp=$busq_radicados_tmp";
    $linkPagina = "$PHP_SELF?$encabezado&orderTipo=$orderTipo&orderNo=$orderNo";
?>
    <HTML>
    <head>
    <link rel="stylesheet" href="<?=$ruta_raiz?>/estilos/orfeo.css">
    </head>
    <BODY>
    <FORM ACTION="<?=$_SERVER['PHPSELF']?>?<?=session_name()?>=<?=session_id()?>" method="POST">
<?
    //incluyo barra de busqueda de orfeo
    $varBuscada = "(RADI_NUME_RADI)";
    include "$ruta_raiz/envios/paEncabeza.php";
    include "$ruta_raiz/envios/paBuscar.php";

?>
    </FORM>
    <FORM ACTION="formUpload.php?<?=$encabezado?>" method="POST">
    <center><input type="submit" value="Asociar Firma del Radicado" name=asocfirmRad class="botones_largo"></center>
<?

    if($Buscar AND $busq_radicados_tmp)
    {
    
	//include "$ruta_raiz/include/query/uploadFile/queryUploadFileRad.php";
	include "$ruta_raiz/include/query/firma/queryUploadFirmaRad.php";

	$rs=$db->conn->Execute($query);

	//$db->conn->debug=true;
	if ($rs->EOF)  {
		echo "<hr><center><b><span class='alarmas'>No se encuentra ningun radicado con el criterio de busqueda</span></center></b></hr>";
	}
	else{
		$orderNo =1;
		$orderTipo=" Desc ";
		$pager = new ADODB_Pager($db,$query,'adodb', true,$orderNo,$orderTipo);
		$pager->checkAll = false;
		$pager->checkTitulo = true;
		$pager->toRefLinks = $linkPagina;
		$pager->toRefVars = $encabezado;
		$pager->descCarpetasGen=$descCarpetasGen;
		$pager->descCarpetasPer=$descCarpetasPer;
		$pager->Render($rows_per_page=100,$linkPagina,$checkbox=chkAnulados);
	}
}
?>
    </FORM>
    </BODY>
    </HTML>
