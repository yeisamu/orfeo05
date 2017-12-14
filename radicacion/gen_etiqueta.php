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
 * Modulo que grafica una equiqueta.
 * Desarollo: Grupo Iyunxi Ltda.
 * Autoría: Fiscalía General de la Nación.
 * Julio de 2008.
 */

//Seguridad
session_start();
//if (!$_SESSION["usua_perm_tpx"]) die("Error accesando la p&aacute;gina. No tiene Privilegios.");

$ruta_raiz="..";
include "$ruta_raiz/config.php";		// incluir configuracion.

define('ADODB_ASSOC_CASE', 1);
include "$ADODB_PATH/adodb.inc.php";	// $ADODB_PATH configurada en config.php
$dsn = $driver."://".$usuario.":".$contrasena."@".$servidor."/".$db;
$conn = NewADOConnection($dsn);
//$conn->debug = true;

if ($conn)
{	
	$numRad=$_GET['r'];
	$conn->SetFetchMode(ADODB_FETCH_ASSOC);
	$sqlfn = $conn->SQLDate('Y-m-d H:i:s','RADI_FECH_RADI');
	$sql = "SELECT RADI_NUME_RADI, $sqlfn as RADI_FECH_RADI, RADI_DESC_ANEX FROM RADICADO WHERE RADI_NUME_RADI=$numRad";
	$vct = $conn->GetRow($sql);
	
//	if (isset($_GET['r']))
//	{
		/*
		if (!defined('RELATIVE_PATH')) define('RELATIVE_PATH',$_SERVER['DOCUMENT_ROOT']."html2fpdf-3.0.2b/");
		if (!defined('FPDF_FONTPATH')) define('FPDF_FONTPATH',RELATIVE_PATH.'font/');
		require_once($_SERVER['DOCUMENT_ROOT']."html2fpdf-3.0.2b/html2fpdf.php");
		// activate Output-Buffer:
		ob_start();
		$pdf = new HTML2FPDF('P','cm','5x3');
		$pdf->DisableTags();
		$pdf->DisplayPreferences('FullScreen');
		*/
//	}
}
?>
<html>
<head></head>
<body marginheight="0" marginwidth="0">
<table align="left" height="60">
<tr>
	<td><img width="44" height="59" src="../logoEtiqueta.gif"></td>
	<td> </td>
	<td align="center" ><FONT FACE="Arial" size="1">Sistema de Gesti&oacute;n Documental</font><br>
		<FONT FACE="Code3of9" size="5">*<?=$vct['RADI_NUME_RADI']?>*</FONT><br>
		<b><FONT FACE="Arial" size="1"> No. <?=$vct['RADI_NUME_RADI']?></b><br>
		Fecha Radicado: <?=$vct['RADI_FECH_RADI']?><br>
<!--		Anexos: <?=$vct['RADI_DESC_ANEX']?>.</font> -->
	</td>
</tr>
</table>
</body>
</html>
<?php
/*
// Output-Buffer in variable:
$html=ob_get_contents();
// delete Output-Buffer
ob_end_clean();
$pdf->AddPage();
$pdf->WriteHTML($html);
$pdf->Output($vct['RADI_NUME_RADI'].'pdf','I');
*/
?>
