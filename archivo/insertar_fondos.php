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
* Administrador de Fondos documentales
* Sistema de gestion Documental ORFEO.
* Permite insertar informacion del fondo documental, se asocia con las tablas de valoracion documental del mismo modulo 
*/

    session_start();
    $ruta_raiz = "..";

    //valido sesion
    $dependencia = $_SESSION['dependencia'];
    $codusuario = $_SESSION['codusuario'];
    $usua_perm_archi=$_SESSION["usua_admin_archivo"];
    if(!$dependencia)  include "$ruta_raiz/rec_session.php";
    
    include_once("$ruta_raiz/include/db/ConnectionHandler.php");
    $db = new ConnectionHandler("$ruta_raiz");
    $db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
    //$db->conn->debug=true;

    if(!$edit)$edit=$edi;
    
    include_once "$ruta_raiz/include/tx/Historico.php";
    $objHistorico= new Historico($db);
	
    $encabezado = session_name()."=".session_id()."&krd=$krd&tipo_archivo=1&edit=$edit&rad=$rad&depe2=$depe2&ano2=$ano2";

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
    <?
    if($edit>=1 or $Modificar){
    ?>
        <title>Modificar Archivo Central</title>
    <?
    }
    else{
    ?>
	<title>Insertar Archivo Central</title>
    <? }?>
    <link rel="stylesheet" href="../estilos/orfeo.css">
    <CENTER>
    <body bgcolor="#FFFFFF">
    <div id="spiffycalendar" class="text"></div>
    <link rel="stylesheet" type="text/css" href="../js/spiffyCal/spiffyCal_v2_1.css">
    <script language="JavaScript" src="../js/spiffyCal/spiffyCal_v2_1.js">
    </script>


    <!-- <form name=insertar_fondos method='post' action='insertar_fondos.php?<?=$encabezado?>'> -->
    <form name=insertar_fondos method='post' action='insertar_fondos.php?<?=session_name()?>=<?=trim(session_id())?>krd=<?=$krd?>&edit=<?=$edit?>&rad=<?=$rad?>&depe2=<?=$depe2?>&ano2=<?=$ano2?>'>
    <br>
    <table border=0 width="90%" cellpadding="0"  class="borde_tab">
    <?
    if($edit>=1 or $Modificar){
    ?>
    <td class=titulosError  width="80%" colspan="4" align="center">MODIFICAR ARCHIVO FONDOS </td>
    <?
    }
    else{
    ?>
    <td class=titulosError  width="80%" colspan="4" align="center">INSERTAR ARCHIVO FONDOS </td>
    <? }?>
    <? 
	// MODIFICADO SKINA JUNIO 4/09
        //$item1="CARRO";
	$item1="ENTREPANO";
	$item3="CARA";
	$item4="CARPETA";
	$item5="ENTREPANO";
	$item6="CAJA";
	if($edi==1){
		include("$ruta_raiz/include/query/archivo/queryinsertar_fondos.php");
		$rsqm=$db->conn->Execute($sqlqm);
		if(!$rsqm->EOF){
			$orden=$rsqm->fields['SGD_ARCHIVO_ORDEN'];
			$depen=$rsqm->fields['SGD_ARCHIVO_DEPE'];
			$proc=$rsqm->fields['SGD_ARCHIVO_TIPO'];
			$ano=$rsqm->fields['SGD_ARCHIVO_YEAR'];
			$deman=$rsqm->fields['SGD_ARCHIVO_DEMANDADO'];
			$demant=$rsqm->fields['SGD_ARCHIVO_DEMANDANTE'];
			$fechaIni=$rsqm->fields['SGD_ARCHIVO_FECHAI'];
			$fechaInif=$rsqm->fields['SGD_ARCHIVO_FECHAF'];
			$zona=$rsqm->fields['SGD_ARCHIVO_ZONA'];
			$carro=$rsqm->fields['SGD_ARCHIVO_CARRO'];
			$cara=$rsqm->fields['SGD_ARCHIVO_CARA'];
			$estante=$rsqm->fields['SGD_ARCHIVO_ESTANTE'];
			$entre=$rsqm->fields['SGD_ARCHIVO_ENTREPANO'];
			$caja=$rsqm->fields['SGD_ARCHIVO_CAJA'];
			$codserie=$rsqm->fields['SGD_ARCHIVO_SRD'];
			$tsub=$rsqm->fields['SGD_ARCHIVO_SBRD'];
			$inder=$rsqm->fields['SGD_ARCHIVO_INDET'];
			$mata=$rsqm->fields['SGD_ARCHIVO_MATA'];
			$docu=$rsqm->fields['SGD_ARCHIVO_CC_DEMANDANTE'];
			$folios=$rsqm->fields['SGD_ARCHIVO_FOLIOS'];
			$unidocu=$rsqm->fields['SGD_ARCHIVO_UNIDOCU'];
			$anexo=$rsqm->fields['SGD_ARCHIVO_ANEXO'];
			$prest=$rsqm->fields['SGD_ARCHIVO_PRESTAMO'];
			$funprest=$rsqm->fields['SGD_ARCHIVO_FUNPREST'];
			$fechaPrestf=$rsqm->fields['SGD_ARCHIVO_FECHPRESTF'];
			
			switch($mata){
				case '1':$mata1=1;break;
				case '2':$mata2=1;break;
				case '3':$mata3=1;break;
				case '4':$mata4=1;break;
				case '5':$mata5=1;break;
				case '6':$mata6=1;break;
				case '7':$mata1=1;$mata2=1;break;
				case '8':$mata1=1;$mata3=1;break;
				case '9':$mata1=1;$mata4=1;break;
				case '10':$mata1=1;$mata5=1;break;
				case '11':$mata1=1;$mata6=1;break;
				case '12':$mata2=1;$mata3=1;break;
				case '13':$mata2=1;$mata4=1;break;
				case '14':$mata2=1;$mata5=1;break;
				case '15':$mata2=1;$mata6=1;break;
				case '16':$mata3=1;$mata4=1;break;
				case '17':$mata3=1;$mata5=1;break;
				case '18':$mata3=1;$mata6=1;break;
				case '19':$mata4=1;$mata5=1;break;
				case '20':$mata4=1;$mata6=1;break;
				case '21':$mata5=1;$mata6=1;break;
				case '22':$mata1=1;$mata2=1;$mata3=1;break;
				case '23':$mata1=1;$mata2=1;$mata4=1;break;
				case '24':$mata1=1;$mata2=1;$mata6=1;break;
				case '25':$mata2=1;$mata3=1;$mata4=1;break;
				case '26':$mata2=1;$mata3=1;$mata5=1;break;
				case '27':$mata2=1;$mata3=1;$mata6=1;break;
				case '28':$mata3=1;$mata4=1;$mata5=1;break;
				case '29':$mata3=1;$mata4=1;$mata6=1;break;
				case '30':$mata1=1;$mata4=1;$mata5=1;break;
				case '31':$mata1=1;$mata3=1;$mata5=1;break;
				case '32':$mata1=1;$mata4=1;$mata6=1;break;
				case '33':$mata1=1;$mata3=1;$mata6=1;break;
				case '34':$mata2=1;$mata4=1;$mata5=1;break;
				case '35':$mata2=1;$mata4=1;$mata6=1;break;
				case '36':$mata1=1;$mata5=1;$mata6=1;break;
				case '37':$mata2=1;$mata5=1;$mata6=1;break;
				case '38':$mata3=1;$mata5=1;$mata6=1;break;
				case '39':$mata4=1;$mata5=1;$mata6=1;break;
				case '40':$mata1=1;$mata2=1;$mata5=1;break;
				case '41':$mata1=1;$mata3=1;$mata4=1;break;
				case '42':$mata1=1;$mata4=1;$mata5=1;break;
				
			}
			$depe2=$depen;
			$ano2=$ano;
		}
		$edit=2;
	}	
    ?>
    <input type="hidden" name="depe2" value="<?=$depe2?>">
    <input type="hidden" name="ano2" value="<?=$ano2?>">

    <tr><td width="20%" class='titulos2' align="left"><label for="ano">A&Ntilde;O</label></td>
    <td width="20%" class='titulos2'>
	<select class="select" name="ano" id="ano" title="Listado de a�os">
          <?
	$agnoactual=Date('Y');
	for($i = 1986; $i <= $agnoactual; $i++)
	{
		if($i == $ano) $option="<option SELECTED value=\"" . $ano . "\">" . $ano . "</option>";
		elseif($i == 1986)$option="<option value=\"\"> TODOS</option>";
		else $option="<option value=\"" . $i . "\">" . $i . "</option>";
		echo $option;
	}
	?>
          </select>
	  <input type="hidden" name="yea" value="<?=$ano?>">
	</td>
    <td width="20%" class='titulos2' align="left"><label for="orden">DOCUMENTO</label> </td>
    <td width="20%" class='titulos2'><input type=text name=orden id="orden" value='<?=$orden?>' class="tex_area" title="Documento de la persona que solicita el ingreso del documento al archivo fondos"></td></tr>
    <tr>
    <td width="20%" class='titulos2'><label for="depen">DEPENDENCIA</label> </td>
    <TD width="20%" class='titulos2' >
    <?
 	$conD=$db->conn->Concat("SGD_DEPE_CODI","'-'","SGD_DEPE_NOMBRE");
        $sql5="select ($conD) as detalle,SGD_DEPE_CODI from SGD_TVD_DEPENDENCIA order by SGD_DEPE_NOMBRE";
        $rs=$db->conn->Execute($sql5);
        print $rs->GetMenu2('depen',$depen,true,false,"","onChange='submit()' class=select id='depen' title='Listado de todas las dependencias'");				
    ?>
    </td>
    <td width="20%" class='titulos2' align="left"><label for="codserie">&nbsp;SERIE</label> </td>
    <td width="20%" class='titulos2'>
     <?php
        if(!$depen) $depen = 0;
        if(!$codserie) $codserie = 0;
        $fecha_hoy = Date("Y-m-d");
        $sqlFechaHoy=$db->conn->DBDate($fecha_hoy);
        $conD=$db->conn->Concat("SGD_STVD_CODI","'-'","SGD_STVD_NOMBRE");
        $sql5="select ($conD) as detalle,SGD_STVD_CODI from SGD_TVD_SERIES WHERE SGD_DEPE_CODI=$depen order by SGD_STVD_NOMBRE";
        $rsS=$db->conn->Execute($sql5);
        print $rsS->GetMenu2("codserie", $codserie, "0:-- Seleccione --", false,"","onChange='submit()' class='select' id='codserie' title='Buscar por numero de serie'" );
        $codiSRD = $codserie;

        ?>
    </tr>
    <tr>
    <td width="20%" class='titulos2' align="left"><label for="demant">NOMBRES / TITULO </label> </td>
    <td width="20%" class='titulos2'><input type=text id="demant" name=demant value='<?=$demant?>' class="tex_area" title="Nombres del que solicita guardar en el archivo fondos">
    <td width="20%" class='titulos2' align="left"><label for="deman">APELLIDOS</label> </td>
    <td width="20%" class='titulos2'><input type=text id="deman" name=deman value='<?=$deman?>' class="tex_area" title="Apellidos del usuario que solicita guardar en el archivo fondos"></td>
    </tr>
    <tr><td width="20%" class='titulos2' align="left"><label for="fechaIni"> FECHA INICIAL <br>&nbsp; A&Ntilde;O-MES-DIA</label> </td>
    <td width="20%" class='titulos2'><input type="text" name="fechaIni" value="<?=$fechaIni?>" id="fechaIni" title="Ingrese la fecha en que ingresa el documento en formato ano,mes, dia"></td>
   
    <td width="20%" class='titulos2' align="left"> <label for="fechaInif">FECHA FINAL <br>&nbsp; YYYY-MM-DD</label>
    <td width="20%" class='titulos2'><input type="text" name="fechaInif" value="<?=$fechaInif?>" id="fechaInif" title="Fecha en que el documento termina el tramite en formato ano, mes, dia">
           
    </td></tr>
    <tr><td width="20%" class='titulos2' align="left"><label for="zona">ESTANTE</label> </td>
    <td width="20%" class='titulos2'><input type=text id="zona" name=zona value='<?=$zona?>' class="tex_area" size=5 maxlength="4" title="Estante en el que se ubicará físicamente el documento"></td>
    <td width="20%" class='titulos2'><label for="carro"><?=$item1?></label></td>
    <td width="20%" class='titulos2'><input type=text id="carro" name=carro value='<?=$carro?>' class="tex_area" size=5 maxlength="4" title="Entrepaño en el que se ubicará el documento en el archivo fondos"></td>
    </td></tr>
    <td width="20%" class='titulos2'><label for="cara"><?=$item3?></label></td>
    <td width="20%" class='titulos2'><input type="radio" name="cara" value="A" <?//=$sec1?>>A &nbsp;
    <input type="radio" name="cara" value="B" <?//=$sec2?>>B &nbsp;
    <input type="radio" name="cara" value="" <?//=$sec3?>>Ninguno &nbsp;</td>
    <tr>
    <td width="20%" class='titulos2' align="left"><label for="unidocu">UNIDAD DOCUMENTAL</label>	</td>
    <td width="20%" class='titulos2'>
    <?
    switch($unidocu){
  	case 'CRPT': $sele13="selected";
		break;
  	case 'LGJ': $sele14="selected";
		break;
	case 'CPDR': $sele15="selected";
		break;
	case 'A-Z': $sele16="selected";
		break;
	case 'CJ': $sele17="selected";
		break;
	case 'PQJ': $sele18="selected";
		break;
	case 'AGL': $sele19="selected";
		break;
	 }
     ?>
     <select class="select" name="unidocu" id="unidocu" title="Listado de tipos de unidad documental">
	  <option value="0" <?=$sele0?>>Ninguno</option>
	<option value="CRPT" <?=$sele13?>>Carpetas</option>
	<option value="LGJ" <?=$sele14?>>Legajos</option>
	<option value="CPDR" <?=$sele15?>>Libro Copiado</option>
	<option value="A-Z" <?=$sele16?>>A-Z</option>
	<option value="CJ" <?=$sele17?>>Cajas</option>
	<option value="PQT" <?=$sele18?>>Paquete</option>
	<option value="AGL" <?=$sele19?>>Argollado</option>
	</select>
    </td>
    <td width="20%" class='titulos2' align="left"><label for="folios">NO. CARPETA</label>
	</td>
    <td width="20%" class='titulos2'><input type=text id="folios" name=folios value='<?=$folios?>' class="tex_area" title="Número de la carpeta donde se guarará el documento">
    </td>
    </tr>
    <tr>
    <td width="20%" class='titulos2' align="left"><label for="inder">INDICADORES DE DETERIORO</label> </td>
    <td width="20%" class='titulos2'>
    <?
    switch($inder){
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
     <select class="select" name="inder" id="inder" title="Indicar qué posibles factores pueden deteriorar el documento">
     <option value="0" <?=$sele0?>>Ninguno</option>
	<option value="1" <?=$sele1?>>Biologicos: Hongos</option>
	<option value="2" <?=$sele2?>>Biologicos: Roedores</option>
	<option value="3" <?=$sele3?>>Biologicos: Insectos</option>
	<option value="4" <?=$sele4?>>Decoloracion Soporte</option>
	<option value="5" <?=$sele5?>>Desgarros</option>
	</select>
    </td>
    <td width="20%" class='titulos2' align="left">MATERIALES INSERTADOS </td>
    <td width="20%" class='titulos2'>
    <table border=0 width="90%" cellpadding="0"  >
    <?
        if($mata1==1)$sele7="checked";
	?>
	<tr>
	<td width="30%" class='titulos2'> <input type="checkbox" name="mata1" id="mata1" value=1 <?=$sele7?>><label for="mata1">Metalico</label></option></td>
	 <?
        if($mata2==1)$sele8="checked";
        ?>
        <td width="30%" class='titulos2'> <input type="checkbox" name="mata2" id="mata2" value=1 <?=$sele8?>><label for="mata2">Post-it</label></option></td>
        <?
        if($mata3==1)$sele9="checked";
        ?>
        <td width="30%" class='titulos2'> <input type="checkbox" name="mata3" id="mata3" value=1<?=$sele9?>><label for="mata3">Planos</label></option></td></tr>
        <?
        if($mata4==1)$sele10="checked";
        ?>
        <tr>
        <td width="30%" class='titulos2'> <input type="checkbox" name="mata4" id="mata4" value=1 <?=$sele10?>><label for="mata4">Fotografia</label></option></td>
        <?
        if($mata5==1)$sele11="checked";
        ?>
        <td width="30%" class='titulos2'> <input type="checkbox" name="mata5" id="mata5" value=1 <?=$sele11?>><label for="mata5">Soporte Optico</label></option></td>
        <?
        if($mata6==1)$sele12="checked";
        ?>
        <td width="30%" class='titulos2'> <input type="checkbox" name="mata6" id="mata6" value=1 <?=$sele12?>><label for="mata6">Soporte Magnetico</label></option></td></tr>
</table>
</td>
 </tr>
 <tr>
        <!--<td width="20%" class='titulos2' align="left">CEDULA DEMANDANTE-->
        <td width="20%" class='titulos2' align="left"><label for="docu">NO. FOLIOS</label>
  </td>
   <td width="20%" class='titulos2'><input type=text name=docu value='<?=$docu?>' id= "docu" class="tex_area" title="Número de folios que ocupa el documento">
   </td>
   <td width="20%" class='titulos2' align="left"><label for="anexo">DESCRIPCION</label>
        </td>
   <td width="20%" class='titulos2'><textarea rows="2" name="anexo" id="anexo" cols="30" title="Describa el documento brevemente"><?=$anexo?></textarea>
   </td>
    <tr>
    <?
    include("$ruta_raiz/include/query/archivo/queryBusqueda_fondos.php");
    if($usua_perm_archi>=1){
    ?>
    <TR><td class='titulos2' align="right">PRESTAMO</td>
    <?
    if($prest==1)$de="checked";else $de="";
    ?>
    <td class='titulos2' align="left" ><input type="checkbox" name="prest" value=1 <?=$de?> onclick="submit();"> </td>
    <?
    if($prest==1){
    ?>
    <td class='titulos2' align="right" >FUNCIONARIO PRESTAMO</td>
    <TD class='titulos2' align="left" ><input type="text" name="funprest" value=<?=$funprest?>></td>
    <?
    if(!$fechaPrestf)$fechaPrestf=date("Y-m-d");
    ?>
    </TR>
    <TR>
    <td class='titulos2' align="right" >FECHA DE ENTREGA</td>
    <TD class='titulos2' align="left" >
    <script language="javascript">
        var dateAvailable1 = new ctlSpiffyCalendarBox("dateAvailable1", "insertar_fondos", "fechaPrestf","btnDate1","<?=$fechaPrestf?>",scBTNMODE_CUSTOMBLUE);
        </script>
        <script language="javascript">
        dateAvailable1.date = "<?=date('Y-m-d');?>";
        dateAvailable1.writeControl();
        dateAvailable1.dateFormat="yyyy-MM-dd";
       </script>
    </TD>
    <?}?>
    </TR>
    <?
    }
    if($edit>=1 or $Modificar){
    ?>
    <td colspan="2" align="right"><input type=submit value=Modificar name=Modificar class="botones">&nbsp;</td>
    <td colspan="2" align="left"><a href='archivo.php?<?=session_name()?>=<?=trim(session_id())?>krd=<?=$krd?>'>
    <input name='Regresar' align="middle" aria-label="Regresar" type="button" class="botones" id="envia22" value="Regresar" ></a></td>
	<?
    }
    else{
    ?>
    <!--Modificado skina-->
    <!--<td colspan="2" align="right"><input name="CargarCSV" type="button" class="botones_mediano" onClick="CargarCsv();" value="Insertar Archivo CSV " >-->
    <td colspan="2" align="right">
    <input type=submit value=Ingresar name=Ingresar class="botones" aria-label="Enviar solicitud de ingreso de documento a archivo central">&nbsp;</td>
   <td colspan="2" align="left"><a href='archivo.php?<?=session_name()?>=<?=trim(session_id())?>krd=<?=$krd?>'><input name='Regresar' align="middle" type="button" class="botones" id="envia22" value="Regresar" aria-label="Volver al menú del módulo de archivo"></td></a>
    <? }?>
    </table>
    <br>
    <?
    if ($Ingresar or $Modificar){
	//Verifico valores obligatorios ano, dependencia, nombre y fecha
	$confi=explode($ano,$fechaIni);
	if($orden=="" and $proc==2)$orden=0;
	if($ano!="" and $depen!="" and $demant!="" and $confi[1]!=""){
		$zon=strtoupper($zona);
		$demq=strtoupper($deman);
		$demtq=strtoupper($demant);
		if($orden=="" and $proc==2)$orden=0;
		if($funprest=="")$funprest=' ';
		if($demtq=="")$demtq=' ';
		if($demq=="")$demq=' ';
		if($docu=="")$docu=0;
		if($folios=="")$folios=0;
		if($carro=="")$carro=0;
		if($cara=="")$cara=0;
		if($zon=="")$zon=0;
		if($caja=="")$caja=0;
		if($estante=="")$estante=0;
		if($entre=="")$entre=0;
		if($prest==1)$fprest=date("Y-m-d");
	
		$depeU=$dependencia;
		$usuacod=$codusuario;
		
		if($prest!=1)$presta=0;
		else $presta=1;
	
		if($mata1==1 and $mata2==1 and $mata3==1)$mata=22;
	        elseif($mata1==1 and $mata2==1 and $mata4==1)$mata=23;
	        elseif($mata1==1 and $mata2==1 and $mata6==1)$mata=24;
	        elseif($mata2==1 and $mata3==1 and $mata4==1)$mata=25;
	        elseif($mata2==1 and $mata3==1 and $mata5==1)$mata=26;
	        elseif($mata2==1 and $mata3==1 and $mata6==1)$mata=27;
	        elseif($mata3==1 and $mata4==1 and $mata5==1)$mata=28;
	        elseif($mata3==1 and $mata4==1 and $mata6==1)$mata=29;
	        elseif($mata1==1 and $mata4==1 and $mata5==1)$mata=30;
	        elseif($mata1==1 and $mata3==1 and $mata5==1)$mata=31;
	        elseif($mata1==1 and $mata4==1 and $mata6==1)$mata=32;
	        elseif($mata1==1 and $mata3==1 and $mata6==1)$mata=33;
	        elseif($mata2==1 and $mata4==1 and $mata5==1)$mata=34;
	        elseif($mata2==1 and $mata4==1 and $mata6==1)$mata=35;
	        elseif($mata1==1 and $mata5==1 and $mata6==1)$mata=36;
	        elseif($mata2==1 and $mata5==1 and $mata6==1)$mata=37;
	        elseif($mata3==1 and $mata5==1 and $mata6==1)$mata=38;
	        elseif($mata6==1 and $mata4==1 and $mata5==1)$mata=39;
	        elseif($mata1==1 and $mata2==1 and $mata5==1)$mata=40;
	        elseif($mata1==1 and $mata3==1 and $mata4==1)$mata=41;
	        elseif($mata1==1 and $mata4==1 and $mata5==1)$mata=42;
       		elseif($mata1==1 and $mata2==1)$mata=7;
       		elseif($mata1==1 and $mata3==1)$mata=8;
	        elseif($mata1==1 and $mata4==1)$mata=9;
       		elseif($mata1==1 and $mata5==1)$mata=10;
       		elseif($mata1==1 and $mata6==1)$mata=11;
       		elseif($mata2==1 and $mata3==1)$mata=12;
       		elseif($mata2==1 and $mata4==1)$mata=13;
       		elseif($mata2==1 and $mata5==1)$mata=14;
       		elseif($mata2==1 and $mata6==1)$mata=15;
       		elseif($mata3==1 and $mata4==1)$mata=16;
		elseif($mata3==1 and $mata5==1)$mata=17;
	        elseif($mata3==1 and $mata6==1)$mata=18;
	        elseif($mata4==1 and $mata5==1)$mata=19;
        	elseif($mata4==1 and $mata6==1)$mata=20;
	        elseif($mata5==1 and $mata6==1)$mata=21;
	        elseif($mata1==1)$mata=1;
	        elseif($mata2==1)$mata=2;
	        elseif($mata3==1)$mata=3;
	        elseif($mata4==1)$mata=4;
	        elseif($mata5==1)$mata=5;
	        elseif($mata6==1)$mata=6;
	        else $mata=0;
	

		$depeU=$dependencia;
		$usuacod=$codusuario;

		if($Ingresar){
		$sec=$db->conn->nextId('SEC_FONDO');
		$sec=str_pad($sec,5,"0", STR_PAD_LEFT);
		$rad=$ano.$depen.$sec."F";
		
		include("$ruta_raiz/include/query/archivo/queryinsertar_fondos.php");
		$rsq=$db->conn->Execute($query);
		if($rsq->RecordCount()!=0) {
			?>
			<script language="javascript">
			confirm('ESTE REGISTRO YA EXISTE');
			</script>
			<h1 >ESTE REGISTRO YA EXISTE</h1>
			<?
		}
		else{
			$rs=$db->conn->Execute($sql);
			if($rs->EOF){
			?>
			<tr><td align="center"><h1>EL NUMERO DE RADICADO ES  <?=$rad?></h1>
			</tr>
			<?
			$rad2[1]=$rad;
			$ree=$db->conn->Execute("select max(HIST_ID) as coe from sgd_archivo_hist");
			$co=$ree->fields['COE']+1;
			$observa="Ingreso de registro en archivo fondos en la ubicacion: Zona ".$zona."-Carro ".$carro."-Cara ".$cara."-Estante ".$estante."-Entrepano ".$entre."-Caja ".$caja;
			$objHistorico->insertarHistoricoArch($co,$rad2,$depeU,$usuacod,$observa, 64);
			}
			else{
			?>
			<script language="javascript">
			confirm('HUBO UN ERROR EN LA CARGA');
			</script>
			<tr><td align="center"><h1>HUBO UN ERROR EN LA CARGA</h1>
			</tr>
			<?
			}
		}
	}
	if($Modificar){
		if($depe2!=$depen){
		$r2=explode($depe2,$rad);
		$rad1=$ano.$depe.$r2[1];
		 }
		elseif($ano2!=$ano){
		$r2=explode($ano2,$rad);
		$rad1=$ano2.$r2[1];
	 	}
		else $rad1=$rad;
		if($prest!=1){
		$fechaPrestf="";
		$fprest="";
		 }
		 $rqr=$db->conn->Execute("select sgd_archivo_usua from sgd_archivo_fondo where sgd_archivo_rad like '''$rad1'");
		 if($rqr->fields['SGD_ARCHIVO_USUA']=="")$qte=" ,sgd_archivo_usua='$krd', depe_codi='$depeU'";
		 else $qte="";
		include("$ruta_raiz/include/query/archivo/queryinsertar_fondos.php");
		$rs=$db->conn->Execute($sqlm);
		if($rs->EOF){
		?>
		<tr><td align="center"><h1 class="titulosError">EL REGISTRO FUE MODIFICADO</h1>
		</tr>
		<?
		
		}
	}
	}elseif($ano==""){
	?>
	<script language="javascript">
	confirm('Debe seleccionar un a&ntilde;o');
	</script>
	<?
	}
	elseif($depen==""){
	?>
	<script language="javascript">
	confirm('Debe seleccionar una dependencia');
	</script>
	<?
	}
	elseif($demant==""){
	?>
	<script language="javascript">
	confirm('Debe ingresar el nombre');
	</script>
	<?
	}
	elseif($confi[1]==""){
	?>
	<script language="javascript">
	confirm('Debe ingresar fecha inicial y fecha final. La fecha de inicial debe coincidir con el a&ntilde;o que selecciono');
	</script>
	<?
	}
}
?>
</table>
</form>
