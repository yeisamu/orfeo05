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

$krd = $_SESSION["krd"];
$dependencia = $_SESSION["dependencia"];
$usua_doc = $_SESSION["usua_doc"];
$codusuario = $_SESSION["codusuario"];
$ruta_raiz = "..";

$whereFiltro = $_GET["whereFiltro"];
$whereFiltro2 = $_GET["whereFiltro2"];

if($_GET["coddepe"]) $coddepe = $_GET["coddepe"];
if($_GET["codusua"]) $codusua = $_GET["codusua"];
if($_GET["codserie"]) $codserie = $_GET["codserie"];
if($_GET["tsub"]) $tsub = $_GET["tsub"];
if($_GET["tdoc"]) $tdoc = $_GET["tdoc"];
if($_GET["insertar_registro"]) $insertar_registro = $_GET["insertar_registro"];
if($_GET["modificar"]) $modificar = $_GET["modificar"];
if($_GET["borrar"]) $borrar = $_GET["borrar"];
if($_GET["linkarchivo"]) $linkarchivo = $_GET["linkarchivo"];
if($_GET["codiTRDEli"]) $codiTRDEli = $_GET["codiTRDEli"];

include_once("$ruta_raiz/include/db/ConnectionHandler.php");
$db = new ConnectionHandler("$ruta_raiz");
if (!defined('ADODB_FETCH_ASSOC')) define('ADODB_FETCH_ASSOC',1);
$ADODB_FETCH_MODE = $ADODB_FETCH_ASSOC;
//$db->conn->debug=true;

include_once ("../include/query/busqueda/busquedaPiloto1.php");
include_once "$ruta_raiz/include/tx/Historico.php";
include_once ("$ruta_raiz/class_control/TipoDocumentalMultiple.php");
$trd = new TipoDocumental($db);

if ($borrar)
{		//Modificado skina
		$sqlE = "SELECT cast(radi_nume_radi as varchar(15)) as RADI_NUME_RADI
					FROM SGD_RDF_RETDOCF b
					WHERE SGD_MRD_CODIGO =  '$codiTRDEli'
				    	     $whereFiltro";
		$rsE=$db->conn->query($sqlE);
		$i=0;
		while(!$rsE->EOF)
		{
	    	$codiRegE[$i] = $rsE->fields['RADI_NUME_RADI'];
	    	$i++;
			$rsE->MoveNext();
		}
		$TRD = $codiTRDEli;
		include "$ruta_raiz/radicacion/detalle_clasificacionTRD.php";
	    	$observa = "*Eliminado TRD*".$deta_serie."/".$deta_subserie."/".$deta_tipodocu;
		
		$Historico = new Historico($db);		  
  		  //$radiModi = $Historico->insertarHistorico($codiRegE, $coddepe, $codusua, $coddepe, $codusua, $observa, 33); 
		$radiModi = $Historico->insertarHistorico($codiRegE, $dependencia, $codusuario, $dependencia, $codusuario, $observa, 33); 
		//$whereFiltro2=  substr($whereFiltro2,0,(strlen($whereFiltro2)-1));
		$radicados = $trd->eliminarTRD($whereFiltro2,$coddepe,$usua_doc,$codusua,$codiTRDEli);
		$mensaje="Archivo eliminado<br> ";
 	}
  /*
  * Proceso de modificación de una clasificación TRD
  */
  if ($modificar)
	{
  		if ($tdoc !=0 && $tsub !=0 && $codserie !=0 )
			{	//Modificado skina
				$sqlH = "SELECT cast(radi_nume_radi as varchar(15)) as RADI_NUME_RADI,
				        	SGD_MRD_CODIGO 
					 FROM SGD_RDF_RETDOCF b
					 WHERE DEPE_CODI = '$coddepe'
				    		$whereFiltro";
				$rsH=$db->conn->query($sqlH);
				$codiActu = $rsH->fields['SGD_MRD_CODIGO'];
				$i=0;
				while(!$rsH->EOF)
				{
	    			$codiRegH[$i] = $rsH->fields['RADI_NUME_RADI'];
	    			$i++;
					$rsH->MoveNext();
				}
                                $codiRegIn = explode(",",$whereFiltro2);
				$rad_nuetrd = array_diff($codiRegIn, $codiRegH);
				$TRD = $codiActu;
		        	include "$ruta_raiz/radicacion/detalle_clasificacionTRD.php";
				
		  		//$observa = "*Modificado TRD* ".$deta_serie."/".$deta_subserie."/".$deta_tipodocu;
  		  		//$Historico = new Historico($db);		  
  		  		//$radiModi = $Historico->insertarHistorico($codiRegH, $coddepe, $codusua, $coddepe, $codusua, $observa, 32); 
				//$radiModi = $Historico->insertarHistorico($codiRegH, $dependencia, $codusuario, $dependencia, $codusuario, $observa, 32); 
		  		/*
		  		*Actualiza el campo tdoc_codi de la tabla Radicados
		  		*/
		 		$radiUp = $trd->actualizarTRD($codiRegH,$tdoc);
				$mensaje="Registro Modificado";
				$isqlTRD = "select SGD_MRD_CODIGO 
						from SGD_MRD_MATRIRD 
						where DEPE_CODI = '$coddepe'
				 	   	and SGD_SRD_CODIGO = '$codserie'
				       		and SGD_SBRD_CODIGO = '$tsub'
					   	and SGD_TPR_CODIGO = '$tdoc'";
			
				$rsTRD = $db->conn->Execute($isqlTRD);
				$codiTRDU = $rsTRD->fields['SGD_MRD_CODIGO'];
				if (is_array($rad_nuetrd) && $rad_nuetrd != null) {
				$codiTRDS[0] = $codiTRDU;
				$codiTRD = $codiTRDU;
				 $radi_ingr = $trd->insertarTRD($codiTRDS,$codiTRD,substr($whereFiltro2,0,-2),$coddepe, $codusua);
				}
				$whereFiltro2=  substr($whereFiltro2,0,(strlen($whereFiltro2)-1));

				$sqlUA = "UPDATE SGD_RDF_RETDOCF SET SGD_MRD_CODIGO = '$codiTRDU',
						  USUA_CODI = '$codusua'
						  WHERE DEPE_CODI =  '$coddepe' 
						and RADI_NUME_RADI IN ($whereFiltro2)";
				$rsUp = $db->conn->query($sqlUA);
		$mensaje="Registro Modificado   <br> ";

		}
		
}
		$tdoc = '';
		$tsub = '';
		$codserie = '';

?>

</script>
<body bgcolor="#FFFFFF" topmargin="0">
<br>
<div align="center">
<p>
<?=$mensaje?>
</p>
<input type='button' value='   Cerrar   ' class='botones_largo' onclick='opener.regresar();window.close();'>
</body>
</html> 
