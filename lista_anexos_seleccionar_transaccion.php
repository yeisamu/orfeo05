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
$krd = $_SESSION["krd"];
$dependencia = $_SESSION["dependencia"];
$usua_doc = $_SESSION["usua_doc"];
$codusuario = $_SESSION["codusuario"];
$tip3Nombre=$_SESSION["tip3Nombre"];
$tip3desc = $_SESSION["tip3desc"];
$tip3img =$_SESSION["tip3img"];
$tpNumRad = $_SESSION["tpNumRad"];
$tpPerRad = $_SESSION["tpPerRad"];
$tpDescRad = $_SESSION["tpDescRad"];
$tip3Nombre = $_SESSION["tip3Nombre"];
$dependencia = $_SESSION["dependencia"];
$tpDepeRad = $_SESSION["tpDepeRad"];


if($_GET["verrad"]) $verrad=$_GET["verrad"];
if($_GET["verradPermisos"]) $verradPermisos=$_GET["verradPermisos"];
if($_GET["numfe"]) $numfe=$_GET["numfe"];
if($_GET["radicar"]) $radicar=$_GET["radicar"];
if($_GET["radicar_a"]) $radicar_a=$_GET["radicar_a"];
if($_GET["vp"]) $vp=$_GET["vp"];
if($_GET["radicar_documento"]) $radicar_documento=$_GET["radicar_documento"];
if($_GET["generar_numero"]) $generar_numero=$_GET["generar_numero"];
if($_GET["numrad"]) $numrad=$_GET["numrad"];
if($_GET["anexo"]) $anexo=$_GET["anexo"];
if($_GET["linkarchivo"]) $linkarchivo=$_GET["linkarchivo"];
if($_GET["numextdoc"]) $numextdoc=$_GET["numextdoc"];
if($_GET["tpradic"]) $tpradic=$_GET["tpradic"];
if($_GET["numerar"]) $numerar=$_GET["numerar"];
if($_GET["borrar"]) $borrar=$_GET["borrar"];


 // http://localhost/orfeo-3.7.2/lista_anexos_seleccionar_transaccion.php?radicar=1&radicar_a=si&vp=n&krd=ADMIN1&PHPSESSID=127o0o0o1oADMIN1&radicar_documento=20061220012421&numrad=20061220012421&anexo=2006122001242100012&linkarchivo=./bodega/2006/122/docs/120061220012421_00012.odt&otro_us11=&dpto_nombre_us11=Valle%20del%20cauca&muni_nombre_us11=Cali&direccion_us11=AVENIDA%20PASOANCHO%20No.%2057-50&nombret_us11=COOPERATIVA%20MEDICA%20DEL%20VALLE%20Y%20DE%20PROFESIONALES%20DE%20COLOMBIA%20(%20COOMEVA%20%20)&otro_us2=&dpto_nombre_us2=&muni_nombre_us2=&direccion_us2=&nombret_us2=%20%20%20%20%20%20&dpto_nombre_us3=Valle%20del%20cauca&muni_nombre_us3=Cali&direccion_us3=AVENIDA%20PASOANCHO%20No.%2057-50&nombret_us3=COOPERATIVA%20MEDICA%20DEL%20VALLE%20Y%20DE%20PROFESIONALES%20DE%20COLOMBIA%20(%20%20ALFREDO%20ARANA%20)&ruta_raiz=.&numfe=0&tpradic=1&aplinteg=&numextdoc=14
if($_GET["numfe"]) $numfe=$_GET["numfe"];
if (!$ruta_raiz) $ruta_raiz= ".";

if ($numfe&&$numfe!=0){
	if ($numerar)
		include("$ruta_raiz/numerar_paquete_anexos.php");
	else if ($radicar&&$radicar_a=="si") 
		include("$ruta_raiz/radicar_paquete_anexos.php");
	else if ($radicar)
		include("$ruta_raiz/genarchivo.php");
	else if($borrar)
		include("$ruta_raiz/borrar_paquete_anexos.php");
}
else {
	if ($radicar) 
		include("$ruta_raiz/genarchivo.php");
	else if ($borrar)
		include("$ruta_raiz/borrar_archivos.php");

}


?>
