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
     * Modificacion Variables Globales Infometrika 2009-05
     * Licencia GNU/GPL
     */
  
   foreach ($_GET as $key => $valor)   ${$key} = $valor;
   foreach ($_POST as $key => $valor)   ${$key} = $valor;
 
$krd = $_SESSION["krd"];
$dependencia = $_SESSION["dependencia"];
$usua_doc = $_SESSION["usua_doc"];
$codusuario = $_SESSION["codusuario"];
$tpNumRad = $_SESSION["tpNumRad"];
$tpPerRad = $_SESSION["tpPerRad"];
$tpDescRad = $_SESSION["tpDescRad"];
if (!$ruta_raiz)  $ruta_raiz="..";
 $ent = $_POST["ent"];
 if(!$ent) $ent = $_GET["ent"];

//if(!$_SESSION['dependencia']) include "$ruta_raiz/rec_session.php"; 

require_once("$ruta_raiz/include/db/ConnectionHandler.php");
if (!$db) $db = new ConnectionHandler("$ruta_raiz");
include("crea_combos_universales.php");	
error_reporting(7);
$db->conn->SetFetchMode(ADODB_FETCH_NUM);	
//$db->conn->debug=true;
?>
<html>
<head>
<title>Busqueda Remitente / Destino</title>
        <link href="<?= $ruta_raiz . $ESTILOS_PATH2 ?>bootstrap.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="<?= $ruta_raiz . $_SESSION['ESTILOS_PATH_ORFEO'] ?>">
<SCRIPT Language="JavaScript" SRC="../js/crea_combos_2.js"></SCRIPT>
<script LANGUAGE="JavaScript">

<?php
// Convertimos los vectores de los paises, dptos y municipios creados en crea_combos_universales.php a vectores en JavaScript.
echo arrayToJsArray($vpaisesv, 'vp'); 
echo arrayToJsArray($vdptosv, 'vd');
echo arrayToJsArray($vmcposv, 'vm');
?>

function verif_data()
{	
//    if (document.formu1.idcont4.value && document.formu1.idpais4.value && document.formu1.codep_us4.value && document.formu1.muni_us4.value == 0)
//	{	alert("Seleccione la geografia completa del destinatario");
//		return false;
//	}
    if (document.formu1.idcont4.value=="" || document.formu1.idpais4.value=="" || document.formu1.codep_us4.value=="" || document.formu1.muni_us4.value=="")
	{	alert("Seleccione la geografia completa del destinatario");
		return false;
	}
        
         if ( document.formu1.codep_us4.value=="0")
	{	alert("Seleccione la geografia completa del destinatario (Departamento)");
		return false;
	}
        
    if (document.formu1.muni_us4.value=="0")
	{	alert("Seleccione la geografia completa del destinatario (Municipio)");
		return false;
	}
        //modificado por skina
	//este javascript permite generar valores obligatorios por usuario o empresa.
	//Valores obligatorios para usuarios 
	if (document.formu1.tagregar.value == 0)
        {       //alert("Debe seleccionar empresa...es una prueba.");
               //return false;
        	if (document.formu1.no_documento1.value=='')
        	{       alert("Debe colocar un numero de identificacion.");
                	return false;
       		}	
        
        	if (document.formu1.nombre_nus1.value=='')
		{	alert("Debe colocar un nombre del remitente/destinatario.");
			return false;
		}
	
        	if (document.formu1.prim_apell_nus1.value=='')
        	{       alert("Debe colocar primer apellido.");
                	return false;
        	}
     
        	/*if (document.formu1.seg_apell_nus1.value=='')
        	{       alert("Debe colocar segundo apellido.");
                	return false;
        	}*/
     
		if (document.formu1.direccion_nus1.value=='')
		{	alert("Debe colocar Direccion de la persona.");
			return false;
		}
	
        	if (document.formu1.telefono_nus1.value=='')
        	{       alert("Debe colocar el numero de telefono.");
                	return false;
       		}
        	return true;

	} 

	//valores obligatorios para empresas 
	if (document.formu1.tagregar.value == 2)
        {       //alert("Debe seleccionar empresa...es una prueba.");
               //return false;
                /*if (document.formu1.no_documento1.value=='')
                {       alert("Debe colocar NIT de la empresa.");
                        return false;
                } */      
                if (document.formu1.nombre_nus1.value=='')
                {       alert("Debe colocar el nombre de la empresa.");
                        return false;
                }

		if (document.formu1.seg_apell_nus1.value=='')
                {       alert("Debe colocar contacto o representante legal.");
                        return false;
                }

                if (document.formu1.telefono_nus1.value=='')
                {       alert("Debe colocar el numero de telefono.");
                        return false;
                }

                if (document.formu1.direccion_nus1.value=='')
                {       alert("Debe colocar direccion de la empresa.");
                        return false;
                }
		return true;
	 }

}
function pasar_datos(fecha)
{
<?php
	($busq_salida==true)? $i_registros=1 : $i_registros=3;
	$i_registros=3;
	 for($i=1;$i<=$i_registros;$i++)
	 {
	 echo "documento = document.formu1.documento_us$i.value;\n";
	 echo "if(documento)
			{	nombre = document.formu1.nombre_us$i.value + ' ';
				apellido1 = document.formu1.prim_apell_us$i.value  + ' ' ;
				apellido2 = document.formu1.seg_apell_us$i.value  + ' ' ;
				opener.document.formulario.documento_us$i.value = documento;
				opener.document.formulario.nombre_us$i.value = nombre ;
				opener.document.formulario.prim_apel_us$i.value = apellido1;
				opener.document.formulario.seg_apel_us$i.value  = apellido2;
				opener.document.formulario.telefono_us$i.value  = document.formu1.telefono_us$i.value;      
				opener.document.formulario.mail_us$i.value      = document.formu1.mail_us$i.value;  
				opener.document.formulario.direccion_us$i.value = document.formu1.direccion_us$i.value;
				opener.document.formulario.tipo_emp_us$i.value = document.formu1.tipo_emp_us$i.value;
				opener.document.formulario.cc_documento_us$i.value = document.formu1.cc_documento_us$i.value;";
	 			
				if ($_GET['tipoval'])
				{	echo "	opener.document.formulario.idcont$i.value = document.formu1.idcont$i.value;
						opener.document.formulario.idpais$i.value = document.formu1.idpais$i.value;
						opener.document.formulario.codep_us$i.value = document.formu1.codep_us$i.value;
						opener.document.formulario.muni_us$i.value = document.formu1.muni_us$i.value;
						}";
				}
				else
				{	echo "	opener.document.formulario.idcont$i.value = document.formu1.idcont$i.value;
						opener.cambia(opener.document.formulario,'idpais$i','idcont$i');
						opener.document.formulario.idpais$i.value = document.formu1.idpais$i.value;
						opener.cambia(opener.document.formulario,'codep_us$i','idpais$i');
						opener.document.formulario.codep_us$i.value = document.formu1.codep_us$i.value;
						opener.cambia(opener.document.formulario,'muni_us$i','codep_us$i');
						opener.document.formulario.muni_us$i.value = document.formu1.muni_us$i.value;
						}";
				}
	}
	echo "opener.document.formulario.otro_us1.focus();opener.focus(); window.close();\n";
	?>   
}
</script>
</head>
<body bgcolor="#FFFFFF">
<script LANGUAGE="JavaScript">
tipo_emp=new Array();
nombre=new Array();
documento=new Array();
cc_documento=new Array();      
direccion=new Array();
apell1=new Array();
apell2=new Array();
telefono=new Array();
mail=new Array();
codigo = new Array();
codigo_muni = new Array();   
codigo_dpto = new Array();      
codigo_pais = new Array();
codigo_cont = new Array();
function pasar(indice,tipo_us)
{ 
<?
	error_reporting(0);
	$nombre_essp = strtoupper($nombre_essp);

	(!$envio_salida and !$busq_salida)? $i_registros=3 : $i_registros=1;	
    $i_registros=1;
	for($i=1;$i<=$i_registros;$i++) 
	{
	
		echo "if(tipo_us==$i)
		{
				document.formu1.documento_us$i.value = documento[indice];
				document.formu1.no_documento1.value = cc_documento[indice];
				document.formu1.codigo.value = codigo[indice];			   
				document.formu1.cc_documento_us$i.value = cc_documento[indice];
				document.formu1.nombre_nus1.value = nombre[indice]; 
				document.formu1.nombre_us$i.value = nombre[indice]; 
				document.formu1.prim_apell_us$i.value = apell1[indice];
				document.formu1.prim_apell_nus1.value = apell1[indice];
				document.formu1.seg_apell_us$i.value = apell2[indice];
				document.formu1.seg_apell_nus1.value = apell2[indice];			   
				document.formu1.direccion_us$i.value = direccion[indice];
				document.formu1.direccion_nus1.value = direccion[indice];			   
				document.formu1.telefono_us$i.value = telefono[indice];
				document.formu1.telefono_nus1.value = telefono[indice];			   
				document.formu1.mail_us$i.value = mail[indice];
				document.formu1.mail_nus1.value = mail[indice];			   
				document.formu1.tipo_emp_us$i.value = tipo_emp[indice];
				document.formu1.tagregar.value = tipo_emp[indice];			   
				document.formu1.muni_us$i.value = codigo_muni[indice];
				document.formu1.codep_us$i.value = codigo_dpto[indice];
				document.formu1.idpais$i.value = codigo_pais[indice];
				document.formu1.idcont$i.value = codigo_cont[indice];
				document.formu1.idcont4.value = codigo_cont[indice];
				cambia(formu1,'idpais4','idcont4');
				document.formu1.idpais4.value = codigo_pais[indice];
				cambia(formu1,'codep_us4','idpais4');
				document.formu1.codep_us4.value = codigo_dpto[indice];
				cambia(formu1,'muni_us4','codep_us4');
				document.formu1.muni_us4.value = codigo_muni[indice];
		}";
		}
	?>
}

