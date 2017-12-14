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
//	$db->conn->debug=true; 
define('ADODB_FETCH_ASSOC', 2);
$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;
//if (!$dep_sel) $dep_sel = $_SESSION['dependencia'];
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
    <br>
<center>
    <div id="titulo" style="width: 45%;" align="center">Documentos listos para entregar por correspondencia</div>
    <form name="gen_listado"  action='./cuerpoListaImpresos.php?<?= session_name() . "=" . session_id() . "&krd=$krd&fecha_ini=$fecha_ini&indi_generar=indi_generar&dep_sel=$dep_sel&tip_radi=$tip_radi&fecha_h=$fechah&fecha_busq=$fecha_busq&fecha_busq2=$fecha_busq2" ?>' method=post>
        <TABLE width="45%" class="borde_tab" border="1" cellspacing="5">
            <!--DWLayoutTable-->
            <TD width="125" height="21"  class='titulos2'>
                <?
                echo "<label for='fecha_busq'> Fecha de inicio:</label>(" . date("Y-m-d") . ")";
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
                <td width="125" height="21"  class='titulos2'><label for="fecha_busqH"> Fecha de finalizacion</label> <br>
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
                <td width="125" height="21"  class='titulos2'><label for="hora_ini"> Hora de inicio</label></td>
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
                    <select name=hora_ini id="hora_ini" class=select>
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
                    </select>	<label for="minutos_ini" style="color:#304B5F">:</label>
                    <select name=minutos_ini id="minutos_ini" class=select>
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
                <TD height="26" class='titulos2'><label for="hora_fin">Hora de finalizacion</label></td>
                <TD valign="top" class='listado2'><select name=hora_fin class=select id="hora_fin" title="Seleccione la hora de finalizacion (1 a 12)">
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
                    </select><label for="minutos_fin">:</label><select id="minutos_fin" name=minutos_fin class=select title="Seleccione los minutos de la hora de finalizacion">
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
//$sqlD = "select SGD_TRAD_DESCR,sgd_trad_codigo from SGD_TRAD_TIPORAD where SGD_TRAD_CODIGO = '2' order by 1";
                    $sqlD = "select SGD_TRAD_DESCR,sgd_trad_codigo from SGD_TRAD_TIPORAD order by 1";
                    $rsDep = $db->conn->Execute($sqlD);
                    print $rsDep->GetMenu2("tip_radi", "$tip_radi", $blank1stItem = "$valor:$ss_RADI_DEPE_ACTUDisplayValue", false, 0, " class='select' id='tip_radi' title='Listado con tipos de radicacion'");
                    ?>
                </td>
            </tr>
            </td> 

            <tr>
                <TD height="26" class='titulos2'><label for="dep_sel">Dependencia</label></td>
                <td class="listado2">
                    <?
                    $ss_RADI_DEPE_ACTUDisplayValue = "--Todas las dependencias--";
                    $valor = 0;
                    $sqlD = "select depe_nomb,depe_codi from dependencia where depe_estado=1 order by 1";
                    $rsDep = $db->conn->Execute($sqlD);
                    print $rsDep->GetMenu2("dep_sel", "$dep_sel", $blank1stItem = "$valor:$ss_RADI_DEPE_ACTUDisplayValue", false, 0, " class='select' id='dep_sel' title='Listado de las dependencias existentes'");
                    ?>
                </td>
            </tr>
            </td>

            <tr>
                <td height="26" colspan="2" valign="top" class='listado1'> 
                    <INPUT TYPE=SUBMIT name=generar_listado Value=' Generar ' class=botones>
                    <INPUT TYPE=submit name=cancelarAnular value=Cancelar class=botones>
                </td></tr>
        </table>
</center>
<?php
if (!$fecha_busq)
    $fecha_busq = date("Y-m-d");
if (!$fecha_busqH)
    $fecha_busqH = date("Y-m-d");
?>
</form>
