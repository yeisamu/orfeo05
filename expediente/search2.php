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


session_start();

if (!$ruta_raiz) $ruta_raiz="..";

require_once("$ruta_raiz/include/db/ConnectionHandler.php");

if (!$db) $db = new ConnectionHandler("$ruta_raiz");

$db->conn->SetFetchMode(ADODB_FETCH_NUM);
$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);

//$db->conn->debug=true;

//$q = strtoupper($_GET["nomExp"]);
 $q = mb_convert_case($_GET["nomExp"], MB_CASE_UPPER, 'UTF-8');

$sql_nomExp = "select sgd_exp_numero as EXP_NUMERO from sgd_sexp_secexpedientes where upper(sgd_sexp_parexp1) like '$q'";
//echo $sql_nomExp;

$rs=$db->query($sql_nomExp);

$jsondata=array(); 
   
$jsondata['EXP_NUM'] = str_replace('"',' ',$rs->fields["EXP_NUMERO"]) . " ";

echo json_encode($jsondata);
?>
