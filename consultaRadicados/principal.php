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



foreach ($_GET as $key => $valor)   ${$key} = $valor;
foreach ($_POST as $key => $valor)   ${$key} = $valor;


$ruta_raiz = "..";
$verradicado = $idRadicado;
$dependencia = 990;
$codusuario = 300;
$verrad = $idRadicado;
$ent = substr($idRadicado,-1);
error_reporting(7);
$iTpRad = 10;
//include "$ruta_raiz/ver_datosrad.php";
include "$ruta_raiz/config.php";
include "sessionWeb.php";

//Conexion a la base datos antigua de RIO
include "nuevaConexion.php";
$conexion = new nuevaConexion();
$conexion->conectar();
if($conexion->conectar()==true){
        //$imgQuery=$conexion->consultar("SELECT radi_path FROM radicado where radi_nume_radi = $verradicado");
        $imgQuery=$conexion->consultar("SELECT radi_path FROM radicado where radi_nume_radi = $verradicado");
	$imgPath=pg_fetch_array($imgQuery, null, PGSQL_ASSOC);
}


/** encriptacion de pagina para inactivar en una Hora
  */
  
$llave = date("YmdH") . "$verrad";
$password =md5($llave);
$fechah=date("YmdHis");
// Finaliza Historicos
?>
<html lang="es">
<head>
<title>SISTEMA DE GESTION DOCUMENTAL - CIUDADANOS</title>
<meta 
<meta http-equiv="Content-Type" charset="UTF-8" content="text/html;">
<!-- CSS -->
<link rel="stylesheet" href="css/structure2.css" type="text/css" />
<link rel="stylesheet" href="css/form.css" type="text/css" />
<style type="text/css">
<!--
@import url("web.css");
-->
</style><script language="JavaScript" type="text/JavaScript">
<!--
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}
function Start(URL, WIDTH, HEIGHT) {
windowprops = "top=0,left=0,location=no,status=no, menubar=no,scrollbars=yes, resizable=yes,width=1020,height=500";
preview = window.open(URL , "preview", windowprops);
}
//-->
</script>
</head>
<body bgcolor="#ffffff">
<form name=form_cerrar action=index_web.php?<?=session_name()."=".session_id()."&fechah=$fechah&krd=$krd"?> method=post>
</form>
<?
//	include "cabez.php";

?>
			<!--<h2><?=$entidad_largo?></h2>-->
<div class="datagrid">

<table width="90%" summary="Esta tabla contiene la información general sobre el radicado consultado
			    y el estado actual del tramite">
<caption><h4>INFORMACION DEL DOCUMENTO CON NUMERO DE RADICADO <?=$verradicado?>   

</h4></caption>
<thead>
<tr>
<th width="11%">TIPO DOCUMENTO</th>
<th width="11%">FECHA RADICADO </th>
<th width="30%">ASUNTO </th>
<th width="30%"><?=$tip3Nombre[1][$ent]?></th>
<th width="11%">DIRECCI&Oacute;N </th>
<th width="11%">MUN/DPTO</th>
<th width="11%">IMAGEN PRINCIPAL </th>
</tr>
</thead>
<tbody>
<?


// MODIFICADO POR SKINATECH SEPT 21/09
//	$isql = "select SGD_TPR_DESCRIP FROM SGD_TPR_TPDCUMENTO where sgd_tpr_codigo='$tdoc'";
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/*
$isql = "select SGD_TPR_DESCRIP FROM SGD_TPR_TPDCUMENTO T, RADICADO R where R.radi_nume_radi='$verradicado' and R.tdoc_codi=t.sgd_tpr_codigo";
$rs=$db->query($isql);
echo("--------------------------");
	if  (!$rs->EOF){
		$tpdoc_nombre = $rs->fields["SGD_TPR_DESCRIP"];
echo("-------------------------- ".$tpdoc_nombre);
	}
*/
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


if($conexion->conectar()==true){
	$radiquery=$conexion->consultar("SELECT * FROM radicado where radi_nume_radi = $verradicado");

	$tprDescript=$conexion->consultar("select SGD_TPR_DESCRIP FROM sgd_tpr_tpdcumento where sgd_tpr_codigo = (select tdoc_codi from  RADICADO  where radi_nume_radi = '$verradicado')");

	$resDepMuniQuery = $conexion->consultar("select DIR.sgd_dir_nomremdes , DIR.sgd_dir_direccion , DEP.dpto_nomb , MUNI.muni_nomb FROM sgd_dir_drecciones DIR , departamento DEP , municipio MUNI where DIR.radi_nume_radi = '$verradicado' AND DEP.dpto_codi = DIR.dpto_codi AND MUNI.muni_codi = DIR.muni_codi AND MUNI.dpto_codi = DEP.dpto_codi");

	$infoRad = pg_fetch_array($radiquery, null, PGSQL_ASSOC); 
	$descript = pg_fetch_array($tprDescript, null, PGSQL_ASSOC);
	$resDepMuni =pg_fetch_array($resDepMuniQuery, null, PGSQL_ASSOC);
 
	$tpdoc_nombre = $descript["sgd_tpr_descrip"];
	$radi_fech_radi= $infoRad["radi_fech_radi"]; 
	$ra_asun = $infoRad["ra_asun"];
	$nombret_us1 = $resDepMuni["sgd_dir_nomremdes"]; 
	$direccion_us1 = $resDepMuni["sgd_dir_direccion"];
	$dpto_nombre_us1 = $resDepMuni["dpto_nomb"];
	$muni_nombre_us1 = $resDepMuni["muni_nomb"];
	$cuentai = (!empty($cuentai)) ? $cuentai: "-" ;// Ningun ejemplo encontrado
//	$flujo_nombre = "-"; //pendiente

	}

