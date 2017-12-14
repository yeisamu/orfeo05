<?php
/********************************************************************************/
/*DESCRIPCION: Funciones para visualizar los registros correpondientes a los         */
/*					  archivados.																*/
/*FECHA: 17 de Agosto de 2007																*/
/*AUTOR: Secretaría de Gobierno Distrital												*/
/*********************************************************************************/
function pintarEstadistica($fila,$indice,$numColumna)
{
	global $ruta_raiz,$_POST,$_GET;
	$salida="";
	switch ($numColumna){
		case  0:
			$salida=$fila['USUARIO'];
			break;
		case 1:	
			$salida=$fila['NUMERO_FOLIOS'];
			break;
		case 2:
			//$salida=$fila['Radicados'];
			//$datosEnvioDetalle="tipoEstadistica=".$_POST['tipoEstadistica']."&amp;genDetalle=1&amp;usua_doc=".urlencode($fila['HID_USUA_DOC'])."&amp;dependencia_busq=".$_POST['dependencia_busq']."&amp;fecha_ini=".$_POST['fecha_ini']."&amp;fecha_fin=".$_POST['fecha_fin']."&amp;tipoRadicado=".$_POST['tipoRadicado']."&amp;tipoDocumento=".$_POST['tipoDocumento']."&amp;codUs=".$fila['HID_COD_USUARIO'];
			$datosEnvioDetalle="tipoReporte=1&amp;genDetalle=1&amp;usua_doc=".urlencode($fila['HID_USUA_DOC'])."&amp;dependencia_busq=".$_POST['dependencia_busq']."&amp;fechaIni=".$_POST['fechaIni']."&amp;fechaInif=".$_POST['fechaInif']."&amp;trad=".$_POST['trad']."&amp;tipoDocumento=".$_POST['tipoDocumento']."&amp;codUs=".$fila['HID_COD_USUARIO']."&amp;arch=".$_POST['arch'];
			$datosEnvioDetalle=(isset($_POST['usActivos']))?$datosEnvioDetalle."&amp;usActivos=".$_POST['usActivos']:$datosEnvioDetalle;
			$salida="<a href=\"../estadisticas/genEstadistica.php?{$datosEnvioDetalle}\"  target=\"detallesSec\" aria-label=\"Abrir el reporte detallado de los radicados encontrados para este usuario\" >".$fila['RADICADOS']."</a>";
			break;
	default: $salida=false;
	}
	return $salida;
}

function pintarEstadisticaDetalle($fila,$indice,$numColumna)
{
	global $ruta_raiz,$encabezado,$krd;
	$verImg=($fila['SGD_SPUB_CODIGO']==1)?($fila['USUARIO']!=$_SESSION['usua_nomb']?false:true):($fila['USUA_NIVEL']>$_SESSION['nivelus']?false:true);
	$numRadicado=$fila['RADICADO'];	
	switch ($numColumna){
			case 0:
				//$salida=$indice;
				if($fila['HID_RADI_PATH'] && $verImg)
					$salida="<center><a href=\"{$ruta_raiz}bodega".$fila['HID_RADI_PATH']."\" aria-label=\"Abrir Documentos del radicado\">".$fila['RADICADO']."</a></center>";
				else 
					$salida="<center class=\"leidos\">{$numRadicado}</center>";
				break;
			case 1:
				if( $_GET['arch'] != 1 )
				{
					if( $verImg)
					{
						$salida="<a class=\"vinculos\" href=\"{$ruta_raiz}verradicado.php?verrad=".$fila['RADICADO']."&amp;".session_name()."=".session_id()."&amp;carpeta=8&amp;nomcarpeta=Busquedas&amp;tipo_carp=0 \" aria-label=\"Abrir información del radicado\" >".$fila['FECHA_RADICACION']."</a>";
					}
					else 
					{
						$salida="<a class=\"vinculos\" href=\"#\" onclick=\"alert(\"ud no tiene permisos para ver el radicado\");\" aria-label=\"Abrir informacion del radicado\">".$fila['FECHA_RADICACION']."</a>";
					}
				}
				else
				{
					$salida = "<center class=\"leidos\">".$fila['FECHA_RADICACION']."</center>";
				}
				break;
			case 2:
				if( $_GET['arch'] != 1 )
				{
					$salida="<a class=\"vinculos\" href=\"{$ruta_raiz}archivo/datos_expediente.php?".session_name()."=".session_id()."&amp;krd=".$_GET['krd']."&amp;nomcarpeta=Expedientes&amp;num_expediente=".$fila['EXPEDIENTE']."&amp;ent=1&amp;nurad=".$fila['RADICADO']."\">".$fila['FECHA_ARCHIVO']."</a>";	
				}
				else
				{
					$salida = "<center class=\"leidos\">".$fila['FECHA_ARCHIVO']."</center>";;	
				}
				break;
			case 3:
				$salida="<center class=\"leidos\">".$fila['USUARIO']."</center>";		
				break;
			case 4:
				$salida="<center class=\"leidos\">".$fila['DEPENDENCIA']."</center>";
				break;
			case 5:
				$salida="<center class=\"leidos\">".$fila['NUMERO_FOLIOS']."</center>";
				break;
	}
	return $salida;
}
?>
