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
 * Modificacion para aceptar Variables GLobales
 * @autor Jairo Losada 
 * @fecha 2009/05
 */
$krd = $_SESSION["krd"];
$dependencia = $_SESSION["dependencia"];
$usua_doc = $_SESSION["usua_doc"];
$codusuario = $_SESSION["codusuario"];
$tip3Nombre = $_SESSION["tip3Nombre"];
$tip3desc = $_SESSION["tip3desc"];
$tip3img = $_SESSION["tip3img"];

if ($_GET["carpeta"])
    $carpeta = $_GET["carpeta"];
$tipo_carpt = $_GET["tipo_carpt"];
$adodb_next_page = $_GET["adodb_next_page"];
if ($_GET["gen_lisDefi"])
    $gen_lisDefi = $_GET["gen_lisDefi"];
if ($_GET["dep_sel"])
    $dep_sel = $_GET["dep_sel"];
if ($_GET["generar_listado"])
    $generar_listado = $_GET["generar_listado"];
if ($_GET["cancelarAnular"])
    $cancelarAnular = $_GET["cancelarAnular"];
if ($_GET["orderNo"])
    $orderNo = $_GET["orderNo"];
if ($_GET["orderTipo"])
    $orderTipo = $_GET["orderTipo"];
if ($_GET["busqRadicados"])
    $gen_lisDefi = $_GET["busqRadicados"];
if ($_GET["gen_lisDefi"])
    $gen_lisDefi = $_GET["gen_lisDefi"];

$verrad = "";
$ruta_raiz = "..";

if (!$dep_sel)
    $dep_sel = $dependencia;
$depeBuscada = $dep_sel;
?>
<html>
    <head>
        <title>Untitled Document</title>
        <link href="<?= $ruta_raiz . $ESTILOS_PATH2 ?>bootstrap.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="<?= $ruta_raiz . $_SESSION['ESTILOS_PATH_ORFEO'] ?>">
        <script src="<?= $ruta_raiz ?>/estilos/js/jquery-3.1.1.min.js" type="text/javascript"></script>
        <script src="<?= $ruta_raiz ?>/estilos/js/bootstrap.min.js" type="text/javascript"></script>
    </head>
    <body>
        <div id="spiffycalendar" class="text"></div>
        <link rel="stylesheet" type="text/css" href="../js/spiffyCal/spiffyCal_v2_1.css">
        <?
        $ruta_raiz = "..";
        include_once "$ruta_raiz/include/db/ConnectionHandler.php";
        $db = new ConnectionHandler("$ruta_raiz");
