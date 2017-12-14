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


//Programa que genera el formulario de seleccion de opciones para el env�o de un grupo de documentos de radicaci�n masiva
error_reporting(7);
session_start();
$ruta_raiz = "..";
if (!isset($_SESSION['dependencia']))	include "../rec_session.php";		

require_once("$ruta_raiz/include/db/ConnectionHandler.php");
include_once "$ruta_raiz/class_control/GrupoMasiva.php"; 
require_once("$ruta_raiz/include/combos.php");
require_once("$ruta_raiz/class_control/Dependencia.php");

if (!$db)	$db = new ConnectionHandler($ruta_raiz);
$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
	
$grupoMas = & new GrupoMasiva($db);
$objDepe =  & new Dependencia($db);
$objDepe->Dependencia_codigo($dep_sel);
$codTerrEnvio = $objDepe->getDepe_codi_territorial();
$terrEnvio = $objDepe->dependenciaArr($codTerrEnvio);
$grupoMas->obtenerGrupo($dep_sel,$radGrupo,'');
//var arreglo que  almacena los radicados inicial y final del grupo 
$radsLimite = $grupoMas->getRadsLimite();
//var arreglo que  almacena el numero de radicados nacionales y locales
$numRadicados=$grupoMas->getNumNacionalesLocales($terrEnvio['cont_codi'], $terrEnvio['pais_codi'], $terrEnvio['dpto_codi'], $terrEnvio['muni_codi']);
?>
<html>
<head>
<title>Untitled Document</title>
<link href="<?= $ruta_raiz . $ESTILOS_PATH2 ?>bootstrap.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="<?= $ruta_raiz . $_SESSION['ESTILOS_PATH_ORFEO'] ?>">
<script src="../js/formchek.js"></script>
<script>
function back1()
{
	history.go(-1);
}

