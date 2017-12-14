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


/**
 * 				//// O J O	\\\\\
 * 				\\\\		/////
 * 
  Este módulo de consulta fue codificada su lógica. En las entidades
  donde la búsqueda duplique, triplique, etc el mismo registro se debe
  ejecutar las siguientes sentencias:

  UPDATE SGD_DIR_DRECCIONES SET sgd_oem_codigo=null WHERE sgd_oem_codigo=0;
  UPDATE SGD_DIR_DRECCIONES SET sgd_ciu_codigo=null WHERE sgd_ciu_codigo=0;
  UPDATE SGD_DIR_DRECCIONES SET sgd_esp_codi=null WHERE sgd_esp_codi=0;
  UPDATE SGD_DIR_DRECCIONES SET sgd_doc_fun=null WHERE sgd_doc_fun=0;
 */
session_start();
$verrad = "";
$ruta_raiz = "..";
include_once dirname(__FILE__) . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "config.php";
include_once "$ruta_raiz/include/db/ConnectionHandler.php";
$db = new ConnectionHandler("$ruta_raiz");
//$db->conn->debug=true;
if (!$_SESSION['dependencia'])
    include "$ruta_raiz/rec_session.php";

if ($orden_cambio == 1)
    (!$orderTipo) ? $orderTipo = "desc" : $orderTipo = "";

if (!$orderNo) {
    $orderNo = "0";
    $order = 1;
} else {
    $order = $orderNo + 1;
}

if (!isset($fecha_ini))
    $fecha_ini = date("Y/m/d", strtotime("-1 month"));
if (!isset($fecha_fin))
    $fecha_fin = date("Y/m/d");

$encabezado1 = "$PHP_SELF?" . session_name() . "=" . session_id() . "&krd=$krd";
$linkPagina = "$encabezado1&n_nume_radi=$n_nume_radi&s_RADI_NOM=$s_RADI_NOM&s_solo_nomb=$s_solo_nomb&s_entrada=$s_entrada&s_salida=$s_salida&fecha_ini=$fecha_ini&fecha_fin=$fecha_fin&fecha1=$fecha1&tipoDocumento=$tipoDocumento&dependenciaSel=$dependenciaSel&orderTipo=$orderTipo&orderNo=$orderNo";
$encabezado = "" . session_name() . "=" . session_id() . "&krd=$krd&n_nume_radi=$n_nume_radi&s_RADI_NOM=$s_RADI_NOM&s_solo_nomb=$s_solo_nomb&s_entrada=$s_entrada&s_salida=$s_salida&fecha_ini=$fecha_ini&fecha_fin=$fecha_fin&fecha1=$fecha1&tipoDocumento=$tipoDocumento&dependenciaSel=$dependenciaSel&orderTipo=$orderTipo&orderNo=";
$nombreSesion = "" . session_name() . "=" . session_id();

