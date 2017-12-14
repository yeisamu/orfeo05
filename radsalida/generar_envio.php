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
if (!isset($_SESSION['dependencia']))
    include "../rec_session.php";
include_once "../include/db/ConnectionHandler.php";
$db = new ConnectionHandler("..");
//$db->conn->debug = true;
if (!defined('ADODB_FETCH_ASSOC'))
    define('ADODB_FETCH_ASSOC', 2);
$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;

if (!$fecha_busq)
    $fecha_busq = date("Y-m-d");
?>
<head>
    <link href="<?= $ruta_raiz . $ESTILOS_PATH2 ?>bootstrap.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="<?= $ruta_raiz . $_SESSION['ESTILOS_PATH_ORFEO'] ?>">
</head>
<script>
    function validar(action)
    {
        if (action != 2)
        {
            document.new_product.action = "generar_envio.php?<?= session_name() . "=" . session_id() . "&krd=$krd&fecha_h=$fechah" ?>&generar_listado_existente= Generar Plantilla existente ";
        } else {

            document.new_product.action = "generar_envio.php?<?= session_name() . "=" . session_id() . "&krd=$krd&fecha_h=$fechah" ?>&generar_listado= Generar Nuevo Envio ";
        }
        document.new_product.submit();
    }

    function rightTrim(sString)
    {
        while (sString.substring(sString.length - 1, sString.length) == ' ')
        {
            sString = sString.substring(0, sString.length - 1);
        }
        return sString;
    }

    function solonumeros()
    {
        jh = document.getElementById('no_planilla');
        if (rightTrim(jh.value) == "" || isNaN(jh.value))
        {
            alert('Solo introduzca numeros.');
            jh.value = "";
            jh.focus();
            return false;
        } else
        {
            document.new_product.submit();
        }
    }
</script>
<BODY>
    <div id="spiffycalendar" class="text"></div>
    <link rel="stylesheet" type="text/css" href="../js/spiffyCal/spiffyCal_v2_1.css">
    <script language="JavaScript" src="../js/spiffyCal/spiffyCal_v2_1.js"></script>
    <script language="javascript">
        setRutaRaiz("..");
    var dateAvailable = new ctlSpiffyCalendarBox("dateAvailable", "new_product", "fecha_busq", "btnDate1", "<?= $fecha_busq ?>", scBTNMODE_CUSTOMBLUE);
    </script>
    <table class=borde_tab width='100%' cellspacing="5">
        <tr>
<!--            <td class=titulos2>
        <center>GENERACION PLANILLAS Y GUIAS DE CORREO</center>
    </td>-->
        <div id="titulo" style="width: 50%; margin-left: 25%;" align="center">Generación de Plantillas y Guías de Correo</div>
    </tr>
</table>
<table>
    <tr>
        <td>     
        </td>
    </tr>
</table>
<form name="new_product"  action='generar_envio.php?<?= session_name() . "=" . session_id() . "&krd=$krd&fecha_h=$fechah" ?>' method=post>
    <center>
        <TABLE width="50%" class="borde_tab" border="2" cellspacing="5">
            <!--DWLayoutTable-->
            <TR>
                <TD width="125" height="21"  class='titulos2'><label for="fecha_busq"> Fecha</label><br>
                    <?
// echo "(".date("Y-m-d").")";
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
                <TD height="26" class='titulos2'><label for="hora_ini"> Hora de inicio</label></TD>
                <TD valign="top" class='listado2'>
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

                    <select name=hora_ini class='select' id="hora_ini" title="Horas">
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
                    </select>:<select name=minutos_ini class='select' title="minutos">
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
                </TD>
            </TR>
            <Tr>
                <TD height="26" class='titulos2'><label for="hora_fin">Hora de finalización</label></TD>
                <TD valign="top" class='listado2'><select id="hora_fin" name=hora_fin class=select title="horas">
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
                    </select>:<select name=minutos_fin class=select title="minutos">
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
                </TD>
            </TR>
            <tr>
                <TD height="26" class='titulos2'><label for="tipo_envio">Tipo de Salida</label></TD>
                <TD valign="top" align="left" class='listado2'>
                    <?
                    /* <select name=tipo_envio class='select' onChange="submit();" >
                      $codigo_envio="101";
                      $datoss = "";
                      if($tipo_envio==1)
                      {
                      $datoss = " selected ";
                      $codigo_envio = "101";
                      }
                      ?>
                      <option value=1 '<?=$datoss?>'>MOTO - PLANILLAS</option>
                      <?
                      $datoss = "";
                      if($tipo_envio==2)
                      {
                      $datoss = " selected ";
                      $codigo_envio = "102";
                      }
                      ?>
                      <option value=2 '<?=$datoss?>'>HOY MISMO - PLANILLAS</option>
                      <?
                      $datoss = "";
                      if($tipo_envio==103)
                      {
                      $datoss = " selected ";
                      $codigo_envio = "103";
                      }
                      ?>
                      <option value=103 '<?=$datoss?>'>MSJ. ESPECIALIZADA - PLANILLAS</option>
                      <?
                      $datoss = "";
                      if($tipo_envio==109)
                      {
                      $datoss = " selected ";
                      $codigo_envio = "109";
                      } */
                    ?>
            <!--<option value=109 '<?= $datoss ?>'>ACUSE DE RECIBO - PLANILLAS</option>	
            </select>
             </TD>
              </tr>-->
                    <?php
