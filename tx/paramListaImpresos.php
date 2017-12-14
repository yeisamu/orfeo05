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
error_reporting(7);
$ruta_raiz = "..";
if (!$fecha_busqH)
    $fecha_busqH = date("Y-m-d");
if (!$fecha_busq)
    $fecha_busq = date("Y-m-d");
if (!$_SESSION['dependencia'])
    include "../rec_session.php";
include_once "../include/db/ConnectionHandler.php";
$db = new ConnectionHandler("..");
define('ADODB_FETCH_ASSOC', 2);
$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;
if (!$dep_sel)
    $dep_sel = $_SESSION['dependencia'];
?>
<head>
    <link href="<?= $ruta_raiz . $ESTILOS_PATH2 ?>bootstrap.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="<?= $ruta_raiz . $_SESSION['ESTILOS_PATH_ORFEO'] ?>">
</head>
<body>
    <div id="spiffycalendar" class="text"></div>
    <link rel="stylesheet" type="text/css" href="../js/spiffyCal/spiffyCal_v2_1.css">
    <script language="JavaScript" src="../js/spiffyCal/spiffyCal_v2_1.js"></script>
    <script language="javascript">
        setRutaRaiz('..');
        var dateAvailable = new ctlSpiffyCalendarBox("dateAvailable", "gen_listado", "fecha_busq", "btnDate1", "<?= $fecha_busq ?>", scBTNMODE_CUSTOMBLUE);
        var dateAvailableH = new ctlSpiffyCalendarBox("dateAvailableH", "gen_listado", "fecha_busqH", "btnDate1", "<?= $fecha_busqH ?>", scBTNMODE_CUSTOMBLUE);
    </script>
    <!--<table class=borde_tab width='100%' cellspacing="5"><tr><td class=titulos2><center>Documentos reasignados por la dependencia</center></td></tr></table>-->
    <form name="gen_listado"  action='./cuerpoListaImpresos.php?<?= session_name() . "=" . session_id() . "&krd=$krd&fecha_ini=$fecha_ini&indi_generar=indi_generar&dep_sel=$dep_sel&dep_sel_dest=$dep_sel_dest&tip_radi=$tip_radi&fecha_h=$fechah&fecha_busq=$fecha_busq&fecha_busq2=$fecha_busq2" ?>' method=post>
        <center>
            <br>
            <div id="titulo" style="width: 45%;" align="center">Documentos reasignados por la dependencia</div>
            <TABLE width="45%" class="borde_tab" border="1" cellspacing="5">
                <!--DWLayoutTable-->
                <TD width="125" height="21"  class='titulos2'><label for="fecha_busq"> Fecha Desde </label><br>
<?
echo "(" . date("Y-m-d") . ")";
?>
                </TD>
                <TD width="225" align="right" valign="top" class='listado2'>

                    <script language="javascript">
                        dateAvailable.date = "2003-08-05";
                        dateAvailable.writeControl();
                        dateAvailable.dateFormat = "yyyy-MM-dd";
                    </script>
                </TD>
                </TR>
                <TR>
                    <td width="125" height="21"  class='titulos2'><label for="fecha_busqH"> Fecha Hasta</label><br>
                    </td>
                    <TD width="225" align="right" valign="top" class='listado2'>
                        <script language="javascript">
                            dateAvailableH.date = "2003-08-05";
                            dateAvailableH.writeControl();
                            dateAvailableH.dateFormat = "yyyy-MM-dd";
                        </script>
                    </td>
                </tr>
                <tr>
                    <td width="125" height="21"  class='titulos2'><label for="hora_ini"> Desde la Hora</label></td>
                    <TD width="225" align="right" valign="top" class='listado2'>
                        <?
                        if (!$hora_ini)
                            $hora_ini = 01;
                        if (!$hora_fin)
                            $hora_fin = date("H");
                        if (!$minutos_ini)
                            $minutos_ini = 01;
                        if (!$minutos_fin)
                            $minutos_fin = date("i");
                        if (!$segundos_ini)
                            $segundos_ini = 01;
                        if (!$segundos_fin)
                            $segundos_fin = date("s");
                        ?>

                        <select name=hora_ini class=select id="hora_ini">
                            <?
                            for ($i = 0; $i <= 23; $i++) {
                                if ($hora_ini == $i) {
                                    $datoss = " selected ";
                                } else {
                                    $datoss = " ";
                                }
                                ?>
                                <option value='<?= $i ?>' '<?= $datoss ?>'>
                                <?= $i ?>
                                </option>
                                <?
                            }
                            ?>
                        </select><label for="minutos_ini">:</label><select id="minutos_ini" name=minutos_ini class=select>
