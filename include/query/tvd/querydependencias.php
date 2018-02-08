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
    $sqlFechaD=$db->conn->DBDate($fecha_busq); 
    $sqlFechaH=$db->conn->DBDate($fecha_busq2);  
    $isql = 'select sgd_depe_codi as "CODIGO"
		,SGD_DEPE_NOMBRE AS "NOMBRE"
		, SGD_DEPE_FECHINI AS "FECHA_INICIO"
		, SGD_DEPE_FECHFIN AS "FECHA_FINAL"
		 from sgd_tvd_dependencia'; 
    $isqlIN="insert into sgd_tvd_dependencia (sgd_depe_codi, sgd_depe_nombre,sgd_depe_FECHINI,sgd_depe_FECHFIN )
                                        VALUES ($coddepeI,'$detadepe'    ,".$sqlFechaD.",".$sqlFechaH.")";

    $isqlUp = "update sgd_tvd_dependencia set sgd_depe_nombre= '$detadepe',
                   sgd_depe_fechini=$sqlFechaD,
                   sgd_depe_fechfin =$sqlFechaH
                where sgd_depe_codi = $coddepeI";

	}
?>
