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


/*
* Asociacion de dias de termino con radicados
* Ing. Isabel Rodriguez
* SkinaTech
* Fecha: 24-Septiembre-2012
* Sistema de gestion Documental ORFEO.
*
* Permite asociar los dias de termino y asignarlas a un radicado
* se guarda en la tabla sgd_dt_radicado
*/
session_start();
$ruta_raiz = "..";
include_once("$ruta_raiz/include/db/ConnectionHandler.php");
if(!isset($_SESSION['dependencia']))        include "$ruta_raiz/rec_session.php";
$db = new ConnectionHandler($ruta_raiz);
$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;
//$db->conn->debug=true;

if($mod==0) $sql= "insert into sgd_dt_radicado values ('$nurad',$birds2)";
elseif($mod==1) $sql="update sgd_dt_radicado set dias_termino=$birds2 where radi_nume_radi='$nurad'";

$rs = $db->conn->Execute($sql);

if ($rs) { echo "<center><label>Se asocio el radicado $nurad con $birds2 días de término</label></center>";
}else{
 echo "No hay datos para la asociacion radicado $nurad";
}

?>
