<?
session_start();
$ruta_raiz = "../..";

if(!isset($_SESSION['dependencia']))	include "$ruta_raiz/rec_session.php";

include_once "$ruta_raiz/include/db/ConnectionHandler.php";
include_once("$ruta_raiz/include/combos.php");

if (!$db)	$db = new ConnectionHandler($ruta_raiz);
$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;
//$db->conn->debug=true;

// Si el csv es valido
if ($accion == "PRUEBA"){
	$hora=date("H")."_".date("i")."_".date("s");
	$ddate=date('d');
	$mdate=date('m');
	$adate=date('Y');
	// Fecha formateada
	$fecha=$adate."_".$mdate."_".$ddate;
	// Nombre del CSV
	$arcCsv=$usua_doc."_".$fecha."_".$hora.".csv";
	$arcCsv_sal=$usua_doc."_".$fecha."_".$hora."_sal".".csv";

	if ($archivoCsv_size >= 10000000 ){
		echo "El tama&nacute;o de el archivo CSV no es correcto. <br><br><table><tr><td><li>Se permiten archivos de 100 Kb m&aacute;ximo.</td></tr></table>";
	}else{
		$dirActual = getcwd();
        	if (!copy($archivoCsv, "../../bodega/masiva/".$arcCsv)) {
                	echo "error al copiar CSV: $archivoCsv en ../../bodega/masiva/" .$arcCsv;
                }else{
			//echo "COmienzo a generar el csv";
			$handle = fopen("../../bodega/masiva/".$arcCsv, "r");
			$handle1 = fopen("../../bodega/masiva/".$arcCsv_sal, "w");
			$contenido_csv=array();
			$encabezado_csv = array('*TIPO*','*NOMBRE*','*DIR*','*MUNI_NOMBRE*','*DEPTO_NOMBRE*','*PAIS_NOMBRE*','*NUM_EXPEDIENTE*');
			$contenido_csv[0]=$encabezado_csv;
			while (($data = fgetcsv($handle)) !== FALSE) {
				if ( !isset($flag)){
					$flag=$data[0];
					if ($flag != "*NO_SUSCRIP*"){
						die("El archivo CSV no es correcto, verifique e intentelo de nuevo");
					}
				}
    				if (is_numeric($data[0])){
					//sql para halar datos necesarios
					$sql="SELECT b.nombre_de_la_empresa AS NOMBRE, 
						b.direccion AS DIR, m.muni_nomb AS MUNI, 
						d.dpto_nomb AS DPTO, p.nombre_pais AS PAIS 
						FROM bodega_empresas b 
						LEFT JOIN municipio m ON b.codigo_del_municipio=CAST(m.muni_codi AS VARCHAR(4000)) 
						AND b.codigo_del_departamento = CAST(m.dpto_codi AS VARCHAR(4000)) 
						LEFT JOIN departamento d ON b.codigo_del_departamento=CAST(d.dpto_codi AS VARCHAR(4000)) 
						LEFT JOIN sgd_def_paises p ON b.id_pais=p.id_pais WHERE nit_de_la_empresa='$data[0]'";
					$rs=$db->conn->query($sql);
					// Asignacion de valores
					$tipo_csv      = 0;
					$nombre_csv    = $rs->fields['NOMBRE'];
					$direccion_csv = $rs->fields['DIR'];
					$muni_csv      = $rs->fields['MUNI'];
					$dpto_csv      = $rs->fields['DPTO'];
					$pais_csv      = $rs->fields['PAIS'];

					// Seleccionando numero de expediente automaticamente
					$nombre_exp = "SUSCRIPTOR"."$data[0]";
					$sql_exp = "SELECT sgd_exp_numero AS NUM_EXP FROM sgd_sexp_secexpedientes WHERE sgd_sexp_parexp1='$nombre_exp'";
					
					$rs1=$db->conn->query($sql_exp);
					// Asignacion de valores
					$num_exp_csv = $rs1->fields['NUM_EXP'];

					//verificacion expediente no existente
					if (is_null($rs1->fields['NUM_EXP'])){
						echo "Entre al vacio";
						$num_exp_csv = "<ESPACIO> </ESPACIO>";
					}

					//Almacenando datos en el arreglo
					$contenido_csv[] = array($tipo_csv, $nombre_csv, $direccion_csv, $muni_csv, $dpto_csv, $pais_csv, $num_exp_csv);
					
				}
			}
			fclose($handle);
			// Guardando archivo
			foreach ($contenido_csv as $fields) {
				fputcsv($handle1, $fields, ",");
			}
			fclose($handle1);

			// Imprimiendo caja de resultados
			print<<<END
                        <html>
                        <head>
                        <link rel="stylesheet" href="../../estilos/orfeo.css">
                        </head>
                        <body bgcolor="#FFFFFF" topmargin="0">
                        <script>
                            function enviar_rad(argumento) {

       	                           document.formMensaje.action=argumento;
                                   document.formMensaje.submit();

                            }
                        </script>
                        <body>
                        <center>
                        <form action="upload3.php" name="formMensaje">

 			<table width="49%" border="0" cellspacing="5" class="borde_tab">
		           <tr align="center">
				<td height="25" colspan="2" class="titulos2">
        				RESULTADO DE LA CONSULTA
			   </tr>
                           <tr align="left" >
                                <td height="84" class=listado2 >Se ha generado el archivo CSV con el resultado de la consulta realizada.<BR>
                                <BR>
                                Para obtener el archivo guarde del destino del siguiente v&iacute;nculo
                                al archivo: <a href="../../bodega/masiva/$arcCsv_sal" target="_blank">CSV GENERADO</a>.
				<br><br> Por favor descargue el CSV, verifique y realice su radicacion masiva en forma habitual.<BR>
                                <BR></td>
                           </tr>
		           <tr>
		                <td class="titulos5"><center>
                                <input name="radicar" type="button"  class="botones_mediano" id="envia22"  value="Generar Radicaci&oacute;n"  onClick="enviar_rad('upload2.php')" >
                                </center></td>
                           </tr>
                        </table>
			</body>
			</center>
                        </form>
                        </html>
END;
		
		}
	}	
}else{

/**
 * Retorna la cantidad de bytes de una expresion como 7M, 4G u 8K.
 *
 * @param char $var
 * @return numeric
 */
function return_bytes($val)
{	$val = trim($val);
	$ultimo = strtolower($val{strlen($val)-1});
	switch($ultimo)
	{	// El modificador 'G' se encuentra disponible desde PHP 5.1.0
		case 'g':	$val *= 1024;
		case 'm':	$val *= 1024;
		case 'k':	$val *= 1024;
	}
	return $val;
}
?>
<html>
<head>
<link rel="stylesheet" href="../../estilos/orfeo.css">
</head>
<body bgcolor="#FFFFFF" topmargin="0">
<script language="JavaScript" type="text/JavaScript">

/**
* Valida que se adjunte un CSV
*/
function validar() {

	archCSV = document.formCsvSuscript.archivoCsv.value;

	if ( (archCSV.substring(archCSV.length-1-3,archCSV.length)).indexOf(".csv") == -1 ){
		alert ( "El archivo de datos debe ser .csv" );
		return false;
	}

	if (document.formCsvSuscript.archivoCsv.value.length<1){
		alert ("Debe ingresar el archivo CSV");
		return false;
	}

	return true;
}

function enviar() {

	if (!validar())
		return;

	document.formCsvSuscript.accion.value="PRUEBA";
	document.formCsvSuscript.submit();
}

</script>

<?


$phpsession = session_name()."=".session_id();

$params=$phpsession."&krd=$krd&dependencia=$dependencia&codiTRD=$codiTRD&depe_codi_territorial=$depe_codi_territorial&usua_nomb=$usua_nomb&depe_nomb=$depe_nomb&usua_doc=$usua_doc&tipo=$tipo&codusuario=$codusuario";
?>
<form action="upload3.php?<?=$params?>" method="post" enctype="multipart/form-data" name="formCsvSuscript">
<input type=hidden name=pNodo value='<?=$pNodo?>'>
<input type=hidden name=codProceso value='<?=$codProceso?>'>
<input type=hidden name=tipoRad value='<?=$tipoRad?>'>
<table><tr><td></td></tr></table>
<table width="31%" align="center" border="0" cellpadding="0" cellspacing="5" class="borde_tab">
	<tr align="center">
		<td height="25" colspan="2" class="titulos4">
			ADJUNTAR ARCHIVO BASE # SUSCRIPTOR
			<input type="hidden" name="MAX_FILE_SIZE" value="<?php echo return_bytes(ini_get('upload_max_filesize')); ?>">
			<input name="accion" type="hidden" id="accion">
		</td>
	</tr>
	<tr align="center">
		<td class="titulos2"><label for="archivoCsv">CSV</label></td>
		<td height="30" class="listado2">
			<input name="archivoCsv" type="file" class="tex_area" id=archivoCsv  value='<?=$archivoCsv?>'>
		</td>
	</tr>
	<tr align="center">
		<td height="30" colspan="2" class="celdaGris">
			<span class="celdaGris"> <span class="e_texto1">
			<input name="enviaPrueba" type="button" class="botones" id="envia22" onClick="enviar();" value="Generar CSV"">
        	</span></span>
        </td>
	</tr>
</table>
</form>
<blockquote>
	<p>&nbsp;</p>
	<table width="30%" align="center" border="0" cellpadding="0" cellspacing="5" class="borde_tab">
		<tr align="center">
		<td height="60"  class="listado2_center">EJEMPLO ARCHIVO BASE:
		<a href="../../bodega/masiva/ejemplo_suscript.csv" target="_blank">CSV EJEMPLO</a>.</td>
		</tr>
	</table>
	<p>&nbsp;</p>	
	<table width="100%" align="center" border="0" cellpadding="0" cellspacing="5" class="borde_tab">
		<tr align="center">
		<td height="60"  class="listado2_center"><strong>Nota.
        Asegurese de que el archivo cumpla con las especificaciones dadas para este proposito.</strong>
		</td>
		</tr>
	</table>
	<p>&nbsp;</p>
</blockquote>
</body>
</html>
<?
}
?>
