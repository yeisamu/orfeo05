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
$imagenes=$_SESSION["imagenes"];
?>

<html>
<title>ERROR - ORFEO</title>
<HEAD>
<link rel="stylesheet" href="estilos/orfeo.css">
</HEAD>
<body bgcolor="#207385">
<p><br>
<p>
<center>
<font face='Verdana, Arial, Helvetica, sans-serif' SIZE=3 color=white>
<p>
<a href="<?=$ruta_raiz?>/login.php" target="_parent">
<img border="0" src="<?=$ruta_raiz?>/<?=$imagenes?>/logo2.gif" width="206" height="76"></a>
<p>Usted <b>NO</b> tiene permisos para ingresar a este m&oacute;dulo.</font>
</center>
</body>
</html>
