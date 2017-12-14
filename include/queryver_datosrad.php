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



switch ($db->driver) 
	{ 
	case "oracle" :
	case 'oci8':
	case 'postgres'
		$numero = "RADI_NUME_DERI as RADI_NUME_DERI1";
	break;	
	case "mssql":
		$numero = "convert(varchar(14), a.RADI_NUME_DERI) as RADI_NUME_DERI1";
	break;				   			   
	}
?>
