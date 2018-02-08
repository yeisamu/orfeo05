<?
/*  Administrador de Tablas sencillas.
 *	Son tablas que tienen un codigo (digitado) y una descripcion. P.E. : Tema, Resolucion.
 * @copyright Sistema de Gestion Documental ORFEO
 * @version 1.0
 * @author Desarrollado por Ing. Hollman Ladino Paredes para el Instituto de Desarrollo Urbano - IDU.
 *
 */

session_start();

if (isset($_POST['krd'])) $krd = $_POST['krd']; if (isset($_GET['krd'])) $krd = $_GET['krd'];
$ruta_raiz="../..";
if(!isset($_SESSION['dependencia']))	include "$ruta_raiz/rec_session.php";

require_once("$ruta_raiz/include/db/ConnectionHandler.php");
$db = new ConnectionHandler($ruta_raiz);
//$db->conn->debug = true;

/*
*	Funcion que convierte un valor de PHP a un valor Javascript.
*/
function valueToJsValue($value, $encoding = false)
{	if (!is_numeric($value))
	{	$value = str_replace('\\', '\\\\', $value);
		$value = str_replace('"', '\"', $value);
		$value = '"'.$value.'"';
	}
	if ($encoding)
	{	switch ($encoding)
		{	case 'utf8' :	return iconv("ISO-8859-2", "UTF-8", $value);
							break;
		}
	}
	else
	{	return $value;	}
	return ;
}

/*
*	Funcion que convierte un vector de PHP a un vector Javascript.
*	Utiliza a su vez la funcion valueToJsValue.
*/
function arrayToJsArray( $array, $name, $nl = "\n", $encoding = false )
{	if (is_array($array))
	{	$jsArray = $name . ' = new Array();'.$nl;
		foreach($array as $key => $value)
		{	switch (gettype($value))
			{	case 'unknown type':
				case 'resource':
				case 'object':	break;
				case 'array':	$jsArray .= arrayToJsArray($value,$name.'['.valueToJsValue($key, $encoding).']', $nl);
								break;
				case 'NULL':	$jsArray .= $name.'['.valueToJsValue($key,$encoding).'] = null;'.$nl;
								break;
				case 'boolean':	$jsArray .= $name.'['.valueToJsValue($key,$encoding).'] = '.($value ? 'true' : 'false').';'.$nl;
								break;
				case 'string':	$jsArray .= $name.'['.valueToJsValue($key,$encoding).'] = '.valueToJsValue($value, $encoding).';'.$nl;
								break;
				case 'double':
				case 'integer':	$jsArray .= $name.'['.valueToJsValue($key,$encoding).'] = '.$value.';'.$nl;
								break;
				default:	trigger_error('Hoppa, egy j ERROR a PHP-ben?'.__CLASS__.'::'.__FUNCTION__.'()!', E_USER_WARNING);
			}
		}
		return $jsArray;
	}
	else
	{	return false;	}
}

$error = 0;

if ($db)
{	$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);

	if (isset($_POST['btn_accion']))
	{	$record = array();
		$record['SGD_FENV_DESCRIP'] = $_POST['txtNombre'];
		$record['SGD_FENV_CODIGO'] = $_POST['txtId'];
		$record['SGD_FENV_ESTADO'] = $_POST['slc_act'];
		$record['SGD_FENV_PLANILLA'] = $_POST['slc_pnl'];

		switch($_POST['btn_accion'])
		{	Case 'Agregar':
				{
					$tabla = 'SGD_FENV_FRMENVIO';
					$sql = $db->conn->GetInsertSQL(&$tabla, $record, true, null);
					//$sql = "INSERT INTO sgd_fenv_frmenvio VALUES (".$record['SGD_FENV_CODIGO'].",'".$record['SGD_FENV_DESCRIP']."',".$record['SGD_FENV_PLANILLA'].",".$record['SGD_FENV_ESTADO'].")";
					$ok = $db->conn->Execute($sql);
					($ok) ? $error = 3 : $error = 2;
			        /*$db->conn->debug=true;
				echo 'Resultado de la insercion '.$ok;*/
                                 }break;
			Case 'Modificar':
				{	$ok = $db->conn->Replace('SGD_FENV_FRMENVIO', $record, 'SGD_FENV_CODIGO', true);
					($ok) ? $error = 4 : $error = 2;
                                /*$db->conn->debug=true;
                                echo 'Resultado de la insercion '.$ok;*/

				}break;
			Case 'Eliminar':
				{	$ADODB_COUNTRECS = true;
					$sql1 = "SELECT count(*) FROM SGD_RENV_REGENVIO WHERE SGD_FENV_CODIGO = ".$record['SGD_FENV_CODIGO'];
					$sql2 = "SELECT count(*) FROM SGD_CLTA_CLSTARIF WHERE SGD_FENV_CODIGO = ".$record['SGD_FENV_CODIGO'];
					$cnt1 = $db->conn->GetOne($sql1);
					$cnt2 = $db->conn->GetOne($sql2);
					if ($cnt1 > 0 || $cnt2 > 0)
					{	$error = 5;	}
					else
					{	$ok = $db->conn->Execute('DELETE FROM SGD_FENV_FRMENVIO WHERE SGD_FENV_CODIGO='.$record['SGD_FENV_CODIGO']);
						if (!$ok) $error = 2;
					}
				}break;
			Default: break;
		}
		unset($record);
	}

	$sql =	"SELECT SGD_FENV_DESCRIP, SGD_FENV_CODIGO, SGD_FENV_ESTADO, SGD_FENV_PLANILLA
				FROM SGD_FENV_FRMENVIO ORDER BY SGD_FENV_DESCRIP";
	$Rs = $db->conn->Execute($sql);
	if (!($Rs)) $error = 2;
	else
	{	//Creamos el vector que contiene todas las Formas de envio con su respectiva informacion.
		$v_fenv = array();
		$i = 0;
		while ($arr = $Rs->fetchRow())
		{	$v_fenv[$i]['nombre'] = trim($arr['SGD_FENV_DESCRIP']);
			$v_fenv[$i]['id'] = trim($arr['SGD_FENV_CODIGO']);
			$v_fenv[$i]['estado'] = trim($arr['SGD_FENV_ESTADO']);
			$v_fenv[$i]['planilla'] = trim($arr['SGD_FENV_PLANILLA']);
			$i +=1;
		}
		//$Rs->Move(0);
		$Rs = $db->conn->Execute($sql);
		$slc_fenv = $Rs->GetMenu2('sls_idfenv',0,"0:&lt;&lt; SELECCIONE &gt;&gt;",false,0,"id=\"sls_idfenv\" class=\"select\" onchange=\"actualiza_datos(this.value)\"");
		$Rs->Close();
		reset($v_fenv);
	}
}
else
{	$error = 1;
}

