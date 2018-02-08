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


 $krdOld = $krd;
session_start();

if(!$krd) $krd = $krdOld;
if (!$ruta_raiz) $ruta_raiz = "..";
//include "$ruta_raiz/rec_session.php";
include_once("$ruta_raiz/include/db/ConnectionHandler.php");
	$db = new ConnectionHandler("$ruta_raiz");
	$db2 = new ConnectionHandler("$ruta_raiz");
	$encabezadol = "$PHP_SELF?".session_name()."=".session_id()."&dependencia=$dependencia&krd=$krd&sel=$sel";
	$encabezado = session_name()."=".session_id()."&krd=$krd&tipo_archivo=1&nomcarpeta=$nomcarpeta";

	function fnc_date_calcy($this_date,$num_years){
	$my_time = strtotime ($this_date); //converts date string to UNIX timestamp
   	$timestamp = $my_time + ($num_years * 86400); //calculates # of days passed ($num_days) * # seconds in a day (86400)
    $return_date = date("Y-m-d",$timestamp);  //puts the UNIX timestamp back into string format
    return $return_date;//exit function and return string
   }
    function fnc_date_calcm($this_date,$num_month){
	$my_time = strtotime ($this_date); //converts date string to UNIX timestamp
   	$timestamp = $my_time - ($num_month * 2678400 ); //calculates # of days passed ($num_days) * # seconds in a day (86400)
    $return_date = date("Y-m-d",$timestamp);  //puts the UNIX timestamp back into string format
    return $return_date;//exit function and return string
    }
?>
<html height=50,width=150>
<head>
<title>Busqueda Archivo Central</title>
<link rel="stylesheet" href="../estilos/orfeo.css">
<CENTER>
<body bgcolor="#FFFFFF">
<div id="spiffycalendar" class="text"></div>
 <link rel="stylesheet" type="text/css" href="../js/spiffyCal/spiffyCal_v2_1.css">
 <script language="JavaScript" src="../js/spiffyCal/spiffyCal_v2_1.js">


 </script>



<form name=busqueda_central action="<?=$encabezadol?>" method='post' action='busqueda_central.php?<?=session_name()?>=<?=trim(session_id())?>krd=<?=$krd?>'>
<br>

<table border=0 width="90%" cellpadding="0"  class="borde_tab">
  <td class=titulosError  width="80%" colspan="4" align="center">BUSQUEDA ARCHIVO CENTRAL </td>

<? // parametrizacion de items
	/*include("$ruta_raiz/include/query/archivo/queryBusqueda_central.php");
	$rs=$db->query($sql1);
	$item11=$rs->fields["SGD_EIT_NOMBRE"];
	$tm=explode('1',$item11);
	$item1=$tm[0];
	include("$ruta_raiz/include/query/archivo/queryBusqueda_central.php");
	$rs=$db->query($sql6);
	$item31=$rs->fields["SGD_EIT_NOMBRE"];
	$tm=explode('1',$item31);
	$item3=$tm[0];
	include("$ruta_raiz/include/query/archivo/queryBusqueda_central.php");
	$rs=$db->query($sql7);
	$item41=$rs->fields["SGD_EIT_NOMBRE"];
	$tm=explode('1',$item41);
	$item4=$tm[0];
	include("$ruta_raiz/include/query/archivo/queryBusqueda_central.php");
	$rs=$db->query($sql8);
	$item51=$rs->fields["SGD_EIT_NOMBRE"];
	$tm=explode('1',$item51);
	$item5=$tm[0];
	include("$ruta_raiz/include/query/archivo/queryBusqueda_central.php");
	$rs=$db->query($sql9);
	$item61=$rs->fields["SGD_EIT_NOMBRE"];
	$tm=explode('1',$item61);
	$item6=$tm[0];*/
        // MODIFICADO POR SKINA JUNIO 4/09
	//$item1="CARRO";
	$item1="ENTREPANO";
	
        $item3="CARA";
	$item4="ESTANTE";
	$item5="ENTREPANO";
	$item6="CAJA";
?>

<tr>
<!-- MODIFICADO POR SKINA JUNIO 4/09
<td width="20%" class='titulos2' align="left">NRO DE DOCUMENTO </td>-->
<td width="20%" class='titulos2' align="left"><label for="buscar_orden">NOMBRES</label> </td>
	<td width="20%" class='titulos2'><input type=text name=buscar_orden id="buscar_orden" value='<?=$buscar_orden?>' class="tex_area" title="Buscar por nombre de persona que radicó">
    </td>
    <td width="20%" class='titulos2' align="left"><label for="buscar_rad"> RADICADO</label> </td>
	<td width="20%" class='titulos2'><input type=text name=buscar_rad id="buscar_rad" value='<?=$buscar_rad?>' class="tex_area" title="Buscar por número de radicado">
	</td>
	</tr>
	<!-- MODIFICADO POR SKINA JUNIO 4/09-->
        <!-- <tr><td width="20%" class='titulos2' align="left">QUERELLADO O TITULO</td>-->
	<tr><td width="20%" class='titulos2' align="left"><label for="buscar_deman">APELLIDOS</label></td>
