<?
	//Modificacion skina 23-10-08 para generar planilla
	switch($db->driver)
	{
	case 'mssql':
		 $isql = 'select
                        c.radi_nume_radi        as "NUMERO_RADICADO"
                        ,c.radi_fech_radi       AS "FECHA_RADICADO"
                        ,c.radi_depe_actu       AS "RADI_DEPE_ACTU"
                        ,c.radi_depe_radi       AS "RADI_DEPE_RADI"
                        ,c.ra_asun              AS "ASUNTO"
                        ,tp.sgd_tpr_descrip     as "TIPO_DOCUMENTO"
                        ,d.sgd_dir_nomremdes    AS "REMITENTE"
                        ,c.radi_cuentai		as "NO_FACTURA"
			,d.sgd_dir_nombre	as "VALOR"
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
	default:
		 $isql = 'select
			c.radi_nume_radi as "NUMERO_RADICADO" 
			,c.radi_fech_radi AS "FECHA_RADICADO" 
			,d.sgd_dir_nomremdes AS "EMPRESA"
			,d.sgd_dir_nombre AS "NOMBRE"
			,c.ra_asun AS "ASUNTO"
			,c.radi_depe_actu AS "RADI_DEPE_ACTU" 
			,c.radi_depe_radi AS "RADI_DEPE_RADI"  
			,c.radi_cuentai as "REFERENCIA" 
			,c.radi_fech_ofic as "FECH_OFIC"
			,u.usua_nomb as "USUARIO"
			,d.sgd_dir_direccion as "DIRECCION"
			from radicado c
			left outer join  usuario u
                                on c.radi_usua_actu=u.usua_codi
                        left outer join  sgd_dir_drecciones d
                                on c.radi_nume_radi=d.radi_nume_radi
                        left outer join  sgd_tpr_tpdcumento tp
                                on c.tdoc_codi=tp.sgd_tpr_codigo
                        left outer join hist_eventos h
                                on c.radi_nume_radi=h.radi_nume_radi
                        left outer join municipio m
				on ( m.id_cont=d.id_cont
				and m.id_pais=d.id_pais
				and m.dpto_codi=d.dpto_codi
				and m.muni_codi=d.muni_codi)
                        where c.radi_nume_radi is not null 
				and c.radi_nume_radi in('.$setFiltroSelect.')
                                and d.sgd_dir_tipo != 7
                                and c.radi_depe_actu=u.depe_codi
                        ';
	}
?>
