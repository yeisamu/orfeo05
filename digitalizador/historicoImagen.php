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



//Variables de sesion de php
session_start();
// Report runtime errors
error_reporting(E_ERROR | E_WARNING | E_PARSE);

//Defino variables de entorno para el ambiente de Orfeo
if (!isset($ruta_raiz)) $ruta_raiz="..";
$krd         = $_SESSION["krd"];
$dependencia = $_SESSION["dependencia"];
$usua_doc    = $_SESSION["usua_doc"];
$codusuario  = $_SESSION["codusuario"];

//Incluyo las libreria adodb para conectar a la bd
require_once("$ruta_raiz/include/db/ConnectionHandler.php");

//Crago la clase de conexión si no esta definida
if (!isset($db)) $db = new ConnectionHandler("$ruta_raiz");

//Definimos como se hara el fetch dela data en adodb
//la llave del array sera el nombre de la columna de la tabla
$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);

//Incluyo la libreria del digitalizador
require_once(dirname(__FILE__).DIRECTORY_SEPARATOR."class/Digitalizador.php");

//Crago la clase de conexión si no esta definida
$digitalizador = new Digitalizador();

//Guardo el radicado enviado
$radicado  = $_GET["nurad"];

?>
<html>
    <head>
        <title>HISTORICO DE DIGITALIZACI&Oacute;N</title>
        <link rel="stylesheet" href="../estilos/orfeo.css">
        <link rel="stylesheet" href="./css/estilos_dig.css">
    </head>
    <body>
	<?php echo $digitalizador->listaHistImagen($radicado);?>
    </body>
</html>

