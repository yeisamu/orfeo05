<?
//MODIFICADO POR SKINA PARA POSTGRES
switch($db->driver)
	{
	case 'mssql':
	default:
		$isql = 'select 
			distinct(cast(c.radi_nume_radi as varchar(15))) AS "IMG_Radicado Salida"
			,c.radi_path as "HID_RADI_PATH"
			,c.radi_fech_radi AS "Fecha Radicado"
			,h.hist_fech as "Fecha Reasignado"
			,c.ra_asun 	as "Asunto"
			,u.usua_nomb 	as "Usuario Destino"
			,u.usua_at 	as "Destino"
			,'.$tmp_cad.' AS "CHK_RADI_NUME_SALIDA" 
			FROM  hist_eventos h
			LEFT JOIN radicado c on h.radi_nume_radi=c.radi_nume_radi and h.sgd_ttr_codigo=9 
			LEFT JOIN usuario u on h.depe_codi_dest=u.depe_codi and h.usua_codi_dest=u.usua_codi 
			WHERE c.radi_nume_radi is not null '. $dependencia_busq2 .' '.$where_general.'order by '.$order .' ' .$orderTipo;
	break;
	}
?>
