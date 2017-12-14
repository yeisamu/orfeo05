<?
/** CONSUTLA 001 
	* Estadiscas por medio de recepcion Entrada
	* @autor JAIRO H LOSADA - SSPD
	* @version ORFEO 3.1
	* 
	*/
$coltp3Esp = '"'.$tip3Nombre[3][2].'"';	
if(!$orno) $orno=2;
 /**
   * $db-driver Variable que trae el driver seleccionado en la conexion
   * @var string
   * @access public
   */
 /**
   * $fecha_ini Variable que trae la fecha de Inicio Seleccionada  viene en formato Y-m-d
   * @var string
   * @access public
   */
/**
   * $fecha_fin Variable que trae la fecha de Fin Seleccionada
   * @var string
   * @access public
   */
/**
   * $mrecCodi Variable que trae el medio de recepcion por el cual va a sacar el detalle de la Consulta.
   * @var string
   * @access public
   */
switch($db->driver)
{	case 'mssql':
	case 'postgres':
		{	if ( $dependencia_busq != 99999)
			{
			$condicionE = "	AND substr(cast(r.radi_nume_radi as varchar(15)),5,$longitud_codigo_dependencia)=cast($dependencia_busq as varchar(15)) AND b.depe_codi = '$dependencia_busq'";	
			}else {
				$condicionE = "	AND r.radi_depe_radi=b.depe_codi";	
			}
			$queryE = "SELECT c.mrec_desc AS MEDIO_RECEPCION, COUNT(*) AS Radicados, max(c.MREC_CODI) AS HID_MREC_CODI
					FROM RADICADO r, MEDIO_RECEPCION c, USUARIO b
					WHERE 
						r.radi_usua_radi=b.usua_CODI 
						AND r.mrec_codi=c.mrec_codi
						$condicionE
						AND ".$db->conn->SQLDate('Y/m/d', 'r.radi_fech_radi')." BETWEEN '$fecha_ini' AND '$fecha_fin'
						$whereTipoRadicado
						$whereUsuario
					GROUP BY c.mrec_desc
					ORDER BY $orno $ascdesc";	
 			/** CONSULTA PARA VER DETALLES 
	 		*/
  			$condicionDep = " AND b.depe_codi = '$depeUs' ";

			$queryEDetalle = "SELECT $radi_nume_radi AS RADICADO, 
						".$db->conn->SQLDate('Y/m/d h:i:s','r.radi_fech_radi')."  AS FECHA_RADICADO
						,c.MREC_DESC 	AS MEDIO_RECEPCION
						,r.RA_ASUN 	AS ASUNTO
						,b.usua_nomb 	AS USUARIO
						,r.radi_nume_hoja as N_HOJAS
						,r.radi_desc_anex as ANEXOS
						,r.RADI_PATH 	AS HID_RADI_PATH{$seguridad}
					FROM RADICADO r, USUARIO b, MEDIO_RECEPCION c
					WHERE 
						r.radi_usua_radi=b.usua_CODI 
						AND r.mrec_codi=c.mrec_codi
						AND c.mrec_codi=$mrecCodi
						$condicionE
						AND ".$db->conn->SQLDate('Y/m/d', 'r.radi_fech_radi')." BETWEEN '$fecha_ini'  AND '$fecha_fin'
						$whereTipoRadicado";			

					$orderE = "	ORDER BY $orno $ascdesc";			

		 	/** CONSULTA PARA VER TODOS LOS DETALLES 
	 		*/ 

			$queryETodosDetalle = $queryEDetalle . $condicionDep . $orderE;
			$queryEDetalle .=  $orderE;
		}break;
	//case 'oracle':
	//case 'ocipo':
	case 'oci8':
	case 'oci805':
		{	if ( $dependencia_busq != 99999)
			{	$condicionE = "	AND substr(r.radi_nume_radi,5,$longitud_codigo_dependencia)='$dependencia_busq' AND b.depe_codi = '$dependencia_busq'";	}
			$queryE = "SELECT c.mrec_desc MEDIO_RECEPCION, COUNT(*) Radicados, max(c.MREC_CODI) HID_MREC_CODI
					FROM RADICADO r, MEDIO_RECEPCION c, USUARIO b
					WHERE 
						r.radi_usua_radi=b.usua_CODI 
						AND r.mrec_codi=c.mrec_codi
						$condicionE
						AND TO_CHAR(r.radi_fech_radi,'yyyy/mm/dd') BETWEEN '$fecha_ini'  AND '$fecha_fin'
						$whereTipoRadicado
						$whereUsuario
					GROUP BY c.mrec_desc
					ORDER BY $orno $ascdesc";	
 			/** CONSULTA PARA VER DETALLES 
	 		*/
  			$condicionDep = " AND b.depe_codi = '$depeUs' ";

			$queryEDetalle = "SELECT r.RADI_NUME_RADI RADICADO
						,TO_CHAR(r.radi_fech_radi,'yyyy/mm/dd hh:mi:ss') FECHA_RADICADO
						,c.MREC_DESC MEDIO_RECEPCION
						,r.RA_ASUN ASUNTO
						,b.usua_nomb USUARIO
						,r.RADI_PATH HID_RADI_PATH{$seguridad}
					FROM RADICADO r, USUARIO b, MEDIO_RECEPCION c
					WHERE 
						r.radi_usua_radi=b.usua_CODI 
						AND r.mrec_codi=c.mrec_codi
						AND c.mrec_codi=$mrecCodi
						$condicionE
						AND TO_CHAR(r.radi_fech_radi,'yyyy/mm/dd') BETWEEN '$fecha_ini'  AND '$fecha_fin'
						$whereTipoRadicado";			

					$orderE = "	ORDER BY $orno $ascdesc";			

		 	/** CONSULTA PARA VER TODOS LOS DETALLES 
	 		*/ 

			$queryETodosDetalle = $queryEDetalle . $condicionDep . $orderE;
			$queryEDetalle .=  $orderE;
		}break;
}
if(isset($_GET['genDetalle'])&& $_GET['denDetalle']=1)
	$titulos=array("#","1#RADICADO","2#FECHA RADICADO","3#ASUNTO","4#ANEXOS","5#NO HOJAS","6#MEDIO DE RECEPCION","7#USUARIO");
