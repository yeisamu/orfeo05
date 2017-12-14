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


//verifico errores
$error=$_GET['error'];
if($error==1) { $msjerror="Conexion OK"; $ok2="ok"; }
elseif($error==2) $msjerror="No me pude conectar";

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" media="screen" type="text/css" title="style" href="style.css" />
<title>Instalador Orfeo</title>
<script>
function comprobar()
{
	if(document.formulario.ipservidor.length!=0)
        {
	alert(No digito la IP);
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
    <li> <a href="index.html">Inicio</a> </li>
    <li> | </li>
    <li> <a href="pasouno.php">Licencia</a> </li>
    <li> | </li>
    <li> <a href="pasodos.php"><div id="ojo">Base de Datos</div> </a> </li>
    <li> | </li>
    <li> <a href="pasotres.php">paso 3 </a> </li>
    <li> | </li>
    <li> <a href="fin.html">fin</a> </li>
  </ul>
  <!-- END MENU -->
  <!-- EDITO -->
<div class="idioma">
    <div id="edito">
      <div class="idioma">
        <div align="right"><img src="images/español.png" alt="español" width="18" height="19" longdesc="español" /><img src="images/ingles.png" alt="ingles" width="18" height="19" longdesc="ingles" /></div>
      </div>
      <h2>INSTALADOR ORFEO </h2>
      <p>&nbsp;</p>
    </div>
  </div>
  <!-- END EDITO -->
  <div id="toal"> </div>
	<h1 align="center">GENERADOR DE LA BASE DE DATOS </h1>
	<p>El programa de instalación requiere la información necesaria para crear esa base de datos</p>
    <div>
      <p> Seleccione el tipo de motor a instalar</p>
      <form id="formulario" method="post" action="comprobar.php">
        <p>Tipo de Motor</p>
        <div class="tpmotor">
           <p>
            <label>
            <input type="radio" name="TipoMotor" value="postgres" checked="checked" />PostgreSQL</label>
            <br />
            <label>
            <input type="radio" name="TipoMotor" value="oci8" />Oracle</label>
            <label></label>
            <br />
            <label>
            <input type="radio" name="TipoMotor" value="mssql" />SQL Server</label>
           <br />
          </p>
        </div>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
    </div>
    <!-- END ABOUT ME -->
    <!-- NEWS -->
    <div id="vertical_barr">
      <h1>DILIGENCIE LOS DATOS </h1>
        <p>
          <label>IP Servidor<br />
          <input name="ipservidor" type="text" id="ipservidor" accesskey="i" />
          </label>
	</p>
        <p>
          <label> Usuario</label>
        </p>
        <p>
          <input name="usuario" type="text" id="usuario" accesskey="u" />
        </p>
        <p>
          <label> Contraseña<br />
          <input name="contraseña" type="password" id="password" accesskey="c" />
          </label>
        </p>     
      
      <div align="center"><input type=submit name=comprobar class="content_button" value='Comprobar' onClick='comprobar();'> </div>
	 <p align="center"><?=$msjerror?></p>
    </div>
	</form>
    <!-- END NEWS -->
    <!-- SERVICES -->
    <div>
      <h1>PROCESO INSTALACIÓN </h1>
      <p>&nbsp;</p>
        <p>
          <label>
            Datos de empresa listos </label>
          <? if ($ok1){ ?><img src="images/ok.png" alt="" width="24" height="26" /></p>
          <? }else{ ?><img src="images/wrong.png" alt="" width="24" height="26" /></p>
	  <? } ?>
        <p>&nbsp;</p>
        <p>
          <label>
          Conexión con el servidor comprobada 
	<!--<img src="images/ok.png" alt="" width="24" height="26" /></label>-->
        </p>
         <p>
          <label>
          Base de Datos Instalada</label>
          <!--<img src="images/ok.png" alt="" width="24" height="26" /></p>-->
        <p>&nbsp;</p>
      <p>
        <label></label>
      </p>
      <p align="left">&nbsp;</p>
    </div>
    <!-- END SERVICES -->
  <div class="clear">
    <p>&nbsp;</p>
    <p align="left"><a href="pasotres.html" id="button_edito">SIGUIENTE</a></p>
  </div>
     <!-- END SHADOW -->
</div>
<!-- FOOTER -->
<div id="footer">
  <p>© 2008 Skina Technologies<br />
Dirección: Carrera 64 No. 96-17 | PBX:+57(1) 226-2080 | Movil: +57(310) 288-0926  | Bogotá DC- Colombia<br />
Design by SkinaTech</p>
</div>
<!-- END FOOTER -->
</div>
<!-- END HOLDER -->
</body>
</html>
