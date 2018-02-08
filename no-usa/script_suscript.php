<?php
//Script para la creacion de expedientes Espinal, para los
//suscriptores en el SGD Orfeo
//Ing Camilo Pintor
//cpintor@skinatech.com
//01/10/2014

require_once("./include/db/ConnectionHandler.php");
$db = new ConnectionHandler(".");
$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
$db->conn->SetFetchMode(ADODB_FETCH_NUM);
$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
//Recorro el archivo csv con los suscriptores

$db->conn->debug = true;
$file = fopen("/home/skina/suscriptores.csv","r");
    $serie = 47;
    $subserie = 63;
    $secuencia = 1;
    $dependencia = 210;
    $usuadoc = '11226127';
    $anoExp = 2014;
    $digCheck = "E";
    
while(! feof($file))
{
	
//    print_r(fgetcsv($file));
	$consecutivoExp = substr("00000".$secuencia,-5);
        $numeroExpediente = $anoExp . $dependencia . $serie . $subserie . $consecutivoExp . $digCheck;
        $datos = fgetcsv($file);
	//print_r ($datos[0]);
	//print_r ($datos[1]);
        $nombreExpediente = $datos[0]."-SUSCRIPTOR";
	$sql = "INSERT INTO sgd_sexp_secexpedientes VALUES ('$numeroExpediente', $serie, $subserie, $secuencia, $dependencia, '$usuadoc', '$datos[1]', 0, $anoExp, '$usuadoc', '$nombreExpediente', NULL, NULL, NULL, NULL, 0 , NULL, NULL, NULL, NULL, NULL, NULL, 0);";	
	echo $datos[0];
	$db->conn->query($sql);
	echo "<br>";
	$secuencia++;
}	

fclose($file);



?>
