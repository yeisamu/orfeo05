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

?>
<html>
<head>
<title>Realizar Transaccion - Orfeo </title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="../estilos/orfeo.css">
</head>
<?php
session_start(); 
require_once('nusoap/lib/nusoap.php');

//$wsdl="http://192.168.20.17/orfeo-3.8.0/webServices/skn_srm_3.php?WSDL"; 
$wsdl="http://10.60.0.83/orfeo/webServices/skn_srm_3.php?WSDL"; 
//$ns="http://192.168.8.203/orfeo-3.8.0p/webservices/nusoap";

$client=new soapclient($wsdl, 'wsdl');  
//prueba radicar
/*$arregloDatos = array();
$arregloDatos['file'] ='TXV5IGJpZW4uIEVsIHRleH RvIGVzdGFiYSBjb2RpZmlj YWRvIGVuIGJhc2UgNjQuDQ pMYSByZXNwdWVzdGEgcXVl IGRlYmVzIGNvbG9jYXIgcG FyYSBwYXNhciBkZSBuaXZl bCBlcyBlbCBh8W8gZGUgbm FjaW1pZW50byBkZWwgZXNj cml0b3IgSG93YXJkIFBoaW xsaXBzIExvdmVjcmFmdC4';
$arregloDatos['filename'] = 'prueba.pdf';
$arregloDatos['destinatario'] ='Empresa XRM';
$arregloDatos['direccion'] = 'calle pepito 123';
$arregloDatos['telefono'] = '123';
$arregloDatos['tdoc'] = '0';
$arregloDatos['no_rm'] = '';
$arregloDatos['no_tran'] = '2456';*/

//$file ='TXV5IGJpZW4uIEVsIHRleH RvIGVzdGFiYSBjb2RpZmlj YWRvIGVuIGJhc2UgNjQuDQ pMYSByZXNwdWVzdGEgcXVl IGRlYmVzIGNvbG9jYXIgcG FyYSBwYXNhciBkZSBuaXZl bCBlcyBlbCBh8W8gZGUgbm FjaW1pZW50byBkZWwgZXNj cml0b3IgSG93YXJkIFBoaW xsaXBzIExvdmVjcmFmdC4';
$file='';
//$filename = 'prueba.pdf';
$filename='';
$destinatario ='Empresa XRM';
//$direccion = 'calle pepito 123';
$direccion = '';
//$telefono = '123';
$telefono = '';
//$tdoc= '0';
$tdoc= '';
$no_rm = '2SD';
//$no_rm = '';
$no_tran = '2456';
//echo "Prueba radicar";
//$a = $client->call('radicarDocumento',array('file'=>$file,'fileName'=>$filename,'destinatario'=>$destinatario,'direccion'=>$direccion,'telefono'=>$telefono,'tdoc'=>$tdoc,'no_rm'=>$no_rm,'no_tran'=>$no_tran));

// Check for a fault
if ($client->fault) {
    echo '<p><b>Fault: ';
    print_r($a);
    echo '</b></p>';
} else {
    // Check for errors
    $err = $client->getError();
    if ($err) {
        // Display the error
        echo '<p><b>Error: ' . $err . '</b></p>';
    } else {
		// Display the result
        print_r($a);
    }
}

$noRad = '20118000001002';
/*$arreglocrear = array();
	$arreglocrear['radiNume']=$noRad;
$arreglocrear['file'] ='TXV5IGJpZW4uIEVsIHRleH RvIGVzdGFiYSBjb2RpZmlj YWRvIGVuIGJhc2UgNjQuDQ pMYSByZXNwdWVzdGEgcXVl IGRlYmVzIGNvbG9jYXIgcG FyYSBwYXNhciBkZSBuaXZl bCBlcyBlbCBh8W8gZGUgbm FjaW1pZW50byBkZWwgZXNj cml0b3IgSG93YXJkIFBoaW xsaXBzIExvdmVjcmFmdC4';
$arreglocrear['filename'] = 'prueba.pdf';
$arreglocrear['tdoc'] = '0';
$arreglocrear['ndoc'] = '3456';*/
$nodoc='3456';
//echo "Prueba anexar";
//$b = $client->call('crearAnexo',array('radiNume'=>$noRad,'file'=>$file,'filename'=>$filename,'tipodoc'=>$tdoc,'nodoc'=>$nodoc));
//print_r($b);
$arregloconsulta= array();
//$arregloconsulta['norad']=$noRad;
$arregloconsulta['norad']='';
$arregloconsulta['destinatario']='';
$arregloconsulta['norm']='';
$arregloconsulta['notran']='';
//$arregloconsulta['nodoc']='';
$arregloconsulta['nodoc']=$nodoc;

$c = $client->call('consultarDocumento',$arregloconsulta);
print_r($c);
//$c = $rs->consultarDocumento('','SOUND','','','');
//$c = $rs->consultarDocumento('','','63000SD','','');
//$c = $rs->consultarDocumento('','','','','2456');*/
$email='';
$status='en problema';

$arregloactu=array();
$arregloactu['norad']=$noRad;
$arregloactu['destinatario']=$destinatario;
$arregloactu['direccion']=$direccion;
$arregloactu['telefono']=$telefono;
$arregloactu['email']=$email;
$arregloactu['tstatus']=$status;
$arregloactu['norm']='63000SD';
//echo "prueba actualizar";
//print_r($arregloactu);
//$d = $client->call('actualizarDocumento',$arregloactu);
//$d = $client->call('actualizarDocumento',array('norad'=>$noRad,'destinatario'=>$destinatario,'direccion'=>$direccion,'telefono'=>$telefono,'email'=>$email,'tstatus'=>$status,'norm'=>$no_rm));

// Check for a fault
if ($client->fault) {
    echo '<p><b>Fault: ';
    print_r($c);
    echo '</b></p>';
} else {
    // Check for errors
    $err = $client->getError();
    if ($err) {
        // Display the error
        echo '<p><b>Error: ' . $err . '</b></p>';
    } else {
		// Display the result
        print_r($c);
    }
}
	?>
</body>
</html>
