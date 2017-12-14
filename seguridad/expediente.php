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


	error_reporting(7); 
	$krdold = $krd;
 	session_start(); 
	$ruta_raiz = ".."; 	
	if(!$krd) $krd = $krdold;
	//include "$ruta_raiz/rec_session.php";	
 	error_reporting(7);

	if (!$nurad) $nurad= $rad;
	if($nurad)
	{
		$ent = substr($nurad,-1);
	}
    include_once("$ruta_raiz/include/db/ConnectionHandler.php");
	$db = new ConnectionHandler("$ruta_raiz");
	include_once "$ruta_raiz/include/tx/Historico.php";
	//include_once ("$ruta_raiz/class_control/TipoDocumental.php");
	include_once "$ruta_raiz/include/tx/Expediente.php";
	//$trd = new TipoDocumental($db);
	//$db->conn->debug = true;	
?>
<html>
<head>
<title>Cambiar Seguridad a Expediente</title>
<link href="../estilos/orfeo.css" rel="stylesheet" type="text/css"><script>

function regresar(){   	
	document.TipoDocu.submit();
}
</script><style type="text/css">
<!--
.style1 {font-size: 14px}
-->
</style>
</head>
<body bgcolor="#FFFFFF">
<?

?>


<form method="post" action="expediente.php?krd=<?=$krd?>&numrad=<?=$numrad?>&num_expediente=<?=$num_expediente?>&nivelExp=<?=$nivelExp?>" name="TipoDocu">
 
<table border=0 width=70% align="center" class="borde_tab" cellspacing="0">
	<tr align="center" class="titulos2">
		<td height="15" class="titulos2">CAMBIAR NIVEL DE SEGURIDAD AL EXPEDIENTE No. <?=$num_expediente?></td>
		</tr>
</table> 
<table><tr><td></td></tr></table>
<table width="80%" border="0" cellspacing="1" cellpadding="0" align="center" class="borde_tab">
<tr >
<td width="62%" class="titulos5" >Nivel:</td>
<td width="38%" class=listado5 >
<select name=nivelExp class=select>
<?
if($nivelExp==0)  $datoss = " selected "; else $datoss = "";
?>
<option value=0 <?=$datoss?>>P&uacute;blico</option>
<?
if($nivelExp==1)  $datoss = " selected "; else $datoss = "";
?>
<option value=1 <?=$datoss?>>Privado solo jefe</option>
<?
if($nivelExp==2)  $datoss = " selected "; else $datoss = "";
?>
<option value=2 <?=$datoss?>>Privado dependencia</option>
</select>
</td>
</tr>
<tr><TD class=listado5 COLSPAN=2 ><center>Si selecciona Privado, La Dependencia de la persona que posee el Expediente ser&aacute; la &uacute;nica que podr&aacute; ver los radicados de dicho Expediente.</TD></tr>
</center><tr>
<td class=listado5  align="center">
<center><input type="submit" class="botones" name=grbNivel value="Grabar Nivel">
</td>
<td class=listado5  align="center">
<input name="Cerrar" type="button" class="botones" id="envia22" onClick="opener.regresar();window.close();"value="Cerrar"></center>
</td>
</tr>
	<tr>
		<td class="titulos5" colspan="2" ><center>&nbsp;<?=$descTipoExpediente?> - <?=$expDesc?></center></td>
	</tr>
</table>
<br>
<br>
</form>
</span>
<p>
<?
if($grbNivel and $num_expediente)
{
	if($nivelExp==1){
		$query = "UPDATE SGD_EXP_EXPEDIENTE SET SGD_EXP_PRIVADO=1 where SGD_EXP_NUMERO='$num_expediente'";
		$query2 = "UPDATE SGD_SEXP_SECEXPEDIENTES SET SGD_EXP_PRIVADO=1 where SGD_EXP_NUMERO='$num_expediente'";

		$observa = "Expediente Confidencial solo Jefe";
	}
	elseif ($nivelExp == 0) 
	{
		$query = "UPDATE SGD_EXP_EXPEDIENTE SET SGD_EXP_PRIVADO=0 where SGD_EXP_NUMERO='$num_expediente'";
		$query2 = "UPDATE SGD_SEXP_SECEXPEDIENTES SET SGD_EXP_PRIVADO=0 where SGD_EXP_NUMERO='$num_expediente'";

		$observa = "Expediente Publico.";
	}elseif ($nivelExp == 2) 
	{
		$query = "UPDATE SGD_EXP_EXPEDIENTE SET SGD_EXP_PRIVADO=2 where SGD_EXP_NUMERO='$num_expediente'";
		$query2 = "UPDATE SGD_SEXP_SECEXPEDIENTES SET SGD_EXP_PRIVADO=2 where SGD_EXP_NUMERO='$num_expediente'";

		$observa = "Expediente Confidencial dependencia.";
	}
	if($db->conn->Execute($query) && $db->conn->Execute($query2))
	{
		echo "<span class=leidos>El nivel se actualiz&oacute; correctamente. ";
		include_once "$ruta_raiz/include/tx/Historico.php";
		$codiRegH = "";
		$Historico = new Historico($db);		  
  		  //$radiModi = $Historico->insertarHistorico($codiRegE, $coddepe, $codusua, $coddepe, $codusua, $observa, 33); 
  		
  		$codiRegR[0] = $numrad;
		$radiModi = $Historico->insertarHistoricoExp($num_expediente,$codiRegR , $dependencia, $codusuario, $observa, 60, 0); 
		
	}else 
	{
		echo "<span class=titulosError> !No se pudo actualizar el nivel para el expediente!";
	}
}
?>
<?=$mensaje_err?>
</p>
</span>
</body>
</html>
