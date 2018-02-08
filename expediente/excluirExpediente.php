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


error_reporting( 7 ); 
$krdold = $krd;
session_start(); 
$ruta_raiz = ".."; 	
if( !$krd )
{
    $krd = $krdold;
}

// Modificado Infom�trika 22-Julio-2009
// Compatibilidad con register_globals = Off
$nurad = $_GET['nurad'];

if ( !$nurad )
{
    $nurad = $rad;
}

if (!isset($_SESSION['dependencia']))	include "$ruta_raiz/rec_session.php";
error_reporting( 7 );

include_once( "$ruta_raiz/include/db/ConnectionHandler.php" );
$db = new ConnectionHandler( "$ruta_raiz" );
//$db->conn->debug=true;
include_once( "$ruta_raiz/include/tx/Historico.php" );

$encabezado = "$PHP_SELF?".session_name()."=".session_id()."&opcionExp=$opcionExp&numeroExpediente=$numeroExpediente&dependencia=$dependencia&krd=$krd&nurad=$nurad&coddepe=$coddepe&codusua=$codusua&depende=$depende&ent=$ent&tdoc=$tdoc&codiTRDModi=$codiTRDModi&codiTRDEli=$codiTRDEli&codserie=$codserie&tsub=$tsub&ind_ProcAnex=$ind_ProcAnex";

error_reporting( 7 );
include_once ("$ruta_raiz/include/tx/Expediente.php");
$expediente = new Expediente( $db );

if( isset( $_POST['expSeleccionados'] ) && $_POST['expSeleccionados'] != "" )
{
    $arrExpSeleccionados = explode( ",", $_POST['expSeleccionados'] );
    
    foreach( $arrExpSeleccionados as $clave => $numExpediente )
    {
        // Consulta si el radicado está archivado
        $arrDatosArchivado = $expediente->expedienteArchivado( $_GET['nurad'], $numExpediente );
        
        // Si el radicado está archivado
        if( $arrDatosArchivado['estado'] == 1 )
        {
            $mensaje  = "El documento se encuentra archivado en el expediente No. ".$numExpediente;
            $mensaje .= " Desea excluirlo del expediente y enviar una solicitud a la dependencia de archivo?";
            break;
        }
        // Si el radicado no está archivado
        else if( $arrDatosArchivado['estado'] == 0 )
        {
            $mensaje = "Va a excluir éste documento del(os) Expediente(s) seleccionado(s). <br> Está seguro?";
        }
    }
    
    // Excluye el radicado del expediente
    if( isset( $_POST['confirmaIncluirExp'] ) && $_POST['confirmaIncluirExp'] == "EXCLUIR_EXP" )
    {
        foreach( $arrExpSeleccionados as $clave => $numExpediente )
        {
            $resultadoExp = $expediente->excluirExpediente( $_GET['nurad'], $numExpediente );
            if( $resultadoExp == 1 )
            {
                $observa = "Excluir radicado de Expediente";
                include_once "$ruta_raiz/include/tx/Historico.php";
                $radicados[0] = $_GET['nurad'];
                $tipoTx = 52;
                $Historico = new Historico( $db );
                $Historico->insertarHistoricoExp( $numExpediente, $radicados, $dependencia, $codusuario, $observa, $tipoTx, 0 );
            }
            else
            {
                print '<hr><font color=red>No se excluyó este radicado del expediente No. '.$numExpediente.'. Por favor intente de nuevo.</font><hr>';
                break;
            }
        }
        ?>
        <script language="JavaScript">
          opener.regresar();
          window.close();
        </script>
        <?php
    }
}
/** CONSULTA SI EL EXPEDIENTE TIENE UNA CLASIFICACION TRD
  */
// Consulta los expedientes a los que pertenece un radicado
$arrExpedientes = $expediente->expedientesRadicado( $_GET['nurad'] );

foreach( $arrExpedientes as $clave => $numExpediente )
{
    // Consulta el proceso y el estado del expediente
    $arrTRDExp = $expediente->getTRDExp( $numExpediente, "", "", "" );
    
    $arrDatosExpediente[ $numExpediente ]['proceso'] = $arrTRDExp['proceso'];
    $arrDatosExpediente[ $numExpediente ]['estado'] = $arrTRDExp['estado'];
}
?>
<html>
<head>
<title>Excluir de Expediente</title>
        <link href="<?= $ruta_raiz . $ESTILOS_PATH2 ?>bootstrap.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="<?= $ruta_raiz . $_SESSION['ESTILOS_PATH_ORFEO'] ?>">