function activa_chk(forma)
{	//alert(forma.tbusqueda.value);
	//var obj = document.getElementById(chk_desact);
	if (forma.tbusqueda.value == 1)
		forma.chk_desact.disabled = false;
	else
		forma.chk_desact.disabled = true;
}
</script>
<?php
if(!$envio_salida and !$busq_salida)
{
	$label_us = $nombreTp1;
	$label_pred = $nombreTp2;
	$label_emp = $nombreTp3;
}
else
{
	$label_us = "DESTINATARIO";
	$label_pred = "$nombreTp2";	
	$label_emp = "$nombreTp3"; 
}

$tbusqueda = $_POST['tbusqueda'];

if($tagregar and $agregar)	{	$tbusqueda=$tagregar;	}

if($no_documento1 and ($agregar or $modificar))	{	$no_documento = $no_documento1; }
if(!$no_documento1 and $nombre_nus1 and ($agregar or $modificar))	{	$nombre_essp = $nombre_nus1;	}

if(!$formulario)
{
?>  
<form method="post" name="formu1" id="formu1" action="buscar_usuario.php?busq_salida=<?=$busq_salida?>&krd=<?=$krd?>&verrad=<?=$verrad?>&nombreTp1=<?=$nombreTp1?>&nombreTp2=<?=$nombreTp2?>&nombreTp3=<?=$nombreTp3?>&tipoval=<?=$_GET['tipoval'] ?>" >
<?
}
?> 
<center>
<input type="hidden" name="radicados" value="<?= $radicados_old?>">
<table border=1 width="95%" class="borde_tab" cellpadding="0" cellspacing="5">
<tr> 
    <td width="30%" colspan="2" class="titulos5">
            Buscar por:
		<select name='tbusqueda' class='select' onchange="activa_chk(this.form)">
				<?
				if($tbusqueda==0){$datos = "selected";$tbusqueda=0;}else{$datos= "";}
				?> 
			<option value=0 <?=$datos ?>>Usuario</option>
				<?
				if($tbusqueda==1){$datos = "selected";$tbusqueda=1;}else{$datos= "";}
				//Entidades
				//if (strlen($nombreTp3) > 0) echo "<option value=1 $datos>$nombreTp3</option>";
				if (strlen($nombreTp3) > 0) echo "<option value=1 $datos>F.F.M.M</option>";
			

				if($tbusqueda==2){$datos = "selected";$tbusqueda=2;}else{$datos= "";}
				?> 
			<option value=2 <?=$datos ?>>Empresas</option>
				 <? if($tbusqueda==6){$datos = " selected ";$tbusqueda=6;}else{$datos= "";}?>
                        <option value=6 <?=$datos ?>>Funcionario</option>
                                 <? if($tbusqueda==7){$datos = " selected ";$tbusqueda=7;}else{$datos= "";}?>
			<option value=7 <?=$datos ?>>PensionadoS</option>
                                <? if($tbusqueda==8){$datos = " selected ";$tbusqueda=8;}else{$datos= "";}?>

                        <option value=8 <?=$datos ?>>Todos</option>
		</select>
	</td>
        <td class="titulos5" valign="middle">
            <span class="titulos5">Nombre</span> 
            <input type=text name=nombre_essp value='' class="tex_area">
            <input type="checkbox" name="chk_desact" id="chk_desact" <? ($_POST['tbusqueda'] != 1) ? print "disabled" : print ""; ?>>Incluir no vigentes  
        </td>
        <td class="titulos5" valign="middle">
            Documento
            <input type=text name=no_documento value='' class="tex_area">
            </font>
        </td>     
        <td width="5%" align="center" class="titulos5" > 
		<input type=submit name=buscar value='BUSCAR' class="botones">
	</td>
</tr>
</table>
<br>
    <div id="titulo" style="width: 95%;" align="center">Resultado de búsqueda
    </div>
<table class=borde_tab width="95%" border='1' cellpadding="0" cellspacing="5">
  <!--DWLayoutTable-->