/* Se recibe el numero del Expediente a Buscar */
if ($nume_expe or $nom_expe or $adodb_next_page or $orderNo or $orderTipo or $orden_cambio or $dependenciaSel) {
    //Se valida rango de fechas
    $sqlFecha = $db->conn->SQLDate('Y/m/d', "R.RADI_FECH_RADI");
    $where_general = " WHERE " . $sqlFecha . " BETWEEN '$fecha_ini' AND '$fecha_fin'";

    /* Se recibe la dependencia actual para bsqueda */
    if ($dependenciaSel == "99999")
        $where_general .= " AND R.RADI_DEPE_ACTU IS NOT NULL ";
    else
        $where_general .= " AND R.RADI_DEPE_ACTU = '" . $dependenciaSel . "'";

    // Se valida el expediente
    if ($nume_expe)
        $where_general .= " AND E.SGD_EXP_NUMERO LIKE '%$nume_expe%' ";
    //Valido para el nombre de la carpeta
    //by skina para ciac

    if ($nom_expe) {
        $nom_expe = strtoupper($nom_expe);
        //by skina para ciac 140711
        $where_general .= " AND UPPER(SECEX.SGD_SEXP_PAREXP1) LIKE '%$nom_expe%' ";
        //Modificado 07042017 solo para sht por la estructura de la base de datos que tiene
        //$where_general .= " AND (UPPER(SECEX.SGD_SEXP_PAREXP1) LIKE '%$nom_expe%' or UPPER(e.SGD_EXP_SUBEXPEDIENTE) LIKE '%$nom_expe%')";
    }
//Modificado Idrd ago-26-2008 para buscar por serie y subserie
    if ($_POST['codserie'] != "")
        $serieSel = $_POST['codserie'];
    else
        $serieSel = $_GET['serieSel'];
    if ($_POST['tsub'] != "")
        $subserieSel = $_POST['tsub'];
    else
        $subserieSel = $_GET['subserieSel'];

    if (!isset($serieSel)) {
        $serieSel = 0;
    }
    if (!isset($subserieSel)) {
        $subserieSel = 0;
    }
    if (!isset($tdocSel)) {
        $tdocSel = 0;
    }


// Se valida la serie
    if ($serieSel)
        $where_general .= " AND SECEX.SGD_SRD_CODIGO = " . $serieSel;
// Subserie
    if ($subserieSel)
        $where_general .= " AND SECEX.SGD_SBRD_CODIGO = " . $subserieSel;

    /* Busqueda por nivel y usuario
      $where_general .= " AND R.CODI_NIVEL <= ".$nivelus;
     */
    include($ruta_raiz . "/include/query/busqueda/busquedaPiloto1.php");

    //Creamos la columna por el cual ORDENAR los resutados
    switch ($orderNo) {
        case 0:
            $c_order = " ORDER BY 1 ";
            break;
        case 2:
            $c_order = " ORDER BY 3 ";
            break;
        case 4:
            $c_order = " ORDER BY 5 ";
            break;
        case 5:
            $c_order = " ORDER BY 6 ";
            break;
        case 6:
            $c_order = " ORDER BY 7 ";
            break;
        case 7:
            $c_order = " ORDER BY 8 ";
            break;
        case 8:
            $c_order = " ORDER BY 9 ";
            break;
        case 9:
            $c_order = " ORDER BY 10 ";
            break;
        case 10:
            $c_order = " ORDER BY 11 ";
            break;
        case 11:
            $c_order = " ORDER BY 12 ";
            break;
    }
    $c_order .= (!$orderTipo) ? "asc" : "desc";
    /* By skina
     * *Para ciac
      BODEGA_EMPRESAS X ON D.SGD_ESP_CODI = X.IDENTIFICADOR_EMPRESA
     */
    $sql = 'SELECT  DISTINCT ' . $radi_nume_radi . ' as "IMG_Numero Radicado", 
                        R.RADI_PATH AS "HID_RADI_PATH",' .
            $sqlFecha . ' AS "FECHA" ,' .
            $radi_nume_radi . ' AS "HID_RADI_NUME_RADI" ,
                        E.SGD_EXP_NUMERO AS "Expediente",
                        USUARIO.USUA_NOMB AS "Responsable",
                        SECEX.SGD_SEXP_PAREXP1 as "Nombre de Carpeta",
                        E.SGD_EXP_SUBEXPEDIENTE AS "Subexpediente",
                        R.RA_ASUN AS "Asunto",
                        SRD.SGD_SRD_DESCRIP AS "Serie",
                        SBRD.SGD_SBRD_DESCRIP  AS "Subserie",
                        T.SGD_TPR_DESCRIP AS "Tipo_Documento",
                        D.SGD_DIR_NOMREMDES AS "Nombre", ' .
            $db->conn->concat('R.RADI_DEPE_ACTU', "'-'", 'R.RADI_USUA_ACTU', "'-'", 'R.SGD_SPUB_CODIGO', "'-'", 'R.CODI_NIVEL') . ' AS "HID_priv" 
                FROM RADICADO R 
                        INNER JOIN SGD_EXP_EXPEDIENTE E ON R.RADI_NUME_RADI = E.RADI_NUME_RADI 
                        INNER JOIN SGD_DIR_DRECCIONES D ON R.RADI_NUME_RADI = D.RADI_NUME_RADI 
                        INNER JOIN SGD_TPR_TPDCUMENTO T ON R.TDOC_CODI = T.SGD_TPR_CODIGO 
                        LEFT JOIN SGD_SRD_SERIESRD SRD ON SRD.SGD_SRD_CODIGO = CAST(SUBSTR(E.SGD_EXP_NUMERO, ' . (5 + $longitud_codigo_dependencia) . ', 2) AS INTEGER)
                        LEFT JOIN SGD_SBRD_SUBSERIERD SBRD 
                                ON (SBRD.SGD_SBRD_CODIGO = CAST(SUBSTR(E.SGD_EXP_NUMERO, ' . (7 + $longitud_codigo_dependencia) . ', 2) AS INTEGER) 
                                AND SBRD.SGD_SRD_CODIGO = CAST(SUBSTR(E.SGD_EXP_NUMERO, ' . (5 + $longitud_codigo_dependencia) . ', 2) AS INTEGER))
                        LEFT JOIN SGD_SEXP_SECEXPEDIENTES SECEX ON E.sgd_exp_numero=SECEX.sgd_exp_numero
                        LEFT JOIN USUARIO ON SECEX.USUA_DOC_RESPONSABLE=USUARIO.USUA_DOC' .
            $where_general . $c_order;
    /* UNION ALL

      SELECT DISTINCT '.$radi_nume_radi.' as "IMG_Numero Radicado",
      R.RADI_PATH AS HID_RADI_PATH,'.
      $sqlFecha.' AS DAT_FECHA ,'.
      $radi_nume_radi.' AS HID_RADI_NUME_RADI ,
      E.SGD_EXP_NUMERO AS Expediente,
      R.RA_ASUN AS "Asunto",
      SRD.sgd_srd_descrip as "Serie",
      SBRD.sgd_sbrd_descrip  as "Subserie",
      T.SGD_TPR_DESCRIP AS Tipo_Documento,
      D.SGD_DIR_NOMREMDES AS Nombre,'.
      $db->conn->concat('R.RADI_DEPE_ACTU',"'-'",'R.RADI_USUA_ACTU',"'-'",'R.SGD_SPUB_CODIGO',"'-'",'R.CODI_NIVEL').' AS HID_priv
      FROM RADICADO R INNER JOIN
      SGD_EXP_EXPEDIENTE E ON R.RADI_NUME_RADI = E.RADI_NUME_RADI INNER JOIN
      SGD_DIR_DRECCIONES D ON R.RADI_NUME_RADI = D.RADI_NUME_RADI INNER JOIN
      SGD_TPR_TPDCUMENTO T ON R.TDOC_CODI = T.SGD_TPR_CODIGO INNER JOIN
      SGD_OEM_OEMPRESAS Y ON D.SGD_OEM_CODIGO = Y.SGD_OEM_CODIGO
      LEFT JOIN SGD_RDF_RETDOCF RDF ON RDF.RADI_NUME_RADI = R.RADI_NUME_RADI
      LEFT JOIN SGD_MRD_MATRIRD MRD ON MRD.SGD_MRD_CODIGO = RDF.SGD_MRD_CODIGO
      LEFT JOIN SGD_SRD_SERIESRD SRD ON SRD.SGD_SRD_CODIGO = MRD.SGD_SRD_CODIGO
      LEFT JOIN SGD_SBRD_SUBSERIERD SBRD ON SBRD.SGD_SBRD_CODIGO = MRD.SGD_SBRD_CODIGO AND SBRD.SGD_SRD_CODIGO = SRD.SGD_SRD_CODIGO
      LEFT JOIN SGD_SEXP_SECEXPEDIENTES SECEX ON E.sgd_exp_numero=SECEX.sgd_exp_numero'.
      $where_general.

      ' UNION ALL

      SELECT DISTINCT '.$radi_nume_radi.' as "IMG_Numero Radicado",
      R.RADI_PATH AS HID_RADI_PATH,'.
      $sqlFecha.' AS DAT_FECHA ,'.
      $radi_nume_radi.' AS HID_RADI_NUME_RADI ,
      E.SGD_EXP_NUMERO AS Expediente,
      R.RA_ASUN AS "Asunto",
      SRD.sgd_srd_descrip as "Serie",
      SBRD.sgd_sbrd_descrip  as "Subserie",
      T.SGD_TPR_DESCRIP AS Tipo_Documento,
      D.SGD_DIR_NOMREMDES AS Nombre,'.
      $db->conn->concat('R.RADI_DEPE_ACTU',"'-'",'R.RADI_USUA_ACTU',"'-'",'R.SGD_SPUB_CODIGO',"'-'",'R.CODI_NIVEL').' AS HID_priv
      FROM RADICADO R INNER JOIN
      SGD_EXP_EXPEDIENTE E ON R.RADI_NUME_RADI = E.RADI_NUME_RADI INNER JOIN
      SGD_DIR_DRECCIONES D ON R.RADI_NUME_RADI = D.RADI_NUME_RADI INNER JOIN
      SGD_TPR_TPDCUMENTO T ON R.TDOC_CODI = T.SGD_TPR_CODIGO INNER JOIN
      SGD_CIU_CIUDADANO Z ON D.SGD_CIU_CODIGO = Z.SGD_CIU_CODIGO
      LEFT JOIN SGD_RDF_RETDOCF RDF ON RDF.RADI_NUME_RADI = R.RADI_NUME_RADI
      LEFT JOIN SGD_MRD_MATRIRD MRD ON MRD.SGD_MRD_CODIGO = RDF.SGD_MRD_CODIGO
      LEFT JOIN SGD_SRD_SERIESRD SRD ON SRD.SGD_SRD_CODIGO = MRD.SGD_SRD_CODIGO
      LEFT JOIN SGD_SBRD_SUBSERIERD SBRD ON SBRD.SGD_SBRD_CODIGO = MRD.SGD_SBRD_CODIGO AND SBRD.SGD_SRD_CODIGO = SRD.SGD_SRD_CODIGO
      LEFT JOIN SGD_SEXP_SECEXPEDIENTES SECEX ON E.sgd_exp_numero=SECEX.sgd_exp_numero'.
      $where_general.$c_order; */

    //echo ($sql);
    $ADODB_COUNTRECS = true;
    $rs = $db->conn->Execute($sql);
    if ($rs) {
        $nregis = $rs->recordcount();
        $fldTotal = $nregis;
    } else
        $fldTotal = 0;
    $ADODB_COUNTRECS = false;

    $pager = new ADODB_Pager($db, $sql, 'adodb', true, $orderNo, $orderTipo);
    $pager->checkAll = false;
    $pager->checkTitulo = true;
    $pager->toRefLinks = $linkPagina;
    $pager->toRefVars = $encabezado;
}

