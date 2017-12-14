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


$krdOld = $krd;
session_start();

if (!$krd)
    $krd = $krdOld;
if (!$ruta_raiz)
    $ruta_raiz = "..";
//cierra sesion
//include "$ruta_raiz/rec_session.php";
include_once("$ruta_raiz/include/db/ConnectionHandler.php");
$db = new ConnectionHandler("$ruta_raiz");
//$db->conn->debug = true;
$encabezadol = "$PHP_SELF?" . session_name() . "=" . session_id() . "&dependencia=$dependencia&krd=$krd";
?>
<script>
    function regresar() {
        window.location.reload();
    }
    function NuevoE() {
        window.open("ingEdificio.php?<?= session_name() . "=" . session_id() ?>&krd=<?= $krd ?>", "Ingresar Edificios", "height=250,width=850,scrollbars=yes");

    }
    function Borrar(cod)
    {
        window.open("bortipo.php?<?= session_name() . "=" . session_id() ?>&krd=<?= $krd ?>&cod=" + cod + "&tipo=1", "Borrar Tipos", "height=150,width=150,scrollbars=yes");
    }
    function Edifi(cod)
    {
        window.open("ediEdificio.php?<?= session_name() . "=" . session_id() ?>&krd=<?= $krd ?>&cod=" + cod + "", "Editar Edificios", "height=750,width=650,scrollbars=yes");
    }
</script>
<html>
    <head>
        <title>Administración de  edificios</title>
        <link href="<?= $ruta_raiz . $ESTILOS_PATH2 ?>bootstrap.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="<?= $ruta_raiz . $_SESSION['ESTILOS_PATH_ORFEO'] ?>">
        <link href="../../../br_3.7/estilos/orfeo.css" rel="stylesheet" type="text/css">
    </head>
    <body bgcolor="#FFFFFF">
        <br>
        <form name="adminEdificio" action="<?= $encabezadol ?>" method="post" >
            <center>
                <div id="titulo" style="width: 50%;" align="center">Administración de edificios</div>
                <table border="1" width="50%" align="center" cellpadding="0"  class="borde_tab">
                    <tr>
                        <td class="listado2"><input type="button" name="NUEVO" value="Nuevo edificio" onClick="NuevoE();" class="botones_largo" aria-label="Abrir formulario en una nueva ventana para registrar un nuevo edificio">
                            <a href='archivo.php?<?= session_name() ?>=<?= trim(session_id()) ?>krd=<?= $krd ?>'><input name='Regresar' align="middle" type="button" class="botones_mediano" id="envia22" value="Regresar" aria-label="Regresar al menú del módulo de archivo">
                               <!--a href="ingEdificio.php?<?= session_name() . "=" . session_id() . "&krd=$krd&fechah=$fechah&$orno&adodb_next_page" ?>' target='mainFrame' class="menu_princ""><b> Nuevo Edificio </b-->
                                </td>
                                </tr>
                                </table>
                                <br>
                                <table border="1" width="50%" cellpadding="0" align="center"  class="borde_tab">
                                    <tr>
                                        <td class="titulos2">EDIFICIO</td>
                                        <td class="titulos2">EDITAR</td>
                                        <td class="titulos2">BORRAR</td>
                                    </tr>
                                    <?
//modificado skina conversion de variable
                                    $sqlp = "select sgd_eit_nombre,sgd_eit_codigo from sgd_eit_items where cast(sgd_eit_cod_padre as varchar) like '0'";
// Modificado skina para Oracle, febrero 17 de 2010
//$sqlp="select sgd_eit_nombre,sgd_eit_codigo from sgd_eit_items where sgd_eit_cod_padre like '0'";
                                    $rs = $db->conn->Execute($sqlp);
                                    while (!$rs->EOF) {
                                        $nom = $rs->fields['SGD_EIT_NOMBRE'];
                                        $cod = $rs->fields['SGD_EIT_CODIGO'];
                                        if ($EDI == 1)
                                            $sel = "checked";
                                        ?>
                                        <tr><td class="listado2"><?= $nom ?></td>
                                            <td class="listado2"><input type="radio" name="EDI" value="1" onClick="Edifi(<?= $cod ?>);" <?= $sel ?> align="absmiddle"></td>
                                            <td class="listado2"><input type="radio" name="BORR" value="1" onClick="Borrar(<?= $cod ?>);" <?= $sel ?> align="absmiddle"></td>
                                        </tr>
                                        <?
                                        $rs->MoveNext();
                                    }
                                    ?>
                                </table>
                                </center>
                                </form>
                                </body>
                                </html>