//$db->conn->debug = true; 
        if (!$dep_sel)
            $dep_sel = $dependencia;
        $depeBuscada = $dep_sel;

        if ($generar_listado and ! $cancelarAnular) {
            $indi_generar = "SI";
        } else {
            $indi_generar = "NO";
        }
        if ($indi_generar == "SI") {
            $encabezado = "" . session_name() . "=" . session_id() . "&num=$num&hora_ini=$hora_ini&hora_fin=$hora_fin&minutos_ini=$minutos_ini&minutos_fin=$minutos_fin&tip_radi=$tip_radi&fecha_busqH=$fecha_busqH&fecha_busq=$fecha_busq&dep_sel=$dep_sel&filtroSelect=$filtroSelect&nomcarpeta=$nomcarpeta";
            $linkPagina = "$PHP_SELF?$encabezado&orderTipo=$orderTipo&orderNo=$orderNo";
            $encabezado = "" . session_name() . "=" . session_id() . "&adodb_next_page=1&num=$num&hora_ini=$hora_ini&hora_fin=$hora_fin&minutos_ini=$minutos_ini&minutos_fin=$minutos_fin&tip_radi=$tip_radi&fecha_busqH=$fecha_busqH&fecha_busq=$fecha_busq&dep_sel=$dep_sel&filtroSelect=$filtroSelect&nomcarpeta=$nomcarpeta&orderTipo=$orderTipo&orderNo=";
            ?>
            <script>
                function Marcar()
                {
                    marcados = 0;
                    for (i = 2; i < document.gen_lisDefi.elements.length; i++)
                    {
                        if (document.gen_lisDefi.elements[i].checked == 1)
                        {
                            marcados++;
                        }
                    }
                    if (marcados >= 1)
                    {
                        document.gen_lisDefi.submit();
                    } else
                    {
                        alert("Debe marcar un elemento");
                    }
                }
            </script>

            <?
            if (strlen($orderNo) == 0) {
                $orderNo = "2";
                $order = 3;
            } else {
                $order = $orderNo + 1;
            }

            //Condicion Dependencia
            $dependencia_busq2 = " and c.radi_depe_radi = '$dep_sel'";
            //Construccion Condicion de Fechas//
            $fecha_ini = $_REQUEST['fecha_busq'];
            $fecha_fin = $_REQUEST['fecha_busqH'];
            $fecha_busq = $_REQUEST['fecha_busq'];
            $fecha_busqH = $_REQUEST['fecha_busqH'];
            $fecha_ini = mktime($hora_ini, $minutos_ini, 00, substr($fecha_busq, 5, 2), substr($fecha_busq, 8, 2), substr($fecha_busq, 0, 4));
            $fecha_fin = mktime($hora_fin, $minutos_fin, 59, substr($fecha_busqH, 5, 2), substr($fecha_busqH, 8, 2), substr($fecha_busqH, 0, 4));

            $where_fecha = " and a.sgd_fech_impres BETWEEN
		" . $db->conn->DBTimeStamp($fecha_ini) . " and " . $db->conn->DBTimeStamp($fecha_fin);
            //Condicion Tipo Radicacion
            if ($tip_radi == 0) {
                $where_tipRadi = "";
            } else {
                $where_tipRadi = " and a.radi_nume_salida like '%$tip_radi'";
            }
            include "$ruta_raiz/include/query/envios/queryParamListaImpresos.php";

            $rs = $db->conn->Execute($isql);
            if (!$rs->EOF) {
                ?>
                <br>
            <center>
                <div id="titulo" style="width: 40%;" align="center">Generación listado de entrega</div>
                <table border=1 cellspace=2 cellpad=2 WIDTH=40%  class="borde_tab">
                    <tr>
                        <td align="right" bgcolor="#CCCCCC" height="25" class="titulos2">Fecha inicial :
                        </td>
                        <td  width="65%" height="25" class="listado2">
                            <?= $fecha_busq . " " . $hora_ini . " : " . $minutos_ini . ":00" ?>
                        </td>
                    </tr>
                    <tr>
                        <td align="right" bgcolor="#CCCCCC" height="25" class="titulos2">Fecha final :
                        </td>
                        <td  width="65%" height="25" class="listado2">
                            <?= $fecha_busqH . " " . $hora_fin . " : " . $minutos_fin . ":59" ?>
                        </td>
                    </tr>
                    <tr>
                        <td align="right" bgcolor="#CCCCCC" height="25" class="titulos2">Fecha generacion :
                        </td>
                        <td  width="65%" height="25" class="listado2">
                            <? echo date("Y-m-d - H:i:s"); ?>
                        </td>
                    </tr>	
                </table>

                <form name=gen_lisDefi  action='generaListaImpresos.php?<?= $encabezado ?>' method="GET">
                    <table border=0 cellspace=2 cellpad=2 WIDTH=40%  class="t_bordeGris" >
                        <tr>
                            <td width="1120" height="26" colspan="2" valign="top" class="listado1" style="text-align: right;"> 
                                <INPUT TYPE=submit name=gen_lisDefi Value=' Confirmar ' class=botones id=Confirmar onclick="Marcar();">
                                <INPUT TYPE=submit name=cancelarListado value=Cancelar class=botones>
                            </td>
                        </tr>
                    </table>

                    <?
                    $pager = new ADODB_Pager($db, $isql, 'adodb', true, $orderNo, $orderTipo);
                    $pager->checkAll = true;
                    //$pager->checkTitulo = true; 
                    $pager->toRefLinks = $linkPagina;
                    $pager->toRefVars = $encabezado;
                    $pager->Render($rows_per_page = 100, $linkPagina, $checkbox = chkEnviar);
                } else {
                    echo "<hr><center><b><span class='alarmas'>No se encuentra ningun radicado con el criterio de seleccion</span></center></b></hr>";
                }
                ?>	
            </form>
            <?
        } else {
            echo "<hr><center><b><span class='alarmas'>Operacion CANCELADA</span></center></b></hr>";
        }
        ?>
        <script>
            $(document).ready(function () {
                $('[data-toggle="tooltip"]').tooltip();
            });
        </script>
    </body>
</html>