<tr class="grisCCCCCC" align="center"> 
	<td width="11%" class="titulos3" >Documento</td>
	<td width="11%" class="titulos3" >Nombre</td>
	<td width="14%" class="titulos3" >Prim.<BR>Apellido o sigla</td>
	<td width="15%" class="titulos3" >Seg.<BR>Apellido o r legal</td>
	<td width="14%" class="titulos3">Dirección</td>
	<td width="9%" class="titulos3" >Teléfono</td>
	<td width="7%" class="titulos3" >Email</td>
	<td colspan="3" class="titulos3" >Colocar como</td>
</tr> 
  <?
   $grilla = "titulos5";
   $i = 0;
   // ********************************
   
   // ********************************
	if($modificar=="MODIFICAR" or $agregar=="AGREGAR")
	{
		$muni_tmp = explode("-",$muni_us4);
   		$muni_tmp = $muni_tmp[2];
   		$dpto_tmp = explode("-",$codep_us4);
   		$dpto_tmp = $dpto_tmp[1];
   }
   if($modificar=="MODIFICAR" and $tagregar==0)
   {	$isql = "update SGD_CIU_CIUDADANO set SGD_CIU_CEDULA='$no_documento1', SGD_CIU_NOMBRE='$nombre_nus1', 
      			SGD_CIU_DIRECCION='$direccion_nus1', SGD_CIU_APELL1='$prim_apell_nus1', SGD_CIU_APELL2='$seg_apell_nus1',
      			SGD_CIU_TELEFONO='$telefono_nus1', SGD_CIU_EMAIL='$mail_nus1', ID_CONT=$idcont4, ID_PAIS=$idpais4, 
      			DPTO_CODI=$dpto_tmp, MUNI_CODI=$muni_tmp where SGD_CIU_CODIGO=$codigo ";
	   	$rs=$db->query($isql);
			if (!$rs){
				die ("<span class='etextomenu'>No se pudo actualizar SGD_CIU_CIUDADANO ($isql) "); 	
			}
      $isql = "select * from SGD_CIU_CIUDADANO where SGD_CIU_CEDULA='$no_documento1'";
			$rs=$db->query($isql);

	  }

	 $db->conn->SetFetchMode(ADODB_FETCH_ASSOC);		
   if($agregar=="AGREGAR" and $tagregar==0)
   {
		$cedula = 999999;
		if($no_documento)
	{
			$isql = "select SGD_CIU_CEDULA  from SGD_CIU_CIUDADANO WHERE  SGD_CIU_CEDULA='$no_documento'";
			$rs=$db->query($isql);
			
			if  (!$rs->EOF)	$cedula = $rs->fields["SGD_CIU_CEDULA"] ;
	   $flag ==0;
	  }
	   //echo "--->Doc >$no_documento<";
     if($cedula==$no_documento and $no_documento!="" and $no_documento!=0)
	 {
	   echo "<center><b><font color=red><center><< No se ha podido agregar el usuario, El usuario ya se encuentra >> </center></font>";
     }else
	 {
	 	 
 	
   	$nextval=$db->nextId("sec_ciu_ciudadano");
	$nombre_nus1=strtoupper($nombre_nus1);
	$prim_apell_nus1=strtoupper($prim_apell_nus1);
	$seg_apell_nus1=strtoupper($seg_apell_nus1);
		if ($nextval==-1){
			die ("<span class='etextomenu'>No se encontr� la secuencia sec_ciu_ciudadano ");						   
		}
	   error_reporting(7);
			$isql = "INSERT INTO SGD_CIU_CIUDADANO(SGD_CIU_CEDULA, TDID_CODI, SGD_CIU_CODIGO, SGD_CIU_NOMBRE,
					SGD_CIU_DIRECCION, SGD_CIU_APELL1, SGD_CIU_APELL2, SGD_CIU_TELEFONO, SGD_CIU_EMAIL, ID_CONT, ID_PAIS, 
					DPTO_CODI, MUNI_CODI) values ('$no_documento', 2, $nextval, '$nombre_nus1', '$direccion_nus1', 
					'$prim_apell_nus1', '$seg_apell_nus1','$telefono_nus1', '$mail_nus1', 
					$idcont4, $idpais4, $dpto_tmp, $muni_tmp)";
	   if (!trim($no_documento)) $nombre_essp = "$nombre_nus1 $prim_apell_nus1 $seg_apell_nus1";
		 $rs=$db->query($isql);
		 if (!$rs){
				$db->conn->RollbackTrans();
				die ("<span class='etextomenu'>No se pudo actualizar SGD_CIU_CIUDADANO ($isql) "); 	
		 }
	   }
	   if ($flag==1)
	   {
			echo "<center><b><font color=red><center>No se ha podido agregar el usuario, verifique que los datos sean correctos</center></font>";
	   }
       $isql = "select * from SGD_CIU_CIUDADANO where SGD_CIU_CEDULA='$no_documento1'";
	   	 $rs=$db->query($isql);
   }
   if($agregar=="AGREGAR" and $tagregar==2)
   {
			$nextval=$db->nextId("sec_oem_oempresas");

		if ($nextval==-1)
		{	die ("<span class='etextomenu'>No se encontr&oacute; la secuencia sec_oem_oempresas ");						   
		}
			 
		$isql = "INSERT INTO SGD_OEM_OEMPRESAS( tdid_codi, SGD_OEM_CODIGO, SGD_OEM_NIT, SGD_OEM_OEMPRESA, SGD_OEM_DIRECCION, 
				SGD_OEM_REP_LEGAL, SGD_OEM_SIGLA, SGD_OEM_TELEFONO, ID_CONT, ID_PAIS, DPTO_CODI, MUNI_CODI) 
				values (4, $nextval, '$no_documento', '$nombre_nus1', '$direccion_nus1', '$seg_apell_nus1', 
						'$prim_apell_nus1', '$telefono_nus1',$idcont4, $idpais4, $dpto_tmp, $muni_tmp)";
		$rs=$db->query($isql);
			 
		if (!$rs)
				die ("<span class='titulosError'>No se pudo insertar en SGD_OEM_OEMPRESAS ($isql) "); 	
		
 }
   if($modificar=="MODIFICAR" and $tagregar==2)
	{	$isql = "UPDATE SGD_OEM_OEMPRESAS SET SGD_OEM_NIT='$no_documento1', SGD_OEM_OEMPRESA='$nombre_nus1', 
				SGD_OEM_DIRECCION='$direccion_nus1', SGD_OEM_REP_LEGAL='$seg_apell_nus1', SGD_OEM_SIGLA='$prim_apell_nus1',
				SGD_OEM_TELEFONO='$telefono_nus1', ID_CONT=$idcont4, ID_PAIS= $idpais4, DPTO_CODI=$dpto_tmp, 
				MUNI_CODI=$muni_tmp where SGD_OEM_CODIGO='$codigo'";
		$rs=$db->query($isql);
		 
		 if (!$rs){
				$db->conn->RollbackTrans();
		 }
 	 }

