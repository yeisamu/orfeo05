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


/**
 * Programa que egistra el env�o de grupos de correspondencia masiva, registra las transacciones seleccionadas desde envio_masiva.php
 * @author      Sixto Angel Pinz�n
 * @version     1.0
 */

session_start();
$ruta_raiz = "..";
//print ("ARRANCA CON LA DEPENDENCIA($dependencia)($krd)($dependencia)");
require_once("$ruta_raiz/include/db/ConnectionHandler.php");

if (!$db)	$db = new ConnectionHandler($ruta_raiz);
$db->conn->BeginTrans();
$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);	

//De ser necesario recupera la sesion
if (!$codusuario or !$dependencia or !$usua_doc)	include "$ruta_raiz/rec_session.php";

$fecha_hoy = Date("Y-m-d");
$sqlFechaHoy=$db->conn->DBDate($fecha_hoy);
?>
<html>
<head>
<title>Enviar Datos</title>
<link href="<?= $ruta_raiz . $ESTILOS_PATH2 ?>bootstrap.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="<?= $ruta_raiz . $_SESSION['ESTILOS_PATH_ORFEO'] ?>">
</head>
<form name="form1" method="post" action="cuerpo_masiva.php?<?=session_name()."=".session_id()."&krd=$krd" ?>" class="borde_tab">
<?php
//almacena el query	
$isql = "UPDATE SGD_RENV_REGENVIO 
		SET 	sgd_renv_tipo = '2',
			depe_codi='$dependencia',
			sgd_fenv_codigo='$empresa_envio'
		WHERE sgd_renv_planilla is NULL and sgd_renv_tipo = 1
			and radi_nume_grupo = '$grupo' and radi_nume_sal not in 
				(select sgd_rmr_radi  from sgd_rmr_radmasivre  where sgd_rmr_grupo='$grupo') ";		
$rs=$db->query($isql);
if (!$rs)
{
	$db->conn->RollbackTrans();
	die ("<span class='etextomenu'>No se ha podido actualizar SGD_RENV_REGENVIO ($isql)"); 
}
$nombre_us = substr($nombre_us,0,29);
//arreglo de los campos a actualizar
$values["usua_doc"] = "'$usua_doc'";
$values["sgd_renv_codigo"] = "'".$renv_codigo."'";	
$values["sgd_fenv_codigo"] = "'$empresa_envio'";
$values["sgd_renv_fech"] = "$sqlFechaHoy";
$values["sgd_renv_telefono"] = "'$telefono'";
$values["sgd_renv_mail"] = "'$mail'";
$values["sgd_renv_peso"] = "'$envio_peso'";
$values["sgd_renv_certificado"] = 0;
$values["sgd_renv_estado"] = 1;
$values["sgd_renv_nombre"] = "'Varios'";
$values["sgd_dir_codigo"] = "0";
$values["sgd_dir_tipo"] = 1;
$values["depe_codi"] = "'$dependencia'";
$values["radi_nume_grupo"] = "'$grupo'";
$values["sgd_renv_dir"] = "'Varios'";
$values["sgd_renv_depto"] = "'$departamento_us'";
$values["sgd_renv_planilla"] = "'$planilla'";
$values["sgd_renv_observa"] = "'$observaciones'";

//Si existen documentos nacionales												
if ($nacional>0)
{
	$values["radi_nume_sal"] = "'$primRadNac'";
	$values["sgd_renv_destino"] = "'Nacional'";
	$values["sgd_renv_valor"] = "'$valor_unit_nacional'";
	$values["sgd_renv_mpio"] = "'Nacional'";;
	$values["sgd_renv_cantidad"] = "'$nacional'";
	$rs=$db->insert("sgd_renv_regenvio",$values);
	if (!$rs)
	{
		$db->conn->RollbackTrans();
		die ("<span class='etextomenu'>No se ha podido insetar la informacion de nacionales en en sgd_renv_regenvio");
}	}

//Si existen documentos locales												
if ($local>0)
{
	$values["radi_nume_sal"] = "'$primRadLoc'";
	$values["sgd_renv_destino"] = "'Local'";
	$values["sgd_renv_valor"] = "'$valor_unit_local'";
	$values["sgd_renv_mpio"] = "'Local'";;
	$values["sgd_renv_cantidad"] = "'$local'";
	$rs=$db->insert("sgd_renv_regenvio",$values);
	if (!$rs)
	{
		$db->conn->RollbackTrans();
		die ("<span class='etextomenu'>No se ha podido insetar la informacion de locales en en sgd_renv_regenvio");
}	}

