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



//http://www.bloogie.es/tecnologia/programacion/34-ajax-con-jquery-php-y-json-ejemplo-paso-a-paso

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

$q = strtoupper($_GET["producto"]);

// 0: ciudadanos, 1: Terceros , 2: Empresas, 6:funcionarios
$isql0 = "SELECT TDID_CODI, SGD_CIU_CODIGO, SGD_CIU_NOMBRE," .
        " SGD_CIU_DIRECCION, SGD_CIU_APELL1," .
        " SGD_CIU_APELL2,SGD_CIU_TELEFONO,SGD_CIU_EMAIL, MUNI_CODI," .
        "DPTO_CODI,SGD_CIU_CEDULA, ID_PAIS, ID_CONT from SGD_CIU_CIUDADANO where " .
        " SGD_CIU_CEDULA='$q'";
$isql2 = "SELECT TDID_CODI,  SGD_OEM_CODIGO AS SGD_CIU_CODIGO,SGD_OEM_OEMPRESA as SGD_CIU_NOMBRE," .
        " SGD_OEM_DIRECCION as SGD_CIU_DIRECCION,  SGD_OEM_SIGLA AS SGD_CIU_APELL1,SGD_OEM_REP_LEGAL " .
        "as SGD_CIU_APELL2,SGD_OEM_TELEFONO AS SGD_CIU_TELEFONO, EMAIL AS SGD_CIU_EMAIL, MUNI_CODI," .
        "DPTO_CODI,SGD_OEM_NIT AS SGD_CIU_CEDULA, ID_PAIS, ID_CONT from SGD_OEM_OEMPRESAS where " .
        " SGD_OEM_NIT='$q'";



$rs0 = $db->query($isql0);
$rs2 = $db->query($isql2);

$nomb0 = $rs0->fields["SGD_CIU_NOMBRE"];
$nomb2 = $rs2->fields["SGD_CIU_NOMBRE"];

//Modificado skinatech
//Garantizamos que solo setea un tbusqueda
//Presentaba error cuando el mismo codigo estaba en varias tablas
//ej ciu 1 y oem 1, tomaba el ultimo y no el real
$tbusqueda = 0;
if ($nomb0 != null) {
    $tbusqueda = 0;
    $tipoSolicitante = 1;
    $isql = $isql0;
} elseif ($nomb2 != null) {
    $tbusqueda = 2;
    $tipoSolicitante = 2;
    $isql = $isql2;
}

$rs = $db->query($isql);

if ($rs) {
    echo "tipoSol = '" . trim($rs->fields["TDID_CODI"]) . "';\n";
    echo "formObj.tipoSolicitante.value = '" . $tipoSolicitante . "';\n";
    echo "formObj.tipoDocumento.value = '" . trim($rs->fields["TDID_CODI"]) . "';\n";
    echo "formObj.nom_ciu.value = '" . trim(str_replace('"', ' ', $rs->fields["SGD_CIU_NOMBRE"])) . "';\n";
    echo "formObj.apll1_ciu.value = '" . trim(str_replace('"', ' ', $rs->fields["SGD_CIU_APELL1"])) . "';\n";
    echo "formObj.apll2_ciu.value = '" . trim(str_replace('"', ' ', $rs->fields["SGD_CIU_APELL2"])) . "';\n";
    echo "formObj.dir_ciu.value = '" . trim(str_replace('"', ' ', $rs->fields["SGD_CIU_DIRECCION"])) . "';\n";
    echo "formObj.tel_ciu.value = '" . trim(str_replace('"', ' ', $rs->fields["SGD_CIU_TELEFONO"])) . "';\n";
    echo "formObj.email_ciu.value = '" . trim(str_replace('"', ' ', $rs->fields["SGD_CIU_EMAIL"])) . "';\n";
    echo "formObj.doc_ciu.value = '" . trim($rs->fields["SGD_CIU_CEDULA"]) . "';\n";
    echo "formObj.slc_pais.selectedIndex = '" . trim($rs->fields["ID_PAIS"]) . "';\n";
    echo "formObj.slc_pais.value = '" . trim($rs->fields["ID_PAIS"]) . "';\n";
    echo "formObj.slc_depto.selectedIndex = '" . trim($rs->fields["DPTO_CODI"]) . "';\n";
    echo "formObj.slc_depto.value = '" . trim($rs->fields["DPTO_CODI"]) . "';\n";
    echo "formObj.slc_municipio.selectedIndex = '" . trim($rs->fields["MUNI_CODI"]) . "';\n";
    echo "formObj.slc_municipio.value = '" . trim($rs->fields["MUNI_CODI"]) . "';\n";
    echo "muni = '" . trim($rs->fields["MUNI_CODI"]) . "';\n";
    echo "formObj.cod_ciu.value = '" . trim($rs->fields["SGD_CIU_CODIGO"]) . "';\n";
    echo "formObj.cont.value = '" . trim($rs->fields["ID_CONT"]) . "';\n";
    echo "mensaje = 'Se ha encontrado un registro para el documento : " . $q . "';\n";
} else if (!$rs) {
    echo "formObj.tipoDocumento.value = '';\n";
    echo "formObj.nom_ciu.value = '';\n";
    echo "formObj.apll1_ciu.value = '';\n";
    echo "formObj.apll2_ciu.value = '';\n";
    echo "formObj.dir_ciu.value = '';\n";
    echo "formObj.tel_ciu.value = '';\n";
    echo "formObj.email_ciu.value = '';\n";
    echo "formObj.slc_pais.selectedIndex = '170';\n";
    echo "formObj.slc_pais.value = '170';\n";
    echo "formObj.slc_depto.selectedIndex = '';\n";
    echo "formObj.slc_depto.value = '';\n";
    echo "formObj.slc_municipio.selectedIndex = '';\n";
    echo "formObj.slc_municipio.value = '';\n";
    echo "muni = '';\n";
    echo "formObj.cod_ciu.value = '';\n";
    echo "formObj.cont.value = '';\n";
    echo "mensaje = 'No se encontro un registro para el documento : " . $q . ". Seleccione su tipo de documento y diligencie los datos del formulario para completar su solicitud';\n";
}
?>