//edd2-----------------
   if($modificar=="MODIFICAR" and $tagregar==7)
   {    $isql = "update SGD_PEN_PENSIONADOS set SGD_CIU_CEDULA='$no_documento1', SGD_CIU_NOMBRE='$nombre_nus1',
                        SGD_CIU_DIRECCION='$direccion_nus1', SGD_CIU_APELL1='$prim_apell_nus1', SGD_CIU_APELL2='$seg_apell_nus1',
                        SGD_CIU_TELEFONO='$telefono_nus1', SGD_CIU_EMAIL='$mail_nus1', ID_CONT=$idcont4, ID_PAIS=$idpais4,
                        DPTO_CODI=$dpto_tmp, MUNI_CODI=$muni_tmp where SGD_CIU_CODIGO=$codigo ";
                $rs=$db->query($isql);
                        if (!$rs){
                                die ("<span class='etextomenu'>No se pudo actualizar SGD_PEN_PENSIONADOS ($isql) ");  
                        }
      //modificado skina
        //$isql = "select * from SGD_CIU_CIUDADANO where SGD_CIU_CEDULA='$no_documento1'";
      $isql = "select * from SGD_PEN_PENSIONADOS where SGD_CIU_CODIGO=$codigo";
                        $rs=$db->query($isql);

          }

         $db->conn->SetFetchMode(ADODB_FETCH_ASSOC);          if($agregar=="AGREGAR" and $tagregar==8)
   {
                $cedula = 999999;
                if($no_documento)
        {
                        $isql = "select SGD_CIU_CEDULA  from SGD_PEN_PENSIONADOS WHERE  SGD_CIU_CEDULA='$no_documento'";
                        $rs=$db->query($isql);

                        if  (!$rs->EOF) $cedula = $rs->fields["SGD_CIU_CEDULA"] ;
           $flag ==0;
          }
           //echo "--->Doc >$no_documento<";
     if($cedula==$no_documento and $no_documento!="" and $no_documento!=0)
         {
           echo "<center><b><font color=red><center><< No se ha podido agregar el usuario, El usuario ya se encuentra >> </center></font>";
     }else
         {


        $nextval=$db->nextId("sec_pen_pensionados");
                if ($nextval==-1){
                        die ("<span class='etextomenu'>No se encontr� la secuencia a sec_pen_pensionados ");        
                }
           error_reporting(7);
                        $isql = "INSERT INTO SGD_PEN_PENSIONADOS(SGD_CIU_CEDULA, TDID_CODI, SGD_CIU_CODIGO, SGD_CIU_NOMBRE,
                                        SGD_CIU_DIRECCION, SGD_CIU_APELL1, SGD_CIU_APELL2, SGD_CIU_TELEFONO, SGD_CIU_EMAIL, ID_CONT, ID_PAIS,
                                        DPTO_CODI, MUNI_CODI) values ('$no_documento', 2, $nextval, '$nombre_nus1', '$direccion_nus1',
                                        '$prim_apell_nus1', '$seg_apell_nus1','$telefono_nus1', '$mail_nus1',
                                        $idcont4, $idpais4, $dpto_tmp, $muni_tmp)";
           if (!trim($no_documento)) $nombre_essp = "$nombre_nus1 $prim_apell_nus1 $seg_apell_nus1";
                 $rs=$db->query($isql);
                 if (!$rs){
                                $db->conn->RollbackTrans();
                                die ("<span class='etextomenu'>No se pudo actualizar SGD_PEN_PENSIONADOS ($isql) ");  
                 }
           }
           if ($flag==1)
           {
                        echo "<center><b><font color=red><center>No se ha podido agregar el usuario, verifique que los datos sean correctos</center></font>";
           }
       //modificado skina para tomar valor consecutivo
        //$isql = "select * from SGD_CIU_CIUDADANO where SGD_CIU_CEDULA='$no_documento1'";
       $isql = "select * from SGD_PEN_PENSIONADOS where SGD_CIU_CODIGO=$nextval";
                 $rs=$db->query($isql);

}

 
if($no_documento or $nombre_essp)
{

	// busqueda por Usuario o todos
	if($tbusqueda==0 or $tbusqueda==8)
	{	$array_nombre = split(" ",$nombre_essp."    ");
   		$isql = "select * from SGD_CIU_CIUDADANO ";
		if($nombre_essp)
   		{	if($array_nombre[0]) {$where_split = $db->conn->Concat("UPPER(sgd_ciu_nombre)","UPPER(sgd_ciu_apell1)","UPPER(sgd_ciu_apell2)"). " LIKE '%". $array_nombre[0] ."%' ";}
			if($array_nombre[1]) {$where_split .= " and ". $db->conn->Concat("UPPER(sgd_ciu_nombre)","UPPER(sgd_ciu_apell1)","UPPER(sgd_ciu_apell2)"). " LIKE '%". $array_nombre[1] ."%' ";}
			if($array_nombre[2]) {$where_split .= " and ". $db->conn->Concat("UPPER(sgd_ciu_nombre)","UPPER(sgd_ciu_apell1)","UPPER(sgd_ciu_apell2)"). " LIKE '%". $array_nombre[2] ."%' ";}
			if($array_nombre[3]) {$where_split .= " and ". $db->conn->Concat("UPPER(sgd_ciu_nombre)","UPPER(sgd_ciu_apell1)","UPPER(sgd_ciu_apell2)"). " LIKE '%". $array_nombre[3] ."%' ";}         
			$isql .= " where $where_split ";
                       
		}

	   if($no_documento)
	   {	if($nombre_essp) $isql .= " and "; else 	   $isql .= " where ";
			$isql .= " SGD_CIU_CEDULA='$no_documento' ";
	   }
           $isql0=$isql;  //  isql  para union de querys  Skina para CIAC
	   $isql .= " order by sgd_ciu_nombre,sgd_ciu_apell1,sgd_ciu_apell2 "; 
         // echo 'consulta ciudadano -----'.$isql; 
	} 
 // busqueda por pensionados o Todos
 if($tbusqueda==7 or $tbusqueda==8)
        {       $array_nombre = split(" ",$nombre_essp."    ");
                $isql = "select * from SGD_PEN_PENSIONADOS ";
                if($nombre_essp)
                {       if($array_nombre[0]) {$where_split = $db->conn->Concat("UPPER(sgd_ciu_nombre)","UPPER(sgd_ciu_apell1)","UPPER(sgd_ciu_apell2)"). " LIKE '%". $array_nombre[0] ."%' ";}
                        if($array_nombre[1]) {$where_split .= " and ". $db->conn->Concat("UPPER(sgd_ciu_nombre)","UPPER(sgd_ciu_apell1)","UPPER(sgd_ciu_apell2)"). " LIKE '%". $array_nombre[1] ."%' ";}
                        if($array_nombre[2]) {$where_split .= " and ". $db->conn->Concat("UPPER(sgd_ciu_nombre)","UPPER(sgd_ciu_apell1)","UPPER(sgd_ciu_apell2)"). " LIKE '%". $array_nombre[2] ."%' ";}
                        if($array_nombre[3]) {$where_split .= " and ". $db->conn->Concat("UPPER(sgd_ciu_nombre)","UPPER(sgd_ciu_apell1)","UPPER(sgd_ciu_apell2)"). " LIKE '%". $array_nombre[3] ."%' ";}
                        $isql .= " where $where_split ";
                }

           if($no_documento)
           {    if($nombre_eesp) $isql .= " and "; else            $isql .= " where ";
                        $isql .= " SGD_CIU_CEDULA='$no_documento' ";
           }
            $isql7=$isql;

           $isql .= " order by sgd_ciu_nombre,sgd_ciu_apell1,sgd_ciu_apell2 ";
		//echo 'consulta pensionados ----- '.$isql;

}
	// Busqueda por empresas o todos
	if($tbusqueda==2 or $tbusqueda==8)
	{	$isql = "select SGD_OEM_NIT AS SGD_CIU_CEDULA,SGD_OEM_OEMPRESA as SGD_CIU_NOMBRE,SGD_OEM_REP_LEGAL as SGD_CIU_APELL2, ".
				"SGD_OEM_CODIGO AS SGD_CIU_CODIGO,SGD_OEM_DIRECCION as SGD_CIU_DIRECCION,SGD_OEM_TELEFONO AS SGD_CIU_TELEFONO, ".
				"SGD_OEM_SIGLA AS SGD_CIU_APELL1,MUNI_CODI,DPTO_CODI,ID_PAIS,ID_CONT from SGD_OEM_OEMPRESAS";

		if($nombre_essp){
		   if($no_documento){
                        $isql .= " where UPPER(SGD_OEM_OEMPRESA) LIKE '%$nombre_essp%' OR UPPER(SGD_OEM_SIGLA) LIKE '%$nombre_essp%' and SGD_OEM_NIT = '$no_documento'";
                   }else{
			$isql .= " where UPPER(SGD_OEM_OEMPRESA) LIKE '%$nombre_essp%' OR UPPER(SGD_OEM_SIGLA) LIKE '%$nombre_essp%'";
		   }
		} 

	 	elseif($no_documento){	
		   if($nombre_essp){
			$isql .= " where UPPER(SGD_OEM_OEMPRESA) LIKE '%$nombre_essp%' OR UPPER(SGD_OEM_SIGLA) LIKE '%$nombre_essp%' and SGD_OEM_NIT = '$no_documento'";
		   }else{
			$isql .= " where SGD_OEM_NIT = '$no_documento'   ";
		   }
		}
		
		$isql .= " order by sgd_oem_oempresa";
	
		// consulta qeu se ejecuta en la opcion 8
		$isql2="  select TDID_CODI,  SGD_OEM_CODIGO AS SGD_CIU_CODIGO,SGD_OEM_OEMPRESA as SGD_CIU_NOMBRE,".
                         " SGD_OEM_DIRECCION as SGD_CIU_DIRECCION,  SGD_OEM_SIGLA AS SGD_CIU_APELL1,SGD_OEM_REP_LEGAL ".
                          "as SGD_CIU_APELL2,SGD_OEM_TELEFONO AS SGD_CIU_TELEFONO, EMAIL AS SGD_CIU_EMAIL, MUNI_CODI,".
                          "DPTO_CODI,SGD_OEM_NIT AS SGD_CIU_CEDULA, ID_PAIS, ID_CONT from SGD_OEM_OEMPRESAS where UPPER".
                         " (SGD_OEM_OEMPRESA) LIKE '%$nombre_essp%' OR UPPER(SGD_OEM_SIGLA) LIKE '%$nombre_essp%'  ";
               
		//echo 'consulta empresas ---'.$isql;
	}

	// busqueda por terceros(f.f.m.m) o todos
	if($tbusqueda==1 or $tbusqueda==8)
	{	$isql = "select NIT_DE_LA_EMPRESA AS SGD_CIU_CEDULA,NOMBRE_DE_LA_EMPRESA as SGD_CIU_NOMBRE,SIGLA_DE_LA_EMPRESA as SGD_CIU_APELL1, ".
				"IDENTIFICADOR_EMPRESA AS SGD_CIU_CODIGO,DIRECCION as SGD_CIU_DIRECCION,TELEFONO_1 AS SGD_CIU_TELEFONO, ".
				"NOMBRE_REP_LEGAL as SGD_CIU_APELL2,SIGLA_DE_LA_EMPRESA as SGD_CIU_APELL1,CODIGO_DEL_DEPARTAMENTO as DPTO_CODI, ".
				"CODIGO_DEL_MUNICIPIO as MUNI_CODI,ID_PAIS, ID_CONT from BODEGA_EMPRESAS ".
				"WHERE (UPPER(SIGLA_DE_LA_EMPRESA) LIKE '%$nombre_essp%' OR UPPER(NOMBRE_DE_LA_EMPRESA) LIKE '%$nombre_essp%') ";
		//Si incluye ESP desactivas
		if (!isset($_POST['chk_desact']))$isql.= " and ACTIVA = 1 ";
		if(strlen(trim($no_documento))>0){	
			$isql.= " and NIT_DE_LA_EMPRESA like '%$no_documento%'"; 
			$isql .= " order by NOMBRE_DE_LA_EMPRESA ";
	   	}

             $isql1="  select ARE_ESP_SECUE AS TDID_CODI,IDENTIFICADOR_EMPRESA AS SGD_CIU_CODIGO,NOMBRE_DE_LA_EMPRESA as SGD_CIU_NOMBRE, DIRECCION as".
                       " SGD_CIU_DIRECCION, NOMBRE_REP_LEGAL  as SGD_CIU_APELL1, SIGLA_DE_LA_EMPRESA as SGD_CIU_APELL2, TELEFONO_1 AS SGD_CIU_TELEFONO,".
                       "EMAIL AS SGD_CIU_EMAIL,  CAST(CODIGO_DEL_MUNICIPIO as numeric(10,0))  as MUNI_CODI, CAST( CODIGO_DEL_DEPARTAMENTO as numeric(10,0))".
                       " as DPTO_CODI, NIT_DE_LA_EMPRESA AS SGD_CIU_CEDULA, ID_CONT,ID_PAIS  from BODEGA_EMPRESAS WHERE (UPPER(SIGLA_DE_LA_EMPRESA) LIKE".
                       " '%$nombre_essp%' OR UPPER(NOMBRE_DE_LA_EMPRESA) LIKE '%$nombre_essp%') and ACTIVA = 1  ";
		//echo 'consulta terceros --- '.$isql;
	}
	
	// busqueda por funcionario o todos
	if($tbusqueda==6 or $tbusqueda==8)
   	{	$array_nombre = split(" ",$nombre_essp."    ");
	 	$isql = "select usua_doc AS SGD_CIU_CEDULA,usua_nomb as SGD_CIU_NOMBRE,'' as SGD_CIU_APELL1,USUA_DOC AS SGD_CIU_CODIGO, ".
				"dependencia.depe_nomb as SGD_CIU_DIRECCION,USUARIO.USUA_EXT  AS SGD_CIU_TELEFONO,USUARIO.USUA_LOGIN as SGD_CIU_APELL2, ".
				"'' as SGD_CIU_APELL1,dependencia.ID_CONT, dependencia.ID_PAIS, dependencia.DPTO_CODI as DPTO_CODI,dependencia.MUNI_CODI as MUNI_CODI,USUARIO.usua_email as SGD_CIU_EMAIL ".
       			"from USUARIO,dependencia where USUA_ESTA='1' AND USUARIO.depe_codi = dependencia.depe_codi ";
		if($nombre_essp){	
			if($array_nombre[0]) {$where_split = "  UPPER(USUA_NOMB) LIKE '%". $array_nombre[0] ."%' ";}
			if($array_nombre[1]) {$where_split .= " AND UPPER(USUA_NOMB) LIKE '%". $array_nombre[1] ."%' ";}
			if($array_nombre[2]) {$where_split .= " AND UPPER(USUA_NOMB) LIKE '%". $array_nombre[2] ."%' ";}
			if($array_nombre[3]) {$where_split .= " AND UPPER(USUA_NOMB) LIKE '%". $array_nombre[3] ."%' ";}     	 
			$isql .= " and $where_split ";
		}
		if($no_documento){	
			if($nombre_eesp) $isql .= " and "; else $isql .= " and ";
			$isql .= " usua_doc='$no_documento' ";
		}

		$isql .= " order by usua_nomb "; 
                $isql6=" select  1  as TDID_CODI, USUA_CODI AS SGD_CIU_CODIGO,usua_nomb as SGD_CIU_NOMBRE, dependencia.depe_nomb as SGD_CIU_DIRECCION,".
                            " '' as SGD_CIU_APELL1,USUARIO.USUA_LOGIN as SGD_CIU_APELL2, CAST(  USUARIO.USUA_EXT as character varying(50)) AS SGD_CIU_TELEFONO,".
                               " USUARIO.usua_email as SGD_CIU_EMAIL ,dependencia.MUNI_CODI as MUNI_CODI, dependencia.DPTO_CODI as DPTO_CODI,usua_doc AS".
                               " SGD_CIU_CEDULA,  dependencia.ID_PAIS, dependencia.ID_CONT  from USUARIO, dependencia where USUA_ESTA='1'  AND USUARIO.depe_codi".                               " = dependencia.depe_codi and UPPER(USUA_NOMB) LIKE '%$nombre_essp%'";
		//echo 'consulta funcionarios --- '.$isql;
	}
        
      	if ($tbusqueda==8){
            $isql=$isql0 ." UNION ".$isql1." UNION ".$isql2." UNION ".$isql6." UNION ".$isql7;
        } 
                            
	$rs=$db->query($isql); 
	$tipo_emp = $tbusqueda;
	if($rs && !$rs->EOF){	//echo $isql;
	 	while(!$rs->EOF){	
			$grilla=($grilla=="listado2")?"listado1":"listado2";
?>
				<tr class='<?=$grilla ?>'> 
					<TD> <font size="-3"><?=$rs->fields["SGD_CIU_CEDULA"] ?></font></TD>
					<TD> <font size="-3"> <?=substr($rs->fields["SGD_CIU_NOMBRE"],0,120) ?></font></TD>
					<TD> <font size="-3"> <?=substr($rs->fields["SGD_CIU_APELL1"],0,70) ?></font></TD>
					<TD> <font size="-3"> <?=$rs->fields["SGD_CIU_APELL2"] ?> </font></TD>
					<TD> <font size="-3"> <?=$rs->fields["SGD_CIU_DIRECCION"] ?></font></TD>
					<TD> <font size="-3"> <?=$rs->fields["SGD_CIU_TELEFONO"] ?> </font></TD>
					<TD> <font size="-3"> <?=$rs->fields["SGD_CIU_EMAIL"] ?></font></TD>
					<TD width="6%" align="center" valign="top">
						<font size="-3"><a href="#btnpasar" onClick="pasar('<?=$i ?>',1);"><?=$label_us?></a></font>
					</TD>
    <? 
				if(!$envio_salida or $ent==5) 
				{ 
	?>
<!--Modificado skina-->
		<!--			<td width="6%" align="center" valign="top" class="listado5">
						
					<font size="-3"><a href="#btnpasar" onClick="pasar('<?//=$i ?>',2);" class="titulos5"><?//=$label_pred?>EMPRESA</a></font>
					</td>-->
    <?
					if($tbusqueda==1)
					{
	?>
					<!--	<td width="7%" align="center" valign="top" class="listado5"><font size="-3">-->
							<a href="#btnpasar" onClick="pasar('<?=$i ?>',3);" class="titulos5"><?//=$label_emp?></a></font>
						</td>
    <?
					}
				}
		?>
  </tr><script>
		<? 
			$cc_documento = trim($rs->fields["SGD_CIU_CODIGO"]) . " ";			
			$email = str_replace('"',' ',$rs->fields["SGD_CIU_EMAIL"]) . " ";
			$telefono = str_replace('"',' ',$rs->fields["SGD_CIU_TELEFONO"]) . " ";
			$direccion = str_replace('"',' ',$rs->fields["SGD_CIU_DIRECCION"]) . " ";
			$apell2 = str_replace('"',' ',$rs->fields["SGD_CIU_APELL2"]) . " ";
			$apell1 = str_replace('"',' ',$rs->fields["SGD_CIU_APELL1"]) . " ";
			$nombre = str_replace('"',' ',$rs->fields["SGD_CIU_NOMBRE"]) . " ";
			$codigo = trim($rs->fields["SGD_CIU_CODIGO"]);
				
			$codigo_cont = $rs->fields["ID_CONT"] ;
			$codigo_pais = $rs->fields["ID_PAIS"] ;
			$codigo_dpto = $codigo_pais."-".$rs->fields["DPTO_CODI"];
			$codigo_muni = $codigo_dpto."-".$rs->fields["MUNI_CODI"];
			$cc_documento = trim($rs->fields["SGD_CIU_CEDULA"]) ;			
		?>
			tipo_emp[<?=$i?>]= "<?=$tbusqueda?>";
			documento[<?=$i?>]= "<?=$codigo?>";
			cc_documento[<?=$i?>]= "<?=$cc_documento?>";
			nombre[<?=$i?>]= "<?=$nombre?>";
			apell1[<?=$i?>]= "<?=$apell1?>";
			apell2[<?=$i?>]= "<?=$apell2?>";
			direccion[<?=$i?>]= "<?=$direccion?>";
			telefono[<?=$i?>]= "<?=$telefono?>";
			mail[<?=$i?>]= "<?=$email?>";
			codigo[<?=$i?>]= "<?=$codigo?>";			 
			codigo_muni[<?=$i?>]= "<?=$codigo_muni?>";
			codigo_dpto[<?=$i?>]= "<?=$codigo_dpto?>";			 
			codigo_pais[<?=$i?>]= "<?=$codigo_pais?>";
			codigo_cont[<?=$i?>]= "<?=$codigo_cont?>";
		</script>
  <?
				$i++;
				$rs->MoveNext();
			}
//		echo "<span class='listado2'>Registros Encontrados</span>";
	}else 
	{
			echo "<span class='titulosError'>No se encontraron Registros -- $no_documento</span>";
	}
	}
	?>
