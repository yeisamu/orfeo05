<?
	switch($db->driver)
	{
	case 'mssql':
	 $isql = 'select
                        c.radi_nume_radi        as "NUMERO_RADICADO"
                        ,c.radi_fech_radi       AS "FECHA_RADICADO"
                        ,c.ra_asun              AS "ASUNTO"
                        ,tp.sgd_tpr_descrip     as "TIPO_DOCUMENTO"
                        ,d.sgd_dir_nomremdes    AS "REMITENTE"
                        ,c.radi_cuentai         as "NO_FACTURA"
                        ,c.radi_depe_actu       as "VALOR"
                        ,c.radi_nume_hoja       as "FOLIOS"
                        from radicado c
                        left outer join  sgd_dir_drecciones d
                                on c.radi_nume_radi=d.radi_nume_radi
                        left outer join  sgd_tpr_tpdcumento tp
                                on c.tdoc_codi=tp.sgd_tpr_codigo
                        left outer join hist_eventos h
                                on c.radi_nume_radi=h.radi_nume_radi
                        where c.radi_nume_radi is not null
                                and c.radi_nume_radi in('.$setFiltroSelect.')
                                and d.sgd_dir_tipo != 7
                                and h.sgd_ttr_codigo=2
                        ';

		break;
	case 'oracle':
	case 'oci8':
	case 'oci805':
	$isql = "SELECT 
	        b.RADI_NUME_RADI as RADI_NUME_RADI,a.ANEX_NOMB_ARCHIVO,a.ANEX_DESC,a.SGD_REM_DESTINO,a.SGD_DIR_TIPO
  		   ,a.ANEX_RADI_NUME as ANEX_RADI_NUME, a.RADI_NUME_SALIDA as RADI_NUME_SALIDA
		 FROM ANEXOS a,RADICADO b
		 WHERE a.radi_nume_salida=b.radi_nume_radi
			and a.RADI_NUME_SALIDA in(".$setFiltroSelect.")
			and a.sgd_dir_tipo <>7 and anex_estado=3";		
		break;
	//Modificacion skina 23-10-08 para generar planilla
	default:
		 $isql = 'select
                        c.radi_nume_radi        as "NUMERO_RADICADO"
                        ,'.$db->conn->SQLDate('Y-m-d h:i A','c.radi_fech_radi').' AS "FECHA_RADICADO"
                        ,c.ra_asun              AS "ASUNTO"
                        ,d.sgd_dir_nomremdes    AS "REMITENTE"
                        ,c.radi_cuentai         as "NO_DOCUMENTO"
                        ,de.depe_nomb           as "DEPENDENCIA"
                        ,c.sgd_tdec_codigo      as "FIRMA"
                        ,c.sgd_tdec_codigo      as "FECHA"
                        from dependencia de, radicado c
                        left outer join  sgd_dir_drecciones d
                                on c.radi_nume_radi=d.radi_nume_radi
                        left outer join  sgd_tpr_tpdcumento tp
                                on c.tdoc_codi=tp.sgd_tpr_codigo
                        left outer join hist_eventos h
                                on c.radi_nume_radi=h.radi_nume_radi
                        where c.radi_nume_radi is not null
                                and c.radi_nume_radi in('.$setFiltroSelect.')
				'. $dependencia_busq1 .
                                $dependencia_busq2 .
                                $where_tipRadi .
                                $where_fecha . '
				and d.sgd_dir_tipo != 7
                                and h.sgd_ttr_codigo=9
                                and de.depe_codi=h.depe_codi_dest
                        order by c.radi_fech_radi
			';


	}
?>
