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
 * Administrador de Archivos
 * Sistema de gestion Documental ORFEO.
 *
 * Permite la administracion del archivo de gestion, central y edificios
 * 
 */
session_start();
$ruta_raiz = "..";
if (!isset($_SESSION['dependencia']))
    include "$ruta_raiz/rec_session.php";

require_once("$ruta_raiz/include/db/ConnectionHandler.php");
$db = new ConnectionHandler($ruta_raiz);

foreach ($_GET as $key => $valor)
    ${$key} = $valor;
foreach ($_POST as $key => $valor)
    ${$key} = $valor;
$krd = $_SESSION["krd"];
$usua_perm_archi = $_SESSION["usua_admin_archivo"];
$encabezadol = "$PHP_SELF?" . session_name() . "=" . session_id() . "&num_exp=$num_exp&krd=$krd";
?>
<html height=50,width=150>
    <head>
        <title>Menu Archivo</title>
        <link href="<?= $ruta_raiz . $ESTILOS_PATH2 ?>bootstrap.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="<?= $ruta_raiz . $_SESSION['ESTILOS_PATH_ORFEO'] ?>">
    <CENTER>
        <body bgcolor="#FFFFFF">
            <div id="spiffycalendar" class="text"></div>
            <link rel="stylesheet" type="text/css" href="../js/spiffyCal/spiffyCal_v2_1.css">
            <script language="JavaScript" src="../js/spiffyCal/spiffyCal_v2_1.js">
            </script>

            <form name=from1 action="<?= $encabezadol ?>" method='post' action='archivo.php?<?= session_name() ?>=<?= trim(session_id()) ?>&krd=<?= $krd ?>&<?= "&num_exp=$num_exp" ?>'>
                <br>
                <center>
   <div id="titulo" style="width: 30%;" align="center">Menu de Archivo</div>
                <table border=1 width="30%" cellpadding="0" cellspacing="5" class="borde_tab">
