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
$ruta_raiz = "..";

foreach ($_GET as $key => $valor)
    ${$key} = $valor;

$krd = $_SESSION["krd"];
$dependencia = $_SESSION["dependencia"];
$usua_doc = $_SESSION["usua_doc"];
$codusuario = $_SESSION["codusuario"];
$tip3Nombre = $_SESSION["tip3Nombre"];
$tip3desc = $_SESSION["tip3desc"];
$tip3img = $_SESSION["tip3img"];

$nomcarpeta = $_GET["carpeta"];
$tipo_carpt = $_GET["tipo_carpt"];

if ($_GET["orderNo"])
    $orderNo = $_GET["orderNo"];
if ($_GET["orderTipo"])
    $orderTipo = $_GET["orderTipo"];
if ($_GET["dependencia_busq"])
    $dependencia_busq = $_GET["dependencia_busq"];
if ($_GET["fecha_ini"])
    $fecha_ini = $_GET["fecha_ini"];
if ($_GET["fecha_fin"])
    $fecha_fin = $_GET["fecha_fin"];
if ($_GET["codus"])
    $codus = $_GET["codus"];
if ($_GET["tipoRadicado"])
    $tipoRadicado = $_GET["tipoRadicado"];
if ($_GET["tipoEstadistica"])
    $tipoEstadistica = $_GET["tipoEstadistica"];
if ($_GET["codUs"])
    $codUs = $_GET["codUs"];
if ($_GET["fecSel"])
    $fecSel = $_GET["fecSel"];
if ($_GET["genDetalle"])
    $genDetalle = $_GET["genDetalle"];
if ($_GET["generarOrfeo"])
    $generarOrfeo = $_GET["generarOrfeo"];

if (!$tipoEstadistica)
    $tipoEstadistica = $_SESSION["tipoEstadistica"];

if (!$db) {
    if ($genDetalle) {
        ?>	
        <html>
            <head>
                <meta charset="UTF-8">
                <title>ORFEO - IMAGEN ESTADISTICAS </title>
                <link href="<?= $ruta_raiz . $ESTILOS_PATH2 ?>bootstrap.css" rel="stylesheet" type="text/css"/>
                <link rel="stylesheet" href="<?= $ruta_raiz . $_SESSION['ESTILOS_PATH_ORFEO'] ?>">
                <script src="<?= $ruta_raiz ?>/estilos/js/jquery-3.1.1.min.js" type="text/javascript"></script>
                <script src="<?= $ruta_raiz ?>/estilos/js/bootstrap.min.js" type="text/javascript"></script>
            </head>
            <body>
                <br>
            <CENTER>
                <?php
            }
            include "$ruta_raiz/envios/paEncabeza.php";
            ?>
            <table><tr><TD> <!--</TD></tr></table>-->
                        <?
                        require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "config.php";
                        include_once "$ruta_raiz/include/db/ConnectionHandler.php";
                        include_once("$ruta_raiz/class_control/Mensaje.php");
                        include("$ruta_raiz/class_control/usuario.php");
                        $db = new ConnectionHandler($ruta_raiz);

                        $db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
                        $objUsuario = new Usuario($db);
//	$db->conn->debug = true;
                        $whereDependencia = " AND DEPE_CODI='$dependencia_busq' ";
                        //$datosaenviar = "fechaf=$fechaf&genDetalle=$genDetalle&tipoEstadistica=$tipoEstadistica&codus=$codus&krd=$krd&dependencia_busq=$dependencia_busq&ruta_raiz=$ruta_raiz&fecha_ini=$fecha_ini&fecha_fin=$fecha_fin&tipoRadicado=$tipoRadicado&tipoDocumento=$tipoDocumento&codUs=$codUs&fecSel=$fecSel";

                        $datosaenviar = "fechaf=$fechaf&genDetalle=$genDetalle&tipoEstadistica=$tipoEstadistica&codus=$codus&krd=$krd&dependencia_busq=$dependencia_busq&ruta_raiz=$ruta_raiz&fecha_ini=$fecha_ini&fecha_fin=$fecha_fin&tipoRadicado=$tipoRadicado&tipoDocumento=$tipoDocumento&codUs=$codUs&fecSel=$fecSel";
                    }

                    $datosaenviar = "fechaf=$fechaf&genDetalle=$genDetalle&tipoEstadistica=" . $_GET['tipoEstadistica'] . "&codus=$codus&krd=$krd&dependencia_busq=$dependencia_busq&ruta_raiz=$ruta_raiz&fecha_ini=$fecha_ini&fecha_fin=$fecha_fin&tipoRadicado=$tipoRadicado&tipoDocumento=$tipoDocumento&codUs=$codUs&fecSel=$fecSel";

                    $seguridad = ",R.SGD_SPUB_CODIGO,B.CODI_NIVEL as  USUA_NIVEL";

                    $whereTipoRadicado = "";
                    if ($tipoRadicado) {
                        $whereTipoRadicado = " AND cast(R.RADI_NUME_RADI as varchar(15)) LIKE '%$tipoRadicado'";
                    }
                    if ($tipoRadicado and ( $tipoEstadistica == 1 or $tipoEstadistica == 6)) {
                        $whereTipoRadicado = " AND cast(r.RADI_NUME_RADI as varchar(15)) LIKE '%$tipoRadicado'";
                    }
                    if ($codus) {
                        $whereTipoRadicado .= " AND b.USUA_CODI = $codus ";
                    } elseif (!$codus and $usua_perm_estadistica < 1) {
                        $whereTipoRadicado .= " AND b.USUA_CODI = $codusuario ";
                    }
                    if ($tipoDocumento and ( $tipoDocumento != '9999' and $tipoDocumento != '9998' and $tipoDocumento != '9997')) {
                        $whereTipoRadicado .= " AND t.SGD_TPR_CODIGO = $tipoDocumento ";
                    } elseif ($tipoDocumento == "9997") {
                        $whereTipoRadicado .= " AND t.SGD_TPR_CODIGO = 0 ";
                    }
                    include_once($ruta_raiz . "/include/query/busqueda/busquedaPiloto1.php");
