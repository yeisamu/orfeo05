<?
$sqlFecha = $db->conn->SQLDate("Y-m-d h:i:s a","r.radi_fech_radi");
	switch($db->driver)
	{
	case 'mssql':
	case 'oracle':
	case 'oci8':
	case 'postgres':
		/*$sql="select distinct(e.RADI_NUME_RADI),s.SGD_SRD_CODIGO,s.SGD_EXP_NUMERO,s.SGD_SBRD_CODIGO,s.SGD_PEXP_CODIGO,e.SGD_EXP_NUMERO,s.SGD_SEXP_PAREXP1,s.SGD_SEXP_PAREXP2,s.SGD_SEXP_PAREXP3,s.SGD_SEXP_PAREXP5,e.SGD_EXP_FECH_ARCH,e.SGD_EXP_FECHFIN,r.RADI_NUME_HOJA,e.SGD_EXP_CAJA,e.SGD_EXP_UFISICA,e.SGD_EXP_ISLA,c.SGD_DIR_DOC
	,e.SGD_EXP_ESTANTE,e.SGD_EXP_CARPETA, e.SGD_EXP_RETE,$sqlFecha as FECH,e.sgd_exp_carro,e.sgd_exp_entrepa, r.radi_path,r.RADI_CUENTAI,r.EESP_CODI
	 from SGD_SEXP_SECEXPEDIENTES s, SGD_EXP_EXPEDIENTE e, radicado r, SGD_DIR_DRECCIONES c where ";
	$sql.=" e.SGD_EXP_NUMERO=s.SGD_EXP_NUMERO and r.radi_nume_radi=e.radi_nume_radi and e.SGD_EXP_ESTADO='1' and c.RADI_NUME_RADI=e.RADI_NUME_RADI";
	if($docu1==3 and $buscar_docu!="")$sql.=" and r.RADI_CUENTAI like '%$buscar_docu%' ";
	if($docu1==2 and $buscar_docu!="")$sql.=" and c.SGD_DIR_DOC like '%$buscar_docu%' ";
	$sql.="$c $srds $d $sbrds $ef $pross $b $r $a $x $f $pis $g $caj $h $estan $v $entre $t $caja $u $caja2 $k $foli $i $fecha $j $fechafin $l $param $n $conse $o $archi $p $depa $q $muni $orde";*/
	//Modificado skina 080909
	$sql="select distinct(e.RADI_NUME_RADI),s.SGD_SRD_CODIGO,s.SGD_EXP_NUMERO,s.SGD_SBRD_CODIGO,s.SGD_PEXP_CODIGO,
			e.SGD_EXP_NUMERO,s.SGD_SEXP_PAREXP1,s.SGD_SEXP_PAREXP2,s.SGD_SEXP_PAREXP3,s.SGD_SEXP_PAREXP5,
			e.SGD_EXP_FECH_ARCH,e.SGD_EXP_FECHFIN,r.MEDIO_M,r.RADI_NUME_HOJA,e.SGD_EXP_CAJA,c.SGD_DIR_DOC, 
			e.SGD_EXP_UNICON, e.SGD_EXP_CARPETA, e.SGD_EXP_RETE,$sqlFecha as FECH,
			e.sgd_exp_entrepa,e.sgd_exp_edificio, r.radi_path,r.RADI_CUENTAI,r.EESP_CODI
		from SGD_SEXP_SECEXPEDIENTES s, SGD_EXP_EXPEDIENTE e, radicado r, SGD_DIR_DRECCIONES c where ";

	$sql.=" e.SGD_EXP_NUMERO=s.SGD_EXP_NUMERO and r.radi_nume_radi=e.radi_nume_radi and e.SGD_EXP_ESTADO='1' 
		and c.RADI_NUME_RADI=e.RADI_NUME_RADI";

	
	if($docu1==3 and $buscar_docu!="")$sql.=" and r.RADI_CUENTAI like '%$buscar_docu%' ";
	if($docu1==2 and $buscar_docu!="")$sql.=" and c.SGD_DIR_DOC like '%$buscar_docu%' ";

//	$sql.=" $c $srds $d $sbrds $ef $pross $b $r $a $x $v $edi $edifi $edi $entre $t $caja $u1 $caja2 $t1 $entre $t2 $estan $t3 $ufisica $t4 $piso $k $foli $i $fecha $j $fechafin $l $param $n $conse $p $depa $q $muni $orde";
	if(!isset($piso)) $piso=""; if(!isset($k)) $k=""; if(!isset($foli)) $foli=""; if(!isset($i)) $i=""; if(!isset($fecha)) $fecha=""; if(!isset($j))$j=""; if(!isset($fechafin)) $fechafin=""; if(!isset($l))$l =""; if(!isset($param)) $param=""; if(!isset($n)) $n=""; if(!isset($conse)) $conse=""; if(!isset($p)) $p=""; if(!isset($depa)) $depa=""; if(!isset($q) ) $q=""; if(!isset($muni)) $muni=""; if(!isset($orde)) $orde="";
 if(!isset($t)) $t=""; if(!isset($t1)) $t1=""; if(!isset($u1)) $u1=""; if(!isset($caja2)) $caja2=""; if(!isset($t2)) $t2=""; if (!isset($t3)) $t3=""; if(!isset($ufisica)) $ufisica=""; if(!isset($t4)) $t4=""; if(!isset($srds)) $srds=""; if(!isset($sbrds)) $sbrds=""; if(!isset($c)) $c=""; if(!isset($d)) $d=""; if(!isset($pross)) $pross=""; if(!isset($ef)) $ef=""; if(!isset($r)) $r=""; if(!isset($b)) $b=""; if(!isset($pis)) $pis=""; if(!isset($entre)) $entre="";
if(!isset($a)) $a=""; if(!isset($x)) $x=""; if(!isset($v)) $v=""; if(!isset($edi)) $edi=""; if(!isset($edifi)) $edifi=""; if(!isset($caja)) $caja=""; if(!isset($estan))$estan="";
	$sql.=" $c $srds $d $sbrds $ef $pross $b $r $a $x $v $edi $edifi $t1 $entre $t $caja $u1 $caja2 $t2 $estan $t3 $ufisica $t4 $piso $k $foli $i $fecha $j $fechafin $l $param $n $conse $p $depa $q $muni $orde";

	if(!isset($docu1)) $docu1="";
	if($docu1==1 and $buscar_docu!="") $sqld="select NIT_DE_LA_EMPRESA from BODEGA_EMPRESAS where IDENTIFICADOR_EMPRESA like '$eesp'";

	$sqlca="select distinct(c.RADI_NUME_RADI) AS RAD,$sqlFecha as FECH,
			r.RADI_PATH,c.SGD_DIR_DOC,r.RADI_CUENTAI,r.RADI_NUME_HOJA";

	if($docu1==1 and $buscar_docu!="")$sqlca.=",m.NIT_DE_LA_EMPRESA";
	$sqlca.=" from RADICADO r,SGD_DIR_DRECCIONES c";
	if($docu1==1 and $buscar_docu!="")$sqlca.=",BODEGA_EMPRESAS m";
	$sqlca.=" where ";
	if($docu1==1 and $buscar_docu!="")$sqlca.="m.NIT_DE_LA_EMPRESA LIKE '%$buscar_docu%' and r.EESP_CODI=m.IDENTIFICADOR_EMPRESA and c.RADI_NUME_RADI=r.RADI_NUME_RADI";
	elseif($docu1==2 and $buscar_docu!="")$sqlca.="c.SGD_DIR_DOC LIKE '%$buscar_docu%' and r.RADI_NUME_RADI=c.RADI_NUME_RADI";
	elseif($docu1==3 and $buscar_docu!="")$sqlca.="r.RADI_CUENTAI like '%$buscar_docu%' and r.RADI_NUME_RADI=c.RADI_NUME_RADI";
	else $sqlca.="r.RADI_NUME_RADI=c.RADI_NUME_RADI";
	$sqlca.=" order by RAD";
	
 	//Modificado skina 080909
if(!isset($f))$f=""; if(!isset($estan)) $estan=""; if(!isset($h)) $h=""; if(!isset($entre))$entre=""; if(!isset($s))$s=""; if(!isset($caja)) $caja="";if(!isset($u)) $u=""; if(!isset($archi)) $archi=""; if(!isset($o)) $o=""; if(!isset($radi)) $radi="";
 	$sqlmi="select e.SGD_EXP_NUMERO,e.SGD_EXP_TITULO,e.SGD_EXP_ASUNTO,e.SGD_EXP_FECH_ARCH,e.SGD_EXP_FECHFIN,
			e.SGD_EXP_CAJA,e.SGD_EXP_UFISICA, e.SGD_EXP_ISLA, e.SGD_EXP_CARPETA,e.SGD_EXP_ESTANTE,
			e.SGD_EXP_EDIFICIO,e.SGD_EXP_RETE, e.SGD_EXP_CARRO, e.SGD_EXP_ENTREPA, e.SGD_EXP_UNICON
			s.SGD_SRD_CODIGO,s.SGD_SBRD_CODIGO,s.SGD_PEXP_CODIGO,
			s.SGD_SEXP_PAREXP1,s.SGD_SEXP_PAREXP2,s.SGD_SEXP_PAREXP3,s.SGD_SEXP_PAREXP5 
		from SGD_EXP_EXPEDIENTE e, SGD_SEXP_SECEXPEDIENTES s
		where $srds $c $sbrds $d $pross $ef $r $b $pis $f $estan $h $entre $s $caja $t $caja2 $u $foli $k 
			$fecha $i $fechafin $j $param $l $conse $n $archi $o $depa $p $muni $q $x $a 
			s.SGD_EXP_NUMERO=e.SGD_EXP_NUMERO and e.RADI_NUME_RADI LIKE '$radi' and e.SGD_EXP_ESTADO='1'";
	/*$sqlmin="select e.SGD_EXP_NUMERO,e.SGD_EXP_TITULO,e.SGD_EXP_FECH_ARCH,e.SGD_EXP_FECHFIN,
			e.SGD_EXP_CAJA,e.SGD_EXP_CARPETA,e.SGD_EXP_RETE,e.sgd_exp_entrepa,e.	
			e.sgd_exp_edificio,s.SGD_SRD_CODIGO,s.SGD_SBRD_CODIGO,s.SGD_PEXP_CODIGO,
			s.SGD_SEXP_PAREXP1,s.SGD_SEXP_PAREXP2,s.SGD_SEXP_PAREXP3,s.SGD_SEXP_PAREXP5 
		from SGD_EXP_EXPEDIENTE e, SGD_SEXP_SECEXPEDIENTES s
	where $srds $c $sbrds $d $pross $ef $r $edi $edifi $b $entre $s $caja $t $caja2 $t1 $entre $t2 $estan $t3 $ufisica $u $foli $k $fecha $i $fechafin $j $param $l $conse $n $depa $p $muni $q $x $a s.SGD_EXP_NUMERO=e.SGD_EXP_NUMERO and e.RADI_NUME_RADI LIKE '$radi' and e.SGD_EXP_ESTADO='1'";*/

if(!isset($exp_edificio)) $exp_edificio=""; if(!isset($buscar_ufisica)) $buscar_ufisica=""; if(!isset($buscar_estan)) $buscar_estan=""; if(!isset($buscar_entre)) $buscar_entre="";if(!isset($buscar_caja)) $buscar_caja=""; if(!isset($buscar_piso)) $buscar_piso="";

	$sql1="select SGD_EIT_NOMBRE from SGD_EIT_ITEMS where cast(SGD_EIT_COD_PADRE as varchar(5)) like '$exp_edificio' order by SGD_EIT_NOMBRE";
	$sql6="select SGD_EIT_NOMBRE from SGD_EIT_ITEMS where cast(SGD_EIT_COD_PADRE as varchar(5)) like '$buscar_ufisica' order by SGD_EIT_NOMBRE";
	$sql7="select SGD_EIT_NOMBRE from SGD_EIT_ITEMS where cast(SGD_EIT_COD_PADRE as varchar(5)) like '$buscar_estan' order by SGD_EIT_NOMBRE";
	$sql8="select SGD_EIT_NOMBRE from SGD_EIT_ITEMS where cast(SGD_EIT_COD_PADRE as varchar(5)) like '$buscar_entre' order by SGD_EIT_NOMBRE";
	$sql9="select SGD_EIT_NOMBRE from SGD_EIT_ITEMS where cast(SGD_EIT_COD_PADRE as varchar(5)) like '$buscar_caja' order by SGD_EIT_NOMBRE";
	$sql12="select SGD_EIT_NOMBRE from SGD_EIT_ITEMS where cast(SGD_EIT_COD_PADRE as varchar(5)) like '$buscar_piso' order by SGD_EIT_NOMBRE";
 
	//Modificado skina 080909
        if(!isset($edificio)) $edificio=""; 
	$sql13="select SGD_EIT_SIGLA from SGD_EIT_ITEMS where cast(sgd_eit_codigo as varchar(15)) like '$edificio'"; //-->nam0
	//$sql2="select SGD_EIT_SIGLA from SGD_EIT_ITEMS where SGD_EIT_CODIGO like '$ite1'";
        if(!isset($it1)) $it1=""; if(!isset($it2)) $it2=""; if(!isset($it3)) $it3=""; if(!isset($it4)) $it4=""; if(!isset($it5)) $it5=""; if(!isset($it6)) $it6="";if(!isset($bus)) $bus=""; 
	$sql2="select SGD_EIT_SIGLA from SGD_EIT_ITEMS where cast(sgd_eit_codigo as varchar(15)) like '$it1'";
 	$sql3="select SGD_EIT_SIGLA from SGD_EIT_ITEMS where cast(sgd_eit_codigo as varchar(15)) like '$it2'";
 	$sql4="select SGD_EIT_SIGLA from SGD_EIT_ITEMS where cast(sgd_eit_codigo as varchar(15)) like '$it3'";
 	$sql5="select SGD_EIT_SIGLA from SGD_EIT_ITEMS where cast(sgd_eit_codigo as varchar(15)) like '$it4'";
	$sql10="select SGD_EIT_SIGLA from SGD_EIT_ITEMS where cast(sgd_eit_codigo as varchar(15)) like '$it5'";
	$sql11="select SGD_EIT_SIGLA from SGD_EIT_ITEMS where cast(sgd_eit_codigo as varchar(15)) like '$it6'";
	$sql14="select SGD_EIT_SIGLA from SGD_EIT_ITEMS where cast(sgd_eit_codigo as varchar(15)) like '$bus'";

 	$queryDpto = "select DPTO_NOMB,DPTO_CODI FROM DEPARTAMENTO ORDER BY DPTO_NOMB";
 	$queryMuni = "select MUNI_NOMB,MUNI_CODI FROM MUNICIPIO WHERE DPTO_CODI= '$codDpto' ORDER BY MUNI_NOMB";
	break;
	}
?>
