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



function sup_tilde($str){
/*-----------------------------------------------------------------------
Funcion Suprime caracteres no imprimibles

DESCRIPTION:

PARAMETERS: 
RESULT: string sin caracteres especiales
-----------------------------------------------------------------------*/
   $stdchars= array("@","a","e","i","o","u","n","A","E","I","O","U","N"," "," "," "," ");
   $tildechars= array("@","=E1","=E9","=ED","=F3","=FA","=F1","=C1","=C9","=CD","=D3","=DA","=D1","=?iso-8859-1?Q?","=?utf-8?Q?","?=","=20");
   return str_replace($tildechars,$stdchars, $str);
}

?>