//Modificado skinatech 26-10-2008
                    $isql = "SELECT SGD_FENV_DESCRIP,SGD_FENV_CODIGO FROM SGD_FENV_FRMENVIO ORDER BY 1";
                    $rs = $db->conn->Execute($isql);
                    if (isset($_POST['codigo_envio']))
                        $codigo_envio = $_POST['codigo_envio'];
                    else
                        $codigo_envio = '';
                    print $rs->GetMenu2("codigo_envio", $codigo_envio, "0:--Seleccione--", false, "class='select' id='tipo_envio' onChange='submit();' title='Listado de tipos de medio de envío'");
                    ?>
            <tr>
                <td colspan=2 class='titulos2'>  
                    <!-- <TD height="26" class='titulos2'>Numero de Planilla</TD>
                       <TD valign="top" align="left" class='listado2'>
                           <input type="text" name="no_planilla" id="no_planilla" value='<?= $no_planilla ?>' class='tex_area' size=11 maxlength="9" >--!>
                    <?
                    $fecha_mes = substr($fecha_busq, 0, 7);
// conte de el ultimo numero de planilla generado.
                    $sqlChar = $db->conn->SQLDate("Y-m", "SGD_RENV_FECH");
//include "$ruta_raiz/include/query/radsalida/queryGenerar_envio.php";	
                    $query = "SELECT sgd_renv_planilla, sgd_renv_fech FROM sgd_renv_regenvio
		  WHERE DEPE_CODI='$dependencia' AND $sqlChar >= '$fecha_mes'
		  AND " . $db->conn->length . "(sgd_renv_planilla) > 0 
		  AND sgd_fenv_codigo = $codigo_envio ORDER BY sgd_renv_fech desc, SGD_RENV_PLANILLA desc";
                    $db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
                    $ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;
                    $rs = $db->query($query);
                    if ($rs) {
                        $planilla_ant = $rs->fields["SGD_RENV_PLANILLA"];
                        $fecha_planilla_ant = $rs->fields["SGD_RENV_FECH"];
                    }

                    echo "<br><span class=etexto>&Uacute;ltima planilla generada : <b> $planilla_ant </b>  Fec:$fecha_planilla_ant";
// Fin conteo planilla generada
                    ?>
                    <!--
                    </td> 
                    <tr>
                       <td height="26" colspan="2" valign="top" class='titulos2'> <center>
                    	<INPUT TYPE=button name=generar_listado_existente Value=' Generar Plantilla existente ' class='botones_funcion' onClick="validar(1);">
                    </center>
                    </td>
                    </tr>
                    -->
            <tr><td height="26" colspan="2" valign="top" class='listado1'> <center>
                <INPUT TYPE=button name=generar_listado Value=' Generar Nuevo Envio ' class='botones_largo' onClick="validar(2);" aria-label="Guardar información del nuevo envío generado">
            </center></td>
            </tr>
        </TABLE>
</form>
<table><tr><td></td></tr></table>
<?php
//Modificado Idrd Julio-31-2008 Todas las planillas modificadas
if (!$fecha_busq)
    $fecha_busq = date("Y-m-d");
if ($generar_listado or $generar_listado_existente) {
    error_reporting(7);
    echo "<table class=borde_tab width='50%'><tr><td class=titulos2><CENTER>FECHA DE BUSQUEDA $fecha_busq</cebter></td></tr></table>";
    if ($generar_listado_existente) {
        $generar_listado = "Genzzz";
        echo "<table class=borde_tab width='50%'><tr><td class=listado2><CENTER>Generar Listado Existente</td></tr></table>";
    }
    include "./generaplanilla.php";
}
?>
