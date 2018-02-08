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
$ruta_raiz = "."; 
$nurad = $_GET["nurad"];
if($_GET["CodEjeTem"]) $CodEjeTem = $_GET["CodEjeTem"];
if($_GET["insertar_registro"]) $insertar_registro = $_GET["insertar_registro"];
if($_GET["actualizar"]) $actualizar = $_GET["actualizar"];
if($_GET["borrar"]) $borrar = $_GET["borrar"];
if($_GET["linkarchivo"]) $linkarchivo = $_GET["linkarchivo"];

if (!$ruta_raiz) $ruta_raiz= ".";
    include_once("$ruta_raiz/include/db/ConnectionHandler.php");
	$db = new ConnectionHandler("$ruta_raiz");
	if (!defined('ADODB_FETCH_ASSOC')) define('ADODB_FETCH_ASSOC',2);
   	$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;
	//$db->conn->debug=true;
	include_once ("./include/query/busqueda/busquedaPiloto1.php");
	include_once "$ruta_raiz/include/tx/Historico.php";
if ($borrar)
{		//Modificado skina
                        $sql_mod_eje = "UPDATE RADICADO SET                                                             SGD_TEMA_CODIGO='' WHERE 
                                        RADI_NUME_RADI=$nurad AND
                                        RADI_DEPE_ACTU=$dependencia AND
                                        RADI_USUA_ACTU=$codusuario";

                        $rs_mod = $db->conn->query($sql_mod_eje);
                     if ($rs_mod){
                        $mensaje="Registro Eliminado <br> ";
                        $sql1="SELECT SGD_TEMA_NOMB FROM SGD_EJE_TEMA WHERE SGD_TEMA_CODIGO='$CodEjeTem'";
                        $rs1 = $db->conn->query($sql1);

                        $observa=" Eliminado Eje tematico : ($CodEjeTem - ".$rs1->fields['SGD_TEMA_NOMB'].")";

                        $Historico = new Historico($db);
                        $codiRegH[0] = $nurad;
                        $radiModi = $Historico->insertarHistorico($codiRegH, $dependencia, $codusuario, $dependencia, $codusuario, $observa, 67);
			$CodEjeTem="";
                        }else{
			$mensaje="El Registro no fue eliminado , verifique sus datos <br> ";
                        }

 	}
  /*
  * Proceso de modificaci�n de una clasificaci�n TRD
  */
  if ($modificar)
	{
  		if ($CodEjeTem !="" )
			{	//Modificado skina

			$sql_mod_eje = "UPDATE RADICADO SET                                                             SGD_TEMA_CODIGO='$CodEjeTem' WHERE 
                                        RADI_NUME_RADI=$nurad AND
                                        RADI_DEPE_ACTU=$dependencia AND
                                        RADI_USUA_ACTU=$codusuario";
                        $rs_mod = $db->conn->query($sql_mod_eje);
                        if ($rs_mod){
			$mensaje="Registro Modificado Exitosamente <br> ";
                        $sql1="SELECT SGD_TEMA_NOMB FROM SGD_EJE_TEMA WHERE SGD_TEMA_CODIGO='$CodEjeTem'";
                        $rs1 = $db->conn->query($sql1);

                        $observa=" Modificado Eje tematico : ($CodEjeTem - ".$rs1->fields['SGD_TEMA_NOMB'].")";

                        $Historico = new Historico($db);
                        $codiRegH[0] = $nurad;
                        $radiModi = $Historico->insertarHistorico($codiRegH, $dependencia, $codusuario, $dependencia, $codusuario, $observa, 66);
                        }else{
			$mensaje="El Registro no fue Modificado , verifique sus datos <br> ";
                        }
		
		}
		
}

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
