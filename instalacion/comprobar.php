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


/**
* Instalador Web Orfeo 
* Desarrollo Ing. Isabel Rodriguez
* Diseño Ing. Erlyzeth Feria
* SkinaTech
* Fecha: 20-Marzo-2012
* Sistema de gestion Documental ORFEO.
*
* Permite la instalacion de Orfeo via web
* Paso 2. Compruebo la conexión y escribo en el config
*/

//traigo datos
$driver=$_POST["TipoMotor"];
$servidor=$_POST["ipservidor"];
$usuario=$_POST["usuario"];
$contrasena=$_POST["password"];
$db="orfeodb";

$ruta_raiz="..";
include($ruta_raiz.'/adodb/adodb.inc.php'); 
$dsn = $driver."://".$usuario.":".$contrasena."@".$servidor."/".$db;
$conn = NewADOConnection($dsn);
if ($conn)  header("Location: pasodos.php?error=1");
else  header("Location: pasodos.php?error=2");

?>
