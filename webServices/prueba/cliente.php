<?
require_once('includes/nusoap.php');
$soapclient = new soapclient('http://estudiowas.com.ar/nusoaptest/server.php');
echo $soapclient->call( 'hola' , array('name' => 'Mundo') );
?>