<td width="20%" class='titulos2'><input type=text name=buscar_deman value='<?=$buscar_deman?>' id="buscar_deman" class="tex_area" title="Buscar por appellidos de quien radicó"></td>
<!-- MODIFICADO POR SKINA JUNIO 4/09
<td width="20%" class='titulos2'>QUERELLANTE </td>-->
<td width="20%" class='titulos2'><label for="buscar_demant">DOCUMENTO</label></td>
<td width="20%" class='titulos2'><input type=text id="buscar_demant" name=buscar_demant value='<?=$buscar_demant?>' class="tex_area" title="Buscar por documento de quien radicó"></td></tr>
<tr><td width="20%" class='titulos2' align="left"> <label for="sep">FECHA INICIAL</label> &nbsp;&nbsp;&nbsp;&nbsp; <label for="fechaIni"> Desde </label> <br>&nbsp;&nbsp;&nbsp;
            <?
			if($sep == 1) $datoss = "checked"; else $datoss= "";
			?>
            <input name="sep" type="checkbox" class="select" value="1" <?=$datoss?> id="sep">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label for="fechaInif">Hasta</label>
            </td>
	<td width="20%" class='titulos2'>
	<script language="javascript">
  	<?
	 	if(!$fechaIni) $fechaIni=fnc_date_calcm(date('Y-m-d'),'1');
	 	if(!$fechaInif) $fechaInif = date('Y-m-d');
  	?>
   	var dateAvailable1 = new ctlSpiffyCalendarBox("dateAvailable1", "busqueda_central", "fechaIni","btnDate1","<?=$fechaIni?>",scBTNMODE_CUSTOMBLUE);
	dateAvailable1.date = "<?=date('Y-m-d');?>";
	dateAvailable1.writeControl();
	dateAvailable1.dateFormat="yyyy-MM-dd";
	</script>
	<br>&nbsp;
	<script language="javascript">
	var dateAvailable2 = new ctlSpiffyCalendarBox("dateAvailable2", "busqueda_central", "fechaInif","btnDate2","<?=$fechaInif?>",scBTNMODE_CUSTOMBLUE);
	dateAvailable2.date = "<?=date('Y-m-d');?>";
	dateAvailable2.writeControl();
	dateAvailable2.dateFormat="yyyy-MM-dd";
	</script>

            </td>
	    <td width="20%" class='titulos2' align="left"><label for="sep2"> FECHA FINAL</label> &nbsp;&nbsp;&nbsp;&nbsp; <label for="fechaIni2"> Desde</label>  <br>&nbsp;&nbsp;&nbsp;
            <?
			if($sep2 == 1) $datoss2 = "checked"; else $datoss2= "";
			?>
            <input name="sep2" type="checkbox" class="select" value="1" <?=$datoss2?> id="sep2">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label for="fechaInif2">Hasta</label>
            </td>
	<td width="20%" class='titulos2'>
	<script language="javascript">
  	<?
	 	if(!$fechaIni2) $fechaIni2=fnc_date_calcm(date('Y-m-d'),'1');
	 	if(!$fechaInif2) $fechaInif2 = date('Y-m-d');
  	?>
   	var dateAvailable3 = new ctlSpiffyCalendarBox("dateAvailable3", "busqueda_central", "fechaIni2","btnDate3","<?=$fechaIni2?>",scBTNMODE_CUSTOMBLUE);
	dateAvailable3.date = "<?=date('Y-m-d');?>";
	dateAvailable3.writeControl();
	dateAvailable3.dateFormat="yyyy-MM-dd";
	</script>
	<br>&nbsp;
	<script language="javascript">
	var dateAvailable4 = new ctlSpiffyCalendarBox("dateAvailable4", "busqueda_central", "fechaInif2","btnDate4","<?=$fechaInif2?>",scBTNMODE_CUSTOMBLUE);
	dateAvailable4.date = "<?=date('Y-m-d');?>";
	dateAvailable4.writeControl();
	dateAvailable4.dateFormat="yyyy-MM-dd";
	</script>

            </td></tr>
	    
	<tr><td width="20%" class='titulos2' align="left"><label for="buscar_proc">TIPO</label> </td>
	<td width="20%" class='titulos2'>
	<?
  $seleD="";
  $seleES="";
  switch($buscar_proc){
  	case 1: $seleD="selected";
		break;
  	case 2: $seleES="selected";
		break;
  }
  ?>
        <!-- MODIFICADO POR SKINA JUNIO 4/09 -->
          <select class="select" name="buscar_proc" id="buscar_proc" title="Clasificación del documento">
	  <option value="0" <?=$sele0?>>Todos</option>
	  <!--<option value="1" <?=$seleD?>>Querellas</option>-->
	  <option value="1" <?=$seleD?>>Historias Laborales</option>
    <option value="2" <?=$seleES?>>Otros</option>
	  </select>
	  </td>
	  <td width="20%" class='titulos2'><label for="depen">DEPENDENCIA</label> </td>
   <TD width="20%" class='titulos2' >
				<? 
				$conD=$db->conn->Concat("DEPE_CODI","'-'","DEPE_NOMB");
				$sql5="select ($conD) as detalle,DEPE_CODI from DEPENDENCIA order by DEPE_CODI";
			      //$db->conn->debug=true;
				$rs=$db->conn->Execute($sql5);
				print $rs->GetMenu2('depen',$depen,true,false,"","class=select id='depen' title='Listado de todas las dependencias'");
				?>
