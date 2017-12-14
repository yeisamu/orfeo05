<?
if(!isset($whereUsua)) $whereUsua="";
if(!isset($whereUsSelect)) $whereUsSelect="";
if(!isset($whereDependencia)) $whereDependencia="";
	switch($db->driver)
	{
	case 'mssql':
	case 'oracle':
	case 'oci8':
	case 'postgres':
			$isqlus = "SELECT u.USUA_NOMB,u.USUA_CODI,u.USUA_ESTA FROM USUARIO u
					   WHERE $whereUsua $whereUsSelect $whereDependencia
					   ORDER BY u.USUA_NOMB";

	break;
	}
?>
