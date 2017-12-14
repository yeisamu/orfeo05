<?php
/********************************************************************************/
/*DESCRIPCION: Reporte que muestra los radicados archivados                     */
/*FECHA: 15 Diciembre de 2006*/
/*AUTOR: Supersolidaria*/
/*********************************************************************************/
?>
<?php
$krdOld = $krd;
$per=1;
session_start();

if(!$krd) $krd = $krdOld;
if (!$ruta_raiz) $ruta_raiz = "..";
//include "$ruta_raiz/rec_session.php";
include_once("$ruta_raiz/include/db/ConnectionHandler.php");
// Modificado SGD 22-Agosto-2007
require( "./funReporteArchivo.php" );
$db = new ConnectionHandler("$ruta_raiz");

if( trim( $orderTipo ) == "" )
{
    $orderTipo="DESC";
}
if( $orden_cambio == 1 )
{
    if( trim( $orderTipo ) != "DESC" )
    {
       $orderTipo = "DESC";
    }
    else
    {
        $orderTipo = "ASC";
    }
}

if( strlen( $orderNo ) == 0 )
{
    $orderNo = "2";
    $order = 3;
}
else
{
    $order = $orderNo +1;
}

$encabezado = "".session_name()."=".session_id()."&krd=$krd&dep_sel=$dep_sel&codigoUsuario=$codigoUsuario&filtroSelect=$filtroSelect&tpAnulacion=$tpAnulacion&carpeta=$carpeta&tipo_carp=$tipo_carp&chkCarpeta=$chkCarpeta&busqRadicados=$busqRadicados&nomcarpeta=$nomcarpeta&agendado=$agendado&";
$linkPagina = "$PHP_SELF?$encabezado&orderTipo=$orderTipo&orderNo=$orderNo";

if( $_GET['fechaIniSel'] == "" && $_GET['fechaInifSel'] == "" )
{
	// Modificado SGD 21-Agosto-2007
	//$encabezado = "".session_name()."=".session_id()."&fechaIniSel=".$_POST['fechaIni']."&fechaInifSel=".$_POST['fechaInif']."&adodb_next_page=1&krd=$krd&depeBuscada=$dep_sel&codigoUsuario=$codigoUsuario&filtroSelect=$filtroSelect&tpAnulacion=$tpAnulacion&carpeta=$carpeta&tipo_carp=$tipo_carp&nomcarpeta=$nomcarpeta&agendado=$agendado&orderTipo=$orderTipo&orderNo=";
	$encabezado = "".session_name()."=".session_id()."&fechaIniSel=".$_POST['fechaIni']."&fechaInifSel=".$_POST['fechaInif']."&adodb_next_page=0&krd=$krd&depeBuscada=$dep_sel&codigoUsuario=$codigoUsuario&filtroSelect=$filtroSelect&tpAnulacion=$tpAnulacion&carpeta=$carpeta&tipo_carp=$tipo_carp&nomcarpeta=$nomcarpeta&agendado=$agendado&orderTipo=$orderTipo&orderNo=";
}
else
{
    // Modificado SGD 21-Agosto-2007
	//$encabezado = "".session_name()."=".session_id()."&fechaIniSel=".$_GET['fechaIniSel']."&fechaInifSel=".$_GET['fechaInifSel']."&adodb_next_page=1&krd=$krd&depeBuscada=$dep_sel&codigoUsuario=$codigoUsuario&filtroSelect=$filtroSelect&tpAnulacion=$tpAnulacion&carpeta=$carpeta&tipo_carp=$tipo_carp&nomcarpeta=$nomcarpeta&agendado=$agendado&orderTipo=$orderTipo&orderNo=";
    $encabezado = "".session_name()."=".session_id()."&fechaIniSel=".$_GET['fechaIniSel']."&fechaInifSel=".$_GET['fechaInifSel']."&adodb_next_page=0&krd=$krd&depeBuscada=$dep_sel&codigoUsuario=$codigoUsuario&filtroSelect=$filtroSelect&tpAnulacion=$tpAnulacion&carpeta=$carpeta&tipo_carp=$tipo_carp&nomcarpeta=$nomcarpeta&agendado=$agendado&orderTipo=$orderTipo&orderNo=";
}
?>
<html>
<head>
<title>REPORTE DE RADICADOS ARCHIVADOS</title>
<link rel="stylesheet" href="../estilos/orfeo.css">
<CENTER>
<body bgcolor="#FFFFFF">
<div id="spiffycalendar" class="text"></div>
 <link rel="stylesheet" type="text/css" href="../js/spiffyCal/spiffyCal_v2_1.css">
 <script language="JavaScript" src="../js/spiffyCal/spiffyCal_v2_1.js">
 </script><style type="text/css">
