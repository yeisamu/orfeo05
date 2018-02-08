<?
	/**
	  * CONSULTA VERIFICACION PREVIA A LA RADICACION
	  */
	//Modificacion skina 23-10-08 para generar listado de entrega en correspondencia
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
	default:
		
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
		        	
			order by '.$order.'			
			';
	}
?>
