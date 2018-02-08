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
$ruta_raiz = "..";
include_once "$ruta_raiz/include/db/ConnectionHandler.php";

if(!isset($_SESSION['dependencia']))
	include "$ruta_raiz/rec_session.php";

(!$db) ? $conexion = new ConnectionHandler($ruta_raiz) : $conexion = $db;
//$conexion->conn->debug = true;
$conexion->conn->SetFetchMode(ADODB_FETCH_ASSOC);

//Función que calcula el tiempo transcurrido
function microtime_float()
{
   list($usec, $sec) = explode(" ", microtime());
   return ((float)$usec + (float)$sec);
}

?>
<html>
<head>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<link rel="stylesheet" href="../estilos/orfeo.css">
<script>
</script>
</head>
<body>

<?php
$time_start = microtime_float();

if ( $_POST['cancel']== "Cancelar" ) {
	
}

if ( $_POST['accept']== "Confirmar" ) {
	$status = $conexion->conn->CompleteTrans();
    echo "La transaccion se realizo de forma satisfactoria". $status;
	exit(0);
}

$hora=date("H")."_".date("i")."_".date("s");
// var que almacena el dia de la fecha
$ddate=date('d');
// var que almacena el mes de la fecha
$mdate=date('m');
// var que almacena el a�o de la fecha
$adate=date('Y');
// var que almacena  la fecha formateada
$fecha=$adate."_".$mdate."_".$ddate;