else 		
	$titulos=array("#","1#MEDIO","2#RADICADOS");
		
function pintarEstadistica($fila,$indice,$numColumna)
{
	global $ruta_raiz,$_POST,$_GET,$krd;
	$salida="";
	switch ($numColumna)
	{
		case  0:
			$salida=$indice;
			break;
		case 1:
			$salida=$fila['MEDIO_RECEPCION'];
			break;
		case 2:
			$datosEnvioDetalle="tipoEstadistica=".$_POST['tipoEstadistica']."&amp;genDetalle=1&amp;usua_doc=".urlencode($fila['HID_USUA_DOC'])."&amp;dependencia_busq=".$_POST['dependencia_busq']."&amp;fecha_ini=".$_POST['fecha_ini']."&amp;fecha_fin=".$_POST['fecha_fin']."&amp;tipoRadicado=".$_POST['tipoRadicado']."&amp;tipoDocumento=".$_POST['tipoDocumento']."&amp;mrecCodi=".$fila['HID_MREC_CODI'];
			$datosEnvioDetalle=(isset($_POST['usActivos']))?$datosEnvioDetalle."&amp;usActivos=".$_POST['usActivos']:$datosEnvioDetalle;
			$salida="<a href=\"genEstadistica.php?{$datosEnvioDetalle}&amp;krd={$krd}\"  target=\"detallesSec\" >".$fila['RADICADOS']."</a>";
			break;
		default: $salida=false;
	}
	return $salida;
}

function pintarEstadisticaDetalle($fila,$indice,$numColumna){
			global $ruta_raiz,$encabezado,$krd;
			$verImg=($fila['SGD_SPUB_CODIGO']==1)?($fila['USUARIO']!=$_SESSION['usua_nomb']?false:true):($fila['USUA_NIVEL']>$_SESSION['nivelus']?false:true);
        	$numRadicado=$fila['RADICADO'];	
			switch ($numColumna){
					case 0:
						$salida=$indice;
						break;
					case 1:
						if($fila['HID_RADI_PATH'] && $verImg)
							$salida="<center><a href=\"{$ruta_raiz}bodega".$fila['RADI_PATH']."\">".$fila['RADICADO']."</a></center>";
						else 
							$salida="<center class=\"leidos\">{$numRadicado}</center>";	
						break;
					case 2:
						if($verImg)
		   					$salida="<a class=\"vinculos\" href=\"{$ruta_raiz}verradicado.php?verrad=".$fila['RADICADO']."&amp;".session_name()."=".session_id()."&amp;krd=".$_GET['krd']."&amp;carpeta=8&amp;nomcarpeta=Busquedas&amp;tipo_carp=0 \" >".$fila['FECHA_RADICADO']."</a>";
		   				else 
		   				$salida="<a class=\"vinculos\" href=\"#\" onclick=\"alert(\"ud no tiene permisos para ver el radicado\");\">".$fila['RADI_FECH_RADI']."</a>";
						break;
					case 3:
						$salida="<center class=\"leidos\">".$fila['ASUNTO']."</center>";
						break;
					case 4:
						$salida="<center class=\"leidos\">".$fila['ANEXOS']."</center>";
						break;
					case 5:
						$salida="<center class=\"leidos\">".$fila['N_HOJAS']."</center>";			
						break;	
					case 6:
						$salida="<center class=\"leidos\">".$fila['MEDIO_RECEPCION']."</center>";			
						break;	
					case 7:
						$salida="<center class=\"leidos\">".$fila['USUARIO']."</center>";			
						break;	
			}
			return $salida;
		}

?>
