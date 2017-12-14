<?
/*  Administrador de Paises.
*	Creado por: Ing. Hollman Ladino Paredes.
*	Para el proyecto ORFEO.
*
*	Permite la administracion de paises. La insercion y modificacion hace uso de la funcion
*	Replace de ADODB, la eliminacion esta sujeta a que este NUNCA haya sido referenciado en radicados.
*/
session_start();
$ruta_raiz = "../..";
if($_SESSION['usua_admin_sistema'] !=1 ) die(include "$ruta_raiz/errorAcceso.php");
/*
 * Se incluye archivo config.php con ruta dinámica para evitar 
 * errores si se incluye este archivo en otro
*/
include dirname(__FILE__).DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR.'config.php';           // incluir configuracion.
/*
 * Se incluye archivo ConnectionHandler.php con ruta dinámica para evitar 
 * errores si se incluye este archivo en otro
*/
require_once dirname(__FILE__).DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."include/db/ConnectionHandler.php";

//include("$ruta_raiz/config.php");                     // incluir configuracion.
$db = new ConnectionHandler("$ruta_raiz");
//$db->conn->debug=true;
include($ADODB_PATH.'/adodb.inc.php');	// $ADODB_PATH configurada en config.php
$error = 0;
//$dsn = $driver."://".$usuario.":".$contrasena."@".$servidor."/".$db;
//$db->conn = NewADOConnection($dsn);
if ($db)
{	$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);

	if (($_POST['btn_accion']))
	{	$record = array();
		$record['ID_PAIS'] = $_POST['txtIdPais'];
		$record['ID_CONT'] = $_POST['idcont'];
		$record['NOMBRE_PAIS'] = $_POST['txtModelo'];
		switch($_POST['btn_accion'])
		{	Case 'Agregar':
			Case 'Modificar':{	$res = $db->conn->Replace('SGD_DEF_PAISES',$record,array('ID_PAIS','ID_CONT'),$autoquote = true);
								($res) ? ($res == 1 ? $error = 3 : $error = 4 ) : $error = 2;
					 		 }break;
			Case 'Eliminar':
				{	$ADODB_COUNTRECS = true;
					$sql = "SELECT * FROM SGD_DIR_DRECCIONES WHERE ID_PAIS = ".$record['ID_PAIS'];
					$rs = $db->conn->Execute($sql);
					$ADODB_COUNTRECS = false;
					if ($rs->RecordCount() > 0)
					{	$error = 5;	}
					else 
					{	$db->conn->BeginTrans();
						$ok = $db->conn->Execute('DELETE FROM MUNICIPIO WHERE ID_PAIS='.$record['ID_PAIS']);
						if ($ok)
						{	$ok = $db->conn->Execute('DELETE FROM DEPARTAMENTO WHERE ID_PAIS='.$record['ID_PAIS']);
							if ($ok)
							{	$record = array_slice($record, 0, 2);
								$ok = $db->conn->Execute('DELETE FROM SGD_DEF_PAISES WHERE ID_PAIS='.$record['ID_PAIS'].' AND ID_CONT='.$record['ID_CONT']);
								$error = 6;
							}
						}
						($ok) ? $db->conn->CommitTrans() : $db->conn->RollbackTrans() ;
					}
				}break;
			Default: break;
		}
		unset($record);
	}
	
	$sql_cont = "SELECT nombre_cont,ID_CONT FROM SGD_DEF_CONTINENTES ORDER BY nombre_cont";
	$Rs_cont = $db->conn->CacheExecute(86400,$sql_cont); 	//Query en cache por 24 horas.
	//$Rs_cont = $db->conn->Execute($sql_cont);
	if (!($Rs_cont)) $error = 2;

	if ( $_POST['idcont'] >0)
	{	$sql_pais = "SELECT NOMBRE_PAIS,ID_PAIS FROM SGD_DEF_PAISES WHERE ID_CONT=".$_POST['idcont']." ORDER BY NOMBRE_PAIS";
		$Rs_pais = $db->conn->Execute($sql_pais);
		if (!($Rs_pais)) $error = 2;
	}
}
else
{	$error = 1;
}
?>
<html>
<head>
<script language="JavaScript">
<!--
function Actual()
{
var Obj = document.getElementById('idpais');
var i = Obj.selectedIndex;
document.getElementById('txtModelo').value = Obj.options[i].text;
document.getElementById('txtIdPais').value = Obj.value;
}

