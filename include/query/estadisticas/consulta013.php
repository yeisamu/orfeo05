<?php
/** CONSULTA 011
	* Estadiscas de Numero de Radicados digitalizados y Hojas Digitalizadas.
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
   * $fecha_fin Vaariable que trae la fecha de Fin Seleccionada
   * @var string
   * @access public
   */
/**
   * $mrecCodi Variable que trae el medio de recepcion por el cual va a sacar el detalle de la Consulta.
   * @var string
   * @access public
   */
	if($_REQUEST['dependencia_busq']!='99999') $subconsEs=" WHERE SE.DEPE_CODI='".$_REQUEST['dependencia_busq']."'";
	else $subconsEs="WHERE SE.DEPE_CODI <> '99999'";
 //Skina se agrega validacion por usuario
   if($_REQUEST['usua_doc']!='') $subconsUs="AND  SE.USUA_DOC='".$_REQUEST['usua_doc']."'";
        else $subconsUs="";

$queryE="SELECT B.USUA_NOMB,
		COUNT(*) AS  EXPEDIENTES, 
                B.USUA_CODI as HID_COD_USUARIO,
		SE.DEPE_CODI,B.USUA_DOC, B.USUA_NOMB
         FROM USUARIO B INNER JOIN SGD_SEXP_SECEXPEDIENTES SE ON B.USUA_DOC=SE.USUA_DOC
		 $subconsEs
         GROUP BY SE.DEPE_CODI,B.USUA_DOC, B.USUA_NOMB, B.USUA_CODI";

$queryEDetalle="SELECT distinct SE.SGD_EXP_NUMERO,
                        B.USUA_CODI as HID_COD_USUARIO,
			SRD.SGD_SRD_DESCRIP,
			SBRD.SGD_SBRD_DESCRIP,
			D.DEPE_NOMB,
			FEXP.SGD_FEXP_DESCRIP,
			PEXP.SGD_PEXP_DESCRIP,
			SE.SGD_SEXP_FECH,
  	     		SE.SGD_EXP_FECH_ARCH, 
			B.USUA_NOMB,
			SE.SGD_EXP_PRIVADO
	       FROM SGD_SEXP_SECEXPEDIENTES SE 
		        JOIN USUARIO B ON B.USUA_DOC=SE.USUA_DOC
			JOIN SGD_SRD_SERIESRD SRD ON SE.SGD_SRD_CODIGO=SRD.SGD_SRD_CODIGO
			JOIN SGD_SBRD_SUBSERIERD SBRD ON SE.SGD_SBRD_CODIGO=SBRD.SGD_SBRD_CODIGO AND SE.SGD_SRD_CODIGO=SBRD.SGD_SRD_CODIGO
			JOIN DEPENDENCIA D ON SE.DEPE_CODI=D.DEPE_CODI
			JOIN SGD_PEXP_PROCEXPEDIENTES PEXP ON SE.SGD_PEXP_CODIGO=PEXP.SGD_PEXP_CODIGO
			JOIN SGD_FEXP_FLUJOEXPEDIENTES FEXP ON SE.SGD_PEXP_CODIGO=FEXP.SGD_PEXP_CODIGO AND SE.SGD_FEXP_CODIGO=FEXP.SGD_FEXP_CODIGO
		$subconsEs 
                $subconsUs
                               ";

if(isset($_GET['genDetalle'])&& $_GET['genDetalle']==1)
{ 
	$titulos=array("#","1#EXPEDIENTE","2#SERIE","3#SUBSERIE ","4#FECHA EXPEDIENTE","5#PROCESO","6#ETAPA ACTUAL","7#FECHA ARCHIVADO", "8#USUARIO CREADOR");
}
else
{
	$titulos=array("#","1#USUARIO","2#NUMERO DE EXPEDIENTES");
} 

function pintarEstadistica($fila,$indice,$numColumna)
{
	global $ruta_raiz,$_POST,$_GET;
	$salida="";
	switch ($numColumna)
	{	case  0:
			$salida=$indice;
			break;
		case 1:
			$salida=$fila['USUA_NOMB'];
			break;
		case 2:
			//Modificado skina 090609 $genDetalle=(isset($fila['USUA_NOMB']))?1:0;
			$dependecia=isset($fila['DEPE_CODI'])?$fila['DEPE_CODI']:$_POST['dependencia_busq'];
			$datosEnvioDetalle="tipoEstadistica=".$_REQUEST['tipoEstadistica']."&amp;genDetalle=1&amp;usua_doc=".urlencode($fila['USUA_DOC'])."&amp;dependencia_busq=".$dependecia."&amp;fecha_ini=".$_POST['fecha_ini']."&amp;fecha_fin=".$_POST['fecha_fin']."&amp;tipoRadicado=".$_POST['tipoRadicado']."&amp;tipoDocumento=".$_POST['tipoDocumento']."&amp;codUs=".$fila['HID_COD_USUARIO']."&amp;depeUs=".$fila['HID_DEPE_USUA'];
			$datosEnvioDetalle=(isset($_POST['usActivos']))?$datosEnvioDetalle."&amp;usActivos=".$_POST['usActivos']:$datosEnvioDetalle;
			$salida="<a href=\"genEstadistica.php?{$datosEnvioDetalle}&amp;krd={$krd}\" target=\"detallesSec\" >".$fila['EXPEDIENTES']."</a>";
			break;
		default: $salida=false;
	}
	return $salida;
}

function pintarEstadisticaDetalle($fila,$indice,$numColumna)
{
	global $ruta_raiz,$encabezado,$krd;
	$verImg=($fila['SGD_SPUB_CODIGO']==1)?($fila['USUARIO']!=$_SESSION['usua_nomb']?false:true):($fila['USUA_NIVEL']>$_SESSION['nivelus']?false:true);
	$verImg=$verImg&&($fila['SGD_EXP_PRIVADO']!=1);
	$numRadicado=$fila['RADI_NUME_RADI'];
	switch ($numColumna)
	{
		case 0:
			$salida=$indice;
			break;
		case 1:
			$salida=$salida="<center class=\"leidos\">".$fila['SGD_EXP_NUMERO']."</center>";
			break;
		case 2:                                                
			$salida=$salida="<center class=\"leidos\">".$fila['SGD_SRD_DESCRIP']."</center>";
			break;
		case 3:
                        $salida=$salida="<center class=\"leidos\">".$fila['SGD_SBRD_DESCRIP']."</center>";
                        break;
		case 4:
			$salida="<center class=\"leidos\">".$fila['SGD_SEXP_FECH']."</center>";
			break;
		case 5:
			$salida="<center class=\"leidos\">".$fila['SGD_PEXP_DESCRIP']."</center>";
			break;
		case 6:
			$salida="<center class=\"leidos\">".$fila['SGD_FEXP_DESCRIP']."</center>";
			break;
		case 7:
			$salida="<center class=\"leidos\">".$fila['SGD_EXP_FECH_ARCH']."</center>";
			break;
		 case 8:
                        $salida="<center class=\"leidos\">".$fila['USUA_NOMB']."</center>";
                        break;
	}
	return $salida;
}
?>