?>

<td><?=$tpdoc_nombre ?></td>
<td><?=$radi_fech_radi ?></td>
<td><?=$ra_asun ?></td>
<td><?=$nombret_us1 ?> </td>
<td><?=$direccion_us1 ?></td>
<td><?=$dpto_nombre_us1."/".$muni_nombre_us1 ?></td>
<td>

<?php
$extension=strtoupper(substr($imgPath["radi_path"],-3));
if ($extension =="TIF"  or  $extension=="PDF" or $extension=="CSV" or $extension=="JPG" or $extension=="DOCX" or $extension=="XLS"){
        ?>
        <a href='<?=$ruta_raiz?>/bodega-OLD/<?=$imgPath["radi_path"]?>' title='Abrir Imagén del documento consultado'  aria-label='Abrir Imagén del documento consultado'><h3>(Ver Imagen del documento)</h3></a>
<?php }else{
echo("No registra");
}?>

</td>

<?
/*
if(!$flujo_nombre and $radi_depe_actu=='999') $flujo_nombre = "Finalizado"; 
else {
	if(!$flujo_nombre) $flujo_nombre = "En Tramite";
	}
*/
?>

<td> 
<?
///////////////////////////////////////////////////////////////////?????????
/*
$rs=$db->query($isql);
$iFld = 0;
if(!$rs->EOF){
	$flujo = $rs->fields["SGD_TPR_TERMINO"];
	//$flujo_nombre = $rs->fields["SGD_FLD_DESC"];			
	}
echo $flujo_nombre;
*/
?> 
</td>
</tr>
</tbody>
</table> 
</div>


<div class="datagrid">
<table width="90%" summary="Esta tabla contiene el detalle de los documentos que han sido anexados al 
			    radicado consultado, si alguno esta digitalizado puede ver la imagen del mismo.">

<?
$i=1;
if($conexion->conectar()==true){
$radiAnexo=$conexion->consultar("SELECT * FROM anexos  where  anex_radi_nume = $verradicado");
$infoAnexo = pg_fetch_all($radiAnexo);
$conexion->destruir();

	?>
	<caption><h4>DOCUMENTOS ANEXOS DE LA SOLICITUD</h4></caption>
	<thead>
	<tr>
	<th width="15%">TIPO</th>
	<th width="15%">RADICADO</th>
	<th width="15%">FECHA</th>
	<th width="25%">ASUNTO</th>
	<th width="15%">DIGITALIZACI&Oacute;N</th>
	</tr>
	</thead>
	<tbody>
	  <?

	foreach($infoAnexo as $info){
		$radEnviado = $info["radi_nume_salida"];
		$anex_codigo = $info["anex_codigo"];
		$ano=substr($anex_codigo, 0, 4);
		$depe=substr($anex_codigo, 5, 3);
		$radi_path="/".$ano ."/".$depe ."/docs/";
		$long=strlen($anex_codigo);
		$anex_salida = $info["radi_nume_salida"];

	if($anex_salida!=NULL) $anex_codigo=$anex_salida;       
	if($long>14){
		$radEnviado=substr($anex_codigo, 0, 14);
	}

	switch(substr($anex_codigo,-1)){
		case 1;
			$tipoDocumentoAnexo = "Salida";
			break;
		case 2;
			$tipoDocumentoAnexo = "Entrada";
			break;
		case 3;
			$tipoDocumentoAnexo = "Memorando";
			break;
	}

	$verImagen = "";
	$anex = $info["anex_nomb_archivo"];
	$radEnviado = $info["anex_radi_nume"];
	$radFecha = $info["anex_radi_fech"];
	$radiPath= $radi_path;
	$ra_asun = $info["anex_desc"];
	$ext = explode(".",$anex);
	$tipoExt=$ext[1];
	$tipo=strtoupper($tipoExt);
	if($tipo =="TIF"  or  $tipo=="PDF" or $tipo=="CSV" or $tipo=="JPG" or $tipo=="DOCX" or $tipo=="XLS" ){
		$ruta = substr($radi_path, 0, 15);
 	        $pathImagen=$ruta_raiz ."/bodega-OLD/". $ruta . $anex;
	 	$verImagen = "<a href='$pathImagen' Target='ImagenOrfeo_$radEnviado' aria-label='Abrir Imagén de radicado'><b>Abrir Imag&eacute;n</b></a>";
	}

	$pathImagen = "";
      
	if($radDev){
		$imgRadDev = "<img src='$ruta_raiz/imagenes/devueltos.gif' alt='Documento Devuelto por empresa de Mensajeria' title='Documento Devuelto por empresa de Mensajeria'>";
	}else{
		$imgRadDev = "";
	}
	$i=1;
	?>
	<td><?=$tipoDocumentoAnexo?></td>
	<td><?=$imgRadDev?><?=$anex_codigo?></td>
	<td><?=$info["anex_radi_fech"]?></td>
	<td> <?=$info["anex_desc"] ?> </td>
	<td><?=$verImagen?> </td>
	</tr>
	<?
	$i=$i++;
	} 
}
?>
</tbody>
</table>
</div>
<div class= "buttons">
<input type="button" name="Cerrar" value="Volver" onclick="history.go(-1);" />
</div>

</table>
</div>
</CENTER>
</body>
</html>
