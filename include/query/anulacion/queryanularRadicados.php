<?
	/**
	  * CONSULTA TIPO RADICACION
	  */
	switch($db->driver)
	{  
	 case 'mssql':
		//$whereTipoRadi = ' and '.$db->conn->substr.'(convert(char(15),b.radi_nume_radi), -1) = \'' .$tipoRadicado."'";
		$whereTipoRadi = " and b.radi_nume_radi like '%" .$tipoRadicado."'";
	break;		
	case 'oracle':
	case 'oci8':
	case 'oci805':	
		//$whereTipoRadi = ' and '.$db->conn->substr.'(b.radi_nume_radi, -1) = \'' .$tipoRadicado."'";
		$whereTipoRadi = " and b.radi_nume_radi like '%" .$tipoRadicado."'";
	break;		
	//Modificacion skina
	default:
		//$whereTipoRadi = " and ".$db->conn->substr."(cast(b.radi_nume_radi as varchar(15)), -1) = '" .$tipoRadicado."'";
		$whereTipoRadi = " and b.radi_nume_radi like '%" .$tipoRadicado."'";
	}
?>
