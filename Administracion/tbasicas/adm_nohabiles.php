<?php
session_start();
$ruta_raiz = "../..";
if ($_SESSION['usua_admin_sistema'] != 1)
    die(include "$ruta_raiz/errorAcceso.php");
/*
 * Se incluye archivo config.php con ruta dinámica para evitar 
 * errores si se incluye este archivo en otro
 */
include dirname(__FILE__) . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . 'config.php';           // incluir configuracion.
/*
 * Se incluye archivo ConnectionHandler.php con ruta dinámica para evitar 
 * errores si se incluye este archivo en otro
 */
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "include/db/ConnectionHandler.php";

//include("$ruta_raiz/config.php"); 			// incluir configuracion.
$db = new ConnectionHandler("$ruta_raiz");
include($ADODB_PATH . '/adodb.inc.php'); // $ADODB_PATH configurada en config.php
$error = 0;
//$dsn = $driver."://".$usuario.":".$contrasena."@".$servidor."/".$db;
//$db->conn = NewADOConnection($dsn);
//$db->conn->debug=true;
if ($db) {
    $db->conn->SetFetchMode(ADODB_FETCH_ASSOC);

    switch ($_POST['btn_accion']) {
        Case 'Agregar': {
                $sqlInsert = "insert into sgd_noh_nohabiles(noh_fecha)values(" . $db->conn->DBDate($_POST['fecha_sel']) . ")";
                $ok = $db->conn->Execute($sqlInsert);
                $ok ? $error = 1 : $error = 2;
            }break;
        Case 'Borrar': {
                $tmp_val = implode("','", $_POST['noh_fecha']);
                $sqlBorra = "delete from sgd_noh_nohabiles where noh_fecha in ('$tmp_val')";
                $ok = $db->conn->Execute($sqlBorra);
                $ok ? $error = 3 : $error = 4;
            }break;
    }


    $where = ($_POST['slc_anio'] == "") ? "" : " WHERE " . $db->conn->SQLDate('Y', 'NOH_FECHA') . "='" . $_POST['slc_anio'] . "'";
    $sql_cont = "SELECT NOH_FECHA as ID,NOH_FECHA as DESCRIP FROM SGD_NOH_NOHABILES $where ORDER BY 1";
    $rs_noh = $db->conn->Execute($sql_cont);

    if ($rs_noh)
        $slc_fechas = $rs_noh->GetMenu2('noh_fecha', false, false, true, 5, "class='select' multiple size=5 id='noh_fecha' title='Listado de días no hábiles por año seleccionado'");
    else {
        $slc_fechas = "<select><option></option></select>";
        $error = 5;
    }
} else {
    $error = 6;
    $slc_fechas = "<select><option></option></select>";
}

switch ($error) {
    case 0:$msg = "";
        break;
    case 1:$msg = "Se agreg&oacute; correctamente el registro";
        break;
    case 2:$msg = "No se Insert&oacute; el registro Verifique";
        break;
    case 3:$msg = "Se eliminaron los registros seleccionados";
        break;
    case 4:$msg = "No se pudo borrar el registro Verifique";
        break;
    case 5:$msg = "No se pudo seleccionar fechas";
        break;
    case 6:$msg = "No se pudo conectar con la Base de Datos";
        break;
    default:$msg = "";
        break;
}

if (!($fecha_sel))
    $fecha_sel = date("Y-m-d");
for ($i = 2010; $i <= 2022; $i++) {
    $sel = ($_POST['slc_anio'] == $i) ? "selected" : "";
    $filtro .= "<option value='$i' $sel>$i</option>";
}
?>
<html>
    <head>
        <link href="<?= $ruta_raiz . $ESTILOS_PATH2 ?>bootstrap.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="<?= $ruta_raiz.$_SESSION['ESTILOS_PATH_ORFEO']?>">
    </head>
    <body>
        <br>
        <br>
        <div id="spiffycalendar" class="text"></div>
        <link rel="stylesheet" type="text/css" href="<?= $ruta_raiz ?>/js/spiffyCal/spiffyCal_v2_1.css">
        <script language="JavaScript" src="<?= $ruta_raiz ?>/js/spiffyCal/spiffyCal_v2_1.js"></script>
        <script language="javascript">
            setRutaRaiz('../..');
            var dateAvailable = new ctlSpiffyCalendarBox("dateAvailable", "new_product", "fecha_sel", "btnDate1", "<?= $fecha_sel ?>", scBTNMODE_CUSTOMBLUE);
        </script>
        
<!--    <center><table width="550" class='borde_tab'><tr><td class='titulos4' align="center">Administraci&oacute;n de Dias no Habiles</td></tr></table></center>-->
    <form name="new_product"  action='<?= $_SERVER['PHP_SELF'] ?>' method="post">
        <center>
            <table width="550" class='borde_tab' border="1">
                <div id="titulo" style="width: 550px;" align="center" >Administración de días no hábiles</div>
                <tr>
                    <td  class='titulos2'><label for="fecha_sel">Seleccionar fecha</label></td>
                    <td  class='listado2'>
                        <script language="javascript">
                            dateAvailable.date = "";
                            dateAvailable.writeControl();
                            dateAvailable.dateFormat = "yyyy-MM-dd";
                        </script>
                    </td>
                    <td height="26" colspan="2" valign="top" class='listado2'>
                    <input type="submit" name='btn_accion' id="btn_accion" Value='Agregar' class='botones_mediano' aria-label="Agregar fecha seleccionada al listado de días no hábiles">
                </td>
                </tr>
                <tr>
                    <td height="26" class='titulos2'><label for="slc_anio">Filtro</label></td>
                    <td height="26" class='listado2'>
                        <select name="slc_anio" id="slc_anio" class="select"  onchange="this.form.submit();" title="Listado para filtrar los días no hábiles por año">
                            <option value="">&lt;&lt Todos los a&ntilde;os &gt;&gt;</option>
<?php /* if (isset($filtro)) */ echo $filtro; ?>
                        </select>
                    </td>
                    <td height="26" class='listado2'></td>
                </tr>
                <tr border="1">
                    <td height="26" class='titulos2'><label for="noh_fecha">Fechas registradas</label></td>
                    <td height="26" class='listado2'>
<? echo $slc_fechas ?>
                    </td>
                    <td height="26" class='listado2' align="center">
                        <input type="submit" name='btn_accion' id="btn_accion" Value='Borrar' class=botones_mediano aria-label="Borrar fecha seleccionada del listado de días no hábiles">
                    </td>
                </tr>
                <tr>
                    <td colspan="3" class='titulos2' align="center">
<? echo $msg ?>
                    </td>
                </tr>
            </table>
        </center>
    </form>
</body>
</html>