<script language="JavaScript" src="../js/funciones.js"></script>
<script language="JavaScript">
function excluirExpediente()
{
    var strExpSeleccionados = "";
    frm = document.excExp;
    if( typeof frm.check_uno.length != "undefined" )
    {
        for( i = 0; i < frm.check_uno.length; i++ )
        {
            if( frm.check_uno[i].checked )
            {
                if( strExpSeleccionados == "" )
                {
                    coma = "";
                }
                else
                {
                    coma = ",";
                }
                
                strExpSeleccionados += coma + frm.check_uno[i].value;
            }
        }
    }
    else
    {
        if( frm.check_uno.checked )
        {
            strExpSeleccionados = frm.check_uno.value;
        }
    }

    if( strExpSeleccionados != "" )
	{
		frm.expSeleccionados.value = strExpSeleccionados;
        frm.submit();
	}
    else
	{
		alert( "Debe seleccionar un expediente." );
        return false;
	}
}
function confirmaExcluir()
{
    document.getElementById( 'confirmaIncluirExp' ).value = "EXCLUIR_EXP";
    document.excExp.submit();
}
</script>
</head>

<body>
<center>
<form name='excExp' action='<?php print $encabezado; ?>' method="post">
<input type="hidden" name="expSeleccionados" value="<?php print $_POST['expSeleccionados']; ?>">
<input type="hidden" name='confirmaIncluirExp' id='confirmaIncluirExp' value="" >
  <div id="titulo" style="width: 93%;" align="center">Excluir radicado de expediente</div>
<table width="93%"  border="1" align="center">
</table>
<table width="93%"  border="1" align="center">
<tr></tr>
</table>
<table width="93%"  border="1" align="center">
  <tr bordercolor="#FFFFFF">
    <td colspan="2" class="titulos2">
      <center>
        Radicado No. <?php print $_GET['nurad']; ?> Se excluir&aacute; del expediente No.
    </center></td>
  </tr>
</table>
<table width="93%"  border="1" align="center">
<tr></tr>
</table>
<div align="center">
	<table width="93%" class="borde_tab" border="1">
	<tr class="timparr">
	  <th width="26%" height="66" class="titulos2" align="center">
        EXPEDIENTE
      </th>
	<th width="24%" class="titulos2" align="center">PROCESO</th>
	<th width="30%" class="titulos2" align="center">ESTADO</th>
	<td width="20%" height="66" class="titulos2"><div align="center">
	  <input type="checkbox" name="check_todos" aria-label="Casilla de verificacion para seleccionar todos los expedientes de la lista" value="checkbox" onClick="todos( document.forms[0] );">
	</div></td>
	</tr>
<?php
foreach( $arrDatosExpediente as $numeroExpediente => $datosExpediente )
{
?>
    <tr class="listado1">
	  <td align="center" class="leidos">
        <?php print $numeroExpediente; ?>
      </td>
      <td align="center" class="leidos">
        <?php print $datosExpediente['proceso']; ?>
      </td>
      <td align="center" class="leidos">
        <?php print $datosExpediente['estado']; ?>
      </td>
      <td align="center">
        <input type="checkbox" name="check_uno" aria-label="Casilla de verificaiacion seleccionar para excluir de expediente <?=$numeroExpediente?>" value="<?php print $numeroExpediente; ?>" onClick="uno( document.forms[0] );">
      </td>
    </tr>
<?php
}
?>
</table>
</div>
<?php
if( !isset( $_POST['expSeleccionados'] ) )
{
?>
<div align="center">
<table border=0 width=93% class="t_bordeGris">
	<tr class="timparr">
	<td height="30" colspan="2" class="listado2">
      <center>
        <input class="botones" type="button" name="btnExcluir" id="btnExcluir" Value="EXCLUIR" aria-label="Excluir radicado del o los expedientes seleccionados" onClick="excluirExpediente();">
	  </center>
    </td>
	<td width="50%" height="30" colspan="2" class="listado2"><center>
    <input class="botones" type="button" name="Cancelar" id="Cancelar" aria-label="Cerrar ventana" value="CANCELAR" onClick="opener.regresar(); window.close();"></center>  </td>
	</tr>
</table>
</div>
<?php
}
// Solicita confirmación para excluir el radicado del expediente
else if( isset( $_POST['expSeleccionados'] ) && $_POST['expSeleccionados'] != "" )
{
?>
<table border=0 width="93%" align="center" class="borde_tab">
  <tr align="center">
    <td width="33%" height="25" class="listado2" align="center">
      <center class="titulosError2">
        <br>
        <?php print $mensaje; ?>
      </center>
    </td>
  </tr>
</table>
<table border=0 width="93%" align="center" class="borde_tab">
  <tr align="center">
    <td width="33%" height="25" class="listado2" align="center">
	  <center>
	    <input name="btnConfirmar" type="button" onClick="confirmaExcluir();" class="botones_funcion" value="Confirmar" aria-label="Boton para confirmar la exclusion del radicado del expediente seleccionado">
	  </center>
    </td>
	<td width="33%" class="listado2" height="25">
	<center><input name="cerrar" type="button" class="botones_funcion" id="envia22" onClick="opener.regresar(); window.close();" aria-label="Cerrar ventana" value=" Cerrar "></center></TD>
	</tr>
</table>
<?php	
}
?>
</form>
<span class="etexto"><center>
</center></span>
</body>
</html>
