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
if (!$ruta_raiz)
    $ruta_raiz = "..";
require_once("$ruta_raiz/include/db/ConnectionHandler.php");
if (!$db)
    $db = new ConnectionHandler("$ruta_raiz");
//include("crea_combos_universales.php");
//error_reporting(7);
$db->conn->SetFetchMode(ADODB_FETCH_NUM);
$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);

//$db->conn->debug=true;
// $q = strtoupper($_GET["term"]);
//$q = mb_convert_case($_GET["term"], MB_CASE_UPPER, 'UTF-8');
//$q2 = mb_convert_case($_GET["term"], MB_CASE_TITLE, 'UTF-8');
$q = $_GET["term"];
$q2 = $_GET["term"];

// Reemplazo agregado para que busque en toda la cadena de caracteres
$q_modif = str_replace(" ", "%", $q);
$q_modif2 = str_replace(" ", "%", $q2);

//$q="ROS";  
// 0: ciudadanos, 1: Terceros , 2: Empresas, 6:funcionarios
$usua_concat = $db->conn->Concat("RTRIM(SGD_CIU_NOMBRE)", "' '", "CASE WHEN  SGD_CIU_APELL1 is NULL THEN ' ' ELSE RTRIM(SGD_CIU_APELL1) END", "' '", "CASE WHEN  SGD_CIU_APELL2 is NULL THEN ' ' ELSE RTRIM(SGD_CIU_APELL2) END");
$usua_concat = "RTRIM(" . $usua_concat . ")";
//carlinho
$vec = explode(" ", $q);
$tam_vec = sizeof($vec);

//
$sql_and = "(SGD_CIU_NOMBRE  ILIKE '%$vec[0]%' OR SGD_CIU_APELL1 ILIKE '%$vec[0]%' OR SGD_CIU_APELL2 ILIKE '%$vec[0]%') ";
for ($i = 1; $i < $tam_vec; $i++) {
    $sql_and = $sql_and . " AND (SGD_CIU_NOMBRE  ILIKE '%$vec[$i]%' OR SGD_CIU_APELL1 ILIKE '%$vec[$i]%' OR SGD_CIU_APELL2 ILIKE '%$vec[$i]%') ";
}

$isql0 = "SELECT " . $usua_concat . " as USUA_NOMB FROM SGD_CIU_CIUDADANO  WHERE  " . $sql_and;
$isql1 = "SELECT  NOMBRE_DE_LA_EMPRESA as USUA_NOMB FROM BODEGA_EMPRESAS  WHERE  NOMBRE_DE_LA_EMPRESA  ILIKE '%$q_modif%'";
$isql2 = "SELECT  SGD_OEM_OEMPRESA as USUA_NOMB FROM SGD_OEM_OEMPRESAS  WHERE  SGD_OEM_OEMPRESA  ILIKE '%$q_modif%'";
$isql6 = "SELECT  USUA_NOMB FROM USUARIO  WHERE  USUA_NOMB ILIKE '%$q_modif%'";
//uno todas las tablas
$isql = $isql0 . " UNION " . $isql1 . " UNION " . $isql2 . " UNION " . $isql6;
// Sacamos a los suscriptores de la query de nombre
//$isql=$isql0 ." UNION ".$isql2." UNION ".$isql6;
//$isql="SELECT  SGD_CIU_NOMBRE as USUA_NOMB FROM SGD_CIU_CIUDADANO  WHERE  SGD_CIU_NOMBRE  LIKE '$q%'";
// $isql="SELECT  USUA_NOMB FROM USUARIO";
$rs = $db->query($isql);
$datos = array();
while (!$rs->EOF) {
    $var = $rs->fields["USUA_NOMB"];
    $datos[$var] = $var;

    $rs->MoveNext();
}

$q = strtolower($_GET["term"]);
// $q = strtoupper($_GET["term"]);
// 0: ciudadanos, 1: Terceros , 2: Empresas, 6:funcionarios
if (!$q)
    return;

//datos de prueba
/* $items = array(
  "Great Bittern"=>"Botaurus stellaris",
  "Little Grebe"=>"Tachybaptus ruficollis",
  "Black-necked Grebe"=>"Podiceps nigricollis",
  "Little Bittern"=>"Ixobrychus minutus",
  ); */


$items = $datos;

function array_to_json($array) {

    if (!is_array($array)) {
        return false;
    }

    $associative = count(array_diff(array_keys($array), array_keys(array_keys($array))));
    if ($associative) {

        $construct = array();
        foreach ($array as $key => $value) {

            // We first copy each key/value pair into a staging array,
            // formatting each key and value properly as we go.
            // Format the key:
            if (is_numeric($key)) {
                $key = "key_$key";
            }
            $key = "\"" . addslashes($key) . "\"";

            // Format the value:
            if (is_array($value)) {
                $value = array_to_json($value);
            } else if (!is_numeric($value) || is_string($value)) {
                $value = "\"" . addslashes($value) . "\"";
            }

            // Add to staging array:
            $construct[] = "$key: $value";
        }

        // Then we collapse the staging array into the JSON form:
        $result = "{ " . implode(", ", $construct) . " }";
    } else { // If the array is a vector (not associative):
        $construct = array();
        foreach ($array as $value) {

            // Format the value:
            if (is_array($value)) {
                $value = array_to_json($value);
            } else if (!is_numeric($value) || is_string($value)) {
                $value = "'" . addslashes($value) . "'";
            }

            // Add to staging array:
            $construct[] = $value;
        }

        // Then we collapse the staging array into the JSON form:
        $result = "[ " . implode(", ", $construct) . " ]";
    }

    return $result;
}

$result = array();
foreach ($items as $key => $value) {
    //Condicion suprimida para busquedas mas completas
    //if (strpos(strtolower($key), $q) !== false) {
    array_push($result, array("id" => $value, "label" => $key, "value" => strip_tags($key)));
    //}
    if (count($result) > 10)
        break;
}
echo array_to_json($result);
?>