<?
for ($i = 0; $i <= 59; $i++) {
    if ($minutos_ini == $i) {
        $datoss = " selected ";
    } else {
        $datoss = " ";
    }
    ?>
                                <option value='<?= $i ?>' '<?= $datoss ?>'>
    <?= $i ?>
                                </option
                                >
                                <?
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <TD height="26" class='titulos2'><label for="hora_fin"> Hasta</label></td>
                    <TD valign="top" class='listado2'><select id="hora_fin" name=hora_fin class=select>
<?
for ($i = 0; $i <= 23; $i++) {
    if ($hora_fin == $i) {
        $datoss = " selected ";
    } else {
        $datoss = " ";
    }
    ?>
                                <option value='<?= $i ?>' '<?= $datoss ?>'>
    <?= $i ?>
                                </option
                                >
                            <?
                        }
                        ?>
                        </select><label for="minutos_fin">:</label><select id="minutos_fin" name=minutos_fin class=select>
                        <?
                        for ($i = 0; $i <= 59; $i++) {
                            if ($minutos_fin == $i) {
                                $datoss = " selected ";
                            } else {
                                $datoss = " ";
                            }
                            ?>
                                <option value='<?= $i ?>' '<?= $datoss ?>'>
                            <?= $i ?>
                                </option
                                >
                            <?
                        }
                        ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <TD height="26" class='titulos2'><label for="tip_radi">Tipo de Radicacion</label></td>
                    <td class="listado2"> 
                        <?
                        $ss_RADI_DEPE_ACTUDisplayValue = "--- Todos los Tipos ---";
                        $valor = 0;
                        $sqlD = "select SGD_TRAD_DESCR,sgd_trad_codigo from SGD_TRAD_TIPORAD order by 1";
                        $rsDep = $db->conn->Execute($sqlD);
                        print $rsDep->GetMenu2("tip_radi", "$tip_radi", $blank1stItem = "$valor:$ss_RADI_DEPE_ACTUDisplayValue", false, 0, " class='select' id='tip_radi'");
                        ?>
                    </td>
                </tr>
                </td> 

                <tr>
                    <TD height="26" class='titulos2'><label for="dep_sel">Dependencia Origen</label></td>
                    <td class="listado2">
<?
$ss_RADI_DEPE_ACTUDisplayValue = "--- Seleccione----";
$valor = 0;
$sqlD = "select depe_nomb,depe_codi from dependencia order by 1";
$rsDep = $db->conn->Execute($sqlD);
print $rsDep->GetMenu2("dep_sel", "$dep_sel", $blank1stItem = "$valor:$ss_RADI_DEPE_ACTUDisplayValue", false, 0, " class='select' id='dep_sel'");
?>
                    </td>
                </tr>
                <tr>
                    <TD height="26" class='titulos2'><label for="dep_sel_dest">Dependencia Destino</label></td>
                    <td class="listado2">
<?
$ss_RADI_DEPE_ACTUDisplayValue = "--- Todas las dependencias----";
$valor = 0;
$sqlDest = "select depe_nomb,depe_codi from dependencia order by 1";
$rsDepDest = $db->conn->Execute($sqlDest);
print $rsDepDest->GetMenu2("dep_sel_dest", "$dep_sel_dest", $blank1stItem = "$valor:$ss_RADI_DEPE_ACTUDisplayValue", false, 0, " class='select' id='dep_sel_dest'");
?>
                    </td>
                </tr>

                </td>

                <tr>
                    <td height="26" colspan="2" valign="top" class='listado1'> 
                <center>
                    <INPUT TYPE=SUBMIT name=generar_listado Value=' Generar ' class=botones>
                    <INPUT TYPE=submit name=cancelarAnular value=Cancelar class=botones>
                    </td></tr>
                    </table>
<?php
if (!$fecha_busq)
    $fecha_busq = date("Y-m-d");
if (!$fecha_busqH)
    $fecha_busqH = date("Y-m-d");
?>
                    </form>