</table>
<BR>
    <div id="titulo" style="width: 95%;" align="center">Datos a colocar en la radicación
    </div>
<table class=borde_tab width="95%" cellpadding="0" border='1' cellspacing="4">
<tr align="center" > 
	<td class="titulos3">Usuario</td>
	<td class="titulos3">Documento</td>
	<td class="titulos3">Nombre</td>
	<td class="titulos3">Prim.<BR>Apellido o sigla</td>
	<td class="titulos3">Seg.<BR>Apellido o rep legal</td>
	<td class="titulos3">Direccion</td>
	<td class="titulos3">Telefono</td>
	<td class="titulos3">Email</td>
</tr>
<tr class='<?=$grilla ?>'readonly> 
	<td align="center"  class="titulos5"><font face="Arial, Helvetica, sans-serif"><?=$nombreTp1?></font></td>
	<TD align="center">
		<input type="hidden" name="tipo_emp_us1" value="<?=$tipo_emp_us1?>">
		<input type="hidden" name="documento_us1" size="3" value="<?=$documento_us1?>" >
		<input type="hidden" name="muni_us1" value="<?=$muni_us1 ?>" >
		<input type="hidden" name="codep_us1" value="<?=$codep_us1 ?>" >
		<input type="hidden" name="idpais1" value="<?=$idpais1 ?>" >
		<input type="hidden" name="idcont1" value="<?=$idcont1 ?>" >
                <input type="text" name="cc_documento_us1" value="<?=$cc_documento_us1 ?>" readonly size="14" class="ecajasfecha">
	</TD>
	<TD align="center"> <input type="text" name="nombre_us1" value="<?=$nombre_us1?>" readonly class="ecajasfecha" size="14"> </TD>
	<TD align="center"> <input type="text" name="prim_apell_us1" value="<?=$prim_apell_us1 ?>" readonly class="ecajasfecha" size="14"> </TD>
	<TD align="center"> <input type="text" name="seg_apell_us1" value="<?=$seg_apell_us1 ?>" readonly class="ecajasfecha" size="14"> </TD>
	<TD align="center"> <input type="text" name="direccion_us1" value="<?=$direccion_us1 ?>" readonly class="ecajasfecha" size="14"> </TD>
	<TD align="center"> <input type="text" name="telefono_us1" value="<?=$telefono_us1 ?>" readonly class="ecajasfecha" size="10"> </TD>
	<TD align="center"> <input type="text" name="mail_us1" value="<?=$mail_us1 ?>" readonly class="ecajasfecha" size="14"> </TD>
	
