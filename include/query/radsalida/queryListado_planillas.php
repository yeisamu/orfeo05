<?
/**
* CONSULTA VERIFICACION PREVIA A LA RADICACION
*/

// $where_isql2 = " WHERE DEPE_CODI = $dependencia AND $sqlChar = $fecha_mes AND SGD_FENV_CODIGO = 101
$where_isql2 = " WHERE $sqlChar = $fecha_mes AND SGD_FENV_CODIGO = 101
                AND ".$db->conn->substr."(SGD_RENV_PLANILLA,1,1) = '$no_planilla' AND sgd_renv_tipo < 2 ";

switch($db->driver)
{
    case 'mssql':
        {   $wrc=" WHERE SGD_RENV_CODIGO = $renv_codigo AND SGD_RENV_PLANILLA = '' ";
            $where_isql1 = " WHERE (DEPE_CODI = $dependencia AND sgd_renv_fech BETWEEN ".$db->conn->DBTimeStamp($fecha_ini)." 
            AND ".$db->conn->DBTimeStamp($fecha_fin)." AND $sqlChar = $fecha_mes AND SGD_FENV_CODIGO = 101
            AND SGD_RENV_PLANILLA = '' AND sgd_renv_tipo <2)
            OR ($sqlChar = $fecha_mes AND SGD_RENV_PLANILLA = '".$no_planilla."' AND SGD_FENV_CODIGO = 101 
            AND DEPE_CODI= $dependencia
            AND sgd_renv_tipo <2) ";
        /*
        $where_isql2 = '    WHERE DEPE_CODI= ' .$dependencia . 
        ' AND '. $sqlChar . ' = '  . $fecha_mes . '
        AND SGD_FENV_CODIGO = 101
        AND SGD_RENV_PLANILLA=' . $no_planilla . 
        ' AND sgd_renv_tipo < 2 ';
     // $query = "select top 32  SGD_RENV_CANTIDAD as CANTIDAD,
     */
    $query = "select SGD_RENV_CANTIDAD as CANTIDAD,
        'Certificado'                 as CERTIFICADO,
        ".$db->conn->substr."(convert(char(15),RADI_NUME_SAL),5,10)     as REGISTRO,
        SGD_RENV_NOMBRE as DESTINATARIO,
        SGD_RENV_DESTINO as DESTINO,
        SGD_RENV_PESO    as PESO,
        ''     as VALOR_PORTE,
        SGD_RENV_VALOR as CERTIFICADO,
        '' as VALOR_ASEGURADO,
        '' as TASA_DE_SEGURO,
        '' as VALOR_REEMBOLSABLE,
        '' as AVISO_DE_LLEGADA,
        '' as SERVICIOS_ESPECIALES,
        (CONVERT(numeric,SGD_RENV_VALOR) * SGD_RENV_CANTIDAD) as VALOR_TOTAL,
        ".$db->conn->substr."(convert(char(15),RADI_NUME_GRUPO),5,10) as RADI_NUME_GRUPO
        from SGD_RENV_REGENVIO ";
        }break;
    case 'oracle':
    case 'oci8':
    case 'oci805':
    // Modificado SGD 18-Septiembre-2007
    case 'postgres':
        $wrc=" WHERE  = $renv_codigo AND ( SGD_RENV_PLANILLA IS NULL OR SGD_RENV_PLANILLA = '' ) ";
        $query = "select SGD_RENV_CANTIDAD         as CANTIDAD,
            SGD_RENV_FECH               as FECHA,
            SGD_FENV_CODIGO             as TIPO,
            RADI_NUME_SAL               as RADICADO,
            RADI_NUME_DERI              as PADRE,
            RA_ASUN                     as ASUNTO,
            SGD_RENV_DEPTO              as DEPARTAMENTO,
            SGD_RENV_MPIO               as MUNICIPIO,
            substr(SGD_RENV_NOMBRE,1,36)         as DESTINATARIO,
            SGD_RENV_PESO               as PESO,
            SGD_RENV_DIR                as DIRECCION,
            SGD_RENV_TELEFONO           as TELEFONO,
            SGD_RENV_OBSERVA            as OBSERVA,
            SGD_RENV_GUIA               as GUIA,
            SGD_RENV_DIR                as DEPE_DIR,
            TP.SGD_TPR_DESCRIP          as TIPO_DOC,
            D.DEPE_NOMB                 as DEPE_ENVIO,
            R.radi_nume_hoja            as FOLIOS,
            DEP.DEPE_NOMB               as REMITENTE
            from DEPENDENCIA D, RADICADO R 
                LEFT OUTER JOIN SGD_RENV_REGENVIO E
                ON R.RADI_NUME_RADI=RADI_NUME_SAL
                LEFT OUTER JOIN SGD_TPR_TPDCUMENTO TP
                ON R.TDOC_CODI=TP.SGD_TPR_CODIGO
		LEFT OUTER JOIN DEPENDENCIA DEP
		ON R.RADI_DEPE_RADI=DEP.DEPE_CODI";
        
//        $where_isql1 = " WHERE (E.DEPE_CODI= " . $dependencia .
//            " and E.DEPE_CODI=D.DEPE_CODI 
        $where_isql1 = " WHERE ( E.DEPE_CODI=D.DEPE_CODI 
            AND sgd_renv_fech BETWEEN " .$db->conn->DBTimeStamp($fecha_ini).
            " AND " .$db->conn->DBTimeStamp($fecha_fin).
            " AND ". $sqlChar . " = " . $fecha_mes . 
            "AND SGD_FENV_CODIGO = $codigo_envio
             AND ( SGD_RENV_PLANILLA IS  NULL OR SGD_RENV_PLANILLA = '' )
            AND sgd_renv_tipo <2)
            OR ( E.DEPE_CODI=D.DEPE_CODI AND
            " . $sqlChar . " = " . $fecha_mes . 
            " AND SGD_RENV_PLANILLA = " . "'" . $no_planilla . "'" .
            " AND SGD_FENV_CODIGO = $codigo_envio 
            AND sgd_renv_tipo <2) ";
//        $where_isql2 = "    WHERE E.DEPE_CODI= " .$dependencia . 
//            " AND E.DEPE_CODI=D.DEPE_CODI 
        $where_isql2 = "    WHERE  E.DEPE_CODI=D.DEPE_CODI 
             AND " . $sqlChar . " = " . $fecha_mes . 
            "    AND SGD_FENV_CODIGO = $codigo_envio
             AND sgd_renv_tipo < 2 ";
        $whereTop = "";
        break;
    }
?>
