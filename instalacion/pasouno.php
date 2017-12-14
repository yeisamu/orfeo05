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

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" media="screen" type="text/css" title="style" href="style.css" />
<title>Instalador Orfeo</title>
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
    <li> <a href="pasouno.php"><div id="ojo">Licencia</div> </a> </li>
    <li> | </li>
    <li> <a href="pasodos.php">Base de Datos </a> </li>
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
      <h2>INSTALADOR ORFEO</h2>
      <p align="center">&nbsp;</p>
    </div>
  </div>
  <div align="center">
    <!-- END EDITO -->
  </div>
  <div id="toal"> </div>
  <h1>&nbsp;</h1>
  <h1 align="center">LICENCIA GNU/GPL</h1>
  <form name="formulario"  action="uno.php" method="post" enctype="multipart/form-data" id="formulario">
<table width="100%">
  <tbody>
	<tr><td colspan="2" align="center">
	<iframe src="gpl.html" width="100%"></iframe>
	</td></tr>
    <tr>
      <td><p align="center">
        <label for="si">Acepto</label>
	  <input type="radio" name="acepto" id="si" onclick="sig.disabled=false"/>
	</p></td>
      <td><p align="center">
        <label for="no">No Acepto</label>
	  <input type="radio" name="acepto" id="no" checked="true" onclick="sig.disabled=true"/>
	</p></td>
    </tr>
    <tr>
      <td colspan="2" align="center">
	<p>&nbsp;</p>
          <p align="center"><input type=button name="sig" id="button_edito" value="SIGUIENTE" disabled="true" size="25" onclick="location.href='pasodos.php'" />
          </p>
      	  <p>&nbsp;</p>
	</td>
    </tr>
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
