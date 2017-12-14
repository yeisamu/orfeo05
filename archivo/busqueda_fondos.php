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
* Permite buscar informacion del fondo documental, se asocia con las tablas de valoracion documental del mismo modulo 
*/

    session_start();
    $ruta_raiz = "..";

    //valido sesion
    $dependencia = $_SESSION['dependencia'];
    if(!$dependencia)  include "$ruta_raiz/rec_session.php";
    
    include_once("$ruta_raiz/include/db/ConnectionHandler.php");
    $db = new ConnectionHandler("$ruta_raiz");
    //$db->conn->debug=true;
	
    $encabezado = "$PHP_SELF?".session_name()."=".session_id()."&dependencia=$dependencia&krd=$krd&sel=$sel";

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
    <title>Busqueda Fondos Documentales</title>
    <link rel="stylesheet" href="../estilos/orfeo.css">
    </head>
    <body bgcolor="#FFFFFF">
    <CENTER>
    <div id="spiffycalendar" class="text"></div>
    <link rel="stylesheet" type="text/css" href="../js/spiffyCal/spiffyCal_v2_1.css">
    <script language="JavaScript" src="../js/spiffyCal/spiffyCal_v2_1.js">
    </script>

    <form name=busqueda_fondo method='post' action='busqueda_fondos.php?<?=$encabezado?>'>
    <br>

    <table border=0 width="90%" cellpadding="0"  class="borde_tab">
    <td class=titulosError  width="80%" colspan="4" align="center">BUSQUEDA FONDOS DOCUMENTALES </td>

<?
	$item1="ENTREPANO";
        $item3="CARA";
	$item4="ESTANTE";
	$item5="ENTREPANO";
	$item6="CAJA";
