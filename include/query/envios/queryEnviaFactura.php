<?
/**
* CONSULTA VERIFICACION PREVIA A LA RADICACION
*/
switch($db->driver)
{
	case 'mssql':
		{	$sql = "select SGD_FENV_DESCRIP 
			               ,SGD_FENV_CODIGO 
				from SGD_FENV_FRMENVIO o
				order by SGD_FENV_CODIGO";
			$RADI_NUME_SALIDA = "convert(varchar(14), c.RADI_NUME_RADI)";
			$radi_nume_deri = "b.RADI_NUME_DERI";
			//$sql_sgd_renv_codigo = "select top 10 SGD_RENV_CODIGO FROM SGD_RENV_REGENVIO ORDER BY SGD_RENV_CODIGO DESC ";
		}break;
	case 'oracle':
	case 'oci8':
		{	$sql = "select concat(concat(SGD_FENV_CODIGO,' '), SGD_FENV_DESCRIP) 
			               ,SGD_FENV_CODIGO from SGD_FENV_FRMENVIO order by SGD_FENV_CODIGO";
			$RADI_NUME_SALIDA = "a.RADI_NUME_SALIDA";
			$radi_nume_deri = "b.RADI_NUME_DERI";
			//$sql_sgd_renv_codigo = "select SGD_RENV_CODIGO FROM SGD_RENV_REGENVIO WHERE ROWNUM <=10 ORDER BY SGD_RENV_CODIGO DESC";
		}break;
	//Modificacion skina
	default:
		{
		$sql = "select  SGD_FENV_DESCRIP 
			               ,SGD_FENV_CODIGO from SGD_FENV_FRMENVIO order by SGD_FENV_CODIGO";
			$RADI_NUME_SALIDA = "a.RADI_NUME_SALIDA";
			$radi_nume_deri = "b.RADI_NUME_DERI";
		}
}
?>
