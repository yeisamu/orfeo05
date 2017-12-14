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
   $ruta_raiz="..";

   require_once("$ruta_raiz/include/db/ConnectionHandler.php");

   $db = new ConnectionHandler("$ruta_raiz");

   //error_reporting(7);
   $db->conn->SetFetchMode(ADODB_FETCH_NUM);
   $db->conn->SetFetchMode(ADODB_FETCH_ASSOC);

   // $db->conn->debug=true;

   // Parametro de entrada -> Codigo del tipo documental enviado desde el select.
   $q = $_GET["tipoDoc"];

   // Se mapean codigos

   $isql1="SELECT SGD_TPR_TERMINO FROM SGD_TPR_TPDCUMENTO WHERE SGD_TPR_CODIGO='$q'";

   $rs=$db->query($isql1);

   $jsondata=array(); 
   
   $jsondata['DIAS']          = str_replace('"',' ',$rs->fields["SGD_TPR_TERMINO"]);

   echo json_encode($jsondata);
?>
