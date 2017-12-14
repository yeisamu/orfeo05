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

|
/**
* Administrador de fondos
* Sistema de gestion Documental ORFEO.
* Permite la creacion, listado y busqueda de fondos documentales
*/
    session_start();
    $krd = $_SESSION["krd"];
    $dependencia = $_SESSION["dependencia"];
    $ruta_raiz = "..";

    //valido sesion
    if(!$dependencia)  include "$ruta_raiz/rec_session.php";

?>
    <html>
    <head>
    <link rel="stylesheet" href="../estilos/orfeo.css">
    </head>
    <body bgcolor="#FFFFFF" topmargin="0" onLoad="window_onload();">
    <table width="47%" align="center" border="0" cellpadding="0" cellspacing="5" class="borde_tab">
     <tr> 
      <td height="25" class="titulos4"> 
        ADMINISTRACION  - FONDOS DOCUMENTALES- 
      </td>
        </tr>
        <tr align="center"> 
          <td class="listado2" > 
            <a href='busqueda_fondos.php' class="vinculos" target='mainFrame'>Busqueda</a>
          </td>
        </tr>
        <tr align="center"> 
          <td class="listado2" > 
            <a href='insertar_fondos.php' class="vinculos" target='mainFrame'>Insertar </a>
          </td>
        </tr>
        </tr>
      </table>
    </body>
    </html>
