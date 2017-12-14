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
//$db ->conn->debug = true;
if (!$ruta_raiz)
    $ruta_raiz = "..";
$sqlFechaDocto = $db->conn->SQLDate("Y-m-D H:i:s A", "mf.sgd_rdf_fech");
$sqlSubstDescS = $db->conn->substr . "(SGD_TPR_DESCRIP, 0, 75)";

$sql = "SELECT 
	SGD_TRAD_CODIGO
	,SGD_TRAD_DESCR 
	FROM SGD_TRAD_TIPORAD ORDER BY SGD_TRAD_CODIGO";
$ADODB_COUNTRECS = true;
//$rs_trad = $db->query($sql);
$rs_trad = $db->conn->query($sql);
if ($rs_trad->RecordCount() >= 0) {
    $til = "SGD_TPR_TP";
    $isqlC = 'select 
	SGD_TPR_CODIGO AS "CODIGO"
	, ' . $sqlSubstDescS . ' AS "TIPOD"
	,SGD_TPR_TERMINO As "TERMINO"
	,SGD_TPR_ESTADO as "ESTADO"
	,SGD_TPR_RADICA,';
    $i = 0;
    while ($arr = $rs_trad->FetchRow()) {
        $cod .= $til . $arr['SGD_TRAD_CODIGO'] . " As \"" . strtoupper($arr['SGD_TRAD_DESCR']) . "\",";

        $titu .= "<td class=titulos3 align=center>";
        $titu .= strtoupper($arr['SGD_TRAD_DESCR']);
        $titu .= "</td>";

        $matriz[$i] = strtoupper($arr['SGD_TRAD_DESCR']);
        $i = $i + 1;
    }
    $cod = substr($cod, 0, strlen($cod) - 1);
    $isqlC .= $cod . ' from SGD_TPR_TPDCUMENTO ' . $whereBusqueda . ' order by  ' . $sqlSubstDescS;

    //$rsC=$db->query($isqlC);
    $rsC = $db->conn->query($isqlC);
    while (!$rsC->EOF) {
//        $val .= "<tr class='listado1'>";
        $val .= ($indice%2==0)?"<tr class='listado2'>":"<tr class='listado1'>";
        $val .= "<td>" . $rsC->fields["CODIGO"] . "</td>";
        $val .= "<td align='left'>" . $rsC->fields["TIPOD"] . "</td>";
        $val .= "<td>" . $rsC->fields["TERMINO"] . "</td>";
        $conteo = count($matriz);
        for ($j = 0; $j < $conteo; $j++) {
            $val .= "<td>" . $rsC->fields[$matriz[$j]] . "</td>";
        }
        $val .= '<td>' . $rsC->fields["ESTADO"] . '</td>';
        $val .= '<td>' . $rsC->fields["SGD_TPR_RADICA"] . '</td></tr>';
        $rsC->MoveNext();
        $indice++;
    }
}
//else $tipos .= "<tr><td align='center'> NO SE HAN GESTIONADO TIPOS DE RADICADOS</td></tr>";
$ADODB_COUNTRECS = false;
error_reporting(7);
?>
<!--<table class=borde_tab width='50%' cellspacing="5">
    <tr>
        <td class=titulos2><center>TIPOS DOCUMENTALES</center></td>
</tr> 
</table>-->
<br>
<table  border="1" align='center' class="borde_tabReducido" width='50%' >
    <tr> 
        <td class=titulos3 align='center'>CODIGO</td>
        <td class=titulos3 align='center'>DESCRIPCION</td>
        <td class=titulos3 align='center'>TERMINO</td>
        <?php
        echo $titu;
        ?> 
        <td class=titulos3 align='center'>ESTADO</td>
        <td class=titulos3 align='center'>Form Radica</td>
    </tr>
    <?php
    echo $val;
    ?> 
</table>