//echo(" tipo $tipoEstadistica ");	
                    switch ($tipoEstadistica) {
                        case "1";
                            include "$ruta_raiz/include/query/estadisticas/consulta001.php";
                            $generar = "ok";
                            break;
                        case "2";
                            include "$ruta_raiz/include/query/estadisticas/consulta002.php";
                            $generar = "ok";
                            break;
                        case "3";
                            include "$ruta_raiz/include/query/estadisticas/consulta003.php";
                            $generar = "ok";
                            break;
                        case "4";
                            include "$ruta_raiz/include/query/estadisticas/consulta004.php";
                            $generar = "ok";
                            break;
                        case "5";
                            include "$ruta_raiz/include/query/estadisticas/consulta005.php";
                            $generar = "ok";
                            break;
                        case "6";
                            include "$ruta_raiz/include/query/estadisticas/consulta006.php";
                            $generar = "ok";
                            break;
                        case "7";
                            include "$ruta_raiz/include/query/estadisticas/consulta007.php";
                            $generar = "ok";
                            break;
                        case "8";
                            include "$ruta_raiz/include/query/estadisticas/consulta008.php";
                            $generar = "ok";
                            break;
                        case "9";
                            include "$ruta_raiz/include/query/estadisticas/consulta009.php";
                            $generar = "ok";
                            break;
                        case "10";
                            include "$ruta_raiz/include/query/estadisticas/consulta010.php";
                            $generar = "ok";
                            break;
                        case "11";
                            include "$ruta_raiz/include/query/estadisticas/consulta011.php";
                            $generar = "ok";
                            break;
                        case "12";
                            include "$ruta_raiz/include/query/estadisticas/consulta012.php";
                            $generar = "ok";
                            break;
                        case "13";
                            include "$ruta_raiz/include/query/estadisticas/consulta013.php";
                            $generar = "ok";
                            break;
                        case "14";
                            include "$ruta_raiz/include/query/estadisticas/consulta014.php";
                            $generar = "ok";
                            break;
                        case "15";
                            include "$ruta_raiz/include/query/estadisticas/consulta015.php";
                            $generar = "ok";
                            break;
                        case "16";
                            include "$ruta_raiz/include/query/estadisticas/consulta016.php";
                            $generar = "ok";
                            break;
                        case "17";
                            include "$ruta_raiz/include/query/estadisticas/consulta017.php";
                            $generar = "ok";
                            break;
                    }
                    /*********************************************************************************
                      Modificado Por: Supersolidaria
                      Fecha: 15 diciembre de 2006
                      Descripci�n: Se incluy� el reporte de radicados archivados reporte_archivo.php
                     **********************************************************************************/
//$db->conn->debug = true;
                    if ($tipoReporte == 1) {
                        include "$ruta_raiz/include/query/archivo/queryReportePorRadicados.php";
                        $generar = "ok";
                        //Modificado skina 100609
                        $titulos = array("1#RADICADO", "2#FECHA RADICADO", "3#FECHA ARCHIVO", "4#USUARIO", "5#DEPENDENCIA", "6#NUMERO FOLIOS");
                        include "$ruta_raiz/archivo/funReporteArchivo.php";
                    }
                    if ($generar == "ok") {
                        if ($genDetalle == 1)
                            $queryE = $queryEDetalle;
                        if ($genTodosDetalle == 1)
                            $queryE = $queryETodosDetalle;
                        //$rsE = $db->conn->Execute($queryE);
                        include ("tablaHtml.php");
                        Exportar($ruta_raiz, $queryE, $titulo);
                    }

                    function Exportar($ruta_raiz, $queryE, $titulo) {
                        ?>
                        <table align="center" ><tr>
                                <td align="center">
                                    <?
                                    $xsql = serialize($queryE); // SERIALIZO EL QUERY CON EL QUE SE QUIERE GENERAR EL REPORTE
                                    $_SESSION ['xheader'] = "<center><b>$titulo</b></center><br><br>"; // ENCABEZADO DEL REPORTE
                                    $_SESSION ['xsql'] = $xsql; // SUBO A SESION EL QUERY// CREO LOS LINKS PARA LOS REPORTES
                                    echo "<b><a href='$ruta_raiz/adodb/adodb-doc.inc.php' target='_blank'><img src='$ruta_raiz/adodb/compfile.png' width='40' heigth='40' border='0' alt='Exportar contenido del listado en formato word'"
                                            . "data-original-title='Exportar contenido del listado en formato &quot;.doc&quot;' data-toggle='tooltip' data-placement='top'></a></b> - "; //
                                    echo "<a href='$ruta_raiz/adodb/adodb-xls.inc.php' target='_blank'><img src='$ruta_raiz/adodb/spreadsheet.png' width='40' heigth='40' border='0' alt='Exportar contenido del listado en formato excel'"
                                            . "data-original-title='Exportar contenido del listado como hoja de calculo' data-toggle='tooltip' data-placement='top'></a>";
                                    ?>
                                </td>
                            </tr>
                        </table><?php
                    }
                    ?>
        </table>
        <br>
        <script>
            $(document).ready(function () {
                $('[data-toggle="tooltip"]').tooltip();
            });
        </script>