if ($archivoCsv_size >= 10000000 ) {	
	echo "El tama&nacute;o del archivo no es correcto. <br><br><table><tr><td><li>Se permiten archivos de 10 Mb m&aacute;ximo.</td></tr></table>";
}
else
{
    $dirActual = getcwd();
	if (!copy($archivoCsv, "../bodega/tmp/".'_'.$fecha.'_'.$hora.'_'.$archivoCsv_name)) {
		echo "Error al copiar XLSX: $archivoCsv en ../bodega/tmp/".'_'.$fecha.'_'.$hora.'_'.$archivoCsv_name;
	}
	else
	{
		// Carga de archivo y actualizacion de 
		echo "Inicia carga del archivo a la DB...<br>";

		// XLSX dimensions
		set_time_limit(0);

		/** Include path **/
		//set_include_path(get_include_path() . PATH_SEPARATOR . '../include/PHPExcel/');

		/** PHPExcel */
		require '../include/PHPExcel/PHPExcel.php';

		/** PHPExcel_IOFactory */
		require '../include/PHPExcel/PHPExcel/IOFactory.php';

		echo "Carga de librerias necesarias...<br>";
		
		// Load file
		$inputFileName = "../bodega/tmp/".'_'.$fecha.'_'.$hora.'_'.$archivoCsv_name;

		/** Identify the type of $inputFileName **/
		$inputFileType = PHPExcel_IOFactory::identify($inputFileName);
		
		/** Create a new Reader of the type that has been identified **/
		$objReader = PHPExcel_IOFactory::createReader($inputFileType);

		$worksheetData = $objReader->listWorksheetInfo($inputFileName);

		// Extract data first sheet
		$firstSheet = array(
			'name' => $worksheetData[0]['worksheetName'], 
			'rows' => $worksheetData[0]['totalRows'],
			'cols' => $worksheetData[0]['totalColumns']);

		echo "Examinando datos del archivo...<br>";

		// Verify format File

		if ($firstSheet['cols'] > 26) {
			$firstSheet['cols'] = 26;
			echo "El archivo no cumple los requisitos: Las variables a combinar no pueden ser mas de 26<br>";
		}

		/** Load $inputFileName to a PHPExcel Object **/
		$objPHPExcel = $objReader->load($inputFileName);

		// Verify file header
		$objWorkSheet = $objPHPExcel->setActiveSheetIndex(0);

		$alphas = range('A', 'Z');

		// CorrectionInfo XLSX
		$highestColumm = $objPHPExcel->setActiveSheetIndex(0)->getHighestDataColumn();
		$highestRow = $objPHPExcel->setActiveSheetIndex(0)->getHighestDataRow();

		$firstSheet['cols']= array_search($highestColumm,$alphas);
		$firstSheet['rows']= $highestRow;

		echo 'getHighestColumn() =  [' . $highestColumm . '], procesada ['.$firstSheet['cols'].']<br/>';
		echo 'getHighestRow() =  [' . $highestRow . ']<br/>';


		// Load header

		$header=array();

		for ($i=0; $i<=$firstSheet['cols']; $i++) {
			$header[]=$objPHPExcel->getActiveSheet()->getCell($alphas[$i].'1')->getValue();
		}

		// Validacion del encabezado
		echo "Validacion de encabezado de archivo:<br/>";

		$header_allow = array("NOMBRE", "CC", "CARGO", "SUELDO", "FECHA", "CONTRATO", "CCF", "COMISIONES");

		for ($i=0;$i<count($header_allow);$i++) {
			if (mb_strtoupper($header[$i],"UTF-8") == $header_allow[$i]) {
				echo "Validacion de ".$header_allow[$i].": OK<br/>";
			} else {
				echo "Validacion de ".$header_allow[$i].": FALSE. Por favor verifique el archivo de entrada...<br/>";
                                echo "Valor obtenido en el error: ".$header[$i];
				die("Imposible continuar.");
			}	
		}
		
		// inicio de transaccion db
		$conexion->conn->StartTrans();

		// Remove data old
		$sql_deleteAll = "DELETE FROM cert_data";
		$conexion->conn->query($sql_deleteAll);

		// Load data in DB and show
		echo '<table border="1" style="width:100%">';
		echo '<tr><th>Nombres y apellidos</th><th>Cédula</th><th>Cargo</th><th>Sueldo</th><th>Fecha de ingreso</th><th>Contrato</th><th>Caja de compensación</th><th>Comisiones</th></tr>';

		// Load data
		for ($j=2; $j<=$firstSheet['rows'];$j++) {
			$dataXLSX=array();
			for ($i=0; $i<=$firstSheet['cols'];$i++) {
				$dataXLSX[]=(string)$objPHPExcel->getActiveSheet()->getCell($alphas[$i].$j)->getValue();
			}
			
			$name       = $dataXLSX[0];
			$CC         = $dataXLSX[1];
			$pos        = $dataXLSX[2];
			$salary     = number_format($dataXLSX[3],0,',','.');
			$admission  = PHPExcel_Style_NumberFormat::toFormattedString($dataXLSX[4], "YYYY-MM-DD");

			$contract   = $dataXLSX[5];
			$BFC        = $dataXLSX[6];

			if ($BFC == "") {
				$BFC = 'N/A';
			}

			$commision = $dataXLSX[7];

			if ($commision == "") {
				$commision= "0";
			}

            echo "<tr><td>$name</td><td>$CC</td><td>$pos</td><td>$salary</td><td>$admission</td><td>$contract</td><td>$BFC</td><td>$commision</td></tr>";

            $sql_insert = "INSERT INTO cert_data (id_person, name, contract, position, salary, BFC, admission_date, commission) 
            	VALUES ($CC, '$name', '$contract', '$pos', '$salary', '$BFC', '$admission', '$commision')";
            //echo $sql_insert;
            $result=$conexion->conn->query($sql_insert);

            if(! $result){
				echo '<center> <font size="3" color="red">Error: Verifique el ultimo registro que aparece en la tabla, tiene errores! Corrija el archivo fuente y realice de nuevo el cargue. Gracias</font> </center>';
				$conexion->conn->RollBackTrans();
				echo "<br>La transaccion se ha cancelado";
				exit(0);
            }
            
		}

		echo "</table>";
	}	

	$status = $conexion->conn->CompleteTrans();

	if ($status) {
		echo '<br><font size="5" color="green">La transacción se realizó de forma satisfactoria</font>';
	} else {
		echo '<br><font size="5" color="red">Ocurrio un error. Verifique el archivo y los datos ingresados</font>';
	}

	//Contabilizamos tiempo final
	$time_end = microtime_float();
	$time = $time_end - $time_start;
	echo "<br><b>Se demor&oacute;: $time segundos la Operaci&oacute;n total.</b>";
}

?>
</body>
</html>
