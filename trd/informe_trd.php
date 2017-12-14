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
$anoActual = date("Y");
if (!$fecha_busq)
    $fecha_busq = date("Y-m-d");
if (!$fecha_busq2)
    $fecha_busq2 = date("Y-m-d");
$ruta_raiz = "..";
if (!$_SESSION['dependencia'] and ! $_SESSION['depe_codi_territorial'])
    include "../rec_session.php";
include_once "$ruta_raiz/include/db/ConnectionHandler.php";
$db = new ConnectionHandler("$ruta_raiz");
//$db->conn->debug = true;	
if (!defined('ADODB_FETCH_ASSOC'))
    define('ADODB_FETCH_ASSOC', 2);
$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;
?>
<head>
    <link href="<?= $ruta_raiz . $ESTILOS_PATH2 ?>bootstrap.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="<?= $ruta_raiz . $_SESSION['ESTILOS_PATH_ORFEO'] ?>">
</head>
<BODY>
    <div id="spiffycalendar" class="text"></div>
    <link rel="stylesheet" type="text/css" href="../js/spiffyCal/spiffyCal_v2_1.css">
    <br>
    <form name="inf_trd"  action='../trd/informe_trd.php?<?= session_name() . "=" . session_id() . "&krd=$krd&fecha_h=$fechah" ?>' method=post>
        <center>
            <div id="titulo" style="width: 550px;" align="center">Informe tablas de retención documental</div> 
            <TABLE width="550" class='borde_tab' border='1' align="center">
                <!--DWLayoutTable-->
                <TR>
                    <TD height="26" class='titulos2'>
                        <label for="dep_sel">Dependencia</label>
                    </TD>
                    <TD valign="top" class='listado2'>
                        <?
                        error_reporting(7);
                        $ss_RADI_DEPE_ACTUDisplayValue = "--- TODAS LAS DEPENDENCIAS ---";
                        $valor = 0;
                        include "$ruta_raiz/include/query/devolucion/querydependencia.php";
                        $sqlD = "select $sqlConcat ,depe_codi from dependencia where depe_estado=1
							order by depe_codi";
                        $rsDep = $db->conn->Execute($sqlD);
                        print $rsDep->GetMenu2("dep_sel", "$dep_sel", $blank1stItem = "$valor:$ss_RADI_DEPE_ACTUDisplayValue", false, 0, " onChange='submit();' class='select' id='dep_sel' title='Listado de todas las dependencias existentes'");
                        ?>
                </TR>
                <tr>
                    <td height="26" colspan="2" valign="top" class='listado1'> <center>
                    <input type=SUBMIT name=generar_informe value=' Generar Informe' class='botones' aria-label="Generar informe detallado de las tablas de gestión documental">
                    <!--<input type=SUBMIT name=generar_archicsv value=' Generar Archivo CSV' class=botones_mediano>-->
                </center>
                </td>
                </tr>
            </TABLE>
        </center>

        <?php
        if ($_POST['generar_informe']) {
            if ($_POST['dep_sel'] == '0') {
                /*
                 * Seleccionar todas las dependencias
                 */
                $where_depe = '';
            } else {

//parametro solo de la SSPD
                if ($entidad == "SSPD") {
                    if ($dep_sel == "527" || $dep_sel == "810" || $dep_sel == "820" || $dep_sel == "830" || $dep_sel == "840" || $dep_sel == "850") {

                        $where_depe = " AND ( ( m.depe_codi = '" . $_POST['dep_sel'] . "'  AND m.SGD_SRD_CODIGO = 15) OR (m.depe_codi = '" . $_POST['dep_sel'] . "' AND m.SGD_SRD_CODIGO <> 15))";
                    } else {
                        $where_depe = " AND m.depe_codi = '" . $_POST['dep_sel'] . "' AND m.SGD_SRD_CODIGO <> 15 ";
                    }
                } else {
                    $where_depe = " and m.depe_codi = '" . $_POST['dep_sel'] . "'";
                }
            }
            $generar_informe = 'generar_informe';
            error_reporting(7);
            $guion = "' '";
            include "$ruta_raiz/include/query/trd/queryinforme_trd.php";
            $order_isql = " order by m.depe_codi, m.sgd_srd_codigo,m.sgd_sbrd_codigo,m.sgd_tpr_codigo ";
            $query_t = $query . $where_depe . $order_isql;
            $ruta_raiz = "..";
            error_reporting(7);
            $rs = $db->query($query_t);
//            echo "<hr>---<hr>";
            ?>
        <br>
            <table class='borde_tabReducido' border='2' width='98%' align='center' >
                <?
                $nSRD_ant = "";
                $nSBRD_ant = "";
                $depTDR_ant = "";
                $openTR = "";
                ?>
                <tr class=titulos3>
                    <td colspan="3" align="center">Codigo</td>
                    <td align="center" rowspan="2">Series Y Tipos Documentales</td>
                    <td colspan="2" align="center">Retencion<br> A&#241;os</td>
                    <td colspan="4" align="center">Disposicion<br> Final</td>
                    <td colspan="3" align="center">Soporte</td>
                    <td rowspan="2" align="center" width=30%>Procedimiento </td>
                </tr>
                <tr class=titulos3>
                    <td Aign="center">D</td><td Aign="center">S</td><td Aign="center">Sb</td>
                    <td align="center">AG</td><TD>AC</TD>
                    <td>CT</TD><TD>E</TD><TD>I</TD><TD>S</TD>
                    <td>P</td><td>EL</td><td>O</td>
                </tr>
                <?
                while (!$rs->EOF and $rs) {

                    $nSRD = strtoupper($rs->fields['SGD_SRD_DESCRIP']); //Nombre Serie
                    $depTDR = $rs->fields['DEPE_CODI'];     //Dependencia
                    $depTDR_nomb = $rs->fields['DEPE_NOMB'];     //Dependencia
                    $nSBRD = $rs->fields['SGD_SBRD_DESCRIP'];   //Nombre SubSerie
                    $cSRD = $rs->fields['SGD_SRD_CODIGO'];    //Codigo Serie
                    $cSBRD = $rs->fields['SGD_SBRD_CODIGO'];   //Codigo Subserie
                    //by skina php5.3
                    $nTDoc = ucfirst($rs->fields['SGD_TPR_DESCRIP']); //Nombre Tipo Documental
                    //Modificado skina 150709 
                    if (($depTDR == $depTDR_ant)) {
                        $pSRD = "";
                    } else {
                        $pSRD = "$nSRD";
                        if ($openTR == "Si") {
                            echo "$colFinales";
                        }
                        echo "<tr class=titulos2><td><font size=2 face='Arial'>$depTDR</font></td>
			 <td>&nbsp;<font size=2 face='Arial'></font></td>
                         <td>&nbsp;</td><td colspan=11><font size=2 face='Arial'>$depTDR_nomb</font></td>";
                        echo "</tr><tr>";
                        $openTR = "No";
                    }

                    //Modificado skina 150709 
                    if (($nSRD == $nSRD_ant) and ( $depTDR == $depTDR_ant)) {
                        $pSRD = "";
                    } else {
                        $pSRD = "$nSRD";
                        if ($openTR == "Si") {
                            echo "$colFinales";
                        }
                        echo "<tr class=listado2><td><font size=2 face='Arial'>$depTDR</font></td>
			  <td>&nbsp;<font size=2 face='Arial'>$cSRD</font></td>
			  <td>&nbsp;</td><td colspan=11><font size=2 face='Arial'>$pSRD</font></td>";
                        echo "</tr><tr>";
                        $openTR = "No";
                    }
                    //Modificado skina 150709 
                    //if(($nSBRD==$nSBRD_anti) and ($nSRD==$nSRD_ant) and ($depTDR==$depTDR_ant))
                    if (($nSBRD == $nSBRD_ant) and ( $depTDR == $depTDR_ant)) {
                        $pSBRD = "&nbsp;&nbsp;&nbsp;- <font size=2 face='Arial'>$nTDoc</font><br>";
                        echo "<font size=2 face='Arial'>$pSBRD</font>";
                    } else {
                        if ($openTR == "Si") {
                            echo "<font size=2 face='Arial'>$colFinales</font>";
                        }
                        $conservCT = "&nbsp;";
                        $conservE = "&nbsp;";
                        $conservI = "&nbsp;";
                        $conservS = "&nbsp;";
                        $soporteP = "&nbsp;";
                        $soporteEl = "&nbsp;";
                        $soporteO = "&nbsp;";
                        //$conserv = strtoupper(substr(trim($rs->fields['DISPOSICION']),0,1));
                        $conserv = $rs->fields['DISPOSICION'];
                        $soporte = strtoupper(substr(trim($rs->fields['SGD_SBRD_SOPORTE']), 0, 1));
                        $pSBRD = "<a href=#><font size=2 face='Arial'>$nSBRD</font></a><br>&nbsp;&nbsp;&nbsp;- 
				<font size=2 face='Arial'>$nTDoc</font>";
                        echo "<tr valign=top class=listado1>
				<td><font size=2 face='Arial'>$depTDR</font></td>
				<td>&nbsp;<font size=2 face='Arial'>$cSRD</font></td>
				<td>.<font size=2 face='Arial'>$cSBRD</font></td>
				<td><font size=2 face='Arial'>$pSBRD</font><br>";

                        // Esto se encarga de pintar las x en INFORME TABLAS DE RETENCION DOCUMENTAL dese la interfaz web
                        $openTR = "Si";
                        if ($conserv == "CT")
                            $conservCT = "X";  // Disposicion final 1 (CONSERVACION TOTAL)
                        if ($conserv == "E")
                            $conservE = "X";    // Disposicion final 2 (ELIMINACION)
                        if ($conserv == "MT")
                            $conservI = "X";   // Disposicion final 3 (MEDIO TECNOLOGICO)
                        if ($conserv == "S")
                            $conservS = "X";    // Disposicion final 4 (SELECCION)



                            
// Se agrega en la query el dato para la disposicion final 5, 6, 7
                        // by Skina jmgamez@skinatech.com FECHA ---> Mayo 31 2016
                        if ($conserv == "CT/MT") {
                            $conservCT = "X";
                            $conservI = "X";
                        } // Disposicion final 5 (CONSERVACION TOTAL Y MEDIO TECNOLOGICO)
                        if ($conserv == "E/MT") {
                            $conservE = "X";
                            $conservI = "X";
                        }   // Disposicion final 6 (ELIMINACION y MEDIO TECNOLOGICO)
                        if ($conserv == "MT/S") {
                            $conservI = "X";
                            $conservS = "X";
                        }   // Disposicion fibal 7 (MEDIO TECNOLOGICO Y SELECCION)

                        if ($soporte == "P")
                            $soporteP = "X";    // Soporte PAPEL
                        if ($soporte == "E")
                            $soporteEl = "X";   // Soporte ELECTRONICO
                        if ($soporte == "O")
                            $soporteO = "X";    // Soporte ORIGINAL 
                        $tiemag = $rs->fields['SGD_SBRD_TIEMAG'];
                        $tiemac = $rs->fields['SGD_SBRD_TIEMAC'];
                        $nObservacion = $rs->fields['SGD_SBRD_PROCEDI'];
                        $conservacion = "<td><font size=2 face='Arial'><font size=2 face='Arial'>$conservCT</font></td>
				<td><font size=2 face='Arial'>$conservE</font></td>
				<td><font size=2 face='Arial'>$conservI</td>
				<td><font size=2 face='Arial'>$conservS</td>";
                        $soporte = "<td><font size=2 face='Arial'>$soporteP</td>
				<td><font size=2 face='Arial'>$soporteEl</td><td>
				<font size=2 face='Arial'>$soporteO</td>";
                        $colFinales = "<td><font size=2 face='Arial'>&nbsp;$tiemag</td>
				<td>&nbsp;<font size=2 face='Arial'>$tiemac</font></td>
				<font size=2 face='Arial'>$conservacion $soporte</font>
				<td>&nbsp;<font size=2 face='Arial'>" . strtoupper($nObservacion) . "</font>
				</td>";
                    }
                    $nSRD_ant = $nSRD;
                    $nSBRD_ant = $nSBRD;
                    $depTDR_ant = $depTDR;
                    $rs->MoveNext();
                }
                if ($openTR == "Si") {
                    echo "$colFinales";
                }
                ?>
            </table>
            <?
        }

        /* function lcfirst($str)
          {
          return strtoupper(substr($str, 0, 1)) . strtolower(substr($str, 1));
          } */
        ?>
    </form>
    <HR>
