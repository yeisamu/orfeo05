<?	
	switch($db->driver)
	{
	case 'mssql':
/*Modificado skinatech 25-10-08
	  $qeryObtenerGrupo = "select  convert(char(14), RADI_NUME_SAL) as RADI_NUME_SAL ,SGD_RENV_CODIGO    from sgd_renv_regenvio 
			   WHERE sgd_renv_planilla = '00' and sgd_renv_tipo = 1
				 and radi_nume_grupo=$grupo
			   and sgd_depe_genera  = '$dependencia'
				 $qFiltro 
				 order by radi_nume_sal asc ";*/
	 $qeryObtenerGrupo = "select  RADI_NUME_SAL,SGD_RENV_CODIGO    from sgd_renv_regenvio
                                        WHERE radi_nume_grupo='$grupo'
                                        and sgd_depe_genera  = '$dependencia'
                                        $qFiltro
                                        order by radi_nume_sal asc ";
        break;

	break;
	case 'oracle':
	case 'oci8':
	case 'oci805':
	case 'ocipo':
	//Modificado IDRD 23-abr-2008 
	case 'postgres':
		/*Modificado idrd sept-16-2008 
		 $qeryObtenerGrupo = "select  RADI_NUME_SAL,SGD_RENV_CODIGO    from sgd_renv_regenvio 
			 	  	WHERE sgd_renv_planilla = '00' and sgd_renv_tipo = 1
				 	and radi_nume_grupo=$grupo
			   		and sgd_depe_genera  = '$dependencia'
				 	$qFiltro 
				 	order by radi_nume_sal asc "; */
		
		 $qeryObtenerGrupo = "select  RADI_NUME_SAL,SGD_RENV_CODIGO    from sgd_renv_regenvio 
			 	  	WHERE radi_nume_grupo='$grupo'
			   		and sgd_depe_genera  = '$dependencia'
				 	$qFiltro 
				 	order by radi_nume_sal asc "; 
	break;
	}
?>
