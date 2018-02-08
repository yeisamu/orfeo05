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

$verrad = "";
$ruta_raiz = "..";
if (!$dependencia and ! $depe_codi_territorial)
    include "../rec_session.php";

if (!$dep_sel)
    $dep_sel = $dependencia;
$depeBuscada = $dep_sel;
?>
<html>
    <head>
        <title>Orfeo -- Reporte Anulacion de Radicados</title>
        <link href="<?= $ruta_raiz . $ESTILOS_PATH2 ?>bootstrap.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="<?= $ruta_raiz . $_SESSION['ESTILOS_PATH_ORFEO'] ?>">
        <script src="<?= $ruta_raiz ?>/estilos/js/jquery-3.1.1.min.js" type="text/javascript"></script>
        <script src="<?= $ruta_raiz ?>/estilos/js/bootstrap.min.js" type="text/javascript"></script>
    </head>
    <body bgcolor="#FFFFFF" topmargin="0" onLoad="window_onload();">
        <div id="spiffycalendar" class="text"></div>
        <link rel="stylesheet" type="text/css" href="js/spiffyCal/spiffyCal_v2_1.css">
        <?
        $ruta_raiz = "..";
        include_once "$ruta_raiz/include/db/ConnectionHandler.php";
        include_once dirname(__FILE__) . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "config.php";
        $db = new ConnectionHandler("$ruta_raiz");
        if (!$dep_sel)
            $dep_sel = $dependencia;
        $depeBuscada = $dep_sel;

        /*
         * Generamos el encabezado que envia las variable a la paginas siguientes.
         * Por problemas en las sesiones enviamos el usuario.
         * @$encabezado  Incluye las variables que deben enviarse a la singuiente pagina. 
         * @$linkPagina  Link en caso de recarga de esta pagina.
         */
        $whereTpAnulacion = "
					AND b.SGD_EANU_CODIGO = 2
				";
        $nomcarpeta = "Reporte de Anulaciones";
        $nombreCarpeta = "Reporte de Anulaciones";
        $accion_sal = "";
        $textSubmit = "";

        $encabezado = "" . session_name() . "=" . session_id() . "&krd=$krd&filtroSelect=$filtroSelect&accion_sal=$accion_sal&dep_sel=$dep_sel&tpAnulacion=$tpAnulacion&orderNo=";
        $linkPagina = "$PHP_SELF?$encabezado&accion_sal=$accion_sal&orderTipo=$orderTipo&orderNo=$orderNo";
        $carpeta = "xx";
        $swBusqDep = "si";
        include "../envios/paEncabeza.php";

        $pagina_actual = "../anulacion/cuerpo_RepAnula.php";
        $varBuscada = "b.radi_nume_radi";
        include "../envios/paBuscar.php";
        $pagina_sig = "../anulacion/solAnulacion.php";
        //$swListar = "no";
        $accion_sal = "";
        include "../envios/paOpciones.php";
//$whereFiltro=$dependencia_busq2;
        if (isset($_POST['dep_sel']))
            $whereFiltro = " AND d.depe_codi='" . $_POST['dep_sel'] . "'";
        if (isset($_GET['dep_sel']))
            $whereFiltro = " AND d.depe_codi='" . $_GET['dep_sel'] . "'";
        /*  GENERACION LISTADO DE RADICADOS
         *  Aqui utilizamos la clase adodb para generar el listado de los radicados
         *  Esta clase cuenta con una adaptacion a las clases utiilzadas de orfeo.
         *  el archivo original es adodb-pager.inc.php la modificada es adodb-paginacion.inc.php
         */

        error_reporting(7);


        if ($orderNo == 98 or $orderNo == 99) {
            $order = 1;
            if ($orderNo == 98)
                $orderTipo = "desc";

            if ($orderNo == 99)
                $orderTipo = "";
        }

        else {
            if (!$orderNo)
                $orderNo = 0;
            $order = $orderNo + 1;

            if ($orden_cambio == 1) {
                if (!$orderTipo) {
                    $orderTipo = "desc";
                } else {
                    $orderTipo = "";
                }
            }
        }
        $sqlFecha = $db->conn->SQLDate("d-m-Y H:i A", "b.RADI_FECH_RADI");
        include "$ruta_raiz/include/query/anulacion/querycuerpo_Repanula.php";
        ?>
        <form name=formEnviar action='../anulacion/solAnulacion.php?<?= session_name() . "=" . session_id() . "&krd=$krd" ?>&tpAnulacion=<?= $tpAnulacion ?>&depeBuscada=<?= $depeBuscada ?>&estado_sal_max=<?= $estado_sal_max ?>&pagina_sig=<?= $pagina_sig ?>&dep_sel=<?= $dep_sel ?>&nomcarpeta=<?= $nomcarpeta ?>&orderTipo=<?= $orderTipo ?>&orderNo=<?= $orderNo ?>' method=post>
            <?
            $encabezado = "" . session_name() . "=" . session_id() . "&krd=$krd&depeBuscada=$depeBuscada&accion_sal=$accion_sal&filtroSelect=$filtroSelect&dep_sel=$dep_sel&tpAnulacion=$tpAnulacion&nomcarpeta=$nomcarpeta&orderTipo=$orderTipo&orderNo=";
            $linkPagina = "$PHP_SELF?$encabezado&orderTipo=$orderTipo";

            $db->conn->debug = false;
            $pager = new ADODB_Pager($db, $isql, 'adodb', true, $orderNo, $orderTipo);
            $pager->checkAll = false;
            $pager->checkTitulo = true;
            $pager->toRefLinks = $linkPagina;
            $pager->toRefVars = $encabezado;
            $pager->Render($rows_per_page = 20, $linkPagina, $checkbox = chkEnviar);
            ?>
        </form>
        <script>
            $(document).ready(function () {
                $('[data-toggle="tooltip"]').tooltip();
            });
        </script>
    </body>
</html>
