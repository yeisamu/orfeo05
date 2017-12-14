<?php
session_start();
/*************************************************************************************/
/* ORFEO GPL:Sistema de Gestion Documental		http://www.orfeogpl.org	     */
/*	Idea Original de la SUPERINTENDENCIA DE SERVICIOS PUBLICOS DOMICILIARIOS     */
/*				COLOMBIA TEL. (57) (1) 6913005  orfeogpl@gmail.com   */
/* ===========================                                                       */
/*                                                                                   */
/* Este programa es software libre. usted puede redistribuirlo y/o modificarlo       */
/* bajo los terminos de la licencia GNU General Public publicada por                 */
/* la "Free Software Foundation"; Licencia version 3. 			             */
/*                                                                                   */
/* Copyleft  2008 por :	  	  	                                     */
/* SSPd "Superintendencia de Servicios Publicos Domiciliarios"                       */
/*   Jairo Hernan Losada  jlosada@gmail.com                Desarrollador             */
/*   Liliana Gomez        lgomezv@gmail.com                Desarrolladora            */
/*   */
/*   EMPRESA IYU                                             */
/*   Hollman Ladino       hladino@gmail.com                Desarrollador             */
/*                                                                                   */
/* Colocar desde esta lInea las Modificaciones Realizadas Luego de la Version 3.5    */
/*  Nombre Desarrollador   Correo     Fecha   Modificacion                           */
/*  Infometrika            info@infometrika.com    2009-05  Eliminacino Variables Globales */
/* Skina                  soporte@skinatech.com   2014-01  Modificacion modulo de asignacion de eje tematico inci
/*************************************************************************************/

$krd = $_SESSION["krd"];
$dependencia = $_SESSION["dependencia"];
$usua_doc = $_SESSION["usua_doc"];
$codusuario = $_SESSION["codusuario"];
$ruta_raiz = "."; 
$nurad = $_GET["nurad"];
if($_GET["codEjeTem"]) $CodEjeTem = $_GET["codEjeTem"];
if($_GET["insertar_registro"]) $insertar_registro = $_GET["insertar_registro"];
if($_GET["actualizar"]) $actualizar = $_GET["actualizar"];
if($_GET["borrar"]) $borrar = $_GET["borrar"];
if($_GET["linkarchivo"]) $linkarchivo = $_GET["linkarchivo"];


	if($nurad)
	{
		$ent = substr($nurad,-1);
	}
	include_once("$ruta_raiz/include/db/ConnectionHandler.php");
	
	$db = new ConnectionHandler("$ruta_raiz");
	//Modificado skina
  
	
	if (!defined('ADODB_FETCH_ASSOC')) define('ADODB_FETCH_ASSOC',2);
   	$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;
  	include_once "$ruta_raiz/include/tx/Historico.php";
    	$coddepe = $dependencia;
	$codusua = $codusuario;
	
	$encabezadol = "$PHP_SELF?".session_name()."=".session_id()."&nurad=$nurad&ent=$ent&tdoc=$tdoc&codiTRDModi=$codiTRDModi&codiTRDEli=$codiTRDEli&codserie=$codserie&tsub=$tsub&ind_ProcAnex=$ind_ProcAnex";

	//$db->conn->debug=true;
?>
<html>
<head>
<title>Asignaci&oacute; Eje Tematico</title>
<link href="./estilos/orfeo.css" rel="stylesheet" type="text/css">
<script>
function regresar(){
	document.TipoDocu.submit();
}
</script>
</head>
<body bgcolor="#FFFFFF">
<form method="GET" action="<?=$encabezadol?>" name="TipoDocu"> 
<input type=hidden name=nurad value='<?=$nurad?>'>
<?php
  /*
  * Adicion nuevo Registro
  */
