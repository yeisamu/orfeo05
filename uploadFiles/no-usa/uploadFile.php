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


$krdOld = $krd;
session_start();
if(!$krd) $krd=$krdOsld;
$ruta_raiz = "..";
if(!$dependencia) include "$ruta_raiz/rec_session.php";
error_reporting(7);
$verrad = "";
/** PROGRAMA DE CARGA DE IMAGENES DE RADICADOS
  *@author JAIRO LOSADA - DNP - SSPD
  *@version Orfeo 3.5.1
  * 
  *@param $varBuscada sTRING Contiene el nombre del campo que buscara
  *@param $krd  string Trae el Login del Usuario actual
  *@param $isql strig Variable temporal que almacena consulta
  */
?>
<HTML>
<head>
<link rel="stylesheet" href="<?=$ruta_raiz?>/estilos/orfeo.css">
</head>
<BODY>

</BODY>