<!--
.style1 {font-size: 14px}
-->
</style>

<form name="reporte_archivo" action='<?=$_SERVER['PHP_SELF']?>?<?=$encabezado?>' method="post">
<table border="0" width="90%" cellpadding="0"  class="borde_tab">
<tr>
  <TD height="35" colspan="2" class="titulos2"><center>
    REPORTE DE RADICADOS ARCHIVADOS
      </div></td>
  </tr>
<tr>
  <TD height="30" class="titulos5">
  <?
        if(!$dep_sel) $dep_sel = 0;
        $fechah=date("dmy") . " ". time("h_m_s");
	$fecha_hoy = Date("Y-m-d");
	$sqlFechaHoy=$db->conn->DBDate($fecha_hoy);
	$check=1;
	$fechaf=date("dmy") . "_" . time("hms");
        $numeroa=0;$numero=0;$numeros=0;$numerot=0;$numerop=0;$numeroh=0;
        
        include("$ruta_raiz/include/query/expediente/queryReporte.php");
//modificado skina conversion de variables
	$queryUs = "select depe_codi from usuario where cast(USUA_LOGIN as varchar(50))='$krd' AND cast(USUA_ESTA as numeric(10))=1";
	//$queryUs = "select depe_codi from usuario where USUA_LOGIN='$krd' AND USUA_ESTA=1";
//$db->conn->debug=true;
	$rsUs = $db->query($queryUs);
	$depe = $rsUs->fields["DEPE_CODI"];
	if ($dependencia_busq != 99999)  {
			$whereDependencia = " AND DEPE_CODI=$depe";
		}
?>
  <div align="right"><b><label for="dep_sel">Dependencia que Archiva</label> </b></div></td>
  <TD class="titulos5">
  <?
  error_reporting(0);
  $query2="SELECT DISTINCT D.DEPE_NOMB, D.DEPE_CODI FROM DEPENDENCIA D, USUARIO U WHERE D.DEPE_CODI=U.DEPE_CODI AND U.USUA_ADMIN_ARCHIVO >= 1 ORDER BY D.DEPE_NOMB";
  $rs1=$db->conn->query($query2);
  print $rs1->GetMenu2('dep_sel',$_POST['dep_sel'],"0:--- TODAS LAS DEPENDENCIAS ---",false,"","  class=select onChange='submit();' id='dep_sel' title='Buscar por dependencia que archiva'");
  ?>
 </td>
<tr>
  <TD height="23" class="titulos5"><div align="right"><label for="trad">Tipo de Radicado</label></div></td>
  <TD class="titulos5">
  <?
	$sql="select sgd_trad_descr,sgd_trad_codigo from sgd_trad_tiporad order by sgd_trad_codigo";
	$rs=$db->query($sql);
	print $rs->GetMenu2("trad", $_POST['trad'], "0:-- Seleccione --", false,"","class='select' id='trad' title='Buscar por tipo de radicado'" );
  ?>
  </td>
<tr>
  <TD height="26" class="titulos5"><div align="right"><label for="codigoUsuario">Usuario que Archiva</label> </div></td>
  <TD class="titulos5"><select name="codigoUsuario" class="select" onChange="formulario.submit();" id="codigoUsuario" title="Buscar por usuario que archiva">
     <option value=0> -- AGRUPAR POR TODOS LOS USUARIOS --</option>
    <?php
		$whereUsSelect = "";
		if(!$usActivos)
		{
//skina
                  $whereUsua = " cast(u.USUA_ESTA as numeric(10)) = 1 ";
		  $whereUsSelect = " AND cast(u.USUA_ESTA as numeric(10)) = 1 ";
		  $whereActivos = " AND cast(b.USUA_ESTA as numeric(10))=1";

		}
 	        if ($_POST['dep_sel'] != "")
		{
//skina
			$isqlus = "SELECT u.USUA_NOMB,u.USUA_CODI FROM USUARIO u, DEPENDENCIA D WHERE cast(u.USUA_ESTA as numeric(10)) = 1 AND D.DEPE_CODI=U.DEPE_CODI AND U.DEPE_CODI='".$_POST['dep_sel']."' ORDER BY u.USUA_NOMB";
			$rs1=$db->query($isqlus);
			while(!$rs1->EOF)
			{
                if( $_POST['codigoUsuario'] == $rs1->fields["USUA_CODI"] )
                {
                    $selected = "selected";
                }
                else
                {
                    $selected = "";
                }
                
				$codigoUsuario = $rs1->fields["USUA_CODI"];
				$vecDeps[]=$codigo;
				$usNombre = $rs1->fields["USUA_NOMB"];
				print "<option value='".$codigoUsuario."' ".$selected.">$usNombre</option>";
				$rs1->MoveNext();
			}
		}
		?>
  </select></td>