$msg = "";
if ($error)
{	$msg .= '<tr bordercolor="#FFFFFF">
			<td width="3%" align="center" class="titulosError" colspan="3" bgcolor="#FFFFFF">';
	switch ($error)
	{	case 1:	//NO CONECCION A BD
			$msg .= "Error al conectar a BD, comun&iacute;quese con el Administrador de sistema !!";break;
		case 2:	//ERROR EJECUCCION SQL
			$msg .= "Error al gestionar datos, Si est&aacute; agregando es posible que el ID asignado exista sino comun&iacute;quese con el Administrador de sistema !!";break;
		case 4:	//ACUTALIZACION REALIZADA
			$msg .= "Informaci&oacute;n actualizada!!";break;
		case 3:	//INSERCION REALIZADA
			$msg .= "Forma de Envio creada satisfactoriamente!!";break;				
		case 5:	//IMPOSIBILIDAD DE ELIMINAR, TIENE HISTORIAL.
			$msg .= "No se puede eliminar, se encuentra ligado a otros registros.";break;
	}
	$msg .= '</td></tr>';
}
?>
<html>
<head>
<script language="JavaScript" src="<?=$ruta_raiz?>/js/crea_combos_2.js"></script>
<script language="JavaScript" src="<?=$ruta_raiz?>/js/formchek.js"></script>
        <link href="<?= $ruta_raiz . $ESTILOS_PATH2 ?>bootstrap.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="<?= $ruta_raiz . $_SESSION['ESTILOS_PATH_ORFEO'] ?>">
<script language="JavaScript" type="text/JavaScript">
function ver_listado(que)
{
	window.open('listados.php?var=fnv','','scrollbars=yes,menubar=no,height=600,width=800,resizable=yes,toolbar=no,location=no,status=no');
}

function ValidarInformacion()
{	var strMensaje = "Por favor ingrese todos los datos.";

	if(isWhitespace(document.form1.txtId.value)) 
	{	alert("Debe seleccionar o digitar el codigo.\n" + strMensaje);
		document.form1.txtId.focus();
		return false;
	}
	else if(isNaN(document.form1.txtId.value))
	{	alert("El Codigo debe ser numerico.\n" + strMensaje);
		document.form1.txtId.focus();
		return false; 
	}
	
	if ( (document.form1.hdBandera.value == "A") || (document.form1.hdBandera.value == "M") )
	{	if(isWhitespace(document.form1.txtNombre.value) || 
			isWhitespace(document.form1.slc_pnl.value) || 
			isWhitespace(document.form1.slc_act.value)
		  )
		{	alert(strMensaje);
			return false; 
		}
	}
	if(document.form1.hdBandera.value == "E") 
	{	if(confirm("Esta seguro de borrar el registro ?\n"))
		{	document.form1.submit();	}
		else
		{	return false;	}
	}
	document.form1.submit();
}

<?php
// Convertimos los vectores de los paises, dptos y municipios creados en crea_combos_universales.php a vectores en JavaScript.
echo arrayToJsArray($v_fenv, 've');
?>

