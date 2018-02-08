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


//session_id($PHPSESSID);
if ($usua_doc)
    $usua_doc_tmp = $usua_doc;
if ($usua_ext)
    $usua_ext_tmp = $usua_ext;
if ($usua_piso)
    $usua_piso_tmp = $usua_piso;
if ($usua_email)
    $usua_email_tmp = $usua_email;
if ($usua_at)
    $usua_at_tmp = $usua_at;
session_start();
error_reporting(7);
$ruta_raiz = ".";
if (!$_SESSION['dependencia'])
    include_once "./rec_session.php";
include_once "./include/db/ConnectionHandler.php";
$usua_dia_grb = substr($usua_nacim, -2);
$usua_mes_grb = substr($usua_nacim, 5, 2);
$usua_ano_grb = substr($usua_nacim, 0, 4);
if (!$db)
    $db = new ConnectionHandler(".");
$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
//$db->conn->debug=true;	

if ($usua_doc_tmp)
    $usua_doc = $usua_doc_tmp;
if ($usua_ext_tmp)
    $usua_ext = $usua_ext_tmp;
//if ($usua_piso_tmp)
    $usua_piso = $usua_piso_tmp;
if ($usua_email_tmp)
    $usua_email = $usua_email_tmp;
if ($usua_at_tmp)
    $usua_at = $usua_at_tmp;
if (!$usua_dia)
    $usua_dia = $usua_dia_grb;
if (!$usua_mes)
    $usua_mes = $usua_mes_grb;
if (!$usua_ano)
    $usua_ano = $usua_ano_grb;
?>
<head>
    <link href="<?= $ruta_raiz . $ESTILOS_PATH2 ?>bootstrap.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="<?= $ruta_raiz . $_SESSION['ESTILOS_PATH_ORFEO'] ?>">
</head>
<body  onload="SetFocus();">
    <script language="JavaScript" type="text/JavaScript">
        var a = false;
    </script>
    <br>
    <center>
        <div id="titulo" style="width: 98%;" align="center">Información General</div>
    <form name=datos_personales action="mod_datos.php?<?= session_name() . "=" . session_id() ?>&fechaf=<?= $fechaf ?>&krd=<?= $krd ?>" method=post> 
        <table WIDTH=98% align="center" border="1" cellpadding="0" cellspacing="5" class="borde_tab" >
<!--            <tr valign="bottom">       
                <td class="titulos4" height="54">Informacion General<br>
                </td>
            </tr>-->
            <tr>
                <td class='listado2'> 
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr align="center"> 
                            <td class="info" height="40"><b>La informaci&oacute;n aqu&iacute; 
                                    reportada se considera oficial y es indispensable para 
                                    iniciar el acceso al Sistema de Gesti&oacute;n Documental ORFEO</b></td>
                        </tr>
                    </table>
                </td> 
            </tr>
        </table>
        <table  WIDTH=98% align="center" border="1" cellpadding="0" cellspacing="5" class="borde_tab">
            <!--DWLayoutTable--> 
            <tr> 
                <td height="50" align="right" class="titulos2" width="24%" >
                    Documento C.C:<br>
                    (No incluir puntos, comas o caracteres especiales) </td>
                <td class='listado2' width="17%" > 
                        <?
                        if ($info)
                            $info = "false";
                        else
                            $info = "true";
                        ?>
                    <input type=text name=usua_doc value='<?= TRIM($usua_doc) ?>' class=tex_area size=15 maxlength="20" title="Digite Documento de identidad del usuario" readonly="<?= $info ?>"></td>
                <td  align="right"  class="titulos2" width="15%">Fecha 
                    Nacimiento<br>
                    (dd-mm-aaaa)<?= $usua_nacim ?> </td>
                <td class='listado2' width="24%" ><?
                        $ano_fin = date("Y");
                        $ano_fin++;
                        $ano_fin = $ano_fin - 10;
                        $ano_ini = $ano_fin - 80;
                        ?><select name=usua_dia class="select" aria-label="Lista de dias para la fechas de nacimiento">
                        <option value=0>Dia</option>				
                        <?
                        for ($i = 1; $i <= 31; $i++) {
                            if ($i == $usua_dia) {
                                $datoss = " selected ";
                            } else {
                                $datoss = "";
                            }
                            echo "<option value=$i  $datoss>$i</option>";
                        }
                        ?>
                    </select><select name=usua_mes class="select" aria-label="Lista de meses del a�o para seleccionar en fecha de nacimiento">
                        <option value=0>Mes</option>
                        <? if ($usua_mes == 1) {
                            $datoss = " selected ";
                        } else {
                            $datoss = "";
                        } ?>
                        <option value=1  '<?= $datoss ?>'>Ene</option>
                        <? if ($usua_mes == 2) {
                            $datoss = " selected ";
                        } else {
                            $datoss = "";
                        } ?>	
                        <option value=2  '<?= $datoss ?>'>Feb</option>
                        <? if ($usua_mes == 3) {
                            $datoss = " selected ";
                        } else {
                            $datoss = "";
                        } ?>				
                        <option value=3  '<?= $datoss ?>'>Mar</option>
<? if ($usua_mes == 4) {
    $datoss = " selected ";
} else {
    $datoss = "";
} ?>				
                        <option value=4  '<?= $datoss ?>'>Abr</option>