<?php
/* Modificado Supersolidaria 05-Dic-2006
 * El rango inicial de fechas se estableci� en 1 mes.
 */
// Fecha inicial
if( $_GET['fechaIniSel'] == "" && $_POST['fechaIni'] == "" )
{
    $fechaIni = date( 'Y-m-d', strtotime( "-1 month" ) );
}
else if( $_POST['fechaIni'] != "" )
{
    $fechaIni = $_POST['fechaIni'];
}
else if(  $_GET['fechaIniSel'] != "" )
{
    $fechaIni = $_GET['fechaIniSel'];
}
// Fecha final
if( $_GET['fechaInifSel'] == "" && $_POST['fechaInif'] == "" )
{
    $fechaInif = date( 'Y-m-d' );
}
else if( $_POST['fechaInif'] != "" )
{
    $fechaInif = $_POST['fechaInif'];
}
else if( $_GET['fechaInifSel'] != "" )
{
    $fechaInif = $_GET['fechaInifSel'];
}
?>
<tr>
  <TD height="23" class="titulos5"><div align="right">
    <div align="right"><label for="fechaIni">Fecha inicial de Archivados</label>
    </div></td>
  <TD class="titulos5">
	<script language="javascript">
   	var dateAvailable1 = new ctlSpiffyCalendarBox("dateAvailable1", "reporte_archivo", "fechaIni","btnDate1","<?=$fechaIni?>",scBTNMODE_CUSTOMBLUE);
  				dateAvailable1.date = "<?=date('Y-m-d');?>";
				dateAvailable1.writeControl();
				dateAvailable1.dateFormat="yyyy-MM-dd";
	</script>

  </td>
<tr>
  <TD width="202" height="24" class="titulos5">&nbsp;
    <div align="right"><label for="fechaInif">Fecha final de Archivados</label></div></td>
  <TD width="323" class="titulos5">
  	<script language="javascript">
	var dateAvailable2 = new ctlSpiffyCalendarBox("dateAvailable2", "reporte_archivo", "fechaInif","btnDate2","<?=$fechaInif?>",scBTNMODE_CUSTOMBLUE);
  				dateAvailable2.date = "<?=date('Y-m-d');?>";
				dateAvailable2.writeControl();
				dateAvailable2.dateFormat="yyyy-MM-dd";
	</script>
</td>
<tr>
<TD width="202" height="24" class="titulos5">&nbsp;
    <div align="right"><label for="arch">Busqueda Archivo Central</label></div></td>
<TD width="323" class="titulos5">
<?
if($arch==1)$set="checked";
?>
<input type="checkbox" id="arch" name="arch" value="1" <?=$set?> title="Active esta casilla para buscar en el archivo central">
</td>
</tr>
<tr>
	<td align="center" colspan="3" class="titulos5"><input type="submit" class="botones" value="Buscar" name="Buscar" aria-label="Buscar radicados archivados con criterios ingresados">
	  <a href='archivo.php?<?=session_name()?>=<?=trim(session_id())?>krd=<?=$krd?>'><input type="button" class="botones" value="Cancelar" name="Cancelar" aria-label="salir sin hacer nada"></td>
</tr>
</table>
<p>&nbsp;</p>
<!-- Modificado SGD 22-Agosto-2007 --> 
</form>
<?
if($Buscar)
{
	include_once( "$ruta_raiz/include/query/archivo/queryReportePorRadicados.php" );
	// Modificado SGD 17-Agosto-2007	
	$queryE = $queryUs;
	//if($genDetalle==1) $queryUs = $queryEDetalle;
	if($genDetalle==1)
	{
		echo  $queryUs = $queryEDetalle;
		echo $queryE = $queryEDetalle;
	}
	//if($genTodosDetalle==1) $queryUs = $queryETodosDetalle;
	if($genTodosDetalle==1)
	{
		$queryUs = $queryETodosDetalle;
		$queryE = $queryETodosDetalle;
	}
   $reporte = 1;
   //$db->conn->debug=true;
   $rsE = $db->conn->Execute($queryUs);
   
	// Modificado SGD 17-Agosto-2007
	$titulos=array("1#USUARIO","2#NUMERO FOLIOS","3#RADICADOS");
   
   include "../estadisticas/tablaHtml.php";
}
$db->conn->Close();
?>
<p>&nbsp;</p>
</form>
</CENTER>
</CENTER>
</html>