function actualiza_datos(vlr)
{	
	var i;
	for (i=0; i<=ve.length; i++)
	{
		if (ve[i]['id'] == vlr)
		{
			break;
		}
	}
	if (form1.sls_idfenv.value>0)
	{	document.getElementById('txtId').value = ve[i]['id'];
		document.getElementById('txtNombre').value = ve[i]['nombre'];
		document.getElementById('slc_pnl').value = ve[i]['planilla'];
		document.getElementById('slc_act').value = ve[i]['estado'];
	}
	else
	{	document.getElementById('txtId').value = '';
		document.getElementById('txtNombre').value = '';
		document.getElementById('slc_pnl').value = '';
		document.getElementById('slc_act').value = '';
	}
}
</script>
<title>.: ORFEO :. Administraci&oacute;n de ESP(Entidades)</title>
</head>
<body>
    <br>
    <br>
<form name="form1" id="form1" method="post" action="<?= $_SERVER['PHP_SELF'] ?>">
<input type="hidden" id="hdBandera" name="hdBandera" value="">
<input type="hidden" id="krd" name="krd" value="<?= $krd ?>">
<center>
<div id="titulo" style="width: 60%;" align="center" >Administraci&oacute;n de formas de env&iacute;o</div>
<table  align="center" border="1" cellspacing="0" class="tablas">
</table>
<table border="1" cellpadding="0" cellspacing="0" align="center" width="60%">
<tr bordercolor = "#FFFFFF">
	<td  align="center" valign="middle" class="titulos2">1.</td>
	<td  align="left" class="titulos2"><label for="sls_idfenv">Seleccione Envío</label></td>
	<td class="listado2">&nbsp;
	<?=$slc_fenv?>
	</td>
</tr>
<tr bordercolor = "#FFFFFF">
	<td align="center" valign="middle" class="titulos2">2.</td>
	<td align="left" class="titulos2">Mod. o Ingrese datos</td>
	<td>
		<table border="1" cellpadding="0" cellspacing="0" width="100%">
		<tr class="listado2">
			<td  align="center" valign="middle" class="titulos2"><label for="txtId">Id</label></td>
			<td  align="center" valign="middle" class="titulos2"><label for="txtNombre">Nombre</label></td>
		</tr>
		<tr align="center" class="listado2" >
			<td ><input class="tex_area" type="text" name="txtId" id="txtId" size="3" maxlength="3" title="Identificador de la forma de envío"></td>
			<td ><input class="tex_area" type="text" name="txtNombre" id="txtNombre" size="40" maxlength="80" title="Nombre de la forma de envío"></td>
		</tr>
		<tr class="listado2">
			<td  align="center" valign="middle" class="titulos2"><label for="slc_act">¿Está activa?</label></td>
			<td  align="center" valign="middle" class="titulos2"><label for="slc_pnl">¿Genera Planilla?</label></td>
		</tr>
		<tr align="center" class="listado2">
			<td>
				<select name="slc_act" id="slc_act" class="select" title="Seleccione si la forma de envío está o no activa">
					<option value="">Seleccione</option>
					<option value="1">SI</option>
					<option value="0">NO</option>
				</select>
			</td>
			<td  class="listado2">
				<select name="slc_pnl" id="slc_pnl" class="select" title="Seleccione si la forma de envío genera o no planilla">
					<option value="">Seleccione</option>
					<option value="1"> SI </option>
					<option value="0"> NO </option>
				</select>
			</td>
		</tr>
		</table>
	</td>
</tr>
<?php	echo $msg;	?>
</table>
<table width="60%" border="0" align="center" cellpadding="0" cellspacing="0" class="tablas">
    <tr class="cajaBotonesMedio">
	<td width="10%" class="listado1">&nbsp;</td>
	<td width="20%"  class="listado1">
		<input name="btn_accion" type="button" class="botones" id="btn_accion" value="Listado" onClick="ver_listado();" aria-label="Mostrar listado de formas de envío existentes en una nueva ventana">
		</td>
	<td width="20%" class="listado1">
		<input name="btn_accion" type="submit" class="botones" id="btn_accion" value="Agregar" onClick="document.form1.hdBandera.value='A'; return ValidarInformacion();" aria-label="Añadir forma de envío">
		</td>
	<td width="20%" class="listado1">
		<input name="btn_accion" type="submit" class="botones" id="btn_accion" value="Modificar" onClick="document.form1.hdBandera.value='M'; return ValidarInformacion();" aria-label="Actualizar forma de envío">
	</td>
	<td width="20%" class="listado1">
		  <input name="btn_accion" type="submit" class="botones" id="btn_accion" value="Eliminar" onClick="document.form1.hdBandera.value='E'; return ValidarInformacion();" aria-label="Eliminar forma de envío">
        </td>
	<td width="10%" class="listado1">&nbsp;</td>
</tr>
</table>
</center>
</form>
</body>
</html>
