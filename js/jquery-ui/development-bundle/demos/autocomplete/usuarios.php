<?

session_start();
if (!$ruta_raiz)        $ruta_raiz="..";
require_once("$ruta_raiz/include/db/ConnectionHandler.php");
if (!$db) $db = new ConnectionHandler("$ruta_raiz");
include("crea_combos_universales.php");
error_reporting(7);
$db->conn->SetFetchMode(ADODB_FETCH_NUM);
$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);

//$db->conn->debug=true;

 $isql="SELECT  USUA_NOMB FROM USUARIO";
// echo $isql;
 $rs=$db->query($isql);
// $result=$rs->fields["USUA_NOMB"];
 
while (!$rs->EOF)
   {
       $datos[]=$rs->fields["USUA_NOMB"];
            
        $rs->MoveNext();
   }
//echo $datos[2];
// initialize the results array
        //$datos[count($datos)] = "Zambia";
        //$datos[count($datos)] = "Zimbabwe";


        $texto = $_GET["texto"];

        // Devuelvo el XML con la palabra que mostramos (con los '_') y si hay éxito o no
        $xml  = '<?xml version="1.0" standalone="yes"?>';
        $xml .= '<datos>';
        foreach ($datos as $dato) {
                if (strpos(strtoupper($dato), strtoupper($texto)) === 0 OR $texto == "") {
                        $xml .= '<pais>'.$dato.'</pais>';
                }
        }
        $xml .= '</datos>';
        header('Content-type: text/xml');
        echo $xml;  
?>



