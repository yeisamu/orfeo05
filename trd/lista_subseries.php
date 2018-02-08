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
/*
 * Lista Subseries documentales
 * @autor Jairo Losada
 * @fecha 2009/06 Modificacion Variables Globales.
 */
foreach ($_GET as $key => $valor)
    ${$key} = $valor;
foreach ($_POST as $key => $valor)
    ${$key} = $valor;
$krd = $_SESSION["krd"];
$dependencia = $_SESSION["dependencia"];
$usua_doc = $_SESSION["usua_doc"];
$codusuario = $_SESSION["codusuario"];
if (!$ruta_raiz)
    $ruta_raiz = "..";
if (!isset($whereBusqueda))
    $whereBusqueda = "";
$sqlFechaDocto = $db->conn->SQLDate("Y-m-D H:i:s A", "mf.sgd_rdf_fech");
$sqlSubstDescS = $db->conn->substr . "(SGD_SBRD_DESCRIP, 0, 40)";
$sqlFechaD = $db->conn->SQLDate("Y-m-d H:i A", "SGD_SBRD_FECHINI");
$sqlFechaH = $db->conn->SQLDate("Y-m-d H:i A", "SGD_SBRD_FECHFIN");
$isqlC = 'select 
		SGD_SBRD_CODIGO          AS "CODIGO",
	' . $sqlSubstDescS . '    AS "SUBSERIE",
	' . $sqlFechaD . ' 			  as "DESDE",
	' . $sqlFechaH . ' 			  as "HASTA" 
	from 
		SGD_SBRD_SUBSERIERD
	where
			SGD_SRD_CODIGO = ' . $codserie .
        $whereBusqueda . '
	order by  ' . $sqlSubstDescS;
error_reporting(7);
?>
<br>
<!--	<table class=borde_tab width='95%' cellspacing="5"><tr><td class=titulos2><center>SUBSERIES DOCUMENTALES</center></td></tr></table>-->
<TABLE width="850" border="1" class="borde_tab" cellspacing="5">
    <tr class=tpar> 
        <td class=titulos3 align=center>Código</td>
        <td class=titulos3 align=center>Descripción</td>
        <td class=titulos3 align=center>Desde</td>
        <td class=titulos3 align=center>Hasta</td>
    </tr>
    <?php
    $rsC = $db->query($isqlC);
    while (!$rsC->EOF) {
        $tsub = $rsC->fields["CODIGO"];
        $dsubserie = $rsC->fields["SUBSERIE"];
        $fini = $rsC->fields["DESDE"];
        $ffin = $rsC->fields["HASTA"];
        ?> 
        <tr class=listado2>
            <td> <?= $tsub ?> </td>
            <td align=left><?= $dsubserie ?> </td>
            <td> <?= $fini ?> </td>
            <td> <?= $ffin ?></td> 
        </tr>
        <?
        $rsC->MoveNext();
    }
    ?>
</table>