if ($insertar_registro && $CodEjeTem !="" )
{	include_once("../include/query/busqueda/busquedaPiloto1.php");
	$sql = "SELECT SGD_TEMA_CODIGO AS CODIGO_EJE_TEM 
				FROM RADICADO r 
				WHERE RADI_NUME_RADI = '$nurad'
				AND  RADI_DEPE_ACTU =  '$dependencia'";
	$rs=$db->conn->query($sql);
	$codigoEje = $rs->fields["SGD_TEMA_CODIGO"];
	if ($codigoEje !='')
	{
		$CodEjeTema = "" ;
		$mensaje_err="<script type='text/javascript'>alert(Ya existe un  Eje Tematico asignado para este radicado verifique la información e intente de nuevo');</script>";
		  }
		else
			$sql_ins_eje = "UPDATE RADICADO SET 								SGD_TEMA_CODIGO='$CodEjeTem' WHERE 
					RADI_NUME_RADI=$nurad AND
					RADI_DEPE_ACTU=$dependencia AND
					RADI_USUA_ACTU=$codusuario";
		
			$radicados = $db->conn->query($sql_ins_eje);
			if ($radicados){
			echo "<script type='text/javascript'>alert('Eje tematico asignado exitosamente');</script>";
			$sql1="SELECT SGD_TEMA_NOMB FROM SGD_EJE_TEMA WHERE SGD_TEMA_CODIGO='$CodEjeTem'";
			$rs1 = $db->conn->query($sql1);
			
			$observa="Eje tematico : ($CodEjeTem - ".$rs1->fields['SGD_TEMA_NOMB'].")";
			
  		  	$Historico = new Historico($db);
			$codiRegH[0] = $nurad;
			$radiModi = $Historico->insertarHistorico($codiRegH, $dependencia, $codusuario, $dependencia, $codusuario, $observa, 66); 
		 	}else{
			echo "<script type='text/javascript'>alert('No se pudo asignar el Eje tematico, verifique sus datos');</script>";

			}
  	}
	?>  
	<table border=0 width=70% align="center" class="borde_tab" cellspacing="0">
	  <tr align="center" class="titulos2">
	    <td height="15" class="titulos2">ASIGNACION DEL EJE TEMATICO - Radicado No <?=$nurad?></td>
      </tr>
	 </table> 
 	<table width="70%" border="0" cellspacing="1" cellpadding="0" align="center" class="borde_tab">
      <tr >
	  <td class="titulos5" ><label for="codserie">EJE TEMATICO </label></td>
	  <td class=listado5 >
        <?php
  
    
    if(!$CodEjeTem) $CodEjeTem = "";
	$num_car = 4;
	$queryEje = "select sgd_tema_nomb as detalle, sgd_tema_codigo 
	         from sgd_eje_tema  order by detalle ";

	$rsD=$db->conn->query($queryEje);
	$comentarioDev = "Lista los ejes tematicos";
	include "$ruta_raiz/include/tx/ComentarioTx.php";
	print $rsD->GetMenu2("CodEjeTem", $CodEjeTem, "0:-- Seleccione --", false,""," class='selectcorto' aria-label='Lista de ejes tematicos disponibles para asignar' id='CodEjeTem' title='Lista de ejes tematicos disponibles para asignar' " );
 ?>   
      </td>
     </tr>
   </table>
<br>
	<table border=0 width=70% align="center" class="borde_tab">
	  <tr align="center">
		<td width="33%" height="25" class="listado2" align="center">
         <center><input name="insertar_registro" type=submit class="botones_funcion" value=" Insertar " aria-label="Agregar Clasificacion de trd"></center></TD>
		 <td width="33%" class="listado2" height="25">
		 <center><input name="actualizar" type="button" class="botones_funcion" id="envia23" onClick="procModificar();"value=" Modificar " aria-label='Modificar el registro actual de trd'></center></TD>
        <td width="33%" class="listado2" height="25">
		 <center><input name="Cerrar" type="button" class="botones_funcion" id="envia22" onClick="opener.regresar();window.close();"value="Cerrar" aria-label="Cerrar Ventana"></center></TD>
	   </tr>
	</table>
	<table width="70%" border="0" cellspacing="1" cellpadding="0" align="center" class="borde_tab">
	  <tr align="center">
	    <td>
		<?
		include "lista_ejesAsignados.php";
		if ($ind_ProcAnex=="S")
			{
	      	echo " <br> <input type='button' value='Cerrar' class='botones_largo' onclick='opener.regresar();window.close();'> ";
			}
		?>
	 	</td>
	   </tr>
	</table>
<script>
function borrarArchivo(anexo,linkarch){
	if (confirm('Esta seguro de borrar este Registro? Al aceptar se abrirá una nueva ventana confirmando que se eliminó el registro'))
	{
		nombreventana="ventanaBorrarR1";
		url="asignar_eje_tem_transacciones.php?borrar=1&nurad=<?=$nurad?>&CodEjeTem="+anexo+"&linkarchivo="+linkarch;
		window.open(url,nombreventana,'height=250,width=300');
	}
return;
}
function procModificar()
{
CodTem = document.TipoDocu.CodEjeTem.value;
if (document.TipoDocu.CodEjeTem.value != '')
  {
  <?php
        $sql = "SELECT SGD_TEMA_CODIGO AS CODIGO_EJE_TEM 
                                FROM RADICADO r 
                                WHERE RADI_NUME_RADI = '$nurad'
                                AND  RADI_DEPE_ACTU =  '$dependencia'
                                AND  RADI_USUA_ACTU =  '$codusuario'";
        $rs=$db->conn->query($sql);
        $codigoEje = $rs->fields["CODIGO_EJE_TEM"];
        if ($codigoEje !='')
        {
			?>

			if (confirm('Esta Seguro de Modificar el Registro del eje tematico ?'))
				{
					nombreventana="Modificación eje tematico";
					url="asignar_eje_tem_transacciones.php?modificar=1&usua=<?=$krd?>&codusua=<?=$codusua?>&CodEjeTem="+CodTem+"&coddepe=<?=$coddepe?>&codusuario=<?=$codusuario?>&dependencia=<?=$dependencia?>&nurad=<?=$nurad?>";
					window.open(url,nombreventana,'height=200,width=300');
				}
			<?php
	 		}else
			{
			?>
			alert("No existe ningun Registro para Modificar ");
			<?php
			}
       ?>
     }
   else
   {
    alert("Campos obligatorios ");
   }
return;
}

</script>
</form>
</span>
<p>
<?=$mensaje_err?>
</p>
</span>
</body>
</html>