function rightTrim(sString)
{	while (sString.substring(sString.length-1, sString.length) == ' ')
	{	sString = sString.substring(0,sString.length-1);  }
	return sString;
}

function ver_listado()
{
	window.open('listados.php?var=pai','','scrollbars=yes,menubar=no,height=600,width=800,resizable=yes,toolbar=no,location=no,status=no');
}
//-->
</script>

<title>Orfeo - Admor de paises.</title>
<link href="<?= $ruta_raiz . $ESTILOS_PATH2 ?>bootstrap.css" rel="stylesheet" type="text/css"/>
<link href="<?=$ruta_raiz.$_SESSION['ESTILOS_PATH_ORFEO']?>" rel="stylesheet" type="text/css">
</head>
<body>
    <br>
    <br>
<form name="form1" method="post" action="<?= $_SERVER['PHP_SELF']?>">  
<input type="hidden" name="hdBandera" value="">
<table width="75%" border="1" align="center" cellspacing="0" class="tablas">
<tr bordercolor="#FFFFFF">
	<!--<td colspan="3" height="40" align="center" class="titulos4" valign="middle"><b><span class=etexto>ADMINISTRADOR DE PAISES</span></b></td>-->
    <div id="titulo" style="width: 75%; margin-left: 12.5%;" align="center">Administrador de paises</div>
</tr>
<tr bordercolor="#FFFFFF"> 
	<td width="3%" align="center" class="titulos2"><b>1.</b></td>
	<td width="25%" align="left" class="titulos2"><b>&nbsp;<label for="idcont">Seleccione Continente</label></b></td>
	<td width="72%" class="listado2">
	<?	// Listamos los continentes.
    	echo $Rs_cont->GetMenu2('idcont',$_POST['idcont'],"0:&lt;&lt;SELECCIONE&gt;&gt;",false,0,"class='select' id='idcont' title='Listado de continentes' onChange=\"this.form.submit()\"");
	    $Rs_cont->Close();
	?>	</td>
</tr>
<tr bordercolor="#FFFFFF"> 
	<td align="center" class="titulos2"><b>2.</b></td>
	<td align="left" class="titulos2"><b>&nbsp;<label for="idpais">Seleccione País</label></b></td>
    <td align="left" class="listado2">
		<?	
		if (isset($_POST['idcont']) and $_POST['idcont'] > 0)
		{	// Listamos los paises segun continente.
    		echo $Rs_pais->GetMenu2('idpais',$_POST['idpais'],"0:&lt;&lt;SELECCIONE&gt;&gt;",false,0,"class='select' id=\"idpais\" title=\"Listado de países de acuerdo al continente seleccionado\" onChange=\"Actual();\"");
	    	$Rs_pais->Close();
	    }
		else 
		{	echo "<select name='idpais' id='idpais' class='select' title='Listado de países de acuerdo al continente seleccionado'><option value='0' selected>&lt;&lt; Seleccione Continente &gt;&gt;</option></select>";
		}
		?></td>
</tr>
<tr bordercolor="#FFFFFF"> 
	<td rowspan="2" valign="middle" class="titulos2">3.</td>
	<td align="left" class="titulos2"><b>&nbsp;<label for="txtIdPais">Código del país</label></b></td>
	<td class="listado2"><input name="txtIdPais" id="txtIdPais" type="text" size="10" maxlength="3" title="Campo para ver,ingresar o editar el código del país"></td>
</tr>
<tr bordercolor="#FFFFFF"> 
	<td align="left" class="titulos2"><b>&nbsp;<label for="txtModelo">Nombre del país</label></b></td>
	<td class="listado2"><input name="txtModelo" id="txtModelo" type="text" size="50" maxlength="30" title="Campo para ver,ingresar o editar el nombre del país"></td>
</tr>
<tr bordercolor="#FFFFFF"> 
	<td width="3%" align="justify" class="info" colspan="3" bgcolor="#FFFFFF"><b>NOTA: </b> Para una estandarización en los códigos de países usar los sugeridos por la ISO. <a href="http://es.wikipedia.org/wiki/ISO_3166-1" target="_blank" class="vinculos" aria-label='Enlace a información de códigos de la ISO en wikipedia'>enlace</a></td>
