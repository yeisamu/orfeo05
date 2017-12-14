<?php
//http://www.bloogie.es/tecnologia/programacion/34-ajax-con-jquery-php-y-json-ejemplo-paso-a-paso

session_start();
if (!$ruta_raiz)        $ruta_raiz="..";
require_once("$ruta_raiz/include/db/ConnectionHandler.php");
if (!$db) $db = new ConnectionHandler("$ruta_raiz");
//include("crea_combos_universales.php");
//error_reporting(7);
$db->conn->SetFetchMode(ADODB_FETCH_NUM);
$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);

//$db->conn->debug=true;

 $q = strtoupper($_GET["producto"]);

 // 0: ciudadanos, 1: Terceros , 2: Empresas, 6:funcionarios


  $rs=$db->query("SELECT TDID_CODI, SGD_CIU_CODIGO, SGD_CIU_NOMBRE,".
                         " SGD_CIU_DIRECCION, SGD_CIU_APELL1,".
                          " SGD_CIU_APELL2,SGD_CIU_TELEFONO,SGD_CIU_EMAIL, MUNI_CODI,".
                          "DPTO_CODI,SGD_CIU_CEDULA, ID_PAIS, ID_CONT from SGD_CIU_CIUDADANO where ".
                         " SGD_CIU_CEDULA='$q'");
if ($rs){

    echo "formObj.nom_ciu.value = '".$rs->fields["SGD_CIU_NOMBRE"]."';\n";    
    echo "formObj.apll1_ciu.value = '".$rs->fields["SGD_CIU_APELL1"]."';\n";    
    echo "formObj.apll2_ciu.value = '".$rs->fields["SGD_CIU_APELL2"]."';\n";    
    echo "formObj.dir_ciu.value = '".$rs->fields["SGD_CIU_DIRECCION"]."';\n";    
    echo "formObj.tel_ciu.value = '".$rs->fields["SGD_CIU_TELEFONO"]."';\n";    
    echo "formObj.email_ciu.value = '".$rs->fields["SGD_CIU_EMAIL"]."';\n";    
    echo "formObj.doc_ciu.value = '".$rs->fields["SGD_CIU_CEDULA"]."';\n";    
    echo "formObj.label.value = '".$rs->fields["MUNI_CODI"]."';\n";    
    echo "formObj.label2.value = '".$rs->fields["DPTO_CODI"]."';\n";    
    echo "formObj.label15.value = '".$rs->fields["ID_PAIS"]."';\n";    
    echo "formObj.cont.value = '".$rs->fields["ID_CONT"]."';\n";    
    echo "formObj.tdid_ciu.value = '".$rs->fields["TDID_CODI"]."';\n";    
    echo "formObj.cod_ciu.value = '".$rs->fields["SGD_CIU_CODIGO"]."';\n";    
    
  }else{
    echo "formObj.nom_ciu.value = '';\n";    
    echo "formObj.apll1_ciu.value = '';\n";    
    echo "formObj.dir_ciu.value = '';\n";    
    echo "formObj.tel_ciu.value = '';\n";    
    echo "formObj.email_ciu.value = '';\n";    
    echo "formObj.label.value = '';\n";      
  }    

?>