</td>
	</tr>
    	<tr> 
	<td width="20%" class='titulos2' align="left"><label for="buscar_ano">AÑO</label></td>
	<td width="20%" class='titulos2'>
	<select class="select" name="buscar_ano" id="buscar_ano" title="Buscar documentos por año">
          <?
	$agnoactual=Date('Y');
	for($i = 1986; $i <= $agnoactual; $i++)
	{
		if($i == $buscar_ano) $option="<option SELECTED value=\"" . $buscar_ano . "\">" . $buscar_ano . "</option>";
		elseif($i == 1986)$option="<option value=\"\"> TODOS</option>";
		else $option="<option value=\"" . $i . "\">" . $i . "</option>";
		echo $option;
	}
	?>
          </select>
	  <input type="hidden" name="yea" value="<?=$buscar_ano?>">
	</td>
	<!-- MODIFICADO POR SKINA JUNIO4/09
        <td width="20%" class='titulos2' align="left">CEDULA DEMANDANTE-->
	<td width="20%" class='titulos2' align="left"><label for="buscar_docu">NO. FOLIOS</label>
	</td>
   <td width="20%" class='titulos2'><input type=text name=buscar_docu value='<?=$buscar_docu?>' id="buscar_docu" class="tex_area" title="Buscar por número de folios">
   </td></tr>
<!-- MODIFICADO POR SKINA JUNIO 4/09
<tr><td width="20%" class='titulos2' align="left">ZONA </td>-->
<tr><td width="20%" class='titulos2' align="left"><label for="buscar_zona">ESTANTE</label></td>
<td width="20%" class='titulos2'><input type=text name=buscar_zona value='<?=$buscar_zona?>' class="tex_area" size=4 maxlength="3" id="buscar_zona" title="buscar por número de estante"></td>
<?/*
$edi=$db->conn->Execute("select sgd_eit_codigo from sgd_eit_items where sgd_eit_nombre like 'central' or sgd_eit_nombre like 'CENTRAL' ");
$edi1=$edi->fields['SGD_EIT_CODIGO'];
  $query="select SGD_EIT_NOMBRE,SGD_EIT_CODIGO from SGD_EIT_ITEMS where SGD_EIT_COD_PADRE LIKE '$edi1'";
  $rs1=$db->conn->query($query);
  print $rs1->GetMenu2('buscar_zona',$buscar_zona,true,false,"","onChange='submit()' class=select");*/
  ?>


<td width="20%" class='titulos2'><label for="buscar_carro"><?=$item1?></label> </td>
<td width="20%" class='titulos2'><input type=text name=buscar_carro value='<?=$buscar_carro?>' class="tex_area" size=4 maxlength="3" id="buscar_carro" title="Buscar por entrepaño"></td>
<?/*
				$sql="select SGD_EIT_NOMBRE,SGD_EIT_CODIGO from SGD_EIT_ITEMS where SGD_EIT_COD_PADRE LIKE '$buscar_zona'";
				$rs=$db->query($sql);
				print $rs->GetMenu2('buscar_carro',$buscar_carro,true,false,"","onChange='submit()'  class=select");
   		    	*/?>
</td></tr>

<!--MODIFICADO POR SKINA JUNIO 4/09
<tr><td width="20%" class='titulos2' align="left"><?=$item3?> </td>
<?
if($buscar_cara=="A")$sec1="checked";
elseif($buscar_cara=="B")$sec2="checked";
else $sec3="checked";
?>
<td width="20%" class='titulos2'><input type="radio" name="buscar_cara" value="A" <?=$sec1?>>A &nbsp;
<input type="radio" name="buscar_cara" value="B" <?=$sec2?>>B &nbsp;
<input type="radio" name="buscar_cara" value="" <?=$sec3?>>Ninguno &nbsp;</td> 
<?
/*
  $query="select SGD_EIT_NOMBRE,SGD_EIT_CODIGO from SGD_EIT_ITEMS where SGD_EIT_COD_PADRE LIKE '$buscar_carro'";
  $rs1=$db->conn->query($query);
  print $rs1->GetMenu2('buscar_cara',$buscar_cara,true,false,"","onChange='submit()' class=select");
  */?>

<td width="20%" class='titulos2'><?=$item4?> </td>
<td width="20%" class='titulos2'><input type=text name=buscar_estante value='<?=$buscar_estante?>' class="tex_area" size=6 maxlength="5"></td>
<?/*
		$sql="select SGD_EIT_NOMBRE,SGD_EIT_CODIGO from SGD_EIT_ITEMS where SGD_EIT_COD_PADRE LIKE '$buscar_cara'";
		$rs=$db->query($sql);
		print $rs->GetMenu2('buscar_estante',$buscar_estante,true,false,"","onChange='submit()' class=select");
	*/?>
</td></tr>

<tr><td width="20%" class='titulos2' align="left"><?=$item5?> </td>
<td width="20%" class='titulos2'><input type=text name=buscar_entre value='<?=$buscar_entre?>' class="tex_area" size=6 maxlength="5"></td>
<?/*

  $query="select SGD_EIT_NOMBRE,SGD_EIT_CODIGO from SGD_EIT_ITEMS where SGD_EIT_COD_PADRE LIKE '$buscar_estante'";
  $rs1=$db->conn->query($query);
  print $rs1->GetMenu2('buscar_entre',$buscar_entre,true,false,"","onChange='submit()' class=select");
  */?>
  <td width="20%" class='titulos2' align="left"><?=$item6?> </td>
<td width="20%" class='titulos2'><input type=text name=buscar_caja value='<?=$buscar_caja?>' class="tex_area" size=6 maxlength="5"></td>
<?
/*
  $query="select SGD_EIT_NOMBRE,SGD_EIT_CODIGO from SGD_EIT_ITEMS where SGD_EIT_COD_PADRE LIKE '$buscar_entre'";
  $rs1=$db->conn->query($query);
  print $rs1->GetMenu2('buscar_caja',$buscar_caja,true,false,"","onChange='submit()' class=select");
  */?>
  </tr>-->
