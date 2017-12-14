<?
/**
* Administrador de Series de la Tabla de Valoracion Documental TVD 
* Sistema de gestion Documental ORFEO.
* Permite la creacion, listado y modificacion de Series para TVD
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

    include "$ruta_raiz/include/query/tvd/queryseries.php";

    $encabezado = session_name()."=".session_id()."&krd=$krd";
    $linkPagina = "$PHP_SELF?$encabezado&orderTipo=$orderTipo&orderNo=$orderNo";	
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
        if (!bandera) alert(err_msg);
        return bandera;
       }
      </script>
    </head>
    <body bgcolor="#FFFFFF">
    <form name="adm_serie" id='adm_serie' method='post'  action='admin_series.php?<?=session_name()."=".session_id()."&krd=$krd&tiem_ac=$tiem_ac&coddepe=$coddepe&codserie=$codserie&detaserie=$detaserie"?>'>      
    <table class=borde_tab width='100%' cellspacing="5"><tr><td class=titulos2><center>SERIES DE VALORACION DOCUMENTAL</center></td></tr></table>
    <table><tr><td></td></tr></table>
    <center>
    <TABLE width="550" class="borde_tab" cellspacing="5">       
    <TR>
    <TD width="95" height="21"  class='titulos2'>Dependencia<br>
    <td class="listado5"> 
    <?php
	$rsD=$db->conn->query($query_dep);
	print $rsD->GetMenu2("coddepe", $coddepe, "0:-- Seleccione --", false,"","onChange='submit()' class='select'" );
    ?>
     </td>
     </td>
    <?
    if($_POST['actua_serie'] and $_POST['codserie'])
     {
    ?>
     <td width="35" height="21"><input type=submit name=modi_serie Value='Grabar Modificacion' class=botones_largo ></td>
     <?
     }
    ?>
    <tr>
	<td width="125" height="21"  class='titulos2'>C&oacute;digo serie</td>
	<td width="125" valign="top" align="left" class='listado2'>
	<input name="codserie" type="text" size="4" maxlength="4" class="tex_area" value="<?=$codserie?>">
	</td>
	<td width="125" height="21"  class='titulos2'>Nombre</td>
	<td valign="top" align="left" class='listado2'>
	<input name="detaserie" type="text" size="50" class="tex_area" value="<?=$detaserie?>">
	</td>
    </tr>
    <tr> 
    	 <TD width="125" height="21"  class='titulos2'> Tiempo Archivo Central</td>
      	 <TD valign="top" align="left" class='listado2'>
	 <input name="tiem_ac" type="text" size="2" class="tex_area" value="<?=$tiem_ac?>"> 
	 </td>
	 <TD width="125" height="21"  class='titulos2'>Disposici&oacute;n Final</td>
         <TD valign="top" align="left" class='listado2'>
	 <select  name='med'  class='select'>
	 <?php
	 if($med==1){$datosel=" selected ";}else {$datosel=" ";}
		echo "<option value='1' $datosel><font>CONSERVACION TOTAL</font></option>";
	 if($med==2){$datosel=" selected ";}else {$datosel=" ";}
		echo "<option value='2' $datosel><font>ELIMINACION</font></option>";
	 if($med==3){$datosel=" selected ";}else {$datosel=" ";}
		echo "<option value='3' $datosel><font>MEDIO TECNICO</font></option>";
	 if($med==4){$datosel=" selected ";}else {$datosel=" ";}
		echo "<option value='4' $datosel><font>SELECCION O MUESTREO</font></option>";
		?>
	 </select>
	 </td>
    </tr>
    <tr>
    	 <TD width="125" height="21"  class='titulos2'>Procedimiento</td>
	 <td width="75%" class="listado5" colspan="2">
	 <textarea name="asu" cols="70" class="tex_area" rows="2" ><?=trim($asu)?></textarea>
	 </td>
    </tr>
    <tr>
    <td height="26" colspan="4" valign="top" class='titulos2'> 
    <center>
	    <input type=submit name=buscar_serie Value='Listar' class=botones >
	    <input type=submit name=insertar_serie Value='Insertar' class=botones onclick="return val_datos();">
	    <input type=submit name=actua_serie Value='Modificar' class=botones >
     	    <a href='menu_tvd.php?<?=$encabezado?>'><input name='Regresar' align="middle" type="button" class="botones" id="regresar" value="Regresar" ></a>
	    </td>

    </tr>
    </table>
    <?PHP
    $detaserie = strtoupper(trim($detaserie));


    //boton insertar	   
    if($insertar_serie){
        if($coddepe!=0 && $codserie !=0 && $detaserie !='' and $tiem_ac != ''){
		//valida que no exista un registro con el mismo codigo
		$isqlB=$isql." where d.sgd_depe_codi=$coddepe and s.sgd_stvd_codi=$codserie";
	        $rs = $db->query($isqlB);
	        if (!$rs->EOF)
	        {
                $mensaje_err = "<HR><center><B><FONT COLOR=RED>EL CODIGO < $coddepe - $codserie > YA EXISTE. <BR>  VERIFIQUE LA INFORMACION E INTENTE DE NUEVO</FONT></B></center><HR>";
	        }
	        else
	        {
               	//inserto valor
		$rsIN = $db->query($isqlIN);
		if(!$rsIN->EOF) $mensaje_err=" <HR><center><B><FONT COLOR=RED> Verifique todos los datos</FONT></B></center><HR>";
		else {$mensaje_err=" <HR><center><B><FONT COLOR=RED> Se inserto la serie correctamente";
		?>
		<script language="javascript">
			document.adm_serie.elements['detaserie'].value= "";
			document.adm_serie.elements['codserie'].value= "";
			document.adm_serie.elements['asu'].value= "";
			document.adm_serie.elements['tiem_ac'].value= "";
			document.adm_serie.elements['med'].value= "";
		</script>
		<?
		}	
  		}
	}else{
		 echo "<script>alert('Los campos Codigo, nombre y tiempo de retencion son OBLIGATORIOS');</script>";
	}
    }
			 
   //Boton modificar		
   if($_POST['actua_serie'] ) {  
	 if ($coddepe !=0 && $codserie !=0 ) {
	         //valida que no exista un registro con el mismo codigo
		$isqlB=$isql." where d.sgd_depe_codi=$coddepe and s.sgd_stvd_codi=$codserie";
                $rs = $db->query($isqlB);
                if ($rs->EOF)
                {
		$mensaje_err = "<HR><center><B><FONT COLOR=RED>EL CODIGO < $codserie >< $codserie > NO EXISTE. <BR>  VERIFIQUE LA INFORMACION E INTENTE DE NUEVO</FONT></B></center><HR>";
                }
                else
                {  
		//Carga Valores actuales
		$detaserie = $rs->fields["NOMBRE"];
 		$tiem_ac   = $rs->fields["TIEMPO ARCHIVO CENTRAL"];  
 		$med       = $rs->fields["DISPOSICION FINAL"];
		$asu       = $rs->fields["PROCEDIMIENTO"];

		//echo "<br> filtro $coddepe $codserie datos  $detaserie  $tiem_ac  $med   $asu  <br> ";
		?>
		<script language="javascript">
			document.adm_serie.elements['detaserie'].value= "<?=$detaserie?>";
			document.adm_serie.elements['codserie'].value= "<?=$codserie?>";
			document.adm_serie.elements['asu'].value= "<?=$asu?>";
			document.adm_serie.elements['tiem_ac'].value= "<?=$tiem_ac?>";
			document.adm_serie.elements['med'].value= "<?=$med?>";
		</script>
		<?
		}
	 }else  {
		  echo "<script>alert('Debe digitar el codigo de la serie');</script>";
		?>
		<script language="javascript">
			document.adm_serie.elements['detaserie'].value= "";
			document.adm_serie.elements['codserie'].value= "";
			document.adm_serie.elements['asu'].value= "";
			document.adm_serie.elements['tiem_ac'].value= "";
			document.adm_serie.elements['med'].value= "";
		</script>
		<?
		}
	}
     
   //Boton Grabar Cambios
   if($_POST['modi_serie'] ){  
       if ($coddepe !=0 && $codserie !=0 && $detaserie != '') {
		//actualizo valores
		$rsUp= $db->query($isqlUp); 
		$mensaje_err ="<HR><center><B><FONT COLOR=RED>SE MODIFICO LA SERIE</FONT></B></center><HR>";
		//reseto valores
		$codserie = '' ;
		$detaserie = '';
		$tiem_ac = '';
		$asu = '';
		?>
		<script language="javascript">
		        document.adm_serie.elements['detaserie'].value= '';
			document.adm_serie.elements['codserie'].value= '';
	    		document.adm_serie.elements['asu'].value= '';
			document.adm_serie.elements['tiem_ac'].value= '';
		</script>
		<?
   	}else{
	    	echo "<script>alert('La Serie, la Subserie y el Detalle son OBLIGATORIOS');</script>";
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
</span>
<p>
</p>
</body>
</html>
