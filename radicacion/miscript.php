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


require_once("../include/db/ConnectionHandler.php");
if (!$db) $db = new ConnectionHandler("..");
$db->conn->SetFetchMode(ADODB_FETCH_NUM);
$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);

//$db->conn->debug = true;
  //if ($coddepe==NULL) $a=$dependencia;
      //  $usua_select=$_POST['usua_select'];


$a=$_POST['variable'];
//echo "Ya ta ".$_POST['variable'];
//$a=119;
  $query=" SELECT  USUA_NOMB, USUA_CODI FROM USUARIO  WHERE  DEPE_CODI='$a' AND USUA_ESTA='1'";
  $rs=$db->conn->query($query);

   print $rs->GetMenu2("usua_select",$usua_select, "0:-- Seleccione el Funcionario --", false,false,"class='select'");

?>
