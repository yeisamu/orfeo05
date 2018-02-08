<?php
/**
* Administrador de Temas
* Ing. Isabel Rodriguez
* SkinaTech
* Fecha: 20-Marzo-2012
* Sistema de gestion Documental ORFEO.
*
* Permite la administracion de los temas en Orfeo
* Intercambio la carpeta de imagenes
*/
session_start();
$ruta_raiz="../..";
if(!isset($_SESSION['dependencia']))    include "$ruta_raiz/rec_session.php";

require_once("$ruta_raiz/include/db/ConnectionHandler.php");
$db = new ConnectionHandler($ruta_raiz);
$error = 0;

include "$ruta_raiz/config.php";
//$b->conn->debug=true;
session_register('imagenes');
$imagenes = $_SESSION["imagenes"];
$sel_img = $_POST["sel_img"];

if (isset($_POST['btn_accion']))
        { 
	 switch($_POST['btn_accion'])
                {       Case 'Probar':{
				if ($sel_img) {
					$imagenes = $sel_img;
					$_SESSION["imagenes"] = $imagenes;
					echo "selecciono Probar con $sel_img <br> Debe recargar para que tome los cambios ";
					$error = 1;
                                        }
				 }break;
                        Case 'Configurar':{ 
				if ($sel_img) {
                                        $imagenes = $sel_img;
					$error = 2;

					$variable_a_modificar= "\$imagenes"; 
					$nuevo_contenido= "\"$imagenes\";"; 
					$file= file ("../../config.php");
					for ($i=0;$i<count($file);$i++){
						$dato= explode (" = ", $file[$i]);
						$nombre_variable= $dato[0];
						$contenido_variable= $dato[1];
					if ($nombre_variable==$variable_a_modificar){
					$file[$i]= "$nombre_variable= $nuevo_contenido\n";
					$fl= fopen ("../../config.php", "w");
						for ($i=0;$i<count($file);$i++){
							fwrite ($fl, $file[$i]);
						}
					fclose ($fl);
		}
		} 
                                        }
                                 }break;
	 
			   
		}
}
if ($error) {
        $cad = '<tr bordercolor="#FFFFFF">
                        <td width="3%" align="center" class="titulosError" colspan="3" bgcolor="#FFFFFF">';
        switch ($error) {
                case 1: //Probo y debe recargar
                        $cad .= "Selecciono Probar con $sel_img <br> Debe recargar para que tome los cambios ";
                        break;
		case 2: //Cambia configuracion
			$cad .= "Selecciono Configurar con $sel_img <br> Debe cerrar sesion y recargar para que tome los cambios";
	}
	 $cad .= '</td></tr>';
}
?>
<html>
<head>
<title>.:Orfeo - Administrador de Temas :.</title>
<link rel="stylesheet" href="../../estilos/orfeo.css">
</head>
<body>
<FORM METHOD="POST" ACTION="<?= $_SERVER['PHP_SELF']?>">
<table width="75%" border="1" align="center" cellspacing="0" class="tablas">
<tr bordercolor="#FFFFFF">
        <td colspan="3" height="40" align="center" class="titulos4" valign="middle"><b><span class=etexto>ADMINISTRADOR DE TEMAS</span></b></td>
</tr>
<tr bordercolor="#FFFFFF">
        <td width="3%" align="center" class="titulos2"><b>1.</b></td>
	 <td width="25%" align="left" class="titulos2"><b>&nbsp;<label for="sel_img">Seleccione tema</label></b></td>
        <td width="72%" class="listado2">
	 <select name="sel_img" class="select" id="sel_img" title="Listado de temas disponibles para la aplicación">
	   <option value="imagenes0" selected>Por defecto</option>
	   <option value="imagenes1">Azul</option>
	 </select>
</table>
<table width="75%" border="1" align="center" cellpadding="0" cellspacing="0" class="tablas">
<tr bordercolor="#FFFFFF">
        <td width="10%" class="listado2">&nbsp;</td>
        <td width="20%"  class="listado2">
                <span class="celdaGris"> <span class="e_texto1"><center>
                <input name="btn_accion" type="submit" class="botones" id="btn_accion" value="Probar" aria-label="botón para probar el tema seleccionado">
                </center></span>
        </td>
        <td width="20%" class="listado2">
                <span class="e_texto1"><center>
                <input name="btn_accion" type="submit" class="botones" id="btn_accion" value="Configurar" aria-label="botón para aplicar el tema seleccionado">
                </center></span>
	</td>
</tr>
<?PHP echo $cad ?>
</table>
</FORM>
</body>
</html>
