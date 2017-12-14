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


	$ruta_raiz = "..";
	session_start();
	if(!$dependencia or !$tpDepeRad) include "$ruta_raiz/rec_session.php";	
	$phpsession = session_name()."=".session_id();
?>
<html>
<head>
<title>Documento sin t&iacute;tulo</title>
</head>
<body>
<table width="40%"  border="1" align="center">
  <tr>
    <td colspan="2"><div align="center"><strong>Modulo de Administraci&oacute;n</strong></div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="6%">1.</td>
    <td width="94%"><a href='usuario/listado.php?<?=$phpsession ?>&krd=<?=$krd?>&<? echo "fechah=$fechah"; ?>' target='mainFrame'>Usuarios y Perfiles</a></td>
  </tr>
  <tr>
    <td>2.</td>
    <td width="94%"><a href='dependencia/listado.php?>&krd=<?=$krd?>&<? echo "fechah=$fechah"; ?>' target='mainFrame'>Dependencias</a></td>
  </tr>
  <tr>
    <td>3.</td>
    <td>Carpetas</td>
  </tr>
  <tr>
    <td>4.</td>
    <td>Env&iacute;os de Correspondencia </td>
  </tr>
  <tr>
    <td>5.</td>
    <td>Tipos Documentales </td>
  </tr>
  <tr>
    <td>6.</td>
    <td>Servicios</td>
  </tr>
  <tr>
    <td>7.</td>
    <td>Tipos de Radicaci&oacute;n </td>
  </tr>
</table>
</body>
</html>