<tr>
<td width="20%" class='titulos2' align="left">&nbsp;<label for="codserie">SERIE</label> </td>
<td width="20%" class='titulos2'>
	<?php
	if(!$tdoc) $tdoc = 0;
	if(!$codserie) $codserie = 0;
	if(!$tsub) $tsub = 0;
	$fechah=date("dmy") . " ". time("h_m_s");
	$fecha_hoy = Date("Y-m-d");
	$sqlFechaHoy=$db->conn->DBDate($fecha_hoy);
	$check=1;
	$fechaf=date("dmy") . "_" . time("hms");
	$num_car = 4;
	$nomb_varc = "s.sgd_srd_codigo";
	$nomb_varde = "s.sgd_srd_descrip";
	include "$ruta_raiz/include/query/trd/queryCodiDetalle.php";
	$querySerie = "select distinct ($sqlConcat) as detalle, s.sgd_srd_codigo from sgd_mrd_matrird m,
 	sgd_srd_seriesrd s where s.sgd_srd_codigo = m.sgd_srd_codigo and ".$sqlFechaHoy." between s.sgd_srd_fechini
 	and s.sgd_srd_fechfin order by detalle ";
	$rsD=$db->conn->query($querySerie);
	$comentarioDev = "Muestra las Series Docuementales";
	include "$ruta_raiz/include/tx/ComentarioTx.php";
	print $rsD->GetMenu2("codserie", $codserie, "0:-- Seleccione --", false,"","onChange='submit()' class='select' id='codserie' title='Buscar por número de serie'" );
	?>
	<td width="20%" class='titulos2' align="left"> <label for="tsub">SUBSERIE</label> </td>
	<td width="20%" class='titulos2'>
	<?
	$nomb_varc = "su.sgd_sbrd_codigo";
	$nomb_varde = "su.sgd_sbrd_descrip";
	include "$ruta_raiz/include/query/trd/queryCodiDetalle.php";
	$querySub = "select distinct ($sqlConcat) as detalle, su.sgd_sbrd_codigo from sgd_mrd_matrird m,
 	sgd_sbrd_subserierd su where m.sgd_srd_codigo = '$codserie' and su.sgd_srd_codigo = '$codserie'
			and su.sgd_sbrd_codigo = m.sgd_sbrd_codigo and ".$sqlFechaHoy." between su.sgd_sbrd_fechini
			and su.sgd_sbrd_fechfin order by detalle ";
	$rsSub=$db->conn->query($querySub);
	include "$ruta_raiz/include/tx/ComentarioTx.php";
	print $rsSub->GetMenu2("tsub", $tsub, "0:-- Seleccione --", false,""," class='select' id='tsub' title='Buscar por subserie'" );

	if(!$codiSRD)
	{
		$codiSRD = $codserie;
		$codiSBRD =$tsub;
	}

	?>
	</tr>
	    <tr>
	    <td width="20%" class='titulos2' align="left"><label for="buscar_inder">INDICADORES DE DETERIORO</label> </td>
<td width="20%" class='titulos2'>
<?
switch($buscar_inder){
  	case 1: $sele1="selected";
		break;
  	case 2: $sele2="selected";
		break;
	case 3: $sele3="selected";
		break;
	case 4: $sele4="selected";
		break;
	case 5: $sele5="selected";
		break;
	 }
  ?>
          <select class="select" name="buscar_inder" id="buscar_inder" title="Buscar por indicador de deterioro">
	  <option value="0" <?=$sele0?>>Ninguno</option>
	<option value="1" <?=$sele1?>>Biologicos: Hongos</option>
	<option value="2" <?=$sele2?>>Biologicos: Roedores</option>
	<option value="3" <?=$sele3?>>Biologicos: Insectos</option>
	<option value="4" <?=$sele4?>>Decoloracion Soporte</option>
	<option value="5" <?=$sele5?>>Desgarros</option>
	</select>
</td>
<td width="20%" class='titulos2' align="left"><label for="buscar_mata">MATERIALES INSERTADOS</label> </td>
<td width="20%" class='titulos2'>
<?
switch($buscar_mata){
  	case 1: $sele7="selected";
		break;
  	case 2: $sele8="selected";
		break;
	case 3: $sele9="selected";
		break;
	case 4: $sele10="selected";
		break;
	case 5: $sele11="selected";
		break;
	case 6: $sele12="selected";
		break;
	case 7: $sele13="selected";
		break;
	case 8: $sele14="selected";
		break;
	case 9: $sele15="selected";
		break;
	case 10: $sele16="selected";
		break;
	case 11: $sele17="selected";
		break;
	case 12: $sele18="selected";
		break;
	case 13: $sele19="selected";
		break;
	case 14: $sele20="selected";
		break;
	case 15: $sele21="selected";
		break;
	case 16: $sele22="selected";
		break;
	case 17: $sele23="selected";
		break;	
	case 18: $sele24="selected";
		break;
	case 19: $sele25="selected";
		break;
	case 20: $sele26="selected";
		break;
	case 21: $sele27="selected";
		break;
	 }
  ?>
          <select class="select" name="buscar_mata" id="buscar_mata" title="buscar por material">
	  <option value="0" <?=$sele0?>>Ninguno</option>
	<option value="1" <?=$sele7?>>Metalico</option>
	<option value="2" <?=$sele8?>>Post-it</option>
	<option value="3" <?=$sele9?>>Planos</option>
	<option value="4" <?=$sele10?>>Fotografia</option>
	<option value="5" <?=$sele11?>>Soporte Optico</option>
	<option value="6" <?=$sele12?>>Soporte Magnetico</option>
	<option value="7" <?=$sele13?>>Metalico y Post-it</option>
	<option value="8" <?=$sele14?>>Metalico y Planos </option>
	<option value="9" <?=$sele15?>>Metalico y Fotografia </option>
	<option value="10" <?=$sele16?>>Metalico y Soporte Optico </option>
	<option value="11" <?=$sele17?>>Metalico y Soporte Magnetico </option>
	<option value="12" <?=$sele18?>>Post-it y Planos</option>
	<option value="13" <?=$sele19?>>Post-it y Fotografia</option>
	<option value="14" <?=$sele20?>>Post-it y Soporte Optico</option>
	<option value="15" <?=$sele21?>>Post-it y Soporte Magnetico</option>
	<option value="16" <?=$sele22?>>Planos y Fotografia</option>
	<option value="17" <?=$sele23?>>Planos y Soporte Optico</option>
	<option value="18" <?=$sele24?>>Planos y Soporte Magnetico</option>
	<option value="19" <?=$sele25?>>Fotografia y Soporte Optico</option>
	<option value="20" <?=$sele26?>>Fotografia y Soporte Magnetico</option>
	<option value="21" <?=$sele27?>>Soporte Optico y Soporte Magnetico</option>
	</select>
