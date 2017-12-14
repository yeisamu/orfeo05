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


require_once('nusoap/lib/nusoap.php');

//$wsdl="http://wiki.superservicios.gov.co:81/~wduarte/br3.6.0/webServices/servidor.php?wsdl"; 
$wsdl="http://192.168.8.203/orfeo-3.8.0p/webServices/skn_srm.php?WSDL"; 

$client=new soapclient($wsdl, 'wsdl');  
//$extension = explode(".",$archivo_name);
//copy($archivo, "../bodega/tmp/visitas/".$archivo_name);

//prueba radicar
$arregloDatos = array();
$arregloDatos['file'] ='TXV5IGJpZW4uIEVsIHRleH RvIGVzdGFiYSBjb2RpZmlj YWRvIGVuIGJhc2UgNjQuDQ pMYSByZXNwdWVzdGEgcXVl IGRlYmVzIGNvbG9jYXIgcG FyYSBwYXNhciBkZSBuaXZl bCBlcyBlbCBh8W8gZGUgbm FjaW1pZW50byBkZWwgZXNj cml0b3IgSG93YXJkIFBoaW xsaXBzIExvdmVjcmFmdC4';
$arregloDatos['filename'] = 'prueba.pdf';
$arregloDatos['destinatario'] ='Empresa XRM';
$arregloDatos['direccion'] = 'calle pepito 123';
$arregloDatos['telefono'] = '123';
$arregloDatos['tdoc'] = '0';
$arregloDatos['no_rm'] = '';
$arregloDatos['no_tran'] = '2456';

$a = $client->call('radicarDocumento',$arregloDatos);
var_dump($a);

$arregloDatos['no_rad'] = '20119980000742';
$arregloDatos['destinatario'] ='Empresa XRM';
$arregloDatos['direccion'] = 'calle pepito 123';
$arregloDatos['telefono'] = '123';
$arregloDatos['email'] = 'edorado@skinatech.com';
$arregloDatos['tstatus'] = 'En problema';
$arregloDatos['no_rm'] = '123456';

$b = $client->call('actualizarDocumento',$arregloDatos);
var_dump($b);


?>
