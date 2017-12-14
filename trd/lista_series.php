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
 * @autor Jairo Losada SuperSOlidaria 
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
$sqlSubstDescS = $db->conn->substr . "(SGD_SRD_DESCRIP, 0, 40)";
$sqlFechaD = $db->conn->SQLDate("Y-m-d H:i A", "SGD_SRD_FECHINI");
$sqlFechaH = $db->conn->SQLDate("Y-m-d H:i A", "SGD_SRD_FECHFIN");
$isqlC = 'select 
			  SGD_SRD_CODIGO          AS "CODIGO",
			' . $sqlSubstDescS . '    AS "SERIE",
			' . $sqlFechaD . ' 			  as "DESDE",
			' . $sqlFechaH . ' 			  as "HASTA" 
			from 
				SGD_SRD_SERIESRD
				' . $whereBusqueda . '
			order by  ' . $sqlSubstDescS;
error_reporting(7);
?>
<!--<table class=borde_tab width='100%' cellspacing="5"><tr><td class=titulos2><center>SERIES DOCUMENTALES</center></td></tr></table>-->
<table><tr><td></td></tr></table>
<br>
<TABLE width="770" class="borde_tab" border="2" cellspacing="5">
    <tr> <div id="titulo" style="width: 770px;" align="center">Series documentales</div>
</tr>
<tr class=tpar> 
    <td class=titulos3 align=center>Código</td>
    <td class=titulos3 align=center>Descripcion</td>
    <td class=titulos3 align=center>Desde</td>
    <td class=titulos3 align=center>Hasta</td>
</tr>
<?php
$rsC = $db->query($isqlC);
while (!$rsC->EOF) {
    $codserie = $rsC->fields["CODIGO"];
    $dserie = $rsC->fields["SERIE"];
    $fini = $rsC->fields["DESDE"];
    $ffin = $rsC->fields["HASTA"];
    ?> 
    <tr class=listado2>
        <td> <?= $codserie ?></td>
        <td align=left> <?= $dserie ?> </td>
        <td> <?= $fini ?> </td>
        <td> <?= $ffin ?> </td>
    </tr>
    <?
    $rsC->MoveNext();
}
//<font face="Arial, Helvetica, sans-serif" class="etextomenu">
?>
</table>
