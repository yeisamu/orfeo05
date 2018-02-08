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
 * Modificacion Variables Globales Infometrika 2009-05
 * Licencia GNU/GPL 
 * Modificacion Jairo Losada Var. Globales 2009-06
 */
foreach ($_GET as $key => $valor)
    ${$key} = $valor;
foreach ($_POST as $key => $valor)
    ${$key} = $valor;
$ruta_raiz = ".";
$krd = $_SESSION["krd"];
$dependencia = $_SESSION["dependencia"];
$usua_doc = $_SESSION["usua_doc"];
$codusuario = $_SESSION["codusuario"];

$imagenes = $_SESSION["imagenes"];

error_reporting(7);
include_once "$ruta_raiz/include/db/ConnectionHandler.php";
$db = new ConnectionHandler($ruta_raiz);
//$db->conn->debug=true; 
?>
<html>
    <title>Adm - Contrase&ntilde;as - ORFEO </title>
    <HEAD>
        <link href="estilos/orfeo50/bootstrap.css" rel="stylesheet" type="text/css"/>
        <link href="estilos/orfeo50/cambioContrasena.css" rel="stylesheet" type="text/css"/>
    </HEAD>
    <body>
        <br>
        <center>
        <div class="flotante" style="margin-left: 1%;">
            <br>
        <a href="<?= $ruta_raiz ?>/login.php">
            <img border="0" src="estilos/orfeo50/imagenes50/sgd.png" alt="Ir a la pagina de incio de sesion">
        </a>
        <?
        if (!$depsel)
            $depsel = $dependencia;
        if ($aceptar == "Grabar cambio de contraseña") {
            $isql = "update usuario set usua_nuevo='1',usua_pasw='" . substr(md5($contraver), 1, 26) . "',depe_codi='$depsel', USUA_SESION='CAMBIO PWD(" . date("Ymd") . "' where usua_login='$usuarionew'";
            //echo $isql;
            ?>
            <!--
            </P><CENTER><B><span class="tpar"><a href="<?= $ruta_raiz ?>/login.php" target="mainFrame"><FONT SIZE=5 color=white class=tpar><FONT SIZE=4 >CIERRE ORFEO Y ENTRE DE NUEVO</font></font></a>
            -->
            <?
            $rs = $db->conn->query($isql);
            if ($rs == -1) {
                echo "<h4>No se ha podido cambiar la contrase&ntilde;a, Verifique los datos e intente de nuevo</h4>";
            } else {
                echo "<h4>Su contrase&ntilde;a ha sido cambiada correctamente</h4>";
                session_destroy();
            }
        } else {
            if ($contradrd == $contraver) {
                ?>
            </p>
            <form action=usuarionuevo.php?krd=<?= $krd ?>&<?= session_name()?>=<?= session_id() ?>" method=post>
                    <table border="0">
                        <tr>
                            <td>
                            <center>
                            <h4><b>Confirmar datos</b></h4>
                            </center>
                            </td>
                        </tr>
                    </table>
                    <table>
                        <tr>
                            <td>
                                <h4>Usuario <?= $usuarionew ?></h4>
                            </td>
                        </tr>
                        <input type=hidden name=usuarionew value='<?= $usuarionew ?>'></td></tr>
                        <input type=hidden name=contraver value='<?= $contraver ?>'></td></tr>
                        <input type=hidden name=depsel value='<?= $depsel ?>'></td></tr>
                        <tr>
                            <td>
                                <h4>Dependencia <?= $depsel ?></h4>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h4>Esta Seguro de estos datos ?</h4>
                            </td>
                        </tr>
                        </table>
                    <input type=submit value='Grabar cambio de contraseña' style="margin-left: -8%;" name=aceptar class=but> 
                        </form>
                        <?
                    } else {
                        ?>
                        <span>
                            <center>
                            <h4>Contrase&ntilde;as no coinciden<br>
                                <b>Por favor devuelvase y repita la operacion</b><br>
                                        <CENTER><b>Gracias</b></h4>
                            <?
                        }
                    }
                    ?>
                <br>
             </div>
        </center>
    </body>
</html>
