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
/**
  * @autor Sebastian Ortiz V.
  * @Ministerio de Salud y  Proteccion Social 2012
  * @licencia GNU/GPL V 3
  */

foreach ($_GET as $key => $valor)   ${$key} = $valor;
foreach ($_POST as $key => $valor)   ${$key} = $valor;

header('Content-Type: text/html; charset=UTF-8');
include('./captcha/simple-php-captcha.php');

//Si la acccion es recargar
if(isset($recargar) && $recargar=="si"){
	$_SESSION['captcha_formulario'] = captcha();
	echo $_SESSION['captcha_formulario']['image_src'];
	return;
}
$strcmpresult = strcasecmp ($captcha ,$_SESSION['captcha_formulario']['code'] );
if($strcmpresult == 0){
	echo "true";
}
else {
	echo "false";
}
?>
