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


$imagenes=$_SESSION["imagenes"];
?>

<table><tr><td> </td></tr></table>
<table BORDER=0  cellpad=2 cellspacing='2' WIDTH=98%  align='center' style="margin-top: 4px;margin-bottom: 4px;" class="borde_tab" cellpadding="2">
     <tr> 
	 <form name=formListado action='../envios/paramListaImpresos.php?<?=$encabezado?>' method=post> 
	 <td width='50%' align='left' height="30" class="titulos2" ><img src="<?=$ruta_raiz?>/<?=$imagenes?>/estadoDocInfo.gif" height="30" alt="Convencion de imagen de tabla de resultados, dividida en 4 de izquierda a derecha anexado, radicado, impreso, enviado">
	   </td>
		   <td width='50%' align="center" class="titulos2" > 
		<a href='<?=$pagina_actual?>?<?=$encabezado?> '></a>
           <input type=submit value="<?=$accion_sal2?>" name=Enviar id=Enviar valign='middle' class='botones_largo' aria-label="Enviar documentos de los radicados seleccionados">
       </td>
        </form>
		</tr>
     </table>
