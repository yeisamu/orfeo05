<?
	/**
	  * CONSULTA VERIFICACION PREVIA A LA RADICACION
	  */
	switch($db->driver)
	{
	case 'mssql':
		 $isql = 'select
                        c.radi_nume_radi as "Numero Radicado"
                        ,c.radi_fech_radi AS "Fecha de Radicado"
                        ,c.ra_asun AS "Asunto"
                        ,tp.sgd_tpr_descrip as "Tipo Documento"
                        ,d.sgd_dir_nomremdes AS "Remitente"
                        ,c.radi_nume_radi as "CHK_RADI_NUME_RADI"
                        from radicado c
                        left outer join  sgd_dir_drecciones d
                                on c.radi_nume_radi=d.radi_nume_radi
                        left outer join  sgd_tpr_tpdcumento tp
                                on c.tdoc_codi=tp.sgd_tpr_codigo
                        left outer join hist_eventos h
                                on c.radi_nume_radi=h.radi_nume_radi
                        where c.radi_nume_radi is not null '.
                                $dependencia_busq2 .
                                $where_tipRadi .
                                $where_fecha . '
                                and c.radi_nume_radi=d.radi_nume_radi
                                and d.sgd_dir_tipo != 7
                                and h.sgd_ttr_codigo=2

                        ';
		break;
	case 'oracle':
	case 'oci8':
	case 'oci805':
		$isql = 'select 
			a.anex_estado CHU_ESTADO
		 	,a.sgd_deve_codigo HID_DEVE_CODIGO
			,a.sgd_deve_fech AS "HID_SGD_DEVE_FECH" 
	    ,a.radi_nume_salida AS "IMG_Radicado Salida"
			,c.RADI_PATH "HID_RADI_PATH"
            ,substr(trim(a.sgd_dir_tipo),2,3) AS "Copia"
			,a.anex_radi_nume AS "Radicado Padre"
			,c.radi_fech_radi AS "Fecha Radicado"
			,a.anex_desc AS "Descripcion"
			,a.sgd_fech_impres AS "Fecha Impresion"
			,a.anex_creador AS "Generado Por"
	        ,a.radi_nume_salida AS "CHK_RADI_NUME_SALIDA" 
			,a.sgd_deve_codigo HID_DEVE_CODIGO1
			,a.anex_estado HID_ANEX_ESTADO1
	    ,a.anex_nomb_archivo AS "HID_ANEX_NOMB_ARCHIVO" 
	    ,a.anex_tamano AS "HID_ANEX_TAMANO"
			,a.anex_radi_fech AS "HID_ANEX_RADI_FECH" 
			,' . "'WWW'" . ' AS "HID_WWW" 
			,' . "'9999'" . ' AS "HID_9999"     
			,a.anex_tipo AS "HID_ANEX_TIPO" 
			,a.anex_radi_nume AS "HID_ANEX_RADI_NUME" 
			,a.sgd_dir_tipo AS "HID_SGD_DIR_TIPO"
			,a.sgd_deve_codigo AS "HID_SGD_DEVE_CODIGO"
		from anexos a,usuario b, radicado c
	    where a.ANEX_ESTADO = ' . "'3'" .
				$dependencia_busq2 .
				$where_tipRadi . 
				$where_fecha . '
				and a.radi_nume_salida=c.radi_nume_radi
				and a.anex_creador=b.usua_login
				and a.anex_borrado= ' . "'N'" . '
				and a.sgd_dir_tipo != 7
				and (a.sgd_deve_codigo >= 90 or a.sgd_deve_codigo =0 or a.sgd_deve_codigo is null)
				AND
				((c.SGD_EANU_CODIGO != 2
				AND c.SGD_EANU_CODIGO != 1) 
				or c.SGD_EANU_CODIGO IS NULL)
		        ';
		break;
	//Modificacion skina 23-10-08
	//Generar listado de entrega en correspondencia
	//Modificacion skina 05-02-09
	//Generar planilla de reasignacion
	default:
		
		$isql = 'select 
				c.radi_nume_radi as "Numero Radicado"
				,'.$db->conn->SQLDate('Y-m-d h:i A','c.radi_fech_radi').'  AS "Fecha de Radicado" 
				,c.radi_cuentai AS "No Documento"
				,d.sgd_dir_nomremdes AS "Remitente"
				,c.ra_asun AS "Asunto"
				,de.depe_nomb as "Dependencia"
				,c.radi_nume_radi as "CHK_RADI_NUME_RADI"
			from dependencia de, radicado c 
			left outer join  sgd_dir_drecciones d 
				on c.radi_nume_radi=d.radi_nume_radi
			left outer join  sgd_tpr_tpdcumento tp 
				on c.tdoc_codi=tp.sgd_tpr_codigo
			left outer join hist_eventos h 
				on c.radi_nume_radi=h.radi_nume_radi
	    		where c.radi_nume_radi is not null 
				and de.depe_codi=h.depe_codi_dest '.
				$dependencia_busq1 .
				$dependencia_busq2 .
				$where_tipRadi . 
				$where_fecha . '
				and c.radi_nume_radi=d.radi_nume_radi
				and d.sgd_dir_tipo != 7
		        	and h.sgd_ttr_codigo=9
			order by c.radi_fech_radi		
			';
	}
?>
