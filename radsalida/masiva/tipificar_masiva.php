<?
$paramsTRD = $phpsession . "&krd=$krd&codiTRD=$codiTRD&tsub=$tsub&codserie=$codserie&tipo=$tipo&dependencia=$dependencia&depe_codi_territorial=$depe_codi_territorial&usua_nomb=$usua_nomb&"
        . "depe_nomb=$depe_nomb&usua_doc=$usua_doc&codusuario=$codusuario";
?>
<br>
<form name = formaTRD action="upload2.php?<?= $paramsTRD ?>" method="post">
    <center>
        <div id="titulo" style="width:45%;" align="center">Aplicaci&oacute;n de la trd</div>
        <table width="45%" align="center" border="1" cellpadding="0" cellspacing="5" class="borde_tab">
            <tr align="center">
                <td width="36%" class="titulos2"><label for="codserie">Serie</label></td>
                <td width="64%" height="35" class="listado2">
                    <?
//echo "<hr>$tipoRad";
                    $coddepe = $_SESSION['dependencia'];
                    if ($codserie != 0 and $tipo != 0 and $tsub != 0) {
                        $queryTRD = "select SGD_MRD_CODIGO AS CLASETRD from sgd_mrd_matrird m
				where m.depe_codi = '$coddepe'
					and m.sgd_srd_codigo = '$codserie' and m.sgd_sbrd_codigo = '$tsub' and m.sgd_tpr_codigo = '$tipo'";
                        $rsTRD = $db->conn->query($queryTRD);
                        if ($rsTRD) {
                            $codiTRD = $rsTRD->fields['CLASETRD'];
                        }
                    }

