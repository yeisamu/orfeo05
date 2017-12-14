<?php
/**

  */
switch($db->driver)
{  
	case 'mssql':
		$isql = 'SELECT b.radi_nume_radi AS "Img_Numero Radicado",
			b.radi_path AS "HID_RADI_PATH", b.radi_nume_deri AS "Radicado Padre", 
			to_char(b.radi_fech_radi, \'yyyy-mm-dd hh24:mi:ss\') AS "HOR_RAD_FECH_RADI", 
			to_char(b.radi_fech_radi, \'yyyy-mm-dd hh24:mi:ss\') AS "Fecha Radicado", 
			b.ra_ASun AS "Descripcion", 
			c.sgd_tpr_descrip AS "Tipo Documento", b.radi_nume_radi AS "CHK_CHKANULAR" 
			FROM radicado b
			LEFT JOIN sgd_tpr_tpdcumento c ON b.tdoc_codi=c.sgd_tpr_codigo
			LEFT JOIN hist_eventos AS historial ON (b.radi_nume_radi=historial.radi_nume_radi)
			WHERE b.radi_nume_radi is not null 
			AND historial.sgd_ttr_codigo NOT IN (25, 26)
			AND historial.sgd_ttr_codigo = 2
			AND b.radi_nume_radi NOT LIKE \'%2\'
			AND '.$db->conn->substr.'(b.radi_nume_radi, 5, '.$longitud_codigo_dependencia.')=\''.$dep_sel.'\'
			AND sgd_eanu_codigo is null 
			AND ( b.sgd_eanu_codigo = 9 or b.sgd_eanu_codigo is null ) '.
			$whereTpAnulacion.' '.$whereFiltro.'
			order by '.$order .' ' .$orderTipo;
		break;
	case 'oracle':
	case 'oci8':
	case 'oci805':	
		$isql = 'SELECT b.radi_nume_radi AS "Img_Numero Radicado",
			b.radi_path AS "HID_RADI_PATH", b.radi_nume_deri AS "Radicado Padre", 
			to_char(b.radi_fech_radi, \'yyyy-mm-dd hh24:mi:ss\') AS "HOR_RAD_FECH_RADI", 
			to_char(b.radi_fech_radi, \'yyyy-mm-dd hh24:mi:ss\') AS "Fecha Radicado", 
			b.ra_ASun AS "Descripcion", 
			c.sgd_tpr_descrip AS "Tipo Documento", b.radi_nume_radi AS "CHK_CHKANULAR" 
			FROM radicado b
			LEFT JOIN sgd_tpr_tpdcumento c ON b.tdoc_codi=c.sgd_tpr_codigo
			LEFT JOIN hist_eventos historial ON (b.radi_nume_radi=historial.radi_nume_radi)
			WHERE b.radi_nume_radi is not null 
			AND historial.sgd_ttr_codigo NOT IN (25, 26)
			AND historial.sgd_ttr_codigo = 2
			AND b.radi_nume_radi NOT LIKE \'%2\'
			AND '.$db->conn->substr.'(b.radi_nume_radi, 5, '.$longitud_codigo_dependencia.')=\''.$dep_sel.'\'
			AND sgd_eanu_codigo is null 
			AND ( b.sgd_eanu_codigo = 9 or b.sgd_eanu_codigo is null ) 
			and rownum < 200 '.
			$whereTpAnulacion.' '.$whereFiltro.'
			order by '.$order .' ' .$orderTipo;
		break;
	default:
		$isql = 'SELECT b.radi_nume_radi AS "Img_Numero Radicado",
			b.radi_path AS "HID_RADI_PATH", b.radi_nume_deri AS "Radicado Padre", 
			to_char(b.radi_fech_radi, \'yyyy-mm-dd hh24:mi:ss\') AS "HOR_RAD_FECH_RADI", 
			to_char(b.radi_fech_radi, \'yyyy-mm-dd hh24:mi:ss\') AS "Fecha Radicado", 
			b.ra_ASun AS "Descripcion", 
			c.sgd_tpr_descrip AS "Tipo Documento", b.radi_nume_radi AS "CHK_CHKANULAR" 
			FROM radicado b
			LEFT JOIN sgd_tpr_tpdcumento c ON b.tdoc_codi=c.sgd_tpr_codigo
			LEFT JOIN hist_eventos AS historial ON (b.radi_nume_radi=historial.radi_nume_radi)
			WHERE b.radi_nume_radi is not null 
			AND historial.sgd_ttr_codigo NOT IN (25, 26)
			AND historial.sgd_ttr_codigo = 2
			AND b.radi_nume_radi NOT LIKE \'%2\'
			AND '.$db->conn->substr.'(b.radi_nume_radi, 5, '.$longitud_codigo_dependencia.')=\''.$dep_sel.'\'
			AND sgd_eanu_codigo is null
			AND ( b.sgd_eanu_codigo = 9 or b.sgd_eanu_codigo is null )'.
			$whereTpAnulacion.' '.$whereFiltro.'
			order by '.$order .' ' .$orderTipo;
}
?>
