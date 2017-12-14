<?php
/**
* Administrador de Dependencias de la Tabla de Valoracion Documental TVD 
* Sistema de gestion Documental ORFEO.
* Permite la creacion, listado y modificacion de Dependencias para TVD
*/
    session_start(); 
    $krd = $_SESSION["krd"];
    $dependencia = $_SESSION["dependencia"];
    $ruta_raiz = "../.."; 

    //valido sesion
    if(!$dependencia)  include "$ruta_raiz/rec_session.php";

    include_once("$ruta_raiz/include/db/ConnectionHandler.php");
    $db = new ConnectionHandler("$ruta_raiz");
    //$db->conn->debug=true;
    $db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
    
    $encabezado = session_name()."=".session_id()."&krd=$krd";
    $linkPagina = "$PHP_SELF?$encabezado&orderTipo=$orderTipo&orderNo=$orderNo";
    
    if (!$fecha_busq)  $fecha_busq=Date('Y-m-d');
    if (!$fecha_busq2)  $fecha_busq2=Date('Y-m-d');
?>
    <html>
    <head>
    <link rel="stylesheet" href="<?=$ruta_raiz?>/estilos/orfeo.css">
    <script>
    function val_datos()
    {
	bandera = true;
	err_msg = '';
	if(!isNonnegativeInteger(document.getElementById('coddepeI').value,false))
	{
		err_msg = err_msg+'Digite codigo numerico\n';
		bandera = false;
	}
	if(isWhitespace(document.getElementById('detadepe').value))
	{
		err_msg = err_msg+'Digite nombre\n';
		bandera = false;
	}
	if (dateAvailable.getSelectedDate() > dateAvailable2.getSelectedDate())
	if(isWhitespace(document.getElementById('detadepe').value))
	{
		err_msg = err_msg+'Escoja correctamente las fechas.\n';
		bandera = false;
	}
	if (!bandera) alert(err_msg);
	return bandera;
    }
    </script>
    </head>
    <body bgcolor="#FFFFFF">
    <div id="spiffycalendar" class="text"></div>
    <link rel="stylesheet" type="text/css" href="<?=$ruta_raiz?>/js/spiffyCal/spiffyCal_v2_1.css">
    <script language="JavaScript" src="<?=$ruta_raiz?>/js/spiffyCal/spiffyCal_v2_1.js"></script>
    <script language="JavaScript" src="<?=$ruta_raiz?>/js/formchek.js"></script>
    <script language="javascript">
    <!--
     var dateAvailable = new ctlSpiffyCalendarBox("dateAvailable", "adm_depe", "fecha_busq","btnDate1","<?=$fecha_busq?>",scBTNMODE_CUSTOMBLUE);
     var dateAvailable2 = new ctlSpiffyCalendarBox("dateAvailable2", "adm_depe", "fecha_busq2","btnDate1","<?=$fecha_busq2?>",scBTNMODE_CUSTOMBLUE);
     //-->
    </script>
    <table class=borde_tab width='100%' cellspacing="5"><tr><td class=titulos2><center>DEPENDENCIAS TVD</center></td></tr></table>
    <form method="post" action="<?=$PHPSELF?>?<?=$encabezado?>" name="adm_depe"> 
    <center>
    <TABLE width="550" class="borde_tab" cellspacing="5">       
    <TR>
	<TD width="125" height="21"  class='titulos2'> C&oacute;digo</td>
	<TD valign="top" align="left" class='listado2'><input type=text id="coddepeI" name=coddepeI value='<?=$coddepeI?>' class='tex_area' size=4 maxlength="4" ></td>
    </tr>
    <tr>
	<TD height="26" class='titulos2'> Nombre</td>
	<TD valign="top" align="left" class='listado2'><input type=text id="detadepe" name=detadepe value='<?=$detadepe?>' class='tex_area' size=100 maxlength="100" ></td>
    </tr>
    <tr>
	<TD height="26" class='titulos2'>Fecha desde<br></td>
	<TD width="225" align="right" valign="top" class='listado2'>
		<script language="javascript">
		dateAvailable.date = "<?=date('Y-m-d');?>";
		dateAvailable.writeControl();
		dateAvailable.dateFormat="yyyy-MM-dd";
		</script>
	</TD>
     </TR>
     <TR>
	<TD height="26" class='titulos2'> Fecha Hasta<br></td>
	<TD width="225" align="right" valign="top" class='listado2'>
		<script language="javascript">
		dateAvailable2.date = "<?=date('Y-m-d');?>";
		dateAvailable2.writeControl();
		dateAvailable2.dateFormat="yyyy-MM-dd";
		</script>
	</td>
     </TR>   
     <tr>
	<td height="26" colspan="3" valign="top" class='titulos2'>
		<center>
		<input type=submit name=buscar_depe Value='Listar' class=botones >
		<input type=submit name=insertar_depe Value='Insertar' class=botones onclick="return val_datos();" >
		<input type=submit name=actua_depe Value='Modificar' class=botones onclick="return val_datos();" >
		<a href='menu_tvd.php?<?=$encabezado?>'><input name='Regresar' align="middle" type="button" class="botones" id="regresar" value="Regresar" ></a>
		</center>
	</td>
     </tr>
    </table>
    <?PHP
    //transformo datos
    $detadepe = strtoupper(trim($detadepe));

    include("$ruta_raiz/include/query/tvd/querydependencias.php");

    //Boton insertar
    if($insertar_depe && $coddepeI !=0 && $detadepe !='')
    {
	//valida que no exista un registro con el mismo codigo
	$isqlB=$isql." where sgd_depe_codi=$coddepe";
	$rs = $db->query($isqlB); 
	if ($rs->EOF)
	{
		$mensaje_err = "<HR><center><B><FONT COLOR=RED>EL CODIGO < $coddepeI > YA EXISTE. <BR>  VERIFIQUE LA INFORMACION E INTENTE DE NUEVO</FONT></B></center><HR>";
	} 
	else 
	{
		//inserto valor

		$rsIN = $db->conn->query($isqlIN);
		$coddepeI = 0 ;
		$detadepe = '';
		$mensaje_err = "<HR><center><B><FONT COLOR=RED>EL CODIGO < $coddepeI > FUE INSERTADO CORRECTAMENTE </FONT></B></center><HR>";
	}
    }

     //Boton Actualizar
    if($actua_depe && $coddepeI !=0 && $detadepe !='')
    {
	$isqlB= $isql." where sgd_depe_nombre='$detadepe' ";
	$rs = $db->query($isqlB); 
	if (!$rs->EOF)
	{
		$mensaje_err = "<HR><center><B><FONT COLOR=RED>EL CODIGO < $coddepeI > NO EXISTE. <BR>  VERIFIQUE LA INFORMACI&Oacute;N E INTENTE DE NUEVO</FONT></B></center><HR>";
	} 
	else 
	{
			$rsUp= $db->query($isqlUp);
			$coddepeI = 0 ;
			$detadepe = '';
			$mensaje_err ="<HR><center><B><FONT COLOR=RED>SE MODIFIC&Oacute; LA DEPENDENCIA</FONT></B></center><HR>";
    ?>
			<script language="javascript">
			document.adm_depe.coddepeI.value ='';
			document.adm_depe.detadepe.value ='';
			</script>
    <?php
	}
     }

    echo "$mensaje_err";
    //Si no presiona ningun boton, se listan todas las dependencias
    //$sql .= " where upper(sgd_depe_nombre) like '%".strtoupper($detadepe)."%'";
    $rs=$db->conn->Execute($isql);
    if ($rs->EOF)  {
		echo "<hr><center><b><span class='alarmas'>No se encuentra ningun radicado con el criterio de busqueda</span></center></b></hr>";
	}
    else{
	$pager = new ADODB_Pager($db,$isql,'adodb', true,$orderNo,$orderTipo);
	$pager->checkAll = false;
	$pager->checkTitulo = true;
	$pager->toRefLinks = $linkPagina;
	$pager->toRefVars = $encabezado;
	$pager->descCarpetasGen=$descCarpetasGen;
	$pager->descCarpetasPer=$descCarpetasPer;
	$pager->Render($rows_per_page=20,$linkPagina,$checkbox=chkAnulados);
	}

   ?>

   </form>
   </body>
   </html>
