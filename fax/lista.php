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
$krdAnt = $krd;
session_start(); 
if(!$krd)  $krd = $krdAnt;
$ruta_raiz = "..";
if (!$dependencia)   include "../rec_session.php";
error_reporting(7);
$fechah = date("ymd") ."_". time("hms");
?> 
<head>
<html>
<head>
  <title>lista</title>
  <meta name="GENERATOR" content="Quanta Plus">
  <link rel="stylesheet" type="text/css" href="../estilos/orfeo.css">
  <script language="JavaScript">
	function outbox()
	{
		parent.formulario.location.href="send.php";
	}
  </script>
</head>
<body vlink="#6666CC" alink="#6666CC" link="#6666CC">
<?php include("functions.php"); ?>
<table width="100%" border="0" class=borde_tab>
<tr class=titulos5>
	<td>Faxes</td>
</tr>
</table>
<table width="100%" border="0" class=borde_tab>
<tr class=listado1>
	<td>
		<img src="../iconos/folder_open.gif" width="20" height="20" border="0" alt="Icono que representa una carpeta">
		<a href="form.php?lista=inbox&<?=session_name()."=".session_id() ?>&krd=<?=$krd?>&<? echo "fechah=$fechah&usr=".md5($dep)."&primera=1&ent=2&depende=$dependencia"; ?>" ssh="Tiene <?php print " ()";?> fax(es) nuevo(s) " class="etextomenu" target="formulario">
Mostrar faxes de Entrada<?php $num=inbox_num(); print " ($num)";?>
	</a>
      </td>
    </tr>
    <tr class=listado1>
       <td><img src="../iconos/folder_open.gif" width="20" height="20" border="0" alt="icono que representa una carpeta">
      <a href="form.php?lista=outbox&<?=session_name()."=".session_id() ?>&krd=<?=$krd?>&<? echo "fechah=$fechah&usr=".md5($dep)."&primera=1&ent=2&depende=$dependencia"; ?>" class="etextomenu" ssh="Faxes Enviados" target="formulario">Mostrar faxes de Salida</a></td>
    </tr>
    <tr class=listado1>
    	<td><img src="../iconos/folder_open.gif" width="20" height="20" border="0" alt="icono que representa una carpeta">
      <a href="form.php?lista=process&<?=session_name()."=".session_id() ?>&krd=<?=$krd?>&<? echo "fechah=$fechah&usr=".md5($dep)."&primera=1&ent=2&depende=$dependencia"; ?>" class="etextomenu" ssh="Faxes en Proceso de Envio" target="formulario">Mostrar listado de faxes En Proceso de envio</a></td>
    </tr>
    <tr class=listado1>
      <td>
      	<img src="../iconos/folder_open.gif" width="20" height="20" border="0" alt="icono que representa una carpeta">
      	<a href="form.php?lista=faxStat&<?=session_name()."=".session_id() ?>&krd=<?=$krd?>&<? echo "fechah=$fechah&usr=".md5($dep)."&primera=1&ent=2&depende=$dependencia"; ?>" ssh="Estado de Modem " class="etextomenu" target="formulario">
		Mostrar Estado del Modem
	</a>
      </td>
    </tr>
 <tr class=listado1>
      <td>
      	<img src="../iconos/folder_open.gif" width="20" height="20" border="0" alt="icono que representa una carpeta">
      	<a href="form.php?lista=historico&<?=session_name()."=".session_id() ?>&krd=<?=$krd?>&<? echo "fechah=$fechah&usr=".md5($dep)."&primera=1&ent=2&depende=$dependencia"; ?>" ssh="Tiene <?php print " ()";?> fax(es) nuevo(s) " class="etextomenu" target="formulario">
		Mostrar listado de Fax Historico<?php print " ()";?>
	</a>
      </td>
    </tr>
  </tbody>
</table>
</body>
</html>
