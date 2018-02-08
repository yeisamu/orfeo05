<?
    switch($db->driver)
    {
    case 'mssql':
    case 'oracle':
    case 'oci8':
    case 'postgres':
    $query_dep="select depe_nomb,depe_codi from DEPENDENCIA where depe_estado=1 ORDER BY DEPE_NOMB";
    $fecha_hoy = Date("Y-m-d");
    $sqlFechaHoy=$db->conn->DBDate($fecha_hoy);
    $sqlConcat = $db->conn->Concat("s.sgd_srd_codigo","'-'","s.sgd_srd_descrip");
    $sqlConcat2 = $db->conn->Concat("su.sgd_sbrd_codigo","'-'","su.sgd_sbrd_descrip");
    $querySub="select distinct ($sqlConcat2) as detalle, su.sgd_sbrd_codigo 
		from sgd_mrd_matrird m,	sgd_sbrd_subserierd su 
		where su.sgd_sbrd_codigo = m.sgd_sbrd_codigo and ".$sqlFechaHoy." between su.sgd_sbrd_fechini
			and su.sgd_sbrd_fechfin ";
    $querySerie="select distinct ($sqlConcat) as detalle, s.sgd_srd_codigo 
		from sgd_mrd_matrird m,	sgd_srd_seriesrd s 
		where s.sgd_srd_codigo = m.sgd_srd_codigo and ".$sqlFechaHoy." between s.sgd_srd_fechini
	 	and s.sgd_srd_fechfin order by detalle ";
    $redondeo_ag="date_part('days', sexp.sgd_sexp_fech - ".$db->conn->sysTimeStamp.") + (sb.sgd_sbrd_tiemag*365)";
    $redondeo_ac="date_part('days', sexp.sgd_sexp_fech - ".$db->conn->sysTimeStamp.") + (sb.sgd_sbrd_tiemac*365)";
    $queryAlerta='select distinct sexp.sgd_exp_numero as "NUMERO_EXP",
			sexp.sgd_srd_codigo as "SERIE",
			sexp.sgd_sbrd_codigo as "SUBSERIE",
			sexp.sgd_sexp_fech as "FECHA_EXP", 
			sexp.sgd_sexp_parexp1 as "NOMBRE_EXP",
			sexp.depe_codi as "DEPENDENCIA", 
			sb.sgd_sbrd_tiemag as "RETENCION_AG",
			sb.sgd_sbrd_tiemac as "RETENCION_AC",
			sb.sgd_sbrd_dispfin as "HID_disp_fin", 
			sexp.sgd_sexp_estado as "ESTADO",
			'.$redondeo_ag.' as "DIAS_RESTANTES_AG", 
			'.$redondeo_ac.' as "DIAS_RESTANTES_AC", 
			sexp.sgd_exp_numero as "CHK_CHKANULAR"
			from sgd_sexp_secexpedientes sexp 
			left join sgd_sbrd_subserierd sb 
			ON sexp.sgd_srd_codigo=sb.sgd_srd_codigo and sexp.sgd_sbrd_codigo=sb.sgd_sbrd_codigo
			left join sgd_exp_expediente exp ON sexp.sgd_exp_numero=exp.sgd_exp_numero
			';
			//order by sexp.sgd_sexp_fech";
    $query_ag =  "select * from (".$queryAlerta." where sexp.sgd_sexp_estado = 0 and sb.sgd_sbrd_dispfin='1' ) AS A where dias_restantes_ag<0";
    $query_ac =  "select * from (".$queryAlerta." where sexp.sgd_sexp_estado = 1 and sb.sgd_sbrd_dispfin='1' ) AS A where dias_restantes_ac<0";
    $query_el =  "select * from (".$queryAlerta." where sexp.sgd_sexp_estado =0 and sb.sgd_sbrd_dispfin='2' ) AS A where dias_restantes_ag<0";
    $query_sel =  "select * from (".$queryAlerta." where sexp.sgd_sexp_estado =0 and sb.sgd_sbrd_dispfin='4' ) AS A where dias_restantes_ag<0";
    $query_up="update sgd_sexp_expediente set sgd_exp_estado=$status ".$whereFiltro;
    break;
    }
?>
