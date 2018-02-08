<?
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
 * Se añadio compatibilidad con variables globales en Off
 * @autor Jairo Losada 2009-05
 */
define('ADODB_ASSOC_CASE', 2);
$krd = $_SESSION["krd"];
$dependencia = $_SESSION["dependencia"];
$usua_doc = $_SESSION["usua_doc"];
$codusuario = $_SESSION["codusuario"];
$tip3Nombre = $_SESSION["tip3Nombre"];
$tip3desc = $_SESSION["tip3desc"];
$tip3img = $_SESSION["tip3img"];

$nomcarpeta = $_GET["carpeta"];
$tipo_carpt = $_GET["tipo_carpt"];
$adodb_next_page = $_GET["adodb_next_page"];
if ($_GET["orderNo"])
    $orderNo = $_GET["orderNo"];
if ($_GET["orderTipo"])
    $orderTipo = $_GET["orderTipo"];
if ($_GET["busqRadicados"])
    $busqRadicados = $_GET["busqRadicados"];
if ($_GET["busq_radicados"])
    $busq_radicados = $_GET["busq_radicados"];
if ($_GET["depeBuscada"])
    $depeBuscada = $_GET["depeBuscada"];
if ($_GET["filtroSelec"])
    $filtroSelec = $_GET["filtroSelec"];
if ($_GET["carpeta"])
    $carpeta = $_GET["carpeta"];

//by skina
$agendado = $_GET["agendado"];

$ruta_raiz = ".";

error_reporting(7);
$verrad = "";
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        <link href="<?= $ruta_raiz . $ESTILOS_PATH2 ?>bootstrap.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="<?= $ruta_raiz . $_SESSION['ESTILOS_PATH_ORFEO'] ?>">
        <script src="<?= $ruta_raiz ?>/estilos/js/jquery-3.1.1.min.js" type="text/javascript"></script>
        <script src="<?= $ruta_raiz ?>/estilos/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="./js/popcalendar.js"></script>
        <script src="./js/mensajeria.js"></script>
    <div id="spiffycalendar" class="text"></div>