<? if ($usua_mes == 5) {
    $datoss = " selected ";
} else {
    $datoss = "";
} ?>				
                        <option value=5  '<?= $datoss ?>'>May</option>
<? if ($usua_mes == 6) {
    $datoss = " selected ";
} else {
    $datoss = "";
} ?>				
                        <option value=6  '<?= $datoss ?>'>Jun</option>
<? if ($usua_mes == 7) {
    $datoss = " selected ";
} else {
    $datoss = "";
} ?>				
                        <option value=7  '<?= $datoss ?>'>Jul</option>
<? if ($usua_mes == 8) {
    $datoss = " selected ";
} else {
    $datoss = "";
} ?>				
                        <option value=8  '<?= $datoss ?>'>Ago</option>
<? if ($usua_mes == 9) {
    $datoss = " selected ";
} else {
    $datoss = "";
} ?>				
                        <option value=9  '<?= $datoss ?>'>Sep</option>
    <? if ($usua_mes == 10) {
        $datoss = " selected ";
    } else {
        $datoss = "";
    } ?>				
                        <option value=10  '<?= $datoss ?>'>Oct</option>
    <? if ($usua_mes == 11) {
        $datoss = " selected ";
    } else {
        $datoss = "";
    } ?>				
                        <option value=11  '<?= $datoss ?>'>Nov</option>
    <? if ($usua_mes == 12) {
        $datoss = " selected ";
    } else {
        $datoss = "";
    } ?>				
                        <option value=12  '<?= $datoss ?>'>Dic</option>
                    </select><select name=usua_ano class="select" aria-label="Listado de a�os para la fecha de nacimiento">
                        <option value=0>A�o</option>
<?
for ($i = 1; $i <= 80; $i++) {
    $ano = ($ano_fin - $i);
    if ($ano == $usua_ano) {
        $datoss = " selected ";
    } else {
        $datoss = "";
    }
    echo "<option value=$ano $datoss>$ano</option>";
}
?>
                    </select>
                </td>
                <td   align="right" width="11%" class="titulos2">
                    Extension  </td>
                <td class='listado2' width="9%"> 
                    <input type=text name=usua_ext value='<?= $usua_ext ?>' class=tex_area size=5 maxlength="4" title="Digite extension en al cual se encuentra el usuario"> 
                </td>
            </tr>
            <tr> 
                <td align="right"  height="41" width="24%" class="titulos2">Correo 
                    Electronico<br>
                </td>
                <td class='listado2' width="17%" > 
                    <input type=text name=usua_email  value='<?= trim($usua_email) ?>' class=tex_area size=15 title="Digite su correo electronico de contacto" maxlength="50"></td>
                <td align="right" class="titulos2" width="15%">Identificacion 
                    Equipo<br>
                    (ej, at-999)</td>
                <td class='listado2' width="24%" > <span class="info"> AT-</span> 
                    <input type=text name=usua_at  value='<?= $usua_at ?>' class=tex_area size=5 maxlength="5" title="Digite la identificacion o placa del equipo">
                </td>
                <td class="titulos2"  align="right" width="11%"> 
                    Piso</td>
                <td class='listado2' width="9%"> 
                    <input type=text name=usua_piso  value='<?= $usua_piso ?>' class=tex_area size=5 maxlength="2" title="Digite ubicacion del usuario en la compa�ia"> 
                    &nbsp; </td>
            </tr>
        </table>   

        <table width="780" border="0" cellspacing="0" cellpadding="0">
            <tr align="center"> 
                <td> 
                    <input type=submit name=grabar_datos_per class=botones_largo Value="Grabar Datos Personales" title="Guardar datos personales">
                </td>
            </tr>
        </table>
    </form>

<?
if ($usua_doc and $usua_dia != 0 and $usua_ano != 0 and $usua_mes != 0 and $grabar_datos_per) {
    $fechaNacimiento = "" . $usua_ano . "-" . substr("0$usua_mes", -2) . "-" . substr("0$usua_dia", -2) . "";
    $record["USUA_DOC"] = "$usua_doc";
    $record["USUA_EMAIL"] = "'" . $usua_email . "'";
    $record["USUA_EXT"] = "$usua_ext";
    $usua_dia = substr("0$usua_dia", -2);

    $record["USUA_NACIM"] = $db->conn->DBDate($fechaNacimiento);
    $record["USUA_PISO"] = "'" . $usua_piso . "'";
    $record["USUA_EXT"] = "'" . $usua_ext . "'";
    $record["USUA_AT"] = "'" . $usua_at . "'";
    $record1["USUA_LOGIN"] = "'" . $krd . "'";
    $db->update("USUARIO", $record, $record1);
    $db->conn->CommitTrans();
    ?>
        <TABLE BORDER=0 WIDTH=98%>
            <TR><TD class="alarmas">
            <center><strong>Los datos han sido guardados, Por favor ingrese de modo normal al sistema.</center>
        </TD></TR>
    </TABLE>
    <?
} ELSE {
    ?>
    <TABLE BORDER=0 WIDTH=98%>
        <TR><TD class="listado2">
        <center><strong><span class="alarmas">Todos los datos deben ser grabados correctamente.  De lo contrario no podra seguir navegando por el sistema.</span></center>
    </TD></TR>
    </TABLE>
    <?
}
?>
</center>
</body>
