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
?>
<html>
<head>
<title>Buscar Radicado</title>
<link rel="stylesheet" href="../estilos_totales.css" type="text/css">
</head>
<body>
<center></P>
  <form action=mod_regenvio.php?sid_j=<?=$sid_j?>&<?=session_name()."=".session_id()?>" method="post" name="FrmBuscar">
    <table width="70%" border="0" >
  <tr class="timpar">
        <td width="25%" height="49">Numero de Radicado</td>
    <td width="55%"><center></center><input type=text name=chk1 class=ecajas>
	 <input type=submit name=Buscar Value="Buscar Radicado" class=ebuttons2>
	 <?php
	 if($drd){$drde=md5($drd);}
	 echo "<INPUT TYPE=hidden name=drde value=$drde>
	 <INPUT TYPE=hidden name=krd value=$krd>
	 <INPUT TYPE=hidden name=depende value=$depende>
	 <INPUT TYPE=hidden name=contra value=$contra>";

	 ?>
	 </td>
  </tr>
</table>
</form>
</center>
<?
	if($chk1)
	{

	

	}

?>