</head>
<?
include "./envios/paEncabeza.php";
?>
<body bgcolor="#FFFFFF" topmargin="0" onLoad="window_onload();">
    <script>
        //Menu inferior visible
        var visible = true;
    </script>

    <?
    include_once "./include/db/ConnectionHandler.php";
    require_once("$ruta_raiz/class_control/Mensaje.php");
    if (!$db)
        $db = new ConnectionHandler($ruta_raiz);
    //$db->conn->debug = true;
    $db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
    $objMensaje = new Mensaje($db);
    $mesajes = $objMensaje->getMsgsUsr($_SESSION['usua_doc'], $_SESSION['dependencia']);

    if ($swLog == 1)
        echo ($mesajes);
    if (trim($orderTipo) == "")
        $orderTipo = "DESC";
    if ($orden_cambio == 1) {
        if (trim($orderTipo) != "DESC") {
            $orderTipo = "DESC";
        } else {
            $orderTipo = "ASC";
        }
    }

    if (!$carpeta)
        $carpeta = 0;
    if ($busqRadicados) {
        $busqRadicados = trim($busqRadicados);
        $textElements = split(",", $busqRadicados);
        $newText = "";
        $dep_sel = $dependencia;
        foreach ($textElements as $item) {
            $item = trim($item);
            if (strlen($item) != 0) {
                if ($entidad != "DNP") {
                    $busqRadicadosTmp .= " b.radi_nume_radi like '%$item%' or";
                } else {
                    $busqRadicadosTmp .= " r.radi_nume_radi like '%$item%' or";
                }
            }
        }
        if (substr($busqRadicadosTmp, -2) == "or") {
            $busqRadicadosTmp = substr($busqRadicadosTmp, 0, strlen($busqRadicadosTmp) - 2);
        }
        if (trim($busqRadicadosTmp)) {
            $whereFiltro .= "and ( $busqRadicadosTmp ) ";
        }
    }
    $encabezado = "" . session_name() . "=" . session_id() . "&krd=$krd&depeBuscada=$depeBuscada&filtroSelect=$filtroSelect&tpAnulacion=$tpAnulacion&carpeta=8&tipo_carp=$tipo_carp&chkCarpeta=$chkCarpeta&busqRadicados=$busqRadicados&nomcarpeta=Agendados&agendado=$agendado&";
    $linkPagina = "$PHP_SELF?$encabezado&orderTipo=$orderTipo&orderNo=$orderNo&carpeta=8";
    $encabezado = "" . session_name() . "=" . session_id() . "&adodb_next_page=1&krd=$krd&depeBuscada=$depeBuscada&filtroSelect=$filtroSelect&tpAnulacion=$tpAnulacion&carpeta=8&tipo_carp=$tipo_carp&nomcarpeta=Agendados&agendado=$agendado&orderTipo=$orderTipo&orderNo=";
    ?>
    <TABLE width="100%" align="center" cellspacing="0" cellpadding="0" class="borde_tab">
        <tr class="tablas">
            <TD class="titulos2">
                <span class="etextomenu">
                    <FORM style="margin: 5px 0px;" name="form_busq_rad" id="form_busq_rad" action='<?= $_SERVER['PHP_SELF'] ?>?<?= $encabezado ?>' method="GET">
                        Buscar radicado(s) (Separados por coma)<span class="etextomenu">
                            <input name="busqRadicados" type="text" size="40" class="tex_area" value="<?= $busqRadicados ?>">
                            <input type=submit value='Buscar ' name=Buscar valign='middle' class='botones'>
                        </span> 
                        <?
                        /**
                         * Este if verifica si se debe buscar en los radicados de todas las carpetas.
                         * @$chkCarpeta char  Variable que indica si se busca en todas las carpetas.
                         *
                         */
                        if ($chkCarpeta) {
                            $chkValue = " checked ";
                            $whereCarpeta = " ";
                        } else {
                            $chkValue = "";
                            if (!$tipo_carp)
                                $tipo_carp = "0";
                            $whereCarpeta = " and b.carp_codi=$carpeta  and b.carp_per=$tipo_carp";
                        }



                        $fecha_hoy = Date("Y-m-d");
                        $sqlFechaHoy = $db->conn->DBDate($fecha_hoy);

                        //Filtra el query para documentos agendados
                        ?>
                        <input type="checkbox" name="chkCarpeta" value=xxx <?= $chkValue ?> > Todas las carpetas
                    </form>
                </span>
            </td>
        </tr>
    </table>

    <form name="form1" id="form1" action="./tx/formEnvio.php?<?= $encabezado ?>" method="GET">

        <?
        $controlAgenda = 1;
        if ($carpeta == 11 and ! $tipo_carp and $codusuario != 1) {
            
        } else {
            include "./tx/txOrfeo.php";
        }
        /*  GENERACION LISTADO DE RADICADOS
         *  Aqui utilizamos la clase adodb para generar el listado de los radicados
         *  Esta clase cuenta con una adaptacion a las clases utiilzadas de orfeo.
         *  el archivo original es adodb-pager.inc.php la modificada es adodb-paginacion.inc.php
         *  
         */

        if (strlen($orderNo) == 0) {
            $orderNo = "2";
            $order = 3;
        } else {
            $order = $orderNo + 1;
        }

        $sqlFecha = $db->conn->SQLDate("Y-m-d H:i A", "b.RADI_FECH_RADI");
        //$sqlFecha = $db->conn->DBDate("b.RADI_FECH_RADI", "d-m-Y H:i A");
        //$sqlFecha = $db->conn->DBTimeStamp("b.RADI_FECH_RADI","" ,"Y-m-d H:i:s");
        //$db->SQLDate('Y-\QQ');
        //$db->conn->debug = true;
        include "$ruta_raiz/include/query/queryCuerpoAgenda.php";
        $rs = $db->conn->Execute($isql);
        if ($rs->EOF and $busqRadicados) {
            echo "<hr><center><b><span class='alarmas'>No se encuentra ningun radicado con el criterio de busqueda</span></center></b></hr>";
        } else {
            $pager = new ADODB_Pager($db, $isql, 'adodb', true, $orderNo, $orderTipo);
            $pager->checkAll = false;
            $pager->checkTitulo = true;
            $pager->toRefLinks = $linkPagina;
            $pager->toRefVars = $encabezado;
            $pager->descCarpetasGen = $descCarpetasGen;
            $pager->descCarpetasPer = $descCarpetasPer;
            $pager->Render($rows_per_page = 15, $linkPagina, $checkbox = chkAnulados);
        }
        ?>
    </form>
</tr>
</td>
</table>
<script>
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
</body>
</html>
