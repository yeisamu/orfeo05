<?php
//http://www.bloogie.es/tecnologia/programacion/34-ajax-con-jquery-php-y-json-ejemplo-paso-a-paso

session_start();
if (!$ruta_raiz)        $ruta_raiz="../..";
require_once("$ruta_raiz/include/db/ConnectionHandler.php");
if (!$db) $db = new ConnectionHandler("$ruta_raiz");
//include("crea_combos_universales.php");
//error_reporting(7);
$db->conn->SetFetchMode(ADODB_FETCH_NUM);
$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);

//$db->conn->debug=true;

// $q = strtoupper($_GET["producto"]);
 $q = mb_convert_case($_GET["producto"], MB_CASE_UPPER, 'UTF-8');
 $data_empresa = explode('- NIT -', $q);
 $q = trim($data_empresa[0]);
 $q_doc = trim($data_empresa[1]);
 // 0: ciudadanos, 1: Terceros , 2: Empresas, 6:funcionarios
$usua_concat=$db->conn->Concat("RTRIM(SGD_CIU_NOMBRE)","' '","CASE WHEN  SGD_CIU_APELL1 is NULL THEN ' '
ELSE RTRIM(SGD_CIU_APELL1) END","' '","CASE WHEN  SGD_CIU_APELL2 is NULL THEN ' ' ELSE RTRIM(SGD_CIU_APELL2) END");
 $usua_concat="RTRIM(".$usua_concat.")";



/* $isql0="SELECT TDID_CODI, SGD_CIU_CODIGO, SGD_CIU_NOMBRE,".
                         " SGD_CIU_DIRECCION, SGD_CIU_APELL1,".
                          " SGD_CIU_APELL2,SGD_CIU_TELEFONO,SGD_CIU_EMAIL, MUNI_CODI,".
                          "DPTO_CODI,SGD_CIU_CEDULA, ID_PAIS, ID_CONT from SGD_CIU_CIUDADANO where ".
                         " $usua_concat='$q'";
 $isql2="SELECT TDID_CODI,  SGD_OEM_CODIGO AS SGD_CIU_CODIGO,SGD_OEM_OEMPRESA as SGD_CIU_NOMBRE,".
                         " SGD_OEM_DIRECCION as SGD_CIU_DIRECCION,  SGD_OEM_SIGLA AS SGD_CIU_APELL1,SGD_OEM_REP_LEGAL ".
                          "as SGD_CIU_APELL2,SGD_OEM_TELEFONO AS SGD_CIU_TELEFONO, EMAIL AS SGD_CIU_EMAIL, MUNI_CODI,".
                          "DPTO_CODI,SGD_OEM_NIT AS SGD_CIU_CEDULA, ID_PAIS, ID_CONT from SGD_OEM_OEMPRESAS where ".
                         " SGD_OEM_OEMPRESA='$q'";*/


$isql1="SELECT NUIR AS NUIR, ARE_ESP_SECUE AS TDID_CODI,IDENTIFICADOR_EMPRESA AS SGD_CIU_CODIGO,NOMBRE_DE_LA_EMPRESA as SGD_CIU_NOMBRE, DIRECCION as".
                       " SGD_CIU_DIRECCION, NOMBRE_REP_LEGAL  as SGD_CIU_APELL1, SIGLA_DE_LA_EMPRESA as SGD_CIU_APELL2, TELEFONO_1 AS SGD_CIU_TELEFONO, TELEFONO_2 AS SGD_CIU_TELEFONO2, ACTIVA AS ACTIVA,".
                       "EMAIL AS SGD_CIU_EMAIL,  CAST(CODIGO_DEL_MUNICIPIO as numeric(10,0))  as MUNI_CODI, CAST( CODIGO_DEL_DEPARTAMENTO as numeric(10,0))".
                       " as DPTO_CODI, NIT_DE_LA_EMPRESA AS SGD_CIU_CEDULA, CODIGO_SUSCRIPTOR AS SUSCRIPTOR , ID_CONT,ID_PAIS  from BODEGA_EMPRESAS WHERE NOMBRE_DE_LA_EMPRESA= '$q' AND NIT_DE_LA_EMPRESA = '$q_doc' ";

/*$isql6=" select  1  as TDID_CODI, USUA_CODI AS SGD_CIU_CODIGO,usua_nomb as SGD_CIU_NOMBRE, dependencia.depe_nomb as SGD_CIU_DIRECCION,".
                            " '' as SGD_CIU_APELL1,USUARIO.USUA_LOGIN as SGD_CIU_APELL2, CAST(  USUARIO.USUA_EXT as character varying(50)) AS SGD_CIU_TELEFONO,".
                               " USUARIO.usua_email as SGD_CIU_EMAIL ,dependencia.MUNI_CODI as MUNI_CODI, dependencia.DPTO_CODI as DPTO_CODI,usua_doc AS".
                               " SGD_CIU_CEDULA,  dependencia.ID_PAIS, dependencia.ID_CONT  from USUARIO, dependencia where USUA_ESTA='1'  AND USUARIO.depe_codi".                               " = dependencia.depe_codi and USUA_NOMB='$q'";
*/

   //Para conocer  si es ciudadano, empresa,entidad o funcionario.

   $rs1=$db->query($isql1);
   $nomb1=$rs1->fields["SGD_CIU_NOMBRE"];

//Modificado skinatech
//Garantizamos que solo setea un tbusqueda
//Presentaba error cuando el mismo codigo estaba en varias tablas
//ej ciu 1 y oem 1, tomaba el ultimo y no el real
  $tbusqueda=0;   
  if($nomb1!=null) { $tbusqueda=1; $isql=$isql1; }

//  $isql=$isql0 ." UNION ".$isql1." UNION ".$isql2." UNION ".$isql6;
//ECHO "TBUSQUEDA $tbusqueda nom $nomb0 1 $nomb1 2 $nomb2 6 $nomb6";
  $rs=$db->query($isql);
  $jsondata=array(); 
   
//   $jsondata['DOCUMENTO']    =$rs->fields["SGD_CIU_CODIGO"];
   $jsondata['NOM']          = str_replace('"',' ',$rs->fields["SGD_CIU_NOMBRE"]) . " ";
   $jsondata['APELL1']       = str_replace('"',' ',$rs->fields["SGD_CIU_APELL1"]) . " ";
   $jsondata['APELL2']       = str_replace('"',' ',$rs->fields["SGD_CIU_APELL2"]) . " ";
   $jsondata['TELEFONO']     = str_replace('"',' ',$rs->fields["SGD_CIU_TELEFONO"]) . " ";
   $jsondata['TELEFONO2']     = str_replace('"',' ',$rs->fields["SGD_CIU_TELEFONO2"]) . " ";
   $jsondata['DIRECCION']    = str_replace('"',' ',$rs->fields["SGD_CIU_DIRECCION"]) . " ";
   $jsondata['DOCUMENTO']    = trim($rs->fields["SGD_CIU_CODIGO"]);
   $jsondata['NUIR']    = trim($rs->fields["NUIR"]);
   $jsondata['MAIL']         = str_replace('"',' ',$rs->fields["SGD_CIU_EMAIL"]) . " ";
   $jsondata['TIPO_EMPRESA'] = $tbusqueda;
   $jsondata['CC_DOCUMENTO'] = trim($rs->fields["SGD_CIU_CEDULA"]) ;
   $jsondata['SUSCRIPTOR'] = trim($rs->fields["SUSCRIPTOR"]) ;
   $jsondata['ACTIVA'] = trim($rs->fields["ACTIVA"]) ;
   $jsondata['CONT']         = $rs->fields["ID_CONT"];
   $jsondata['PAIS']         = $rs->fields["ID_PAIS"];
   $jsondata['DPTO']         = $rs->fields["DPTO_CODI"];
   $jsondata['MUNI']         = $rs->fields["MUNI_CODI"];


  echo json_encode($jsondata);
?>
