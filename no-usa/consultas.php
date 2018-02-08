<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
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

<html>
<head>
<title>Untitled Document</title>
</head>
<body>
<?php
   include_once "./include/db/ConnectionHandler.php";
	$db = new ConnectionHandler(".");
	error_reporting(7);   
   $isql = "Select * from  usuario where usua_login like '%JH%'";
   $pager = new ADODB_Pager($db->conn,$isql,'adodb', true,$orderNo,$orderTipo);
   $pager->toRefLinks = $linkPagina;
   $pager->Render($rows_per_page=75,$linkPagina,$checkbox=chkAnulados);

?>
</body>
</html>
