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

if (!isset($_SESSION['dependencia']))
    include "$ruta_raiz/rec_session.php";

include_once "$ruta_raiz/include/db/ConnectionHandler.php";

(!$db) ? $conexion = new ConnectionHandler($ruta_raiz) : $conexion = $db;
//$conexion->conn->debug = true;
$conexion->conn->SetFetchMode(ADODB_FETCH_ASSOC);
?>
<html>
    <head>
        <link href="<?= $ruta_raiz . $ESTILOS_PATH2 ?>bootstrap.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="<?= $ruta_raiz . $_SESSION['ESTILOS_PATH_ORFEO'] ?>">
    </head>
    <body bgcolor="#FFFFFF" topmargin="0">
        <script language="JavaScript" type="text/JavaScript">
        </script>
        <br>
        <form action="upload3.php" method="post" enctype="multipart/form-data" name="formAdmon">
            <center>
                <div id="titulo" style="width: 70%;" align="center">Administrador de tipos de certificación</div>
                <table width="70%" align="center" border="1" cellpadding="0" cellspacing="5" class="borde_tab">
                    <tr align="center">
                        <td class="titulos2"><label>ID</label></td>
                        <td class="titulos2"><label>Nombre plantilla ODT</label></td>
                        <td class="titulos2"><label>Descripción</label></td>
                        <td class="titulos2"><label>v1</label></td>
                        <td class="titulos2"><label>v2</label></td>
                        <td class="titulos2"><label>v3</label></td>
                        <td class="titulos2"><label>v4</label></td>
                        <td class="titulos2"><label>v5</label></td>
                        <td class="titulos2"><label>v6</label></td>
                        <td class="titulos2"><label>v7</label></td>
                        <td class="titulos2"><label>v8</label></td>
                        <td class="titulos2"><label>v9</label></td>
                        <td class="titulos2"><label>Habilitar</label></td>
                        <!--td height="30" class="listado2">
                                <input name="archivoCsv" type="file" class="tex_area" id="archivoCsv" title="Presione espacio para abrir ventana y adjuntar el archivo CSV" value='<?= $archivoCsv ?>'>
                        </td-->
                    </tr>
                    <?php
                    // Generacion automatica del resto de variables desde DB
                    $isql = "SELECT id_type, file_name, type_desc, v1, v2, v3, v4, v5, v6, v7, v8, v9, type_enable FROM cert_types";

                    $rs = $conexion->conn->query($isql);

                    while (!$rs->EOF) {
                        $id = $rs->fields['ID_TYPE'];
                        $file = $rs->fields['FILE_NAME'];
                        $desc = $rs->fields['TYPE_DESC'];
                        $v1 = $rs->fields['V1'];
                        $v2 = $rs->fields['V2'];
                        $v3 = $rs->fields['V3'];
                        $v4 = $rs->fields['V4'];
                        $v5 = $rs->fields['V5'];
                        $v6 = $rs->fields['V6'];
                        $v7 = $rs->fields['V7'];
                        $v8 = $rs->fields['V8'];
                        $v9 = $rs->fields['V9'];
                        $enable = $rs->fields['TYPE_ENABLE'];

                        echo "<tr>";
                        echo "<td class=\"listado2\">$id</td>";
                        echo "<td class=\"listado2\">$file</td>";
                        echo "<td class=\"listado2\"><input type=\"text\" name=\"desc$id\" value=\"$desc\"> </td>";
                        if ($v1 == 1) {
                            echo "<td class=\"listado2\"><input type=\"checkbox\" id=\"v1$id\" name=\"v1$id\" value=\"v1$id\" checked> </td>";
                        } else {
                            echo "<td class=\"listado2\"><input type=\"checkbox\" id=\"v1$id\" name=\"v1$id\" value=\"v1$id\"> </td>";
                        }
                        if ($v2 == 1) {
                            echo "<td class=\"listado2\"><input type=\"checkbox\" id=\"v2$id\" name=\"v2$id\" value=\"v2$id\" checked> </td>";
                        } else {
                            echo "<td class=\"listado2\"><input type=\"checkbox\" id=\"v2$id\" name=\"v2$id\" value=\"v2$id\"> </td>";
                        }
                        if ($v3 == 1) {
                            echo "<td class=\"listado2\"><input type=\"checkbox\" id=\"v3$id\" name=\"v3$id\" value=\"v3$id\" checked> </td>";
                        } else {
                            echo "<td class=\"listado2\"><input type=\"checkbox\" id=\"v3$id\" name=\"v3$id\" value=\"v3$id\"> </td>";
                        }
                        if ($v4 == 1) {
                            echo "<td class=\"listado2\"><input type=\"checkbox\" id=\"v4$id\" name=\"v4$id\" value=\"v4$id\" checked> </td>";
                        } else {
                            echo "<td class=\"listado2\"><input type=\"checkbox\" id=\"v4$id\" name=\"v4$id\" value=\"v4$id\"> </td>";
                        }
                        if ($v5 == 1) {
                            echo "<td class=\"listado2\"><input type=\"checkbox\" id=\"v5$id\" name=\"v5$id\" value=\"v5$id\" checked> </td>";
                        } else {
                            echo "<td class=\"listado2\"><input type=\"checkbox\" id=\"v5$id\" name=\"v5$id\" value=\"v5$id\"> </td>";
                        }
                        if ($v6 == 1) {
                            echo "<td class=\"listado2\"><input type=\"checkbox\" id=\"v6$id\" name=\"v6$id\" value=\"v6$id\" checked> </td>";
                        } else {
                            echo "<td class=\"listado2\"><input type=\"checkbox\" id=\"v6$id\" name=\"v6$id\" value=\"v6$id\"> </td>";
                        }
                        if ($v7 == 1) {
                            echo "<td class=\"listado2\"><input type=\"checkbox\" id=\"v7$id\" name=\"v7$id\" value=\"v7$id\" checked> </td>";
                        } else {
                            echo "<td class=\"listado2\"><input type=\"checkbox\" id=\"v7$id\" name=\"v7$id\" value=\"v7$id\"> </td>";
                        }
                        if ($v8 == 1) {
                            echo "<td class=\"listado2\"><input type=\"checkbox\" id=\"v8$id\" name=\"v8$id\" value=\"v8$id\" checked> </td>";
                        } else {
                            echo "<td class=\"listado2\"><input type=\"checkbox\" id=\"v8$id\" name=\"v8$id\" value=\"v8$id\"> </td>";
                        }
                        if ($v9 == 1) {
                            echo "<td class=\"listado2\"><input type=\"checkbox\" id=\"v9$id\" name=\"v9$id\" value=\"v9$id\" checked> </td>";
                        } else {
                            echo "<td class=\"listado2\"><input type=\"checkbox\" id=\"v9$id\" name=\"v9$id\" value=\"v9$id\"> </td>";
                        }


                        echo "</tr>";



                        $rs->MoveNext();
                    }
                    ?>
                    <tr align="center">
                        <td height="30" colspan="13" class="listado1">
                            <span class="celdaGris"> <span class="e_texto1">
                                    <input name="enviaPrueba" type="button" class="botones" id="envia22" onClick="enviar();" value="Modificar">
                                    </td>
                                    </tr>
                                    </table>
                                    </form>
                                    <!--<blockquote>-->
                                    <br>
                                    <center>
                                        <div id="titulo" style="width: 70%;" align="center">Convención de variables</div>
                                        <table width="70%" align="center" border="1" cellpadding="0" cellspacing="5" class="borde_tab">
                                            <tr class="listado2"><td>v1 --- Nombres y apellidos </td></tr>
                                            <tr class="listado2"><td>v2 --- Documento de identidad </td></tr>
                                            <tr class="listado2"><td>v3 --- Termino de contrato </td></tr>
                                            <tr class="listado2"><td>v4 --- Cargo </td></tr>
                                            <tr class="listado2"><td>v5 --- Salario </td></tr>
                                            <tr class="listado2"><td>v6 --- Caja de compensación familiar</td></tr>
                                            <tr class="listado2"><td>v7 --- Fecha de ingreso </td></tr>
                                            <tr class="listado2"><td>v8 --- A solicitud de </td></tr>
                                            <tr class="listado2"><td>v9 --- Comisiones </td></tr>
                                        </table>
                                    </center>
                                    <p>&nbsp;</p>
                                    <!--</blockquote>-->
                                    </body>
                                    </html>