//$coddepe=$dependencia;
                    if ($coddepe != 0 && $tipo != 0 && $tsub != 0)
                        if (!$tipo)
                            $tipo = 0;
                    if (!$codserie)
                        $codserie = 0;
                    if (!$tsub)
                        $tsub = 0;
                    $fechah = date("dmy") . " " . time("h_m_s");
                    $fecha_hoy = Date("Y-m-d");
                    $sqlFechaHoy = $db->conn->DBDate($fecha_hoy);
                    $num_car = 4;
                    $nomb_varc = "s.sgd_srd_codigo";
                    $nomb_varde = "s.sgd_srd_descrip";
                    include "$ruta_raiz/include/query/trd/queryCodiDetalle.php";
                    $querySerie = "select distinct ($sqlConcat) as detalle, s.sgd_srd_codigo
	         from sgd_mrd_matrird m, sgd_srd_seriesrd s
			 where m.depe_codi = '$coddepe'
			       and s.sgd_srd_codigo = m.sgd_srd_codigo
			       and " . $sqlFechaHoy . " between s.sgd_srd_fechini and s.sgd_srd_fechfin
			 order by detalle";
                    $rsD = $db->conn->query($querySerie);
                    $comentarioDev = "Muestra las Series Docuementales";
                    include "$ruta_raiz/include/tx/ComentarioTx.php";
                    print $rsD->GetMenu2("codserie", $codserie, "0:-- Seleccione --", false, "", "onChange='submit()' class='select' id='codserie' title='Listado de series'");
                    ?>
                </td>
            <tr align="center">
                <td width="36%" class="titulos2"><label for="tsub">Subserie</label></td>
                <td width="64%" height="35" class="listado2">
                    <?
                    $nomb_varc = "su.sgd_sbrd_codigo";
                    $nomb_varde = "su.sgd_sbrd_descrip";
                    include("$ruta_raiz/include/query/trd/queryCodiDetalle.php");
                    $querySub = "select distinct ($sqlConcat) as detalle, su.sgd_sbrd_codigo
			from sgd_mrd_matrird m, sgd_sbrd_subserierd su
			where m.depe_codi = '$coddepe'
			       and m.sgd_srd_codigo = '$codserie'
				   and su.sgd_srd_codigo = '$codserie'
			       and su.sgd_sbrd_codigo = m.sgd_sbrd_codigo
 			       and " . $sqlFechaHoy . " between su.sgd_sbrd_fechini and su.sgd_sbrd_fechfin
			 order by detalle";
                    $rsSub = $db->conn->query($querySub);
                    include "$ruta_raiz/include/tx/ComentarioTx.php";
                    print $rsSub->GetMenu2("tsub", $tsub, "0:-- Seleccione --", false, "", "onChange='submit()' class='select' id='tsub' title='listado de subseries'");
                    ?>
                </td>
            </tr>
            <tr align="center">
                <td width="36%" class="titulos2"><label for="tipo">Tipo de documento</label></td>
                <td width="64%" height="35" class="listado2">
                    <?
                    $ent = 1;
                    $nomb_varc = "t.sgd_tpr_codigo";
                    $nomb_varde = "t.sgd_tpr_descrip";
                    include "$ruta_raiz/include/query/trd/queryCodiDetalle.php";
                    $queryTip = "select distinct ($sqlConcat) as detalle, t.sgd_tpr_codigo
	         from sgd_mrd_matrird m, sgd_tpr_tpdcumento t
			 where m.depe_codi = '$coddepe'
 			       and m.sgd_srd_codigo = '$codserie'
			       and m.sgd_sbrd_codigo = '$tsub'
 			       and t.sgd_tpr_codigo = m.sgd_tpr_codigo
				   and t.sgd_tpr_tp$ent='1'
			 order by detalle";
                    $rsTip = $db->conn->query($queryTip);
                    include "$ruta_raiz/include/tx/ComentarioTx.php";
                    print $rsTip->GetMenu2("tipo", $tipo, "0:-- Seleccione --", false, "", "onChange='submit()' class='select' id='tipo' title='listado de tipos de documento'");
                    ?>
            </tr>
        </table>
        <br>
        <center>
            <div id="titulo" style="width:45%;" align="center">Tipo de radicaci&oacute;n</div>
            <table width="45%" align="center" border="1" cellpadding="0" cellspacing="5" class="borde_tab">
                <tr align="center">
                    <td width="16%" class="titulos2"><label for="Slc_Trd">Seleccione:</label> </td>
                    <td width="84%" height="30" class="listado2">
                        <?php
                        $cad = "USUA_PRAD_TP";
                        // Creacion del combo de Tipos de radicado habilitados seg�n permisos
                        //$sql = "SELECT SGD_TRAD_CODIGO,SGD_TRAD_DESCR FROM SGD_TRAD_TIPORAD WHERE SGD_TRAD_GENRADSAL > 0";	//Buscamos los TRAD En la entidad carlinho para adicionar masiva pagos
                        $sql = "SELECT SGD_TRAD_CODIGO,SGD_TRAD_DESCR FROM SGD_TRAD_TIPORAD WHERE SGD_TRAD_CODIGO <> 2";
                        $Vec_Trad = $db->conn->GetAssoc($sql);
                        $Vec_Perm = array();
                        while (list($id, $val) = each($Vec_Trad)) {
                            $sql = "SELECT " . $cad . $id . " FROM USUARIO WHERE USUA_LOGIN='" . $krd . "'";
                            $rs2 = $db->conn->Execute($sql);
                            if ($rs2->fields[$cad . $id] > 0) {
                                $Vec_Perm[$id] = $val;
                            }
                        }
                        //print_r($Vec_Perm);
                        reset($Vec_Perm);
                        ?>
                        <select name="tipoRad" id="Slc_Trd" class="select" onchange="submit();" title="Listado de tipos de radicacion">
                            <?
                            while (list($id, $val) = each($Vec_Perm)) {
                                if ($tipoRad == $id)
                                    $datoss = " selected ";
                                else
                                    $datoss = "";
                                echo "<option value=" . $id . " $datoss>$val</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
            </table><br/>
            <?
            $queryProc = "select SGD_PEXP_DESCRIP,SGD_PEXP_CODIGO
         from SGD_PEXP_PROCEXPEDIENTES
         WHERE SGD_SRD_CODIGO=$codserie
         AND SGD_SBRD_CODIGO=$tsub";
            $rs = $db->conn->query($queryProc);
            $codTmpProc = $rs->fields["SGD_PEXP_CODIGO"];
            if ($codTmpProc) {
                ?>

                <table width="45%" align="center" border="1" cellpadding="0" cellspacing="5" class="borde_tab">
                    <tr>
                        <td class="titulos2">Vincular a proceso</td>
                        <td class="listado2">
                            <?php
                            print $rs->GetMenu2("codProceso", $codProceso, "0:-- Ningun Proceso --", false, "", " class='select'  onchange='submit();' title='Listado de procesos'");
                            include ("$ruta_raiz/include/tx/Flujo.php");
                            $objFlujo = new Flujo($db, $codProceso, $usua_doc);
                            echo $objFlujo->getMenuProximaArista($tipo, $codProceso, $codserie, $tsub, $tipoRad, 'pNodo', $pNodo, " class='select' onChange='submit();'");
                            ?>
                        </td>
                    </tr>
                </table>
                <br>
                <?
            }
            ?>
            </form>
