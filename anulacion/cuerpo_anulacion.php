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
if (isset($_GET['dependencia']))
    $dependencia = $_GET['dependencia'];
if (!$dependencia and ! $depe_codi_territorial)
    include "../rec_session.php";

if (!isset($dep_sel))
    $dep_sel = $dependencia;
$depeBuscada = $dep_sel;
?>
<html>
    <head>
        <title>Anulación de Radicados</title>
        <link href="<?= $ruta_raiz . $ESTILOS_PATH2 ?>bootstrap.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="<?= $ruta_raiz . $_SESSION['ESTILOS_PATH_ORFEO'] ?>">
        <script language="javascript">
<!-- Funcion que activa el sistema de marcar o desmarcar todos los check  -->
        </script>
    </head>
    <body bgcolor="#FFFFFF" topmargin="0" onLoad="window_onload();">
        <div id="spiffycalendar" class="text"></div>
        <link rel="stylesheet" type="text/css" href="../js/spiffyCal/spiffyCal_v2_1.css">
        <?
        $ruta_raiz = "..";
        include_once dirname(__FILE__) . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "config.php";
        include_once "$ruta_raiz/include/db/ConnectionHandler.php";
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
        switch ($tpAnulacion) {
            case 1:
                /* by skina $whereTpAnulacion = "
                  and (
                  b.SGD_EANU_CODIGO = 9
                  or b.SGD_EANU_CODIGO = 2
                  or b.SGD_EANU_CODIGO IS NULL
                  )
                  "; */
                $whereTpAnulacion = "
			and (
			b.SGD_EANU_CODIGO = 9
			or b.SGD_EANU_CODIGO IS NULL
			)
		";
                $nomcarpeta = "Solicitud de Anulacion de Radicados";
                $nombreCarpeta = "Solicitud de Anulacion de Radicados";
                $accion_sal = "Solicitar Anulacion";
                $textSubmit = "Solicitar Anulacion";
                break;
            case 2:
                $whereTpAnulacion = "
			AND b.SGD_EANU_CODIGO = 2
		";
                $nomcarpeta = "Radicados para Anular";
                $nombreCarpeta = "Radicados para Anular";
                $accion_sal = "";
                $textSubmit = "";
                break;
            case 3:
                $whereTpAnulacion = "
		and b.SGD_EANU_CODIGO = 9
		";
                $nomcarpeta = "Radicados Anulados";
                $nombreCarpeta = "Radicados Anulados";
                $accion_sal = "Ver Reporte";
                $textSubmit = "Ver Reporte";
                break;
        }

        if (!isset($filtroSelect))
            $filtroSelect = "";
        if (!isset($orderTipo))
            $orderTipo = "";
        if (!isset($orderNo))
            $orderNo = "";
        $encabezado = "" . session_name() . "=" . session_id() . "&krd=$krd&filtroSelect=$filtroSelect&accion_sal=$accion_sal&dep_sel=$dep_sel&tpAnulacion=$tpAnulacion&orderNo=";
        $linkPagina = "$PHP_SELF?$encabezado&accion_sal=$accion_sal&orderTipo=$orderTipo&orderNo=$orderNo";
        $carpeta = "xx";

        include "../envios/paEncabeza.php";

        $pagina_actual = "../anulacion/cuerpo_anulacion.php";
        $varBuscada = "b.radi_nume_radi";
        include "../envios/paBuscar.php";
        $pagina_sig = "../anulacion/solAnulacion.php";
        //$swListar = "no";
        $accion_sal = "Solicitar Anulacion";
        include "../envios/paOpciones.php";
//if(!isset($dependecia_busq2))$dependencia_busq2="";
        $whereFiltro = $dependencia_busq2;
        /*  GENERACION LISTADO DE RADICADOS
         *  Aqui utilizamos la clase adodb para generar el listado de los radicados
         *  Esta clase cuenta con una adaptacion a las clases utiilzadas de orfeo.
         *  el archivo original es adodb-pager.inc.php la modificada es adodb-paginacion.inc.php
         */

        //error_reporting(7);
        if ($orderNo == 98 or $orderNo == 99) {
            $order = 1;
            if ($orderNo == 98)
                $orderTipo = "desc";
            if ($orderNo == 99)
                $orderTipo = "";
        }

        else {
            if (!$orderNo)
                $orderNo = 3;
            $order = $orderNo + 1;

            if (!isset($orden_cambio) == 1) {
                if (!$orderTipo) {
                    $orderTipo = "desc";
                } else {
                    $orderTipo = "";
                }
            }
        }
        $sqlFecha = $db->conn->SQLDate("d-m-Y H:i A", "b.RADI_FECH_RADI");

        //$sqlFecha = "b.RADI_FECH_RADI";     

        if ($tpAnulacion == 2) {
            include "$ruta_raiz/include/query/anulacion/querycuerpo_anulacion.php";
        } else {
            include "$ruta_raiz/include/query/anulacion/querycuerpo_anulacion.php";
        }
        ?>
        <form name=formEnviar action='../anulacion/solAnulacion.php?<?= session_name() . "=" . session_id() . "&krd=$krd" ?>&tpAnulacion=<?= $tpAnulacion ?>&depeBuscada=<?= $depeBuscada ?>&estado_sal_max=<?= $estado_sal_max ?>&pagina_sig=<?= $pagina_sig ?>&dep_sel=<?= $dep_sel ?>&nomcarpeta=<?= $nomcarpeta ?>&orderTipo=<?= $orderTipo ?>&orderNo=<?= $orderNo ?>' method=post>
            <?
//$db->conn->debug=true;
            if (!isset($chkEnviar))
                $chkEnviar = "";
            $encabezado = "" . session_name() . "=" . session_id() . "&krd=$krd&depeBuscada=$depeBuscada&accion_sal=$accion_sal&filtroSelect=$filtroSelect&dep_sel=$dep_sel&tpAnulacion=$tpAnulacion&nomcarpeta=$nomcarpeta&orderTipo=$orderTipo&orderNo=";
            $linkPagina = "$PHP_SELF?$encabezado&orderTipo=$orderTipo&orderNo=$orderNo";
            $pager = new ADODB_Pager($db, $isql, 'adodb', true, $orderNo, $orderTipo);
            $pager->checkAll = false;
            $pager->checkTitulo = true;
            $pager->toRefLinks = $linkPagina;
            $pager->toRefVars = $encabezado;
            $pager->Render($rows_per_page = 20, $linkPagina, $checkbox = $chkEnviar);
            ?>
        </form>

    </body>

</html>