$sql = "SELECT DEPE_NOMB, DEPE_CODI FROM DEPENDENCIA ORDER BY 1";
$rs = $db->conn->execute($sql);
$cmb_dep = $rs->GetMenu2('dependenciaSel', $dependenciaSel, $blank1stItem = "99999:Todas las Dependencias", false, 0, 'class=select id="dependenciaSel" title="Listado con todas las dependencias existentes"');
?>
<html>
    <head>
        <title>Consultas</title>
        <meta http-equiv="pragma" content="no-cache">
        <meta http-equiv="expires" content="0">
        <meta http-equiv="cache-control" content="no-cache">
        <!--<link rel="stylesheet" href="Site.css" type="text/css">-->
        <link href="<?= $ruta_raiz . $ESTILOS_PATH2 ?>bootstrap.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="<?= $ruta_raiz . $_SESSION['ESTILOS_PATH_ORFEO'] ?>">
        <script>
            function limpiar()
            {
                document.Search.elements['nume_expe'].value = "";
                document.Search.elements['dependenciaSel'].value = "99999";
            }
        </script>
    </head>
    <body class="PageBODY">
        <div id="spiffycalendar" class="text"></div>
        <link rel="stylesheet" type="text/css" href="../js/spiffyCal/spiffyCal_v2_1.css">
        <script language="JavaScript" src="../js/spiffyCal/spiffyCal_v2_1.js"></script>
        <script language="javascript">
                setRutaRaiz("..");
            <!--
        var dateAvailable = new ctlSpiffyCalendarBox("dateAvailable", "Search", "fecha_ini", "btnDate1", "<?= $fecha_ini ?>", scBTNMODE_CUSTOMBLUE);
            var dateAvailable1 = new ctlSpiffyCalendarBox("dateAvailable1", "Search", "fecha_fin", "btnDate2", "<?= $fecha_fin ?>", scBTNMODE_CUSTOMBLUE);
            //-->
        </script>
        <form  name="Search"  action='<?= $_SERVER['PHP_SELF'] ?>?<?= $encabezado ?>' method=post>
            <center>
                <table>
                    <tbody>
                        <tr>
                            <td valign="top">
                                <input type="hidden" name="FormName" value="Search"><input type="hidden" name="FormAction" value="search">
                                <div id="titulo">
                                    <label style="margin-left: 38%;">Búsqueda de Expedientes</label>
                                    <!--<a class="vinculosCabezote"  href="../busqueda/busquedaExp.php?<?= $phpsession ?>&<? ECHO "&fechah=$fechah&primera=1&ent=2"; ?>">B&uacute;squeda Expediente</a>-->
                                    <a type="button" class="btn btn-primary2" style="margin-left: 23%;" href="../busqueda/busquedaPiloto.php?<?= $phpsession ?>&krd=<?= $krd ?>&<? ECHO "&fechah=$fechah&primera=1&ent=2&s_Listado=VerListado"; ?>">B&uacute;squeda Cl&aacute;sica</a>
                                </div>
                                <table border=1 cellpadding=0 cellspacing=2 class='borde_tab' style="width: 1250px;" >
                                    <tbody>
    <!--                                    <tr>
                                            <td class="titulos4" colspan="13"><a name="Search">Búsqueda de Expedientes</a></td>
                                        </tr>-->
                                        <tr>
                                            <td class="titulos2"><label for="nume_expe">Expediente</label></td>
                                            <td class="listado2">
                                                <input id="nume_expe" class="tex_area" type="text" name="nume_expe" maxlength="" value="<?= $nume_expe ?>" size=""  title="Ingrese el número o parte del número del expediente a consultar">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="titulos2"><label for="nom_expe">Nombre de Carpeta</label></td>
                                            <td class="listado2">
                                                <input id="nom_expe" class="tex_area" type="text" name="nom_expe" maxlength="" value="<?= $nom_expe ?>" size="" title="Ingrese el nombre o parte del nombre del expediente a buscar">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="titulos2"><label for="fecha_ini">Fecha inicial (año/mes/dia)</label></td>
                                            <td class="listado2">
                                                <script language="javascript">
            dateAvailable.writeControl();
            dateAvailable.dateFormat = "yyyy/MM/dd";
                                                </script>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="titulos2"><label for="fecha_fin">Fecha final (año/mes/dia)</label></td>
                                            <td class="listado2">
                                                <script language="javascript">
                                                    dateAvailable1.writeControl();
                                                    dateAvailable1.dateFormat = "yyyy/MM/dd";
                                                </script>
                                            </td>
                                        </tr>
                                        <tr> 
                                            <td class="titulos2"><label for="dependenciaSel">Dependencia Actual</label></td>
                                            <td class="listado2">
                                                <?php echo $cmb_dep; ?>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="titulos2" align="left" ><label for="codserie">Serie</label> </td>
                                            <td class='listado2'>

                                                <?php
                                                if (!$codserie)
                                                    $codserie = 0;
                                                if (!$tsub)
                                                    $tsub = 0;
                                                if (!$tdoc)
                                                    $tdoc = 0;
                                                $fechah = date("dmy") . " " . time("h_m_s");
                                                $fecha_hoy = Date("Y-m-d");
                                                $sqlFechaHoy = $db->conn->DBDate($fecha_hoy);
                                                $check = 1;
                                                $fechaf = date("dmy") . "_" . time("hms");
                                                $nomb_varc = "s.sgd_srd_codigo";
                                                $nomb_varde = "s.sgd_srd_descrip";
                                                include "$ruta_raiz/include/query/trd/queryCodiDetalle.php";
                                                $querySerie = "select distinct  sgd_srd_descrip  as detalle, s.sgd_srd_codigo from sgd_mrd_matrird m,
 	sgd_srd_seriesrd s where s.sgd_srd_codigo = m.sgd_srd_codigo and " . $sqlFechaHoy . " between s.sgd_srd_fechini
 	and s.sgd_srd_fechfin order by detalle ";
                                                $rsD = $db->conn->query($querySerie);
                                                $comentarioDev = "Muestra las Series Docuementales";
                                                include "$ruta_raiz/include/tx/ComentarioTx.php";

                                                print $rsD->GetMenu2("codserie", $serieSel, "0:-- Seleccione --", false, "", "onChange='submit()' class='select' id='codserie' title='Listado de todas las series documentales existentes'");
                                                ?>
                                            </td></tr>
                                        <tr><td class='titulos2' align="left" ><label for="tsub"> SubSerie</label> </td>
                                            <td class='listado2'>
                                                
                                                <style>
                                                    .selectorOverflow{
                                                       overflow-x:auto;
                                                       overflow-y:auto;
                                                    }
                                                 </style>   
                                                <?
                                                $nomb_varc = "su.sgd_sbrd_codigo";
                                                $nomb_varde = "su.sgd_sbrd_descrip";
                                                include "$ruta_raiz/include/query/trd/queryCodiDetalle.php";
                                                //Modificado skina 080909
                                                if ($serieSel)
                                                    $where = " and m.sgd_srd_codigo = '" . $serieSel . "' 
                                and su.sgd_srd_codigo = '" . $serieSel . "'";

                                                $querySub = "select distinct sgd_sbrd_descrip as detalle, su.sgd_sbrd_codigo 
		     from sgd_mrd_matrird m, sgd_sbrd_subserierd su 
		     where su.sgd_sbrd_codigo = m.sgd_sbrd_codigo 
				and " . $sqlFechaHoy . " between su.sgd_sbrd_fechini
				and su.sgd_sbrd_fechfin " . $where . "
				order by detalle ";
                                                $rsSub = $db->conn->query($querySub);
                                                include "$ruta_raiz/include/tx/ComentarioTx.php";
                                               // echo "<div class='selectorOverflow' style='width:500px;'>";
                                                print $rsSub->GetMenu2("tsub", $subserieSel, "0:-- Seleccione --", false, "", "onChange='submit()' class='select' id='tsub' title='Listado con todas las subseries documentales existentes'");
                                               // echo "</div>";
                                                if (!$codiSRD) {
                                                    $codiSRD = $codserie;
                                                    $codiSBRD = $tsub;
                                                }
                                                if ($codiSRD != '0') {
                                                    $srds = "m.SGD_SRD_CODIGO LIKE '$codiSRD'";
                                                    $c = "and";
                                                } else {
                                                    $srds = "";
                                                    $c = "";
                                                }
                                                if ($codiSBRD != '0') {
                                                    $sbrds = "m.SGD_SBRD_CODIGO LIKE '$codiSBRD'";
                                                    $d = "and";
                                                } else {
                                                    $sbrds = "";
                                                    $d = "";
                                                }
                                                ?>
                                            </td>


                                        <tr> 
                                            <td colspan="3" class='listado1' style="text-align: right;">
                                                <input class="botones" value="Limpiar" onclick="limpiar();" type="button">
                                                <input class="botones" value="B&uacute;squeda" type="submit">
                                            </td>
                                        </tr>
                                    </tbody> 
                                </table>
                                <!--</td>-->
                                <!--<td valign="top">-->
                                <!--<a class="vinculos" href="../busqueda/busquedaPiloto.php?<?= $phpsession ?>&krd=<?= $krd ?>&<? ECHO "&fechah=$fechah&primera=1&ent=2&s_Listado=VerListado"; ?>">B&uacute;squeda Cl&aacute;sica</a><br>-->
                                <!--<a class="vinculos" href="../busqueda/busquedaHist.php?<?= $phpsession ?>&krd=<?= $krd ?>&<? ECHO "&fechah=$fechah&primera=1&ent=2"; ?>">B&uacute;squeda por Hist&oacute;rico</a><br>	-->
                                <!--Modificado skina 070909 para Emdupar
                                <a class="vinculos" href="busquedaUsuActu.php?<?= session_name() . "=" . session_id() . "&fechah=$fechah&krd=$krd" ?>">B&uacute;squeda por Usuarios</a><br> -->
                                <!--</td>-->
                        </tr>
                    </tbody>
                </table>
            </center>
            <?php
            if ($nume_expe or $adodb_next_page or $orderNo or $orderTipo or $orden_cambio or $dependenciaSel) {
                ?>
                <table>
                    <tbody>
                        <tr>
                            <td valign="top">
                                <table width="100%" border="0" class="borde_tabReducido">
                                    <tbody>
                                        <tr>
                                            <td colspan="5" class="info"><label>Total Registros Encontrados: <?= $fldTotal ?></label></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <?php
                                $pager->Render($rows_per_page = 15, $linkPagina, $checkbox = chkAnulados);
                                ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <?php
            }
            ?>
        </form>
    </body>
</html>