</tr>

<tr class='<?=$grilla ?>'> 
	<!--modificado skina-->
	<!--<td align="center" class="listado5"> <font face="Arial, Helvetica, sans-serif"><?//=$nombreTp2?><BR> o Seg. Not</font></TD>-->
	<td align="center" class="titulos5"> <font face="Arial, Helvetica, sans-serif">Empresa<BR> o Seg. Not</font></TD>
	<TD align="center">
		<input type="hidden" name="tipo_emp_us2" value="<?=$tipo_emp_us2?>" > 
		<input type="hidden" name="documento_us2" value="<?=$documento_us2?>" >
		<input type="hidden" name="codep_us2" value="<?=$codep_us2 ?>" >
		<input type="hidden" name="muni_us2" value="<?=$muni_us2 ?>" >
		<input type="hidden" name="idpais2" value="<?=$idpais2 ?>" >
		<input type="hidden" name="idcont2" value="<?=$idcont2 ?>" > 
		<input type="text" name="cc_documento_us2" value="<?=$cc_documento_us2?>" readonly size="14" class="ecajasfecha" >
	</TD>
	<TD align="center"> <input type="text" readonly name="nombre_us2" value="<?=$nombre_us2 ?>" class="ecajasfecha" size="14"> </TD>
	<TD align="center"> <input type="text" readonly name="prim_apell_us2" value="<?=$prim_apell_us2 ?>" class="ecajasfecha" size="14"> </TD>
	<TD align="center"> <input type="text" readonly name="seg_apell_us2" value="<?=$seg_apell_us2 ?>" class="ecajasfecha" size="14"> </TD>
	<TD align="center"> <input type="text" readonly name="direccion_us2" value="<?=$direccion_us2 ?>" class="ecajasfecha" size="14"> </TD>
	<TD align="center"> <input type="text" readonly name="telefono_us2" value="<?=$telefono_us2 ?>" class="ecajasfecha" size="10"> </TD>
	<TD align="center"> <input type="text" readonly name="mail_us2" value="<?=$mail_us2 ?>" class="ecajasfecha" size="14"> </TD>
