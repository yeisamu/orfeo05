<?php
session_start();
if (!$ruta_raiz)        $ruta_raiz="..";
require_once("$ruta_raiz/include/db/ConnectionHandler.php");
if (!$db) $db = new ConnectionHandler("$ruta_raiz");
//include("crea_combos_universales.php");
//error_reporting(7);
$db->conn->SetFetchMode(ADODB_FETCH_NUM);
$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);

//$db->conn->debug=true;

 $q = strtoupper($_GET["term"]);
// Reemplazo agregado para que busque en toda la cadena de caracteres
 $q_modif = str_replace(" ", "%", $q);

 //$q="ROS";  
 // 0: ciudadanos, 1: Terceros , 2: Empresas, 6:funcionarios
 $usua_concat=$db->conn->Concat("RTRIM(SGD_CIU_NOMBRE)","' '","CASE WHEN  SGD_CIU_APELL1 is NULL THEN ' '
ELSE RTRIM(SGD_CIU_APELL1) END","' '","CASE WHEN  SGD_CIU_APELL2 is NULL THEN ' ' ELSE RTRIM(SGD_CIU_APELL2) END");
 $usua_concat="RTRIM(".$usua_concat.")";
//carlinho
 $vec = explode(" ", $q);
 $tam_vec = sizeof($vec);
$sql_and="(SGD_CIU_CEDULA ='$vec[0]') ";
 
 $isql="SELECT ".$usua_concat." as USUA_NOMB FROM SGD_CIU_CIUDADANO  WHERE  ".$sql_and;
//uno todas las tablas

 $rs=$db->query($isql);
 $datos=array(); 
 while (!$rs->EOF)
   {
       $var=$rs->fields["USUA_"]; 
       $datos[$var]=$var;
       
        $rs->MoveNext();
   }
$q = strtolower($_GET["term"]);
// $q = strtoupper($_GET["term"]);
 // 0: ciudadanos, 1: Terceros , 2: Empresas, 6:funcionarios
if (!$q) return;

//datos de prueba
/*$items = array(
"Great Bittern"=>"Botaurus stellaris",
"Little Grebe"=>"Tachybaptus ruficollis",
"Black-necked Grebe"=>"Podiceps nigricollis",
"Little Bittern"=>"Ixobrychus minutus",
);*/


$items=$datos;
function array_to_json( $array ){

    if( !is_array( $array ) ){
        return false;
    }

    $associative = count( array_diff( array_keys($array), array_keys( array_keys( $array )) ));
    if( $associative ){

        $construct = array();
        foreach( $array as $key => $value ){

            // We first copy each key/value pair into a staging array,
            // formatting each key and value properly as we go.

            // Format the key:
            if( is_numeric($key) ){
                $key = "key_$key";
            }
            $key = "\"".addslashes($key)."\"";

            // Format the value:
            if( is_array( $value )){
                $value = array_to_json( $value );
            } else if( !is_numeric( $value ) || is_string( $value ) ){
                $value = "\"".addslashes($value)."\"";
            }

            // Add to staging array:
            $construct[] = "$key: $value";
        }

        // Then we collapse the staging array into the JSON form:
        $result = "{ " . implode( ", ", $construct ) . " }";

    } else { // If the array is a vector (not associative):

        $construct = array();
        foreach( $array as $value ){

            // Format the value:
            if( is_array( $value )){
                $value = array_to_json( $value );
            } else if( !is_numeric( $value ) || is_string( $value ) ){
                $value = "'".addslashes($value)."'";
            }

            // Add to staging array:
            $construct[] = $value;
        }

        // Then we collapse the staging array into the JSON form:
        $result = "[ " . implode( ", ", $construct ) . " ]";
    }

    return $result;
}

$result = array();
foreach ($items as $key=>$value) {
        //Condicion suprimida para busquedas mas completas
	//if (strpos(strtolower($key), $q) !== false) {
		array_push($result, array("id"=>$value, "label"=>$key, "value" => strip_tags($key)));
	//}
	if (count($result) > 10)
		break;
}
echo array_to_json($result);

?>
