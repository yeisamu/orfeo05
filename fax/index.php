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


   error_reporting(0);
   session_start();
   //$dependencia = "";

   if(!$dependencia or !$krd) include "rec_session.php";
   $carpeta=$carpetano;
   $tipo_carp = $tipo_carpp;
	$encabezado = session_name()."=".session_id()."&krd=$krd&fechah=$fechah";
?>
<html>
<head>
	<title>Fax</title>
</head>
<frameset rows="60%,40%" border="5" name="filas">
<!--<frame name="image" src="./image.php?<?=$encabezado?>" name="columnas" alt="Imagen de encabezado" title="Panel superior de radicacion de fax, contiene el encabezado">-->
	<frameset cols="150,947" name="secundario">
	<frame name="lista" src="lista.php?<?=$encabezado?>" parent="secundario" resize=true border=1 title="Panel izquierdo de radicacion de fax, contiene los tipos de fax que exiten">
	<frame name="formulario" src="form.php?<?=$encabezado?>" parent="secundario" resize=true title="Panel superior de radicacion de fax, se encuentra vacio">
	</frameset>
<!--<frame src="UntitledFrame-1">--></frameset><noframes></noframes>
</html>