</td>	
 </tr>
<TR><td class='titulos2' align="right" ><label for="presta">PRESTAMO</label></td>
<?
if($presta==1)$de="checked";else $de="";
?>
<td class='titulos2' align="left"><input type="checkbox" name="presta" id="presta" value=1 <?=$de?> title="Seleccione si desea pedir prestado el documento"> </td>
<td width="20%" class='titulos2' align="left"> <label for="sep3">FECHA RADICADO</label> &nbsp;&nbsp;&nbsp;&nbsp;  <label for="fechaIni3">Inicial</label>  <br>&nbsp;&nbsp;&nbsp;
            <?
			if($sep3 == 1) $datoss3 = "checked"; else $datoss3= "";
			?>
            <input name="sep3" type="checkbox" id="sep3" class="select" value="1" <?=$datoss3?>>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <label for="fechaInif3">Final</label>
            </td>
	<td width="20%" class='titulos2'>
	<script language="javascript">
  	<?
	 	if(!$fechaIni3) $fechaIni3=fnc_date_calcm(date('Y-m-d'),'1');
	 	if(!$fechaInif3) $fechaInif3 = date('Y-m-d');
  	?>
   	var dateAvailable5 = new ctlSpiffyCalendarBox("dateAvailable5", "busqueda_central", "fechaIni3","btnDate5","<?=$fechaIni3?>",scBTNMODE_CUSTOMBLUE);
	dateAvailable5.date = "<?=date('Y-m-d');?>";
	dateAvailable5.writeControl();
	dateAvailable5.dateFormat="yyyy-MM-dd";
	</script>
	<br>&nbsp;
	<script language="javascript">
	var dateAvailable6 = new ctlSpiffyCalendarBox("dateAvailable6", "busqueda_central", "fechaInif3","btnDate6","<?=$fechaInif3?>",scBTNMODE_CUSTOMBLUE);
	dateAvailable6.date = "<?=date('Y-m-d');?>";
	dateAvailable6.writeControl();
	dateAvailable6.dateFormat="yyyy-MM-dd";
	</script>

            </td>
