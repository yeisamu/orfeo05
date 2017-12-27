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
  * Se añadio compatibilidad con variables globales en Off
  * @autor Jairo Losada 2009-05
  * @licencia GNU/GPL V 3
  */

define('ADODB_ASSOC_CASE', 2);

foreach($_GET as $k=>$v) $$k=$v;

$krd = $_SESSION["krd"];
$dependencia = $_SESSION["dependencia"];
$usua_doc = $_SESSION["usua_doc"];
$codusuario = $_SESSION["codusuario"];
$tip3Nombre=$_SESSION["tip3Nombre"];
$tip3desc = $_SESSION["tip3desc"];
$tip3img =$_SESSION["tip3img"];
$ruta_raiz = "..";

if (isset($_GET['carpeta'])) $nomcarpeta=$_GET["carpeta"];
if (isset($_GET['tipo_carpt'])) $tipo_carpt=$_GET["tipo_carpt"];
if (isset($_GET['adodb_next_page'])) $adodb_next_page=$_GET["adodb_next_page"];
if($_SESSION['usua_admin_sistema']!=1) die(include "$ruta_raiz/sinacceso.php");
?>
<html>
<head>
<title>Documento  sin t&iacute;tulo</title>
<link rel="stylesheet" href="<?=$_SESSION['ESTILOS_PATH_ORFEO']?>">
<link href="<?= $ruta_raiz . $_SESSION['ESTILOS_PATH2'] ?>bootstrap.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<br>
<br>
<table width="45%" align="center" border="1" cellpadding="0" cellspacing="5" class="menuEnlaces">
    <div id="titulo" style="width: 45%; margin-left: 27.5%" align="center" >Módulo de administración</div>
<!--<tr bordercolor="#FFFFFF">
	<td colspan="2" class="titulos4"><div align="center"><strong>M&Oacute;DULO DE ADMINISTRACI&Oacute;N</strong></div></td>
</tr>-->
<tr bordercolor="#FFFFFF">
	<td align="center" class="listado1" width="48%">
		<a href='usuario/mnuUsuarios.php?krd=<?=$krd?>' target='mainFrame' class="vinculos">1. Usuarios y perfiles</a>
	</td>
	<td align="center" class="listado1" width="48%"><a href="tbasicas/adm_dependencias.php" class="vinculos" target="mainFrame">2. Dependencias</a></td>
</tr>
<tr bordercolor="#FFFFFF">
	<td align="center" class="listado2" width="48%"> <a  href="tbasicas/adm_nohabiles.php" class="vinculos" target='mainFrame'>3. Días no hábiles</a></td>
	<td align="center" class="listado2" width="48%"><a href="tbasicas/adm_fenvios.php" class="vinculos" target='mainFrame'>4. Env&iacute;o de correspondencia</a> </td>
</tr>
<tr bordercolor="#FFFFFF">
	<td align="center" class="listado1" width="48%"><a href="tbasicas/adm_tsencillas.php" class="vinculos" target='mainFrame'>5. Tablas sencillas</a></td>
	<td align="center" class="listado1" width="48%"><a href="tbasicas/adm_trad.php?krd=<?=$krd?>" class="vinculos" target='mainFrame'>6. Tipos de radicaci&oacute;n</a></td>
</tr>
<tr bordercolor="#FFFFFF">
	<td align="center" class="listado2" width="48%"><a href="tbasicas/adm_paises.php" class="vinculos" target='mainFrame'>7. Países</a></td>
	<td align="center" class="listado2" width="48%"><a href="tbasicas/adm_dptos.php" class="vinculos" target='mainFrame'>8. Departamentos</a></td>
</tr>
<tr bordercolor="#FFFFFF">
	<td align="center" class="listado1" width="48%"><a href="tbasicas/adm_mcpios.php" class="vinculos" target='mainFrame'>9. Municipios</a></td>
	<td align="center" class="listado1" width="48%"><a href="tbasicas/adm_tarifas.php" class="vinculos" target='mainFrame'>10. Tarifas</a></td>
</tr>
<tr bordercolor="#FFFFFF">
	<td align="center" class="listado2" width="48%"><a href="tbasicas/adm_contactos.php" class="vinculos" target='mainFrame'>11. Contactos</a></td>
<td align="center" class="listado2" width="48%"><a href="tbasicas/adm_esp.php?krd=<?=$krd?>" class="vinculos" target='mainFrame'>12. Terceros </a></td>
</tr>
<tr bordercolor="#FFFFFF">
    <td align="center" class="listado1" colspan="2" width="48%"><a href="seguridad.php" class="vinculos" target='mainFrame'>13. Seguridad</a></td>
      
 <!--<td align="center" class="listado1" width="48%"><a href="migra.php" class="vinculos" target='mainFrame'>14. Migración</a></td>-->
</tr
<tr bordercolor="#FFFFFF">
<!--          <td align="center" class="listado2" width="48%"><a href="tbasicas/adm_temas.php?krd=<?=$krd?>" class="vinculos" target='mainFrame'>15. TEMAS</a></td>-->
</tr>

</table>
</body>
</html>
