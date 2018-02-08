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
/** Modulo de Expedientes o Carpetas Virtuales
  * Modificacion Variables
  *@autor Jairo Losada 2009/06
  *Licencia GNU/GPL 
  */
foreach ($_GET as $key => $valor)   ${$key} = $valor;
foreach ($_POST as $key => $valor)   ${$key} = $valor;

$krd = $_SESSION["krd"];
$dependencia = $_SESSION["dependencia"];
$usua_doc = $_SESSION["usua_doc"];
$codusuario = $_SESSION["codusuario"];
$tip3Nombre=$_SESSION["tip3Nombre"];
$tip3desc = $_SESSION["tip3desc"];
$tip3img =$_SESSION["tip3img"];
$tpNumRad = $_SESSION["tpNumRad"];
$tpPerRad = $_SESSION["tpPerRad"];
$tpDescRad = $_SESSION["tpDescRad"];
$tip3Nombre = $_SESSION["tip3Nombre"];
$tpDepeRad = $_SESSION["tpDepeRad"];
$usuaPermExpediente = $_SESSION["usuaPermExpediente"];
$ruta_raiz = ".."; 	

if ( !$nurad )
{
    $nurad = $rad;
}

include_once( "$ruta_raiz/include/db/ConnectionHandler.php" );
$db = new ConnectionHandler( "$ruta_raiz" );
//$db->conn->debug = true;
include_once( "$ruta_raiz/include/tx/Historico.php" );
include_once( "$ruta_raiz/include/tx/Expediente.php" );

$encabezado = "$PHP_SELF?".session_name()."=".session_id()."&opcionExp=$opcionExp&numeroExpediente=$numeroExpediente&nurad=$nurad&coddepe=$coddepe&codusua=$codusua&depende=$depende&ent=$ent&tdoc=$tdoc&codiTRDModi=$codiTRDModi&codiTRDEli=$codiTRDEli&codserie=$codserie&tsub=$tsub&ind_ProcAnex=$ind_ProcAnex";
$expediente = new Expediente( $db );

// Inserta el radicado en el expediente
if( $funExpediente == "INSERT_EXP" )
{   
    // Consulta si el radicado est� incluido en el expediente.
    $arrExpedientes = $expediente->expedientesRadicado( $nurad);
    /* Si el radicado esta incluido en el expediente digitado por el usuario.
     * != No identico no se puede poner !== por que la funcion array_search 
     * tambien arroja 0 o "" vacio al ver que un expediente no se encuentra
     */ 
	 $arrExpedientes[] = "1";
    foreach ( $arrExpedientes as $line_num => $line){
    	if ($line == $_POST['numeroExpediente']) {
    		  print '<center><hr><font color="red">El radicado ya est&aacute; incluido en el expediente.</font><hr></center>';
    	}else {
    		  $resultadoExp = $expediente->insertar_expediente( $_POST['numeroExpediente'], $_GET['nurad'], $dependencia, $codusuario, $usua_doc );
        if( $resultadoExp == 1 )
        {
            $observa = "Incluir radicado en Expediente";
            include_once "$ruta_raiz/include/tx/Historico.php";
            $radicados[] = $_GET['nurad'];
            $tipoTx = 53;
            $Historico = new Historico( $db );
            $Historico->insertarHistoricoExp( $_POST['numeroExpediente'], $radicados, $dependencia, $codusuario, $observa, $tipoTx, 0 );
            
            ?>
            <script language="JavaScript">	
               window.opener.location.reload();
               window.close();
            </script>  
            <?php
        }
        else
        {
            print '<hr><font color=red>No se anexo este radicado al expediente. Verifique que el numero del expediente exista e intente de nuevo.</font><hr>';	    
        }
    	}
    }
   
      
    
}
?>
<html>
<head>
<title>Incluir en Expediente</title>
<link href="../estilos/orfeo.css" rel="stylesheet" type="text/css">
<script language="JavaScript">
function validarNumExpediente()
{
    numExpediente = document.getElementById( 'numeroExpediente' ).value;
	
    // Valida que se haya digitado el nombre del expediente
    // a�o dependencia serie subserie consecutivo E
    if( numExpediente.length != 0 && numExpediente != "" )
    {
        insertarExpedienteVal = true;
    }
    else if( numExpediente.length == 0 || numExpediente == "" )
    {
        alert( "Error. Debe especificar el nombre de un expediente." );
        document.getElementById( 'numeroExpediente' ).focus();
        insertarExpedienteVal = false;
    }
    
    if( insertarExpedienteVal == true )
	{
        document.insExp.submit();
	}
}