</TR>
<td colspan="2" align="right"><input type=submit value=Buscar name=Buscar class="botones" aria-label="Buscar documentos por criterios ingresados">&nbsp;</td>
<td colspan="2" align="left"><a href='archivo.php?<?=session_name()?>=<?=trim(session_id())?>krd=<?=$krd?>'><input name='Regresar' align="middle" aria-label="Regresar al menú del módulo de archivo" type="button" class="botones" id="envia22" value="Regresar" ></td>
</table>
<br>
<?
if($Buscar){
include("$ruta_raiz/include/query/archivo/queryBusqueda_central.php");		
$dbg=$db->conn->Execute($sqla);
if(!$dbg->EOF)$usua_perm_archi=$dbg->fields['USUA_ADMIN_ARCHIVO'];
if($buscar_proc==2 or $codiSRD==8){
	$it1="NRO DE CARPETA";
	$it2="TITULO";
	$it3="REMITENTE";
}
else{
// MODIFICADO POR SKINA JUNIO 4/09
	$it1="NOMBRES";
	$it2="APELLIDOS";
	$it3="DOCUMENTO";
	
      /*$it1="NRO DOCUMENTO";
	$it2="QUERELLADO";
	$it3="QUERELLANTE";*/
}
?>
<table border=0 width 100% cellpadding="1"  class="borde_tab">
<TD class=titulos5 >RADICADO
<TD class=titulos5 >FECHA RADICADO
<TD class=titulos5 >FECHA INICIAL
<TD class=titulos5 >FECHA FINAL
<TD class=titulos5 >A&Ntilde;O
<TD class=titulos5 >DEPENDENCIA
<TD class=titulos5 ><?=$it1?>
<TD class=titulos5 ><?=$it2?>
<TD class=titulos5 ><?=$it3?>
<!--<TD class=titulos5 >CEDULA-->
<TD class=titulos5 >SERIE
<TD class=titulos5 >SUBSERIE
<TD class=titulos5 >TIPO
<TD class=titulos5 >FOLIOS
<!-- MODIFICADO SKINA JUNIO 4/09
<TD class=titulos5 >ZONA-->
<TD class=titulos5 >ESTANTE
<!--<TD class=titulos5 >CARRO-->
<TD class=titulos5 >ENTREPANO
<!--<TD class=titulos5 >CARA
<TD class=titulos5 >ESTANTE
<TD class=titulos5 >ENTREPA&Ntilde;O
<TD class=titulos5 >CAJA-->
<TD class=titulos5 >UNIDAD DOCUMENTAL
<TD class=titulos5 >NO. CARPETA
<TD class=titulos5 >OBSERVACION
<TD class=titulos5 ><p>INDICADORES DE DETERIORO</p>
<TD class=titulos5 ><p>MATERIAL AGREGADO</p>
<TD class=titulos5 >PRESTAMO
<TD class=titulos5 >FUNCIONARIO PRESTAMO
<TD class=titulos5 >FECHA ENTREGA PRESTAMO

</tr>

<?
if($buscar_ano!=""){$x="SGD_ARCHIVO_YEAR LIKE '$buscar_ano'";$a="and";}
else {$x="";$a="";}
if($buscar_rad!=""){$r="SGD_ARCHIVO_RAD LIKE '%$buscar_rad%'";$b="and";}
else {$r="";$b="";}
if($codserie!='0'){$srds="SGD_ARCHIVO_SRD LIKE '$codserie'";$c="and";}
else {$srds="";$c="";}
if($codiSBRD!='0'){$sbrds="SGD_ARCHIVO_SBRD LIKE '$codiSBRD'";$d="and";}
else {$sbrds="";$d="";}
if($buscar_proc!='0'){$pross="SGD_ARCHIVO_TIPO LIKE '$buscar_proc'";$ef="and";}
else{$pross="";$ef="";}
if($buscar_zona!=""){$bzon=strtoupper($buscar_zona);$zon="SGD_ARCHIVO_ZONA LIKE '$bzon'";$f="and";}
else {$zon="";$f="";}
// MODIFICADO POR SKINA JUNIO 4/09
if($buscar_carro!=""){
//if($item1=="ESTANTE")$carro="SGD_ARCHIVO_ESTANTE LIKE '$buscar_carro'";
if($item1=="ENTREPANO")$carro="SGD_ARCHIVO_CARRO LIKE '$buscar_carro'";
//elseif($item1=="CARRO")$carro="SGD_ARCHIVO_CARRO LIKE '$buscar_carro'";
$g="and";}
else {$carro="";$g="";}
if($buscar_cara!=""){
if($item3=="ENTREPANO")$cara="SGD_ARCHIVO_ENTREPANO LIKE '$buscar_cara'";
elseif($item3=="CARA")$cara="SGD_ARCHIVO_CARA LIKE '$buscar_cara'";
$i="and";}
else {$cara="";$i="";}
if($buscar_estante!=""){
if($item4=="ESTANTE")$estan="SGD_ARCHIVO_ESTANTE LIKE '$buscar_estante'";
elseif($item4=="CAJA")$estan="SGD_ARCHIVO_CAJA LIKE '$buscar_estante'";
$h="and";}
else {$estan="";$h="";}
if($buscar_entre!=""){$entre="SGD_ARCHIVO_ENTREPANO LIKE '$buscar_entre'";$v="and";}
else {$entre="";$v="";}
if($buscar_caja!=""){$caja="SGD_ARCHIVO_CAJA LIKE '$buscar_caja'";$t="and";}
else {$caja="";$s="";}
if ($sep=='1'){
	if($fechaIni==$fechaInif)$fecha="SGD_ARCHIVO_FECHAI like '$fechaIni'";
	else{
	$time=fnc_date_calcy($fechaInif,'1');
	$fecha="SGD_ARCHIVO_FECHAI <= '$time' and SGD_ARCHIVO_FECHAI >= '$fechaIni'";
	}
	$j="and";
}
else {$fecha="";$j="";}
if ($sep2=='1'){
	if($fechaIni2==$fechaInif2)$fecha2="SGD_ARCHIVO_FECHAF like '$fechaIni2'";
	else{
	$time2=fnc_date_calcy($fechaInif2,'1');
	$fecha2="SGD_ARCHIVO_FECHAF <= '$time2' and SGD_ARCHIVO_FECHAF >= '$fechaIni2'";
	}
	$w="and";
}
else {$fecha2="";$w="";}
if ($sep3=='1'){
	if($fechaIni3==$fechaInif3)$fecha3="SGD_ARCHIVO_FECH like '$fechaIni3'";
	else{
	$time3=fnc_date_calcy($fechaInif3,'1');
	$fecha3="SGD_ARCHIVO_FECH <= '$time3' and SGD_ARCHIVO_FECH >= '$fechaIni3'";
	}
	$wq="and";
}
else {$fecha3="";$wq="";}
if($buscar_orden!=""){$orden="SGD_ARCHIVO_ORDEN LIKE '%$buscar_orden%'";$k="and";}
else {$orden="";$k="";}
if($depen!=""){$depe="SGD_ARCHIVO_DEPE LIKE '$depen' ";$l="and";}
else {$depe="";$l="";}
if($buscar_deman!=""){$dem=strtoupper($buscar_deman);$deman="SGD_ARCHIVO_DEMANDADO LIKE '%$dem%'";$n="and";}
else {$deman="";$n="";}
if($buscar_demant!=""){$demt=strtoupper($buscar_demant);$demant="SGD_ARCHIVO_DEMANDANTE LIKE '%$demt%'";$m="and";}
else {$demant="";$m="";}
if($buscar_docu!=""){$docu="SGD_ARCHIVO_CC_DEMANDANTE LIKE '%$buscar_docu%'";$o="and";}
else {$docu="";$o="";}
if($buscar_inder!='0'){$inder="SGD_ARCHIVO_INDER LIKE '$buscar_inder'";$p="and";}
else {$inder="";$p="";}
if($buscar_mata!='0'){$mata="SGD_ARCHIVO_MATA LIKE '$buscar_mata'";$q="and";}
else {$mata="";$q="";}
if ($buscar_ano!="")$orde=" order by sgd_archivo_year";
else $orde=" order by sgd_archivo_fech";
if ($presta!=""){$pst="SGD_ARCHIVO_PRESTAMO=$presta ";$pt="and";}
else {$pst="";$pt="";}

$at=$buscar_orden.$buscar_rad.$buscar_ano.$buscar_caja.$buscar_estante.$buscar_entrepa.$buscar_zona.$buscar_deman.$fecha.$depe.$buscar_demant.
$buscar_docu.$buscar_ufisica.$codserie.$codiSBRD.$buscar_proc.$buscar_inder;
$cont=0;

include("$ruta_raiz/include/query/archivo/queryBusqueda_central.php");
//$db->conn->debug=true;
	$rs=$db->conn->Execute($sql);
	while(!$rs->EOF){
		$orden1=$rs->fields['SGD_ARCHIVO_ORDEN'];
		$sbrd=$rs->fields['SGD_ARCHIVO_SBRD'];
		$srd=$rs->fields['SGD_ARCHIVO_SRD'];
		$tipo=$rs->fields['SGD_ARCHIVO_TIPO'];
		$demandado=$rs->fields['SGD_ARCHIVO_DEMANDADO'];
		$demandante=$rs->fields['SGD_ARCHIVO_DEMANDANTE'];
		$cc=$rs->fields['SGD_ARCHIVO_CC_DEMANDANTE'];
		$indet=$rs->fields['SGD_ARCHIVO_INDER'];
		$mata1=$rs->fields['SGD_ARCHIVO_MATA'];
		$fechi=$rs->fields['SGD_ARCHIVO_FECHAI'];
		$fechf=$rs->fields['SGD_ARCHIVO_FECHAF'];
		$year=$rs->fields['SGD_ARCHIVO_YEAR'];
		$caja1=$rs->fields['SGD_ARCHIVO_CAJA'];
		$carro1=$rs->fields['SGD_ARCHIVO_CARRO'];
		$cara1=$rs->fields['SGD_ARCHIVO_CARA'];
		$radi=$rs->fields["SGD_ARCHIVO_RAD"];
		$estante1=$rs->fields['SGD_ARCHIVO_ESTANTE'];
		$unidoc=$rs->fields['SGD_ARCHIVO_UNIDOCU'];
		$dependencia=$rs->fields['SGD_ARCHIVO_DEPE'];
		$entrepa1=$rs->fields['SGD_ARCHIVO_ENTREPANO'];
		$folio=$rs->fields['SGD_ARCHIVO_FOLIOS'];
		$path=$rs->fields['SGD_ARCHIVO_PATH'];
		$zona1=$rs->fields['SGD_ARCHIVO_ZONA'];
		$anexo=$rs->fields['SGD_ARCHIVO_ANEXO'];
		$pres=$rs->fields['SGD_ARCHIVO_PRESTAMO'];
		$funprest=$rs->fields['SGD_ARCHIVO_FUNPREST'];
		$fprestf=$rs->fields['SGD_ARCHIVO_FECHPRESTF'];
		$fechaR=$rs->fields['FECHR'];
		if($pres==1)$prest="SI";
		else $prest="NO";
		
		switch($indet){
			case 0: $indete="Ninguno";
				break;
			case 1: $indete="Biologicos: Hongos";
				break;
			case 2: $indete="Biologicos: Roedores";
				break;
			case 3: $indete="Biologicos: Insectos";
				break;
			case 4: $indete="Decoloracion Soporte";
				break;
			case 5: $indete="Desgarros";
				break;
		}
		switch($mata1){
				case '0':$mata2="Ninguno";break;
				case '1':$mata2="Metalico";break;
				case '2':$mata2="Post-it";break;
				case '3':$mata2="Planos";break;
				case '4':$mata2="Fotografia";break;
				case '5':$mata2="Soporte Optico";break;
				case '6':$mata2="Soporte Magnetico";break;
				case '7':$mata2="Metalico y Post-it ";break;
				case '8':$mata2="Metalico y Planos ";break;
				case '9':$mata2="Metalico y Fotografia ";break;
				case '10':$mata2="Metalico y Soporte Optico ";break;
				case '11':$mata2="Metalico y Soporte Magnetico ";break;
				case '12':$mata2="Post-it y Planos";break;
				case '13':$mata2="Post-it y Fotografia";break;
				case '14':$mata2="Post-it y Soporte Optico";break;
				case '15':$mata2="Post-it y Soporte Magnetico";break;
				case '16':$mata2="Planos y Fotografia";break;
				case '17':$mata2="Planos y Soporte Optico";break;
				case '18':$mata2="Planos y Soporte Magnetico";break;
				case '19':$mata2="Fotografia y Soporte Optico";break;
				case '20':$mata2="Fotografia y Soporte Magnetico";break;
				case '21':$mata2="Soporte Optico y Soporte Magnetico";break;
				case '22':$mata2="Metalico, Post-it y Planos ";break;
				case '23':$mata2="Metalico, Post-it y Fotografia ";break;
				case '24':$mata2="Metalico, Post-it y Soporte Magnetico ";break;
				case '25':$mata2="Post-it, Planos y Fotografia";break;
				case '26':$mata2="Post-it, Planos y Soporte Optico";break;
				case '27':$mata2="Post-it, Planos y Soporte Magnetico";break;
				case '28':$mata2="Planos, Fotografia y Soporte Optico";break;
				case '29':$mata2="Planos, Fotografia y Soporte Magnetico";break;
				case '30':$mata2="Metalico, Fotografia y Soporte Optico";break;
				case '31':$mata2="Metalico, Planos y Soporte Optico";break;
				case '32':$mata2="Metalico, Fotografia y Soporte Magnetico";break;
				case '33':$mata2="Metalico, Planos y Soporte Magnetico";break;
				case '34':$mata2="Post-it, Fotografia y Soporte Optico";break;
				case '35':$mata2="Post-it, Fotografia y Soporte Magnetico";break;
				case '36':$mata2="Metalico, Soporte Optico y Soporte Magnetico";break;
				case '37':$mata2="Post-it, Soporte Optico y Soporte Magnetico";break;
				case '38':$mata2="Planos, Soporte Optico y Soporte Magnetico";break;
				case '39':$mata2="Fotografia, Soporte Optico y Soporte Magnetico ";break;
				case '40':$mata2="Metalico, Post-it y Soporte Optico";break;
				case '41':$mata2="Metalico, Planos y Fotografia";break;
				case '42':$mata2="Metalico, Fotografia y Soporte Optico";break;
		}
		switch($tipo){
			/* MODIFICADO POR SKINA JUNIO 4/09
                        case 1: $tipo1="Querella";*/
			case 1: $tipo1="Historias Laborales";
				break;
			case 2: $tipo1="Otros";
				break;
		}
		/*include("$ruta_raiz/include/query/archivo/queryBusqueda_exp.php");
		$rsr=$db->query($sql2);
		if(!$rsr->EOF)$caja=$rsr->fields["SGD_EIT_SIGLA"];
		$rsr=$db->query($sql3);
		if(!$rsr->EOF)$estante=$rsr->fields["SGD_EIT_SIGLA"];
		$rsr=$db->query($sql4);
		if(!$rsr->EOF)$piso=$rsr->fields["SGD_EIT_SIGLA"];
		$rsr=$db->query($sql5);
		if(!$rsr->EOF)$archiva=$rsr->fields["SGD_EIT_SIGLA"];
		$rsr=$db->query($sql10);
		if(!$rsr->EOF)$carro=$rsr->fields["SGD_EIT_SIGLA"];
		$rsr=$db->query($sql11);
		if(!$rsr->EOF)$entrepa=$rsr->fields["SGD_EIT_SIGLA"];*/
		?>
		<tr>

		<td class=leidos2 align="center">
		<?

if($usua_perm_archi>=3){
		?>
		<a href='insertar_central.php?<?=session_name()."=".session_id()."&krd=$krd&fechah=$fechah&$orno&adodb_next_page&edi=1&rad=$radi" ?>' > 
		<? }?>
		<?=$radi?></a></td>
		<!--by skina for ciac<td class=titulos5 align="center"><b><a href='verHistoricoArch.php?<?=session_name()."=".session_id()."&krd=$krd&fechah=$fechah&$orno&adodb_next_page&rad=$radi" ?>' ><?=$fechaR?></b></td>-->
		<td class=titulos5 align="center"><b><?=$fechaR?></b></td>
		<td class=titulos5 align="center"><b><span class=leidos2> <?=$fechi?></b></td>
		<td class=leidos2 align="center"> <b><span class=leidos2><?=$fechf?></b></td>
		<td class=titulos5 align="center"><b><span class=leidos2><?=$year?></b></td>
		<td class=leidos2 align="center"><b><span class=leidos2><?=$dependencia?></b></td>
		<td class=leidos2 align="center"><b><?=$orden1?></b></td>
		<td class=titulos5 align="center"><b><span class=leidos2><?=$demandado?></b></td>
		<td class=leidos2 align="center"><b><span class=leidos2><?=$demandante?></b></td>
		<td class=leidos2 align="center"><b><span class=leidos2><?=$srd?></b></td>
		<td class=titulos5 align="center"><b><span class=leidos2><?=$sbrd?></b></td>
		<td class=leidos2 align="center"><b><span class=leidos2><?=$tipo1?></b></td>
		<td class=titulos5 align="center"><b><span class=leidos2><?=$cc?></b></td>
		<td class=leidos2 align="center"><b><span class=leidos2><?=$zona1?></b></td>
		<td class=titulos5 align="center"><b><span class=leidos2><?=$carro1?></b></td>
		<!--<td class=leidos2 align="center"><b><span class=leidos2><?=$cara1?></b></td>
		<td class=titulos5 align="center"><b><span class=leidos2><?=$estante1?></b></td>
		<td class=leidos2 align="center"><b><span class=leidos2><?=$entrepa1?></b></td>
		<td class=titulos5 align="center"><b><span class=leidos2><?=$caja1?></b></td>-->
		<td class=leidos2 align="center"><b><span class=leidos2><?=$unidoc?></b></td>
		<td class=titulos5 align="center"><b><span class=leidos2><?=$folio?></b></td>
		<td class=titulos5 align="center"><b><span class=leidos2><?=$anexo?></b></td>
		<td class=leidos2 align="center"><b><span class=leidos2><?=$indete?></b></td>
		<td class=titulos5 align="center"><b><span class=leidos2><?=$mata2?></b></td>
		<td class=leidos2 align="center"><b><span class=leidos2><?=$prest?></b></td>
		<td class=titulos5 align="center"><b><span class=leidos2><?=$funprest?></b></td>
		<td class=leidos2 align="center"><b><span class=leidos2><?=$fprestf?></b></td>
		</tr>

		<?
		$cont++;
	$rs->MoveNext();

	}
}?>
</table>
<br>
<center><?=$cont?> Archivos Encontrados</center>
