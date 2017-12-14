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
 * Este programa despliega el men� principal de correspondencia masiva
 * @author      Sixto Angel Pinz�n
 * @version     1.0
 */
error_reporting(7);
session_start();
$ruta_raiz = "../";

require_once("$ruta_raiz/include/db/ConnectionHandler.php");
//Si no llega la dependencia recupera la sesi�n
if (!isset($_SESSION['dependencia'])) {
    include "$ruta_raiz/rec_session.php";
}
if (!$db)
    $db = new ConnectionHandler($ruta_raiz);
$phpsession = session_name() . "=" . session_id();
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        <link href="<?= $ruta_raiz . $ESTILOS_PATH2 ?>bootstrap.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="<?= $ruta_raiz . $_SESSION['ESTILOS_PATH_ORFEO'] ?>">
        <script language="JavaScript">
            <!--
        function Start(URL, WIDTH, HEIGHT)
            {
                windowprops = "top=0,left=0,location=no,status=no, menubar=no,scrollbars=yes, resizable=yes,width=";
                windowprops += WIDTH + ",height=" + HEIGHT;

                preview = window.open(URL, "preview", windowprops);
            }
            //-->
        </script>
    </head>
    <body bgcolor="#FFFFFF" topmargin="0" onLoad="window_onload();">

<center>
<br>
<div id="titulo" style="width: 47%;" align="center">Generaci&oacute;n de certificaciones RH</div>
<table width="47%" align="center" border="1" cellpadding="0" cellspacing="5" class="borde_tab">
                <tr align="center">
                    <td class="listado2" >
                        <a href='upload2.php?<?= $phpsession ?>&krd=<?= $krd ?>&<? echo "fechah=$fechah"; ?>' class="vinculos" target='mainFrame'>
                            Cargue de datos de nomina para el mes
                        </a>
                    </td>
                </tr>
                <tr align="center">
                    <td class="listado2" >
                        <a href='upload3.php?<?= $phpsession ?>&krd=<?= $krd ?>&<? echo "fechah=$fechah"; ?>' class="vinculos" target='mainFrame'>
                            Administraci&oacute;n de tipos de certificaci&oacute;n
                        </a>
                    </td>
                </tr>
                <tr align="center">
                    <td class="listado2" >
                        <a href="./WS/" class="vinculos">
                            Generación de certificación sin uso de la DB (Formulario antiguo)
                        </a>
                    </td>
                </tr>
                <tr align="center">
                    <td class="listado2" >
                        <a href='sht/' class="vinculos" target='mainFrame'>
                            Generación de certificación con documento</a>
                    </td>
                </tr>
                <!--tr align="center">
                        <td class="listado2" >
                                <a href='consultaESP.php?<?= $phpsession ?>&krd=<?= $krd ?>&<? echo "fechah=$fechah"; ?>' target='mainFrame' class="vinculos">
                                Consulta y Selecci&oacute;n destinatarios masiva
                                </a>
                        </td>
                </tr-->
            </table>
</center>
            <?
            //Modificado skina - inhabilitado tabla de administracion de secuencias
//	include( "administradorSecuencias.php" );
            ?>
    </body>
</html>