function confirmaIncluir()
{
    document.getElementById( 'funExpediente' ).value = "INSERT_EXP";
    document.insExp.submit();
}
</script>
</head>
<body bgcolor="#FFFFFF" onLoad="document.insExp.numeroExpediente.focus();">
<form method="post" action="<?php print $encabezado; ?>" name="insExp">
<input type="hidden" name='funExpediente' id='funExpediente' value="" >
<input type="hidden" name='confirmaIncluirExp' id='confirmaIncluirExp' value="" >
  <table border=0 width=70% align="center" class="borde_tab" cellspacing="1" cellpadding="0">        
    <tr align="center" class="titulos2">
      <td height="15" class="titulos2" colspan="2">INCLUIR EN  EL EXPEDIENTE</td>
    </tr>
  </table>
<table width="70%" border="0" cellspacing="1" cellpadding="0" align="center" class="borde_tab">

</table>
<table border=0 width=70% align="center" class="borde_tab">
      <tr align="center">
      <td class="titulos5" align="left" nowrap>
  Nombre del Expediente </td>
      <td class="titulos5" align="left">
        <input type="text" name="numeroExpediente" id="numeroExpediente" value="<?php print $_POST['numeroExpediente']; ?>" aria-label="Digite nombre del expediente, muevase entre los resultados con las flechas arriba y abajo" size="30">
      </td>
    </tr>
</table>
<table border=0 width=70% align="center" class="borde_tab">
	<tr align="center">

	<td width="33%" height="25" class="listado2" align="center">
	<center>
	  <input name="btnIncluirExp" type="button" class="botones_funcion" id="btnIncluirExp" onClick="validarNumExpediente();" value="Incluir en Exp" aria-label="Incluir radicados en expediente">
		</center></TD>
	<td width="33%" class="listado2" height="25">
	<center><input name="btnCerrar" type="button" class="botones_funcion" id="btnCerrar" onClick="window.opener.location.reload(); window.close();" value=" Cerrar " aria-label="Cerrar Ventana"></center></TD>
	</tr>
</table>
<?
// Consulta si existe o no el expediente.
if ( $expediente->existeExpediente( $_POST['numeroExpediente'] ) !== 0 )
{
?>
<table border=0 width=70% align="center" class="borde_tab">
  <tr align="center">
    <td width="33%" height="25" class="listado2" align="center">
      <center class="titulosError2">
        ESTA SEGURO DE INCLUIR ESTE RADICADO EN EL EXPEDIENTE: 
      </center>
      <B>
        <center class="style1"><b><?php print $numeroExpediente; ?></b></center>
      </B>
      <div align="justify"><br>
        <strong><b>Recuerde:</b>No podr&aacute; modificar el numero de expediente si hay
        un error en el expediente, m&aacute;s adelante tendr&aacute; que excluir este radicado del
        expediente y si es el caso solicitar la anulaci&oacute;n del mismo. Adem&aacute;s debe
        tener en cuenta que tan pronto coloca un nombre de expediente, en Archivo crean
        una carpeta f&iacute;sica en el cual empezaran a incluir los documentos
        pertenecientes al mismo.
        </strong>
      </div>
    </td>
  </tr>
</table>
<table border=0 width=70% align="center" class="borde_tab">
  <tr align="center">
    <td width="33%" height="25" class="listado2" align="center">
	  <center>
	    <input name="btnConfirmar" type="button" onClick="confirmaIncluir();" class="botones_funcion" value="Confirmar">
	  </center>
    </td>
	<td width="33%" class="listado2" height="25">
	<center><input name="cerrar" type="button" class="botones_funcion" id="envia22" onClick="window.opener.location.reload(); window.close();" value=" Cerrar "></center></TD>
	</tr>
</table>
<?	
}
else if ( $_POST['numeroExpediente'] != "" && ( $expediente->existeExpediente( $_POST['numeroExpediente'] ) === 0 ) )
{
    ?>
    <script language="JavaScript">
      alert( "Error. El nombre del Expediente en el que desea incluir este radicado \n\r no existe en el sistema. Por favor verifique e intente de nuevo." );
      document.getElementById( 'numeroExpediente' ).focus();
    </script>
    <?php
}
?>
</form>
</body>
</html>
