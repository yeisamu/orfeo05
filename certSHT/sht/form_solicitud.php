<?php

// Probando variables
session_start();

if(!isset($_SESSION['dependencia'])) {
 include "../rec_session.php";
 die();
}

?>

<!doctype html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Formulario de solicitud</title>
	<link rel="stylesheet" type="text/css" href="css/estilos.css">
	<script type="text/javascript" src="js/jquery-1.9.1.js"></script>
	<script type="text/javascript" src="js/funciones.js"></script>
</head>
<body>

	<form action="<?php $_SERVER['PHP_SELF'] ?>" class="form" method="post">
		<fieldset>
			<div>
		<img align="center" src="./img/logo_sht.png" width="20%">
                <h2>SOLICITUD DE CERTIFICACI&Oacute;N</h2>
             </div>
         <br>


<?php if (isset($_POST['name'])) { 

// Recolecion de variables

$category = $_POST['category'];
$name = $_POST['name'];
$idPerson = $_POST['idPerson'];
$idPlace = $_POST['idPlace'];
$contractTerm = $_POST['contractTerm'];
$positon = $_POST['position'];
$salary = $_POST['salary'];
$bfc = $_POST['bfc'];
$admissionDate = $_POST['admissionDate'];
$commissions = $_POST['commissions'];
$requestOf = $_POST['requestOf'];

// Cargando WS
require_once "nusoap/nusoap.php";

$client = new nusoap_client("http://localhost/orfeo/certSHT/WS/certi_SHT.php?wsdl",true);

$error = $client->getError();

if ($error) {
    echo "<h2>Constructor error</h2><pre>" . $error . "</pre>";
}
 
$result = $client->call("genRadi", array("category" => $category,
                                         "name" => $name,
                                         "idPerson" => $idPerson,
                                         "idPlace" => $idPlace,
                                         "contractTerm" => $contractTerm,
                                         "position" => $position,
                                         "admissionDate" => $admissionDate,
                                         "salary" => $salary,
                                         "bfc" => $bfc,
                                         "requestOf" => $requestOf,
                                         "commissions" => $commissions));
 
if ($client->fault) {
    echo "<h2>Fault</h2><pre>";
    print_r($result);
    echo "</pre>";
}
else {
    $error = $client->getError();
    if ($error) {
        echo "<h2>Error</h2><pre>" . $error . "</pre>";
    }
    else {
        echo '<h2 style="text-align: center;">Descargue su certificado del siguiente enlace</h2>';
        echo '<div style="text-align: center;"><a href="'.$result.'">Descargar certificado generado</a>';
        echo '<br>';
        echo "</div>";
        echo '<div style="text-align: center;"><a href="form_solicitud.php">Generar otro certificado</a>';
    }
}

} else {

?>
			<div>
			<label for="category">SELECCIONE TIPO DE CERTIFICACI&Oacute;N : </label>
			<select name="category" id="category" required>
				<option value="">Seleccione ...</option>
				<option value="1">Tipo I</option>
				<option value="2">Tipo II</option>
				<option value="3">Tipo III</option>
				<option value="4">Tipo IV</option>
			</select>
			<br>
			</div>
			<input type="text" name="name" id="name" title="Nombres y apellidos del solitante" placeholder="Nombres y Apellidos"
			required pattern="[a-zA-Z- áéíóúñúüàèÁÉÍÓÚÜÑ]+" class="input-block-level" maxlength="">
			<input type="text" name="idPerson" id="idPerson" title="Cédula de ciudadania" placeholder="Cédula de ciudadania"
			required pattern="[0-9-.]+" class="input-block-level" maxlength="">
			<input type="text" name="idPlace" id="idPlace" title="Lugar de Expedición cédula" placeholder="Lugar de Expedición"
			required pattern="[a-zA-Z- áéíóúñúüàèÁÉÍÓÚÜÑ]+" class="input-block-level" maxlength="">
			<input type="text" name="contractTerm" id="contractTerm" title="Termino del contrato" placeholder="Termino del contrato"
			required pattern="[a-zA-Z- áéíóúñúüàèÁÉÍÓÚÜÑ]+" class="input-block-level" maxlength="">
			<input type="text" name="position" id="position" title="Cargo" placeholder="Cargo"
			required pattern="[a-zA-Z- áéíóúñúüàèÁÉÍÓÚÜÑ]+" class="input-block-level" maxlength="">
			<input type="text" name="salary" id="salary" title="Salario" placeholder="Salario"
			required pattern="[0-9-.]+"  class="input-block-level" maxlength="">
			<input type="text" name="bfc" id="bfc" title="Caja de compensación familiar" placeholder="Caja de compensación familiar"
			required pattern="[a-zA-Z- áéíóúñúüàèÁÉÍÓÚÜÑ]+" class="input-block-level" maxlength="">
			<input type="text" name="admissionDate" id="admissionDate" title="Fecha de Ingreso (AAAA-MM-DD)" placeholder="Fecha Ingreso (AAAA-MM-DD)" 
			required pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" class="input-block-level" maxlength="">
			<input type="text" name="requestOf" id="requestOf" title="A solicitud de :" placeholder="A solicitud de:"
			required pattern="[a-zA-Z- áéíóúñúüàèÁÉÍÓÚÜÑ]+"  class="input-block-level" maxlength="">
			<input type="text" name="commissions" id="commissions" title="Comisiones" placeholder="Comisiones"
			required pattern="[0-9-.]+" class="input-block-level" maxlength="">
			 <br>
			<div align="center">
			<button title="limpiar" class="btn btn-large btn-primary" type="reset">LIMPIAR</button>
            <button title="enviar" class="btn btn-large btn-primary" type="submit">ENVIAR</button>
            </div>
		</fieldset>
	</form>
<?php } ?>
</body>
</html>