function enviar()
{
	sw=0;
	if (document.form1.empresa_envio.value!='null' && isInteger(document.form1.envio_peso.value))
	{	sw=1;	}
	else
	{	alert ('Debe suministrar los datos de la empresa de envio y el peso de los documentos');
		return;
	}

/*by skina sin observaciones o planilla
	if (document.form1.observaciones.value.length>1 && document.form1.planilla.value.length>0)
	{
		sw=1;
	}
	else
	{
		alert ('Debe suministrar las observaciones y el numero de planilla');
		return;
	}*/
	document.form1.submit();	
}
</script>
<style type="text/css">
<!--
.style1 {color: #CC0000}
-->
</style>
</head>
<body>
<span class=etexto>
</span> 
<form name="form1" method="post" action="envio_masiva_registro.php?<?=session_name()."=".session_id()."&krd=$krd" ?>" class="borde_tab">
<center>
    <div id="titulo" style="width: 60%;" align="center">Envío de documentos - Radicación masiva</div>
</center>
<table border=2 width=60% class=borde_tab cellspacing="5" align="center">
<tr class=titulos2 align="center" > 
	<td width="26%" >Grupo</td>
	<td width="35%" >Empresa de Envío</td>
	<td width="13%" >Peso(Gr) C/U </td>
	<td width="26%" >U.medida</td>
</tr>
<tr class=listado2>
	<td height="26" align="center" width="26%"> 
          <? echo ($radsLimite[0]."<br>".$radsLimite[1]);?>
          <input type="hidden" name="rangoini" value="<?=$radsLimite[0]?>" >
          <input type="hidden" name="rangofin" value="<?=$radsLimite[1]?>" >
        </td>
        <td height="26" align="center" width="35%"> 
          <select name=empresa_envio id=empresa_envio class=select  onClick=" if (this.value!='null'&& envio_peso.value.length>1) calcular_precio('empresa_envio','envio_peso','valor_gr');" >
         <option selected value="null">--- empresa de envio ---</option>
		<? 
 			$a = new combo($db); 			
			$s = "select SGD_FENV_CODIGO as COD,SGD_FENV_DESCRIP as DES FROM SGD_FENV_FRMENVIO WHERE SGD_FENV_ESTADO=1 ";
			$r = "COD"; 
			$t = "DES";
			$v = $estado;
			$sim = 0; 
      $a->conectar($s,$r,$t,$v,$sim);	
   ?>
      </select>
    </td>
        <td width="13%"> 
          <input type=text class="tex_area" name=envio_peso id=envio_peso  size=6 onChange="calcular_precio('empresa_envio','envio_peso','valor_gr');">
    </td>
        <TD width="26%"> 
          <input type=text name=valor_gr id=valor_gr class=tex_area   size=30 disabled>
    </td>
  </tr>
</table>
<br />
<table border=2 width=60% class=borde_tab align="center">
<tr class="titulos2" align="center">
	<td   valign="top" width="12%">Destino</td>
	<td  valign="top" width="17%">Documentos</td>
	<td valign="top" width="34%">Valor C/U</td>
	<td valign="top" width="28%">Valor total</td>
	<td valign="top" rowspan="6" width="9%" >
		<input type=button class="botones" name=Calcular_button id=Calcular_button value=Calcular onClick="calcular_precio('empresa_envio','envio_peso','valor_gr');">
	</td>
</tr>
  <tr > 
    <td height="21" align="center" valign="top" width="12%" class="titulos5">Local </td>
    <td align="center" valign="top" width="17%" class='listado2'> 
      <center><?=$numRadicados["local"]?></center>
      <input type="hidden" name="local" value="<?=$numRadicados["local"]?>" id=local>
    </td>
    <td valign="midle" width="34%" class='listado2'> 
      <input type=text class='tex_area' name=valor_unit_local id=valor_unit_local  readonly     >
    </Td>
    <td width="28%" class='listado2'> 
      <input type=text class='tex_area' name=valor_total_local id=valor_total_local  readonly     >
    </Td>
  </tr>
  <tr > 
    <td height="21" align="center" valign="top" width="12%" class="titulos5">Nacional </td>
    <td align="center" valign="top" width="17%" class='listado2'> 
      <center><?=$numRadicados["nacional"]?></center>
      <input type="hidden" name="nacional" value="<?=$numRadicados["nacional"]?>" id=nacional >
    </td>
    <td valign="midle" width="34%" class='listado2'> 
      <input type=text class='tex_area'  name=valor_unit_nacional id=valor_unit_nacional  readonly     >
    </Td>
    <td width="28%" class='listado2'> 
      <input type=text class='tex_area' name=valor_total_nacional id=valor_total_nacional  readonly    >
    </Td>
  </tr>
  <tr > 
    <td height="21" align="center" valign="top" width="12%" class="titulos5">Int. G1 </td>
    <td align="center" valign="top" width="17%" class='listado2'> 
      <center><?=$numRadicados["grupo1"]?></center>
      <input type="hidden" name="grupo1" value="<?=$numRadicados["grupo1"]?>" id=grupo1 >
    </td>
    <td valign="midle" width="34%" class='listado2'> 
      <input type=text class='tex_area'  name=valor_unit_grupo1 id=valor_unit_grupo1  readonly     >
    </Td>
    <td width="28%" class='listado2'> 
      <input type=text class='tex_area' name=valor_total_grupo1 id=valor_total_grupo1  readonly    >
    </Td>
  </tr>
  <tr > 
    <td height="21" align="center" valign="top" width="12%" class="titulos5">Int. G2</td>
    <td align="center" valign="top" width="17%" class='listado2'> 
      <center><?=$numRadicados["grupo2"]?></center>
      <input type="hidden" name="grupo2" value="<?=$numRadicados["grupo2"]?>" id=grupo2 >
    </td>
    <td valign="midle" width="34%" class='listado2'> 
      <input type=text class='tex_area'  name=valor_unit_grupo2 id=valor_unit_grupo2  readonly     >
    </Td>
    <td width="28%" class='listado2'> 
      <input type=text class='tex_area' name=valor_total_grupo2 id=valor_total_grupo2  readonly    >
    </Td>
  </tr>
  <tr class=listado2>
    <td width="12%"></td>
    <td width="17%">
          <input type="hidden" name="primRadNac" value="<?=$grupoMas->getPrimerRadicadoNacional() ?>" id=nacional >
          <input type="hidden" name="primRadLoc" value="<?=$grupoMas->getPrimerRadicadoLocal() ?>" id=nacional >
          <input type="hidden" name="primRadG1" value="<?=$grupoMas->getPrimerRadicadoGrupo1() ?>" id=nacional >
          <input type="hidden" name="primRadG2" value="<?=$grupoMas->getPrimerRadicadoGrupo2() ?>" id=nacional >
          <input type="hidden" name="grupo" value="<?=$radGrupo ?>" id=nacional >
          <input type="hidden" name="renv_codigo" value="<?=$grupoMas->getSgd_renv_codigo()?>" id=nacional >
        </td>
    <td width="34%">&nbsp; </Td>
    <td width="28%"> 
      <input type=text class='tex_area' name=valor_total id=valor_total  readonly    >
  </Td>
</table>
<br />
<table class="borde_tab" width="33%" border="2" align="center">
<tbody> 
	<tr class=titulos5 bgcolor="">
		<td class="#cccccc" width="29%">Observaciones o desc. anexos</td>
		<td class="#cccccc" width="71%"><input id="observaciones" name="observaciones" type="text" size="56" class='tex_area' ></td>
	</tr>

	<!-- By skina Quitamos numero de planilla, se colocara automaticamente
	<tr class=titulos5 bgcolor="">
		<td class="#cccccc" width="29%">No. De Planilla</td>
		<td class="#cccccc" width="71%"><input value="" id="planilla" name="planilla" type="text" class='tex_area'></td>
	</tr> -->
</tbody> 
</table>
<p align="center"> 
	<input name=reg_envio type=button class="botones_largo" value='Generar registro de envio' onClick='enviar()' >
</p>
</form>
<span class=vinculos>
	<center><a href=javascript:back1()>Regresar a Listado</a></center>
</span>
<SCRIPT type="text/javascript">
<?php
$grupoMas->javascriptCalcularPrecio($numRadicados["local"],$numRadicados["nacional"],$numRadicados["grupo1"],$numRadicados["grupo2"]);
?>
</SCRIPT>
</body>
</html> 
