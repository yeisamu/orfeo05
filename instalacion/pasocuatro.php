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


$error=$_GET['error'];
if($error==1) $msjerror="Debe ingresar todos los datos obligatorios, Nombre y Sigla";
elseif($error==2) $msjerror="Hubo un problema con el logo, La extension o  el tamano del archivo no es correcta. Se permiten archivos GIF y maximo 100 Kb";
elseif($error==3) $msjerror="No se pudo guardar el logo";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" media="screen" type="text/css" title="style" href="style.css" />
<title>Instalador Orfeo</title>
<script>

function confirma()
{
	if(document.formulario.nomempresa.value!=null)
	{
			   document.formulario.submit();
		}
	 else
	 	{	
		alert("El Nombre de la empresa, Direccion y Dependencia son obligatorios ");	
			   document.formulario.nomempresa.focus();
	}
}
</script>
</head>
<body>
 <div id="holder">
   <!--BEGIN OF TERMS OF USE. DO NOT EDIT OR DELETE THESE LINES. IF YOU EDIT OR DELETE THESE LINES AN ALERT MESSAGE MAY APPEAR WHEN TEMPLATE WILL BE ONLINE-->
   <!--END OF TERMS OF USE-->
   <!-- HEADER -->
<div id="header"> <a href="index.php"></a> </div>
<!-- END HEADER -->
<div id="shadow">
  <!-- MENU -->
  <ul id="menu">
    <li><a href="index.php">INICIO</a> </li>
    <li> | </li>
    <li> <a href="pasouno.php"><div id="ojo">PASO 1</div> </a> </li>
    <li> | </li>
    <li> <a href="pasodos.php">PASO 2 </a> </li>
    <li> | </li>
    <li> <a href="pasotres.php">PASO 3 </a></li>
    <li> | </li>
    <li> <a href="fin.html">FIN</a> </li>
  </ul>
  <!-- END MENU -->
  <!-- EDITO -->
  <div class="idioma">
    <div id="edito">
      <div class="idioma">
        <div align="right"><img src="images/español.png" alt="español" width="18" height="19" longdesc="español" /><img src="images/ingles.png" alt="ingles" width="18" height="19" longdesc="ingles" /></div>
      </div>
      <h2>DATOS DE LA EMPRESA </h2>
      <p align="center">&nbsp;</p>
    </div>
  </div>
  <div align="center">
    <!-- END EDITO -->
  </div>
  <div id="toal"> </div>
  <h1>&nbsp;</h1>
  <h1 align="center">DILIGENCIE LOS DATOS DE LA EMPRESA </h1>
  <p align="center"><?=$msjerror?></p>
    <form name="formulario"  action="uno.php" method="post" enctype="multipart/form-data" id="formulario">
    <table width="100%">
	<tbody>
     <tr>
	<td>
      <p align="center">
        <label>Nombre:
	</td><td>
        <input type="text" name="nomempresa" accesskey="n" />
          </label>
      </p>
	</td>
	</tr><tr>
	<td>
      <p align="center">&nbsp;</p>
      <p align="center">
        <label>Sigla: 
	</td><td>
        <input type="text" name="sigla" accesskey="s" />
        </label>
	</p>
	</td>
	</tr><tr>
	<td>
      <p align="center">&nbsp;</p>
      <p align="center">
        <label> Direcci&oacute;n:
	</td><td>
        <input type="text" name="dir" accesskey="d" />
        </label>
	</p>
	</td>
	</tr><tr>
	<td>
      <p align="center">&nbsp;</p>
      <p align="center">
        <label>Tel&eacute;fono: 
	</td><td>
        <input name="tel" type="text" accesskey="t" value="" />
        </label>
      </p>
	</td>
	</tr><tr>
	<td>
      <p align="center">&nbsp;</p>
      <p align="center">
        <label>Url Contacto:
	</td><td>
        <textarea name="url"></textarea>
        </label>
      </p>
	</td>
	</tr><tr>
	<td>
      <p align="center">&nbsp;</p>
      <p align="center">
        <label>Logotipo(GIF):
	</td><td>
      	</p><p align="left">
        <input type="file" name="logo" />
        </label>
      </p>
	</td>
	</tr><tr>
	<td>
      <p align="center">&nbsp;</p>
      <p align="center">
        <label>Correo de Contacto:
	</td><td>
        <input type="text" name="correo" accesskey="c" />
        </label>
      </p>
	</td>
	</tr><tr>
	<td>
	</td><td>
      <p align="center">&nbsp;</p>
      <p align="left">
	<label>
	<input type=checkbox name=check>Deseo recibir soporte gratuito una semana</td>
	</label>
	</p>
	</td>
	</tr><tr>
	<td>
  	<div class="clear">
    	<div align="center">
	<div align="left">
      		<p align="left">
		<!--<input type=button name=next Value='SIGUIENTE' id="button_edito" onClick='confirma();'>-->
		<input type=button Value='SIGUIENTE' id="button_edito" onClick='confirma();'>
		</p>
	</div>
    	</div>
  	</div>
	</td></tr>
</tbody>
</table>
</form>	
<!-- END SHADOW -->
</div>
<!-- FOOTER -->
<div id="footer">
  <p>© 2008 Skina Technologies<br />
Direcci&oacute;n: Carrera 64 No. 96-17 | PBX:+57(1) 226-2080 |Movil: +57(310) 288-0926  | Bogot&acute; DC- Colombia<br />
Design by SkinaTech</p>
</div>
<!-- END FOOTER -->
</div>
<!-- END HOLDER -->
</body>
</html>