<!--                       <TD class=titulos2 align="center" >
                        Menu de Archivo
                    </TD>-->
                    <tr>
                        <td class=listado1>
                            <span class="leidos2"><a href='../expediente/cuerpo_exp.php?<?= $phpsession ?>&krd=<?= $krd ?>&<?= "fechaf=$fechah&carpeta=8&nomcarpeta=Expedientes&orno=1&adodb_next_page=1"; ?>' target='mainFrame' class="vinculos"><b>1. Busqueda Basica(Archivar) </a></span>
                        </td>
                    </tr>
                    <tr>
                        <td class="listado2">
                            <span class="leidos2"><a href='../archivo/busqueda_archivo.php?<?= session_name() . "=" . session_id() . "&dep_sel=$dep_sel&krd=$krd&fechah=$fechah&$orno&adodb_next_page&nomcarpeta&tipo_archivo=$tipo_archivo&carpeta" ?>' target='mainFrame' class="vinculos"><b>2. Busqueda Avanzada </a>
                        </td>
                    </tr>
                    <tr>
                        <td class=listado1>
                            <span class="leidos2"><a  href='reporte_archivo.php?<?= session_name() . "=" . session_id() . "&krd=$krd&adodb_next_page&nomcarpeta&fechah=$fechah&$orno&carpeta&tipo=1'" ?>' target='mainFrame' class="vinculos"><b>3. Reporte por Radicados Archivados</a>
                        </td>
                    </tr>
                    <!---
                            <tr>
                            <td class=listado2>
                    <span class="leidos2"><a href='inventario.php?<?= session_name() . "=" . session_id() . "&krd=$krd&fechah=$fechah&$orno&adodb_next_page&nomcarpeta&carpeta&tipo=2'" ?>' target='mainFrame' class="menu_princ"><b> 4.Cambio de Coleccion</a>
                              </td>
                            </tr>
                    -->
                    <!--
                            <tr>
                            <td class=listado2>
                    <span class="leidos2"><a href='inventario.php?<?= session_name() . "=" . session_id() . "&krd=$krd&fechah=$fechah&$orno&nomcarpeta&carpeta&tipo=1'" ?>' target='mainFrame' class="menu_princ"><b>5.Inventario Consolidado Capacidad</a>	  </td>
                            </tr>
                    -->
                    <!--Modificado skina-->
                    <!--	<tr>
                            <td class=listado2>
                    <span class="leidos2"><a href='inventario.php?<?= session_name() . "=" . session_id() . "&krd=$krd&fechah=$fechah&$orno&adodb_next_page&nomcarpeta&carpeta&tipo=3'" ?>' target='mainFrame' class="menu_princ"><b>6.Inventario Documental</a>       </td>
                    </tr>-->
                    <tr>
                        <td class=listado2>
                            <span class="leidos2"><a href='sinexp.php?<?= session_name() . "=" . session_id() . "&krd=$krd&fechah=$fechah&$orno&adodb_next_page&nomcarpeta&carpeta&tipo=3'" ?>' target='mainFrame' class="vinculos"><b>4.Radicados Archivados Sin Expediente</a>	</td>
                    </tr>
                    <tr>
                        <td class=listado1>
                            <span class="leidos2"><a href='alerta.php?<?= session_name() . "=" . session_id() . "&krd=$krd&fechah=$fechah&$orno&adodb_next_page" ?>' target='mainFrame' class="vinculos"><b>5.Transferencias documentales (Expedientes)</a></td>
                    </tr>
                    <!--
                    <tr>
                      <td class="listado2">
                        <span class="leidos2"><a href='<?php print $ruta_raiz; ?>/archivo/busqueda_central.php?<?= session_name() . "=" . session_id() . "&krd=$krd&fechah=$fechah&$orno&adodb_next_page" ?>' target='mainFrame' class="menu_princ"><b>9.Busqueda Archivo Central</a>  </td>
                    </tr>
                    <tr>
                      <td class="listado2">
                        <span class="leidos2"><a href='<?php print $ruta_raiz; ?>/archivo/insertar_central.php?<?= session_name() . "=" . session_id() . "&krd=$krd&fechah=$fechah&$orno&adodb_next_page" ?>' target='mainFrame' class="menu_princ"><b>10.Insertar Archivo Central</a>  </td>
                    </tr>
                    -->
                    <!--
                        /**
                          * Modificado cra 05-Dic-2006
                          * Se agreg� la opci�n Administarci�n de Edificios.
                          */
                    -->
                    <?
                    if ($usua_perm_archi == 2) {
                        ?>
                        <tr>
                            <td class="listado2">
                                <span class="leidos2"><a href='<?php print $ruta_raiz; ?>/archivo/adminEdificio.php?<?= session_name() . "=" . session_id() . "&krd=$krd&fechah=$fechah&$orno&adodb_next_page" ?>' target='mainFrame' class="vinculos"><b>6.Administracion de Edificios</a></td>
                        </tr>
                    <? } ?>
                    <!--
                    <tr>
                      <td class="listado2">
                        <span class="leidos2"><a href='<?php print $ruta_raiz; ?>/archivo/tvd/menu_tvd.php?<?= session_name() . "=" . session_id() . "&krd=$krd&fechah=$fechah&$orno&adodb_next_page" ?>' target='mainFrame' class="menu_princ"><b>12.Administracion de TVD</a>  </td>
                    </tr>
                    <tr>
                      <td class="listado2">
                        <span class="leidos2"><a href='<?= $ruta_raiz ?>/archivo/menu_fondos.php?<?= session_name() . "=" . session_id() . "&krd=$krd&fechah=$fechah&$orno&adodb_next_page" ?>' target='mainFrame' class="menu_princ"><b>13. Fondos documentales</a>  </td>
                    </tr>
                    -->
                </table>
   <center>
            </form>
    </CENTER>
</html>