//Si existen documentos internacionales grupo1												
if ($_POST['grupo1'] > 0)
{
	$values["radi_nume_sal"] = "'$primRadG1'";
	$values["sgd_renv_destino"] = "'Int. G1'";
	$values["sgd_renv_valor"] = "'$valor_unit_grupo1'";
	$values["sgd_renv_mpio"] = "'Int. G1'";;
	$values["sgd_renv_cantidad"] = "'".$_POST['grupo1']."'";
	$rs=$db->insert("sgd_renv_regenvio",$values);
	
	if (!$rs)
	{
		$db->conn->RollbackTrans();
		die ("<span class='etextomenu'>No se ha podido insetar la informacion de Int. Grupo1 en sgd_renv_regenvio");
}	}

//Si existen documentos internacionales grupo2										
if ($_POST['grupo2'] > 0)
{
	$values["radi_nume_sal"] = "'$primRadG2'";
	$values["sgd_renv_destino"] = "'Int. G2'";
	$values["sgd_renv_valor"] = "'$valor_unit_grupo2'";
	$values["sgd_renv_mpio"] = "'Int. G2'";;
	$values["sgd_renv_cantidad"] = "'".$_POST['grupo1']."'";
	$rs=$db->insert("sgd_renv_regenvio",$values);
	
	if (!$rs)
	{
		$db->conn->RollbackTrans();
		die ("<span class='etextomenu'>No se ha podido insetar la informacion de Int. Grupo2 en sgd_renv_regenvio");
}	}

$db->conn->CommitTrans();
?>
<br>
<!--<table width="100%" class="borde_tab">
	<tr><td class="titulos5"><center><b>Confirmación del envío - radicación masiva <br>
	se han marcado como enviados los radicados del grupo  </b></center>
	</td></tr>
</table>-->

<center>
        <div id="titulo" style="width: 43%;" align="center">Confirmación del envío - radicación masiva
	se han marcado como enviados los radicados del grupo -</div>
<table border="2" width=43% class="borde_tab" align="center">
<tr  class="titulos2" align="center">
	<td valign="top" width="12%" >Grupo</td>
	<td   valign="top" width="12%" >Destino</td>
	<td  valign="top" width="17%" >Documentos</td>
	<td valign="top" width="28%" >Valor total</font></td>
</tr>
<tr class=listado2>
	<td height="44" valign="middle" align="center" valign="top" rowspan="4">
		<? echo ($rangoini."<br>-<br>".$rangofin);?>
	</td>
	<td height="21" align="center" valign="top" width="12%">Local</td>
	<td align="center" valign="top" width="17%"><?=$_POST['local']?></td>
	<td width="28%" align="center"><?=$_POST['valor_total_local']?></td>
</tr>
<tr class=listado2>
	<td height="21" align="center" valign="top" width="12%">Nacional</td>
	<td align="center" valign="top" width="17%"> <?=$_POST['nacional']?></td>
	<td width="28%" align="center"> <?=$_POST['valor_total_nacional']?></td>
</tr>
<tr class=listado2>
	<td height="21" align="center" valign="top" width="12%">Int. G1</td>
	<td align="center" valign="top" width="17%"><?=$_POST['grupo1']?></td>
	<td width="28%" align="center"><?=$_POST['valor_total_grupo1']?></td>
</tr>
<tr class=listado2>
	<td height="21" align="center" valign="top" width="12%">Int. G2</td>
	<td align="center" valign="top" width="17%"> <?=$_POST['grupo2']?></td>
	<td width="28%" align="center"> <?=$_POST['valor_total_grupo2']?></td>
</tr>
<tr class="listado2"> 
	<td width="12%">&nbsp;</td>
	<td width="12%">&nbsp;</td>
	<td width="17%">&nbsp;</td>
	<td width="28%">&nbsp;</td>
</tr>
<TR>
    <TD style="text-align: center" colspan="4" class="listado1">
        <input type=submit class="botones" name=aceptar id=aceptar value=Aceptar>
    </TD>
</TR>
</table> 
</form>
</BODY>
</HTML>
