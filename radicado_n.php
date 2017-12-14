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
<title>:: Confirmacion de radicado ::</title>
</head>
<body bgcolor="#63CB97" text="#000000">
<?php
include_once dirname(__FILE__).DIRECTORY_SEPARATOR.".".DIRECTORY_SEPARATOR."config.php";
$x1=substr($nurad,0,4);
$x2=substr($nurad,4,$longitud_codigo_dependencia);
$x3=substr($nurad,(4+$longitud_codigo_dependencia),6);
$x4=substr($nurad,-1);

?>
<table width="100%" border="1" cellspacing="0" cellpadding="4" bordercolor="#CCCCCC" height="100%">
  <tr>
    <td bgcolor="#FFCC66" valign="middle" align="center"> 
      <div align="center"><font face="Arial, Helvetica, sans-serif" size="3"><b>Estimado 
        usuario, <br>
        se gener&oacute; el radicado No.</b></font><font face="Arial, Helvetica, sans-serif" size="4" color="#009933"><u><b> 
        <font color="#000000">
        <? echo "$x1-$x2-$x3-$x4";?>
        </font></b><br>
        </u></font><font face="Arial, Helvetica, sans-serif"><b><br>
        <input type="button" name="Submit" value="Cerrar Ventana" onClick="window.close()">
        </b></font></div>
    </td>
  </tr>
</table>
</body>
</html>
