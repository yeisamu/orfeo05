<?
    /**
    * Consultas para TVD Dependencias
    */
    switch($db->driver)
    {  
    case 'mssql':
    case 'oracle':
    case 'oci8':
    default:
    $query_dep="select sgd_depe_nombre,sgd_depe_codi from sgd_tvd_dependencia order by sgd_depe_nombre";
    $isql = 'select d.sgd_depe_codi as "CODIGO_DEPENDENCIA"
		,d.sgd_depe_nombre as "NOMBRE DEPENDENCIA" 
		,s.sgd_stvd_codi as "CODIGO_SERIE"
		,s.sgd_stvd_nombre as "NOMBRE"
		,s.sgd_stvd_ac as "TIEMPO ARCHIVO CENTRAL"
		,s.sgd_stvd_dispfin as "DISPOSICION FINAL"
		,s.sgd_stvd_proc as "PROCEDIMIENTO"
		 from sgd_tvd_series s LEFT JOIN sgd_tvd_dependencia d  ON s.sgd_depe_codi=d.sgd_depe_codi'; 
    $isqlIN="insert into sgd_tvd_series VALUES ($coddepe,$codserie,'$detaserie',$tiem_ac,$med,'$asu')";
    $isqlUp = "update sgd_tvd_series set sgd_stvd_nombre= '$detaserie',
                	sgd_stvd_ac=$tiem_ac,
			sgd_stvd_dispfin=$med,
			sgd_stvd_proc='$asu'
		where sgd_depe_codi = $coddepe and sgd_stvd_codi=$codserie";

	}
?>