</tr>
<?php
if ($error)
{	echo '<tr bordercolor="#FFFFFF"> 
			<td width="3%" align="center" class="titulosError" colspan="3" bgcolor="#FFFFFF">';
	switch ($error)
	{	case 1:	//NO CONECCION A BD
				echo "Error al conectar a BD, comun&iacute;quese con el Administrador de sistema !!";
				break;
		case 2:	//ERROR EJECUCCIÓN SQL
				echo "Error al gestionar datos, comun&iacute;quese con el Administrador de sistema !!";
				break;
		case 3:	//ACUTALIZACION REALIZADA
				echo "Informaci&oacute;n actualizada!!";break;
		case 4:	//INSERCION REALIZADA
				echo "Pa&iacute;s creado satisfactoriamente!!";break;
		case 5:	//IMPOSIBILIDAD DE ELIMINAR PAIS, EST&Aacute; LIGADO CON DIRECCIONES
				echo "No se puede eliminar pa&iacute;s, se encuentra ligado a direcciones.";break;
		case 6:	//PAIS ELIMINADO
				echo "Pais eliminado correctamente";break;
	}
	echo '</td></tr>';
}
?>
</table>
<table width="75%" border="0" align="center" cellpadding="0" cellspacing="0" class="tablas">
<tr class="cajaBotonesMedio">
	<td width="10%" class="listado1">&nbsp;</td>
	<td width="20%"  class="listado1">
		<span class="celdaGris"> <span class="e_texto1"><center>
		<input name="btn_accion" type="button" class="botones" id="btn_accion" value="Listado" onClick="ver_listado();" aria-label="Listar los países existentes">
		</center></span>
	</td>
	<td width="20%" class="listado1">
		<span class="e_texto1"><center>
		<input name="btn_accion" type="submit" class="botones" id="btn_accion" value="Agregar" onClick="document.form1.hdBandera.value='A'; return ValidarInformacion();" aria-label="Agregar nuevo país">
		</center></span>
	</td>
	<td width="20%" class="listado1">
		<span class="e_texto1"><center>
		<input name="btn_accion" type="submit" class="botones" id="btn_accion" value="Modificar" onClick="document.form1.hdBandera.value='M'; return ValidarInformacion();" aria-label="Guardar cambios de país">
		</center></span>
	</td>
	<td width="20%" class="listado1">
		<span class="e_texto1"><center>
		<input name="btn_accion" type="submit" class="botones" id="btn_accion" value="Eliminar" onClick="document.form1.hdBandera.value='E'; return ValidarInformacion();" aria-label="Eliminar país seleccionado">
		</center></span>
	</td>
	<td width="10%" class="listado1">&nbsp;</td>
</tr>
</table>
</form>

<script ID="clientEventHandlersJS" LANGUAGE="JavaScript">
<!--
function ValidarInformacion()
{	var strMensaje = "Por favor ingrese las datos.";
	
	if (document.form1.idcont.value == "0")
	{	alert("Debe seleccionar el continente.\n" + strMensaje);
		document.form1.idcont.focus();
		return false;
	}
	
	if ( rightTrim(document.form1.txtIdPais.value) <= "0")
	{	alert("Debe ingresar el Codigo de Pais.\n" + strMensaje);
		document.form1.txtIdPais.focus();
		return false;
	}
	else if(isNaN(document.form1.txtIdPais.value))
	{	alert("El Codigo de Pais debe ser numerico.\n" + strMensaje);
		document.form1.txtIdPais.select();
		document.form1.txtIdPais.focus();
		return false; 
	}
	
	if (document.form1.hdBandera.value == "A")
	{	if(rightTrim(document.form1.txtModelo.value) == "")
		{	alert("Debe ingresar nombre del Pais.\n" + strMensaje);
			document.form1.txtModelo.focus();
			return false; 
		}
		else
		{	document.form1.submit();	
		}
	}
	else if(document.form1.hdBandera.value == "M")
	{	if(rightTrim(document.form1.txtModelo.value) == "")
		{	alert("Primero debe seleccionar el Pais a modificar.\n" + strMensaje);	
			return false; 
		}
		else
		{	document.form1.submit();	
		}
	}
	else if(document.form1.hdBandera.value == "E") 
	{	if(confirm("Esta seguro de borrar el registro ?\n La eliminaci\xf3n de este pais incluye sus Dptos y municipios."))
		{	document.form1.submit();	}
		else
		{	return false;	}
	}
}
//-->
</script>
</body>
</html>