?>

    <tr>
    <td width="20%" class='titulos2' align="left"><label for="buscar_demant">NOMBRES</label> </td>
    <td width="20%" class='titulos2'><input type=text name=buscar_demant id="buscar_demant" value='<?=$buscar_demant?>' class="tex_area" title="Buscar por nombre de carpeta">
    </td>
    <td width="20%" class='titulos2' align="left"><label for="buscar_rad"> RADICADO</label> </td>
    <td width="20%" class='titulos2'><input type=text name=buscar_rad id="buscar_rad" value='<?=$buscar_rad?>' class="tex_area" title="Buscar por número de radicado">
    </td>
    </tr>
    <tr><td width="20%" class='titulos2' align="left"><label for="buscar_deman">APELLIDOS</label></td>
    <td width="20%" class='titulos2'><input type=text name=buscar_deman value='<?=$buscar_deman?>' id="buscar_deman" class="tex_area" title="Buscar por appellidos de quien radicó"></td>
    <td width="20%" class='titulos2'><label for="buscar_orden">DOCUMENTO</label></td>
    <td width="20%" class='titulos2'><input type=text id="buscar_orden" name=buscar_orden value='<?=$buscar_orden?>' class="tex_area" title="Buscar por documento" ></td></tr>
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
   	var dateAvailable1 = new ctlSpiffyCalendarBox("dateAvailable1", "busqueda_fondo", "fechaIni","btnDate1","<?=$fechaIni?>",scBTNMODE_CUSTOMBLUE);
	dateAvailable1.date = "<?=date('Y-m-d');?>";
	dateAvailable1.writeControl();
	dateAvailable1.dateFormat="yyyy-MM-dd";
	</script>
	<br>&nbsp;
	<script language="javascript">
	var dateAvailable2 = new ctlSpiffyCalendarBox("dateAvailable2", "busqueda_fondo", "fechaInif","btnDate2","<?=$fechaInif?>",scBTNMODE_CUSTOMBLUE);
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
   	var dateAvailable3 = new ctlSpiffyCalendarBox("dateAvailable3", "busqueda_fondo", "fechaIni2","btnDate3","<?=$fechaIni2?>",scBTNMODE_CUSTOMBLUE);
	dateAvailable3.date = "<?=date('Y-m-d');?>";
	dateAvailable3.writeControl();
	dateAvailable3.dateFormat="yyyy-MM-dd";
	</script>
	<br>&nbsp;
	<script language="javascript">
	var dateAvailable4 = new ctlSpiffyCalendarBox("dateAvailable4", "busqueda_fondo", "fechaInif2","btnDate4","<?=$fechaInif2?>",scBTNMODE_CUSTOMBLUE);
	dateAvailable4.date = "<?=date('Y-m-d');?>";
	dateAvailable4.writeControl();
	dateAvailable4.dateFormat="yyyy-MM-dd";
	</script>

            </td></tr>
	    
   <td width="20%" class='titulos2'><label for="depen">DEPENDENCIA</label> </td>
   <TD width="20%" class='titulos2' >
	<? 
	$conD=$db->conn->Concat("SGD_DEPE_CODI","'-'","SGD_DEPE_NOMBRE");
	$sql5="select ($conD) as detalle,SGD_DEPE_CODI from SGD_TVD_DEPENDENCIA order by SGD_DEPE_NOMBRE";
	$rs=$db->conn->Execute($sql5);
	print $rs->GetMenu2('depen',$depen,true,false,"","onChange='submit()' class=select id='depen' title='Listado de todas las dependencias'");
				?>
	</td>
	</tr>
    	<tr> 
    <td width="20%" class='titulos2' align="left"><label for="buscar_ano">A&Ntilde;O</label></td>
    <td width="20%" class='titulos2'>
	<select class="select" name="buscar_ano" id="buscar_ano" title="Buscar documentos por agno">
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
    <tr>
    <td width="20%" class='titulos2' align="left">&nbsp;<label for="codserie">SERIE</label> </td>
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
    <td colspan="2" align="right"><input type=submit value=Buscar name=Buscar class="botones" aria-label="Buscar documentos por criterios ingresados">&nbsp;</td>
    <td colspan="2" align="left"><a href='archivo.php?<?=session_name()?>=<?=trim(session_id())?>krd=<?=$krd?>'>
    <input name='Regresar' align="middle" aria-label="Regresar" type="button" class="botones" id="envia22" value="Regresar" ></a></td>
    </table>
    <br>
    <?
    if($Buscar){
	
    if($buscar_ano!=""){$xano="SGD_ARCHIVO_YEAR LIKE '$buscar_ano'";$a="and";}
    else {$xano="";$a="";}
    if($buscar_rad!=""){$rad="SGD_ARCHIVO_RAD LIKE '%$buscar_rad%'";$b="and";}
    else {$rad="";$b="";}
    if($codserie!='0'){$srds="SGD_ARCHIVO_SRD LIKE '$codserie'";$c="and";}
    else {$srds="";$c="";}
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
    if($depen!=""){$depe="SGD_ARCHIVO_DEPE LIKE '$depen' ";$l="and";}
    else {$depe="";$l="";}
    if($buscar_deman!=""){$dem=strtoupper($buscar_deman);$deman="SGD_ARCHIVO_DEMANDADO LIKE '%$dem%'";$n="and";}
    else {$deman="";$n="";}
    if($buscar_demant!=""){$demt=strtoupper($buscar_demant);$demant="SGD_ARCHIVO_DEMANDANTE LIKE '%$demt%'";$m="and";}
    else {$demant="";$m="";}
    if($buscar_orden!=""){$orden="SGD_ARCHIVO_ORDEN LIKE '%$buscar_orden%'";$k="and";}
    else {$orden="";$k="";}
    
    if ($buscar_ano!="")$orde=" order by sgd_archivo_year";
    else $orde=" order by sgd_archivo_fech";
    
    if ($presta!=""){$pst="SGD_ARCHIVO_PRESTAMO=$presta ";$pt="and";}
    else {$pst="";$pt="";}
    
    include("$ruta_raiz/include/query/archivo/queryBusqueda_fondo.php");
    $rs=$db->conn->Execute($sql);
 
    if(!$rs->EOF){
    //Pongo la informacion encontrada
    ?>
   <table border=0 width 100% cellpadding="1"  class="borde_tab">
    <tr>
    <TD class=titulos5 >RADICADO</td>
    <TD class=titulos5 >FECHA RADICADO</td>
    <TD class=titulos5 >NOMBRES O TITULO </td>
    <TD class=titulos5 >APELLIDOS </td>
    <TD class=titulos5 >FECHA INICIAL</td>
    <TD class=titulos5 >FECHA FINAL</td>
    <TD class=titulos5 >DEPENDENCIA </td>
    <TD class=titulos5 >SERIE	 </td>
    <TD class=titulos5 >UNIDAD DOCUMENTAL</td>
    <TD class=titulos5 >PRESTAMO</td>
    <TD class=titulos5 >FUNCIONARIO PRESTAMO</td>
    <TD class=titulos5 >FECHA PRESTAMO</td>
    </tr>
<?
    while(!$rs->EOF){
                $rad=$rs->fields['RADICADO'];
                $fecha=$rs->fields['FECHA_INGRESO'];
                $nombre=$rs->fields['NOMBRE_TITULO'];
                $apellidos=$rs->fields['APELLIDOS'];
                $finicial=$rs->fields['FECHA_INICIAL'];
                $ffinal=$rs->fields['FECHA_FINAL'];
                $depe=$rs->fields['DEPENDENCIA'];
                $srd=$rs->fields['SERIE'];
                $udocu=$rs->fields['UNIDAD_DOCUMENTAL'];
                $pres=$rs->fields['PRESTADO'];
                $fpres=$rs->fields['FUNCIONARIO_PRESTAMO'];
                $fecha_prest=$rs->fields['FECHA_PRESTAMO'];
		if($pres==1)$prest="SI";
                else $prest="NO";

	?>
    <tr>
    <td> <a href='insertar_fondos.php?<?=session_name()."=".session_id()."&krd=$krd&fechah=$fechah&$orno&adodb_next_page&edi=1&rad=$rad" ?>' ><?=$rad?></a></td>
    <td class=titulos5 align="center"><b><?=$fecha?></b></td>
    <td class=titulos5 align="center"><b><span class=leidos2> <?=$nombre?></b></td>
    <td class=titulos5 align="center"><b><span class=leidos2> <?=$apellidos?></b></td>
    <td class=titulos5 align="center"><b><span class=leidos2> <?=$finicial?></b></td>
    <td class=titulos5 align="center"><b><span class=leidos2> <?=$ffinal?></b></td>
    <td class=titulos5 align="center"><b><span class=leidos2> <?=$depe?></b></td>
    <td class=titulos5 align="center"><b><span class=leidos2> <?=$srd?></b></td>
    <td class=titulos5 align="center"><b><span class=leidos2> <?=$udocu?></b></td>
    <td class=titulos5 align="center"><b><span class=leidos2> <?=$prest?></b></td>
    <td class=titulos5 align="center"><b><span class=leidos2> <?=$fpres?></b></td>
    <td class=titulos5 align="center"><b><span class=leidos2> <?=$fecha_prest?></b></td>
    </tr>
    <?
    $rs->MoveNext();
    	}

    }
    }
    ?>
    </table>
    </body>
    </html>