</tr>
<tr class='<?=$grilla ?>'> 
<!--MODIFICADO SKINA-->
<!--<td align="center" class="listado5"><font face="Arial, Helvetica, sans-serif"><?//=$nombreTp3?> prueba</font></td>-->
<td align="center" class="titulos5"><font face="Arial, Helvetica, sans-serif">F.F.M.M</font></td>
	<TD align="center">
            <input type=hidden name='tipo_emp_us3' value='<?=$tipo_emp_us3?>' >
		<input type="hidden" name="tipo_emp_us3" value="<?=$tipo_emp_us3?>" > 
		<input type=hidden name=documento_us3 value='<?=$documento_us3?>' >
		<input type=hidden name=codep_us3 value='<?=$codep_us3 ?>'>
		<input type=hidden name=muni_us3 value='<?=$muni_us3 ?>'>
		<input type="hidden" name="idpais3" value="<?=$idpais3 ?>" >
		<input type="hidden" name="idcont3" value="<?=$idcont3 ?>" >
		<input type=text readonly name="cc_documento_us3" value='<?=$cc_documento_us3?>' size="14" class="ecajasfecha">	
	</TD>
	<TD align="center"> <input type="text" readonly name="nombre_us3" value="<?=$nombre_us3 ?>" class="ecajasfecha" size="14"> </TD>
	<TD align="center"> <input type="text" readonly name="prim_apell_us3" value="<?=$prim_apell_us3 ?>" class="ecajasfecha" size="14"> </TD>
	<TD align="center"> <input type="text" readonly name="seg_apell_us3" value="<?=$seg_apell_us3 ?>" class="ecajasfecha" size="14"> </TD>
	<TD align="center"> <input type="text" readonly name="direccion_us3" value="<?=$direccion_us3 ?>"class="ecajasfecha" size="14"> </TD>
	<TD align="center"> <input type="text" readonly name="telefono_us3" value="<?=$telefono_us3 ?>" class="ecajasfecha" size="10"> </TD>
	<TD align="center"> <input type="text" readonly name="mail_us3" value="<?=$mail_us3 ?>" class="ecajasfecha" size="14"> </TD>
</tr>
	<?
	$nombre_tt = str_replace('"',' ',$rs->fields["SGD_CIU_NOMBRE"]);
	?><script>
		 nombre[<?=$i ?>]= "<?=$nombre_tt?>"; 
	</script>
  </table>
  
  <center>
  <?
    if($envio_salida) 
	{
	?>
      <input type=submit name=grb_destino value='Grabar el Destino de Este Radicado' class="botones_largo">
      <input type=hidden name=verrad_sal value='<?=$verrad_sal?>' >
    <? 
	}else
	{
	?>
       <B><A href="javascript:pasar_datos('<?=$fechah?>');" name="btnpasar"><span name=btnpasardatos id=btnpasardatos class="botones_largo">&nbsp;PASAR DATOS AL FORMULARIO DE RADICACIÓN &nbsp;</span></a></B>
      <input type=hidden name=verrad_sal value='<?=$verrad_sal?>' >
    <?
	}
	?> 
    <BR><BR>
<table class=borde_tab border='1' width="95%" cellpadding="0" cellspacing="4">
<tr align="center" class='titulos3' > 
	<td>Documento <font color="#15317E">*</font><font color="#800000"></font></td>
	<td>Nombre <font color="#15317E">*</font><font color="#800000">*</font></td>
	<td>Primer <font color="#15317E">*</font><BR>Apellido o Sigla</td>
	<td>Seg. <!--font color="#15317E">*</font--><font color="#800000">*</font><BR>Apellido o rep legal </td>
	<td>Direccion <font color="#15317E">*</font><font color="#800000">*</font></td>
	<td>Telefono <font color="#15317E">*</font><font color="#800000">*</font></td>

	<td>Email</td>
</tr>
	<tr class='<?=$grilla ?>' align="center"> 
	<TD>  
		<input type="text" name="codigo" class="e_cajas" size="3" value='<?=$codigo?>' >
		<input type="text" name="no_documento1" value="<?=$no_documento ?>" size="13" class="ecajasfecha">
	</TD>
	<TD><input type="text" name="nombre_nus1" value="<?=$nombre_nus1?>"class="ecajasfecha" size=15></TD>
	<TD><input type="text" name="prim_apell_nus1" value="<?=$prim_apell_nus1?>"class="ecajasfecha" size="14"></TD>
	<TD><input type="text" name="seg_apell_nus1" value="<?=$seg_apell_nus1?>" class="ecajasfecha" size="14"></TD>
	<TD><input type="text" name="direccion_nus1" value="<?=$direccion_nus1?>"class="ecajasfecha" size="15"></TD>
	<TD><input type="text" name="telefono_nus1" value="<?=$telefono_nus1?>" class="ecajasfecha" size="10"></TD>
	<TD><input type="text" name="mail_nus1" value="<?=$mail_nus1?>" class="ecajasfecha" size=16></TD>
</tr>
<tr align="center" class='titulos3' class='<?=$grilla ?>'> 
	<td>Continente</font><font color="#800000">*</font></td>
	<td>Pa&iacute;s</font><font color="#800000">*</font></td>
	<td>Dpto / Estado</font><font color="#800000">*</font></td>
	<td>Municipio</font><font color="#800000">*</font></td>
	<td colspan="3" rowspan="2" class='<?=$grilla ?>'>
		<select name="tagregar" class="select">
			<option value='0'>Usuario(Ciudadano) </option>
			<option value='2'>Empresas </option>
			<option value='8'>Pensionado </option>
		</select> 
		<input type='SUBMIT' name='modificar' value='MODIFICAR' class="botones" onclick="return verif_data();">
		<input type='SUBMIT' name='agregar' value='AGREGAR' class="botones" onclick="return verif_data();">
	</td>
</tr>
<tr class='<?=$grilla ?>' align="center"> 
	<TD>
	<?php
		$i = 4;
		
		echo $Rs_Cont->GetMenu2("idcont$i",substr($_SESSION['cod_local'],0,1)*1,"$0:&lt;&lt; seleccione &gt;&gt;",false,0," CLASS=\"select\" id=\"idcont$i\" onchange=\"cambia(this.form, 'idpais$i', 'idcont$i')\" ");
		$Rs_Cont->Move(0);
		
	?>
	</TD>
	<TD>
	<?php
		if ($_SESSION['cod_local']) 
			$paiscodi = substr($_SESSION['cod_local'],2,3)*1;
		echo "<SELECT NAME=\"idpais$i\" ID=\"idpais$i\" CLASS=\"select\" onchange=\"cambia(this.form, 'codep_us$i', 'idpais$i')\">";
		while (!$Rs_pais->EOF)
		{	if ($_SESSION['cod_local'] and ($Rs_pais->fields['id0'] == substr($_SESSION['cod_local'],0,1)*1))//Si hay local Y pais pertenece al continente.
				{	($paiscodi == $Rs_pais->fields['id1'])? $s = " selected='selected'" : $s = "";
					echo "<option".$s." value='".$Rs_pais->fields['id1']."'>".$Rs_pais->fields['nombre']."</option>";
				}
			$Rs_pais->MoveNext();
		}
		echo "</SELECT>";
		$Rs_pais->Move(0);
	?>
	</TD>
	<TD>
	<?php
		echo "<SELECT NAME=\"codep_us$i\" ID=\"codep_us$i\" CLASS=\"select\" onchange=\"cambia(this.form, 'muni_us$i', 'codep_us$i')\">";
		while (!$Rs_dpto->EOF)
		{	if ($_SESSION['cod_local'] and ($Rs_dpto->fields['id0'] == substr($_SESSION['cod_local'],2,3)*1))	//Si hay local Y dpto pertenece al pais.
			{	((substr($_SESSION['cod_local'],2,3)*1)."-".(substr($_SESSION['cod_local'],6,3)*1) == $Rs_dpto->fields['id1'])? $s = " selected='selected'" : $s = "";
				echo "<option".$s." value='".$Rs_dpto->fields['id1']."'>".$Rs_dpto->fields['nombre']."</option>";
			}
			$Rs_dpto->MoveNext();
		}
		echo "</SELECT>";
		$Rs_dpto->Move(0);
	?>
	</TD>
	<TD>
	<?php
		echo "<SELECT NAME=\"muni_us$i\" ID=\"muni_us$i\" CLASS=\"select\"\>";
		while (!$Rs_mcpo->EOF)
		{	if ($_SESSION['cod_local'] and ($Rs_mcpo->fields['id'] == substr($_SESSION['cod_local'],2,3)*1) and ($Rs_mcpo->fields['id0'] == substr($_SESSION['cod_local'],6,3)*1))	//Si hay local Y mcpio pertenece al pais Y dpto.
			{	((substr($_SESSION['cod_local'],2,3)*1)."-".(substr($_SESSION['cod_local'],6,3)*1)."-".(substr($_SESSION['cod_local'],10,3)*1) == $Rs_mcpo->fields['ID1'])? $s = " selected='selected'" : $s = "";
				echo "<option".$s." value='".$Rs_mcpo->fields['id1']."'>".$Rs_mcpo->fields['nombre']."</option>";
			}
			$Rs_mcpo->MoveNext();
		}
		echo "</SELECT>";
		$Rs_mcpo->Move(0);
	?> 
		</td>
</tr>
</table>
<?
if(!$formulario)
{
?>
</form>
<?
}
?>
<input type='button' value='Cerrar' class="botones_largo" onclick='window.close()'></center>
<!--Modificado skina-->
<strong>
<div align="left" > <font color="#15317E" size="2">* Valores obligatorios para usuarios</font></div>
<div align="left" > <font color="#800000" size="2">* Valores obligatorios para empresa</font></div>
</strong>
</body>
</html>
