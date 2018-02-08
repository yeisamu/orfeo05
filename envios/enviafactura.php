<?php
/**
 * En este frame se van cargado cada una de las funcionalidades del sistema
 *
 * Descripcion Larga
 *
 * @category
 * @package      SGD Orfeo
 * @subpackage   Main
 * @author       Community
 * @author       Skina Technologies SAS (http://www.skinatech.com)
 * @license      GNU/GPL <http://www.gnu.org/licenses/gpl-2.0.html>
 * @link         http://www.orfeolibre.org
 * @version      SVN: $Id$
 * @since
 */

        /*---------------------------------------------------------+
        |                     INCLUDES                             |
        +---------------------------------------------------------*/


        /*---------------------------------------------------------+
        |                    DEFINICIONES                          |
        +---------------------------------------------------------*/


        /*---------------------------------------------------------+
        |                       MAIN                               |
        +---------------------------------------------------------*/


session_start();
 /**
     * Modificacion para aceptar Variables GLobales
     * @autor Jairo Losada
     * @fecha 2009/05
     */
   $krd = $_SESSION["krd"];
   $dependencia = $_SESSION["dependencia"];
  $usua_doc = $_SESSION["usua_doc"];
  $codusuario = $_SESSION["codusuario"];
  $tip3Nombre=$_SESSION["tip3Nombre"];
  $tip3desc = $_SESSION["tip3desc"];
  $tip3img =$_SESSION["tip3img"];
 
  /*
   * Envios intersedes
   * @autor Isabel rodriguez - Skinatech
   * @fecha 2008 
	* Hecho inicialmente para Indupalma
	* Modificacion Variables Globales. Arreglo cambio de los req    uest Gracias a recomendacion de Hollman Ladino
   */
  foreach ($_GET as $key => $valor)   ${$key} = $valor;
  foreach ($_POST as $key => $valor)   ${$key} = $valor;

$ruta_raiz = "..";

include_once "$ruta_raiz/include/db/ConnectionHandler.php";
if (!$db)	$db = new ConnectionHandler($ruta_raiz);
$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
//$db->conn->debug = true;
if (!$_SESSION['dependencia'])	include_once "../rec_session.php";
?>
<html>
<head>
<title>Envio de documentos Intersedes</title>
<link href="../estilos/orfeo.css" rel="stylesheet" type="text/css">
<?
if (!$radicados)
{
 	$radicados = implode('*,*',array_keys($checkValue));
	$tmp = explode('-',$radicados);
/* $whereFiltro .= ' (c.radi_nume_radi = '.$tmp[1].' and h.depe_codi_dest='.$tmp[0].') ';  }*/

	$num = count($_POST['checkValue']);
        reset($_POST['checkValue']);        $i = 0;
	while (list($recordid,$tmp) = each($_POST['checkValue']))
        {       $record_id = $recordid;
                if (strpos($record_id,'-'))
                                        {
                                                $tmp = explode('-',$record_id);
                                                if ($tmp[0])
                                                {       $whereFiltro .= ' (c.radi_nume_radi = '.$tmp[1].' and h.depe_codi_dest='.$tmp[0].') or';
                                                $depe_codi_dest=$tmp[0];
						}
                                                else
                                                {       $whereFiltro .= ' c.radi_nume_radi = '.$tmp[1].' or';
                                                }

                                        }
                                        else
                                        {       $whereFiltro .= ' c.radi_nume_radi = '.$record_id.' or';
                                        }
                                        $record_id = $tmp[1];
}

}

$procradi = $radicados;
//$procradi = $record_id;
$long=strlen($whereFiltro);
$short=$long-2;
$whereFiltro =substr($whereFiltro,0,$short);
if(trim($whereFiltro))
        {       $whereFiltro = "($whereFiltro)";
        }


?>
<script>
function back1()
{	history.go(-1);	}

function generar_envio()
{	
	if (document.forma.elements['valor_unit'].value == '' || document.forma.elements['valor_unit'].value == 0)
	{	alert('Seleccione Empresa de Envio Y digite el peso del mismo');
			return false;
 }

	if (document.forma.elements['no_guia'].value == 0 || document.forma.elements['no_guia'].value == '' )
        {       alert('Digite un valor para el numero de guia diferente de cero');
                        return false;
 }

}
</script>
</head>
<body>
<span class=etexto>
<center>
<a class="vinculos" href='../envios/cuerpoEnvioFactura.php?<?=session_name()."=".session_id()."&krd=$krd&fecha_h=$fechah&dep_sel=$dep_sel&estado_sal=$estado_sal&estado_sal_max=$estado_sal_max&nomcarpeta=$nomcarpeta"?>'>Devolver a Listado</a>
</center></span>
<?
 /** INICIO GRABACION DE DATOS 					*
   *											*
   *											*/
?>
<center>
<table width="100%" class="borde_tab">
<tr class="titulos2"><td align="center">
ENVIO DE DOCUMENTOS
</td></tr>
</table>
</center>
<form name='forma' action='enviafactura.php?<?=session_name()."=".session_id()."&krd=$krd&fecha_h=$fechah&dep_sel=$dep_sel&whereFiltro=$whereFiltro&estado_sal=$estado_sal&estado_sal_max=$estado_sal_max&no_guia=$no_guia&codigo_envio=$codigo_envio&verrad_sal=$verrad_sal&nomcarpeta=$nomcarpeta"?>' method="post">
<input type='hidden' name='radicados' value='<?= $radicados ?>'>
<?
//$whereFiltro = str_replace("*","'", $whereFiltro);
include_once("$ruta_raiz/include/query/envios/queryEnviaFactura.php");
if(!isset($_POST["reg_envio"]))
{
?>
<table border=0 width=100% class=borde_tab>
	<!--DWLayoutTable-->
	<tr class='titulos2' >
		<td >Empresa De envio</td>
		<td >Peso(Gr)</td>
		<td >U.Medida</td>
		<td colspan="2" >Valor Total C/U</td>

	</tr>
	<tr class=timparr>
	<td height="26" align="center"><font size=2><B>
    <?
		$rsEnv = $db->conn->query($sql);
		//	if(!$empresa_envio) $empresa_envio=101;  <<===Evitemos estos amarres en código.
		print $rsEnv->GetMenu2("empresa_envio",0,"0:&lt;&lt; Seleccione  &gt;&gt;", false, 0," id='empresa_envio' class='select' onChange='calcular_precio();'");
   ?>
   </td>
   <td> <input type='text' name='envio_peso' id='envio_peso' value='<?=$envio_peso?>' size="6" onChange="calcular_precio();" class="tex_area"></td>
		<TD><input type="text" name="valor_gr" id="valor_gr"  value='<?=$valor_gr?>' size="30" disabled class="tex_area"> </td>
		<td align="center"> <input type="text" name="valor_unit" id="valor_unit"  readonly   value="<?=$valor_unit?>" class="tex_area"> </td>
		<td> <input type="button" name="Calcular_button" id="Calcular_button" Value="Calcular" onClick="calcular_precio();" class="tex_area"> </td>
    </tr>
<!--	<tr  class=titulos2>
        <td height="21" colspan="5">No. Guia
        <input type=text name=no_guia value='<?=$no_guia?>' size=20 class="tex_area">
        </td>
        </tr> -->

  </table>
  <?
}
  ?>
<table border=4 width=100% class=borde_tab>
	<!--DWLayoutTable-->
	<tr class='titulos2' >
		<td valign="top" >Radicado</td>
		<td valign="top" >Radicado Padre</td>
		<td valign="top" >Destinatario</td>
		<td valign="top" >Direccion</td>
		<td valign="top" >Municipio</td>
		<td valign="top" >Depto</td>
		<td valign="top" >Pa&iacute;s</td>
	</tr>
<?
include_once "$ruta_raiz/config.php";
require_once("$ruta_raiz/class_control/ControlAplIntegrada.php");
include_once "$ruta_raiz/include/db/ConnectionHandler.php";
//HLP $isql = "SELECT rtrim(a.ANEX_RADI_NUME),a.ANEX_NOMB_ARCHIVO,a.ANEX_DESC,a.SGD_REM_DESTINO,a.SGD_DIR_TIPO, ".
if(substr($whereFiltro,0,4)=="(( (")  $whereFiltro =substr($whereFiltro,1,strlen($whereFiltro)); 


//$isql = "SELECT  cast(c.RADI_NUME_RADI AS VARCHAR(15)) as RADI_NUME_SALIDA ,
$isql = "SELECT  distinct(c.RADI_NUME_RADI) as RADI_NUME_SALIDA ,
		 h.DEPE_CODI_DEST as DEPE_CODI_DEST ,
		 cast(c.RADI_NUME_DERI AS VARCHAR(15)) as RADI_NUME_DERI,
		 dir.SGD_DIR_TIPO AS SGD_DIR_TIPO
		FROM RADICADO c, SGD_DIR_DRECCIONES dir, HIST_EVENTOS h, 
			DEPENDENCIA d 
		WHERE  ".$whereFiltro.
		"  ".$comb_salida .
		"
		and c.radi_nume_radi=dir.radi_nume_radi
		and c.radi_nume_radi=h.radi_nume_radi
		and d.depe_codi=h.depe_codi_dest
		and h.sgd_ttr_codigo=9
		ORDER BY 1 ";
$db = new ConnectionHandler("$ruta_raiz");
$db->conn->BeginTrans();
if (isset($_POST["reg_envio"]))  {	 
				//$objCtrlAplInt = new ControlAplIntegrada($db); 
	}
if (!defined('ADODB_FETCH_ASSOC'))	{	define('ADODB_FETCH_ASSOC',2);	}
$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;
$ADODB_COUNTRECS = true;
//$db->conn->debug = true;
$rsEnviar = $db->query($isql);
//echo " isql $isql";
$ADODB_COUNTRECS = false;
$igual_destino = "si";
$tmp  = explode('-',$_SESSION['cod_local']);
$tmp_idcl = $tmp[0];
$tmp_idpl = $tmp[1];
$tmp_iddl = $tmp_idpl.'-'.$tmp[2]*1;
$tmp_idml = $tmp_iddl.'-'.$tmp[3]*1;
unset($tmp);
if ($rsEnviar && !$rsEnviar->EOF  )
{	$pCodDepAnt = "";
	$pCodMunAnt = "";
	if (!isset($_POST["reg_envio"]))
	{	$cnt_idcl = 0;
		$cnt_idcc = 0;
		$cnt_idpl = 0;
		$cnt_idpc = 0;
		$cnt_idml = 0;
		$cnt_idmc = 0;
		while (!$rsEnviar->EOF)
		{
			$verrad_sal     = $rsEnviar->fields["RADI_NUME_SALIDA"];   //OK
			$depe_codi_dest = $rsEnviar->fields["DEPE_CODI_DEST"];   //OK
			$verrad         = $verrad_sal;
			$verrad_padre   = $rsEnviar->fields["RADI_NUME_DERI"];
			$sgd_dir_tipo   = $rsEnviar->fields["SGD_DIR_TIPO"];
			$rem_destino    = $rsEnviar->fields["SGD_DIR_TIPO"];
			$anex_radi_nume = $verrad_sal;
			$dep_radicado   = substr($verrad_sal,4,$longitud_codigo_dependencia);
			$ano_radicado   = substr($verrad_sal,0,4);
			$carp_codi      = substr($dep_radicado,0,2);
			$radi_path_sal = "/$ano_radicado/$dep_radicado/docs/$ref_pdf";

			if (substr($rem_destino,0,1)=="7") $anex_radi_nume = $verrad_sal;
			$nurad = $anex_radi_nume;
			$verrad = $anex_radi_nume;

			/*include "../ver_datosrad.php";

			if ($radicadopadre)	$radicado = $radicadopadre;
			if ($nurad)	$radicado = $nurad;

			include "../clasesComunes/datosDest.php";

			//$dat = new DATOSDEST($db,$radicado,$espcodi,$sgd_dir_tipo,$rem_destino);
			$dat = new DATOSDEST($db,$verrad_sal,$espcodi,$sgd_dir_tipo,$rem_destino);
			$pCodDep = $dat->codep_us;
			$pCodMun = $dat->muni_us;
			$pNombre = $dat->nombre_us;
			$pPriApe = $dat->prim_apel_us;
			$pSegApe = $dat->seg_apel_us;
			$nombre_us    = substr($pNombre . " " . $pPriApe . " " . $pSegApe,0 ,33);
			$direccion_us = $dat->direccion_us;
			if ($pCodDepAnt == "")   $pCodDepAnt = $pCodDep;
			if ($pCodMunAnt == "")   $pCodMunAnt = $pCodMun;
			
			$id_cont=$dat->idcont;
			$id_pais=$dat->idpais;
			$id_muni=$dat->muni_us;
			$documento_us=$dat->documento_us;

			*/
				
	
			//busqueda de destinatario by skinatech

			$isql="SELECT distinct(H.RADI_NUME_RADI),
					h.HIST_FECH,
					U.USUA_NOMB AS NOMBRE_US,
					D.DEPE_NOMB AS DIRECCION_US,
					C.RA_ASUN AS ASUNTO,
					M.MUNI_CODI AS MUNI_US,
					M.DPTO_CODI AS DEPTO_US,
					M.ID_PAIS AS ID_PAIS,
					M.ID_CONT AS ID_CONT,
					U.USUA_DOC AS DOCUMENTO_US
				FROM USUARIO U, DEPENDENCIA D, HIST_EVENTOS H, MUNICIPIO M, RADICADO C
				WHERE  c.radi_nume_radi=h.radi_nume_radi
            			and h.sgd_ttr_codigo=9
	       		 		and h.depe_codi_dest=d.depe_codi
						and h.hist_doc_dest=u.usua_doc
						and ( m.id_cont=d.id_cont
                		        and m.id_pais=d.id_pais
		                        and m.dpto_codi=d.dpto_codi
                		        and m.muni_codi=d.muni_codi)
						and c.radi_nume_radi=".$verrad_sal." 
						and h.depe_codi_dest=".$depe_codi_dest."
				ORDER BY h.hist_fech asc";
			$rs_us=$db->query($isql);
			//echo "isql = $isql";
			//asigno las variables
			$nombre_us = $rs_us->fields["NOMBRE_US"];
			$documento_us = $rs_us->fields["DOCUMENTO_US"];
			$direccion_us = $rs_us->fields["DIRECCION_US"]; 
			$ra_asun = $rs_us->fields["ASUNTO"];
			$id_muni = $rs_us->fields["MUNI_US"]; 
			$pCodMun = $rs_us->fields["MUNI_US"]; 
			$pCodDep = $rs_us->fields["DEPTO_US"]; 
			$id_pais = $rs_us->fields["ID_PAIS"]; 
			$id_cont = $rs_us->fields["ID_CONT"]; 
		
			//	Validacion de local(local/nacional)/intenacional(grupo1/grupo2)
			if ($id_cont == $tmp_idcl)	//Comparativo desde el 1er continente con el continente local
			{	$cnt_idcl += 1;
				if ($id_pais == $tmp_idpl)	//Comparativo desde el 1er pais con el continente local
				{	$cnt_idpl += 1;
					if ($id_muni == $tmp_idml)	//Comparativo desde el 1er mcpio con el continente local
						$cnt_idml += 1;
					else	$cnt_idmc += 1;
				}
				else	$cnt_idpc += 1;
			}
			else	$cnt_idcc += 1;


			if(!$rem_destino) $rem_destino =1;
			$sgd_dir_tipo = 1;
			echo "<input type=hidden name=$espcodi value='$espcodi'>";

			$ruta_raiz = "..";
			include "../include/jh_class/funciones_sgd.php";
			$a = new LOCALIZACION($pCodDep,$pCodMun,$db);
			$departamento_us = $a->departamento;
			$destino         = $a->municipio;
			$pais_us         = $a->GET_NOMBRE_PAIS($id_pais,$db);
			$dir_codigo      = $documento_us;
			include "../envios/listaEnvioF.php";
			$cantidadDestinos++;
			$rsEnviar->MoveNext();
		}
		if ($cnt_idcl > 0 && $cnt_idcc >0)
			$igual_destino = "no";
		else
		{	($cnt_idcl > 0) ? $masiva = 3 : $masiva = 4;
			//Si contador continente local > 0  ==> masiva = 3 (Grupo 1)  sino masiva = 4 (Grupo 2)
			if ($cnt_idpl > 0 && $cnt_idpc >0)
				$igual_destino = "no";
			else
			{	if ($cnt_idpl > 0)	$masiva = 2;
				//Si contador paises local > 0  ==> masiva = 2 (Envios nacionales)
				if ($cnt_idml > 0 && $cnt_idmc >0)
					$igual_destino = "no";
				else
				{	if ($cnt_idml > 0)	$masiva = 1;
					//Si contador municipio local > 0  ==> masiva = 1 (Envios locales)
		}	}	}
	}	// no reg_envio

	if ($igual_destino == "si")
	{	if (!isset($_POST["reg_envio"]))
		{
?>
	<tr>
	<td colspan="7">
	<table class="borde_tab" width="100%" border="3">
	<tr>
		<td height="21" valign="top">
			<font size=2><center>
			<input name="reg_envio" type="submit" value="GENERAR REGISTRO DE ENVIO DE DOCUMENTO" id="GENERAR REGISTRO DE ENVIO DE DOCUMENTO" onClick="return generar_envio();" class="botones_largo">
			<input name="masiva" value="<?=$masiva?>" type="hidden">
			</center></font>
		</td>
	</tr>
	</table>
	</td>
	</tr>
<?
		}
		else
		{	
			
			if (!$k)
			{
				$rsEnviar->MoveFirst();
				while (!$rsEnviar->EOF)
				{	$verrad_sal     = $rsEnviar->fields["RADI_NUME_SALIDA"];
// MODIFICADO SKInA, SE AGREGA LA DECLaRaCION DE LA VaRIABLE $depe_codi_dest
					$depe_codi_dest = $rsEnviar->fields["DEPE_CODI_DEST"];
					$verrad_padre   = $rsEnviar->fields["RADI_NUME_DERI"];
					$rem_destino    = $rsEnviar->fields["SGD_DIR_TIPO"];
					$campos["P_RAD_E"]=$verrad_sal;
					/*$estQueryAdd=$objCtrlAplInt->queryAdds($verrad_sal,$campos,$MODULO_ENVIOS);

					if ($estQueryAdd==0)
					{	$db->conn->RollbackTrans();
						die;
					}
					*/
					if(!$rem_destino) $rem_destino =1;
					if (!trim($rem_destino))
						$isql_w = " sgd_dir_tipo is null ";
					else	$isql_w = " sgd_dir_tipo='$rem_destino' ";
					//MODIFICADO SKINA 130410 para indupalma 
						//$verrad_sal1=$verrad_sal."0000".$nextval;


						//$db->conn->debug=true;

					//Busco el max de los anexos
					$sql_max=" select max(anex_numero) AS MAX, RADI_NUME_SALIDA, ANEX_CREADOR
							from anexos where anex_radi_nume=$verrad_sal and anex_borrado='N'
							group by radi_nume_salida, anex_creador";
					
					$rs_max=$db->conn->Execute($sql_max);
						//$db->conn->debug=true;
					$max=$rs_max->fields["MAX"];
					$radi_nume_sal=$rs_max->fields["RADI_NUME_SALIDA"];
					$creador=$rs_max->fields["ANEX_CREADOR"];
					//echo "<br> max $max radi_sal $radi_nume_sal crea $creador <br>";
		                        
					//Para las facturas y entradas intersedes, inserta en la pestana documentos
					if ((substr($verrad,-1)==2 or substr($verrad,-1)==4) and (($radi_nume_sal==$verrad_sal and !$max) or $radi_nume_sal==""))
					{
						$max++;
						//echo "<br> max1 $max <br>";
						$verrad_sal1=$verrad_sal."0000".$max;
                	                        $verrad_sal2=" ";
                        	                $isql = "insert into ANEXOS(ANEX_ESTADO, ANEX_FECH_ENVIO,ANEX_RADI_FECH,
                                                        SGD_DIR_TIPO,ANEX_RADI_NUME, ANEX_CODIGO, ANEX_SOLO_LECT,
                                                        ANEX_CREADOR, ANEX_BORRADO, ANEX_SALIDA, RADI_NUME_SALIDA,
                                                        ANEX_DEPE_CREADOR, ANEX_TIPO, ANEX_NUMERO, ANEX_NOMB_ARCHIVO, ANEX_DESC)
                                                        VALUES (4,".$db->conn->OffsetDate(0,$db->conn->sysTimeStamp).", ".$db->conn->OffsetDate(0,$db->conn->sysTimeStamp).",
                                                        $rem_destino, $verrad_sal,  '$verrad_sal1', 'S',
                                                         '$krd','N', 1,  '$verrad_sal', ".$dependencia.",14, $max, '$verrad_sal2', 'ENVIO INTERSEDES')";
					}elseif($radi_nume_sal==$verrad_sal and $max==1) 
					{
						$isql="update anexos set anex_estado=4 where anex_radi_nume=$verrad_sal and anex_numero=1";
					}else {
						$isql="update anexos set anex_estado=4 where radi_nume_salida=$radi_nume_sal ";
					}

                                        $rsUpdate = $db->query($isql);

                			//echo "k1 $k";

					//$db->conn->debug=true;
                                        if ($rsUpdate)  $k++;

					if (!$codigo_envio)
					{	//include_once("$ruta_raiz/include/query/envios/queryEnvia.php");
						$sql_sgd_renv_codigo = "select SGD_RENV_CODIGO FROM SGD_RENV_REGENVIO ORDER BY SGD_RENV_CODIGO DESC ";
						$rsRegenvio = $db->conn->SelectLimit($sql_sgd_renv_codigo,10);
						$nextval = $rsRegenvio->fields["SGD_RENV_CODIGO"];
						$nextval++;
						$codigo_envio = $nextval;
						$radi_nume_grupo =  $verrad_sal ;
						$isql = "update RADICADO set SGD_EANU_CODIGO=9 where RADI_NUME_RADI =$verrad_sal";
						$rsUpdate2 = $db->query($isql);
					}
					else
					{	$nextval = $codigo_envio;
						$valor_unit=0;
					}
					$dir_tipo = $rem_destino;
					/*
					$verrad_sal1=$verrad_sal."0000".$nextval;
					$verrad_sal2=" ";
                                        $isql = "insert into ANEXOS(ANEX_ESTADO, ANEX_FECH_ENVIO,ANEX_RADI_FECH,
                                                        SGD_DIR_TIPO,ANEX_RADI_NUME, ANEX_CODIGO, ANEX_SOLO_LECT,
                                                        ANEX_CREADOR, ANEX_BORRADO, ANEX_SALIDA, RADI_NUME_SALIDA,
                                                        ANEX_DEPE_CREADOR, ANEX_TIPO, ANEX_NUMERO, ANEX_NOMB_ARCHIVO)
                                                        VALUES (4,".$db->conn->OffsetDate(0,$db->conn->sysTimeStamp).", ".$db->conn->OffsetDate(0,$db->conn->sysTimeStamp).",
                                                        $rem_destino, $verrad_sal,  '$verrad_sal1', 'S',
                                                         '$krd','N', 1,  '$verrad_sal', ".$dependencia.",14, 1, '$verrad_sal2')";
                                        $rsUpdate = $db->query($isql);
                                        //$db->conn->debug=true;
                                        if ($rsUpdate)  $k++;

*/
//Modificado skina 
//$observaciones=" Guia No. ".$no_guia;


/*       			$isql_depdest = "SELECT DEPE_CODI_DEST FROM HIST_EVENTOS WHERE RADI_NUME_RADI=$verrad_sal";
			$rsDepdest = $db->query($isql_depdest);
			$depe_codi_dest = $rsDepdest->fields["DEPE_CODI_DEST"];*/
			$isql_select = "SELECT U.USUA_NOMB AS NOMBRE_US,
					D.DEPE_NOMB AS DIRECCION_US,
					U.USUA_DOC AS DOCUMENTO_US
				FROM USUARIO U, DEPENDENCIA D, HIST_EVENTOS H, RADICADO C
				WHERE  h.radi_nume_radi=c.radi_nume_radi
		                        and h.sgd_ttr_codigo=9
                		        and h.depe_codi_dest=d.depe_codi
					and h.usua_codi_dest=u.usua_codi
					and h.hist_doc_dest=u.usua_doc
					and c.radi_nume_radi=".$verrad_sal."
                                        and h.depe_codi_dest=".$depe_codi_dest; 
					$rsSelect = $db->query($isql_select);
					//echo "isql_select =$isql_select";
					$nombre_us = $rsSelect->fields["NOMBRE_US"];
					$direccion_us = $rsSelect->fields["DIRECCION_US"];
					$usua_doc = $rsSelect->fields["DOCUMENTO_US"];
					$isql = "INSERT INTO SGD_RENV_REGENVIO(USUA_DOC ,SGD_RENV_CODIGO ,SGD_FENV_CODIGO
							,SGD_RENV_FECH ,RADI_NUME_SAL ,SGD_RENV_DESTINO ,SGD_RENV_TELEFONO
							,SGD_RENV_MAIL ,SGD_RENV_PESO ,SGD_RENV_VALOR ,SGD_RENV_CERTIFICADO
							,SGD_RENV_ESTADO ,SGD_RENV_NOMBRE ,SGD_DIR_CODIGO ,DEPE_CODI
							,SGD_DIR_TIPO ,RADI_NUME_GRUPO ,SGD_RENV_PLANILLA ,SGD_RENV_DIR
							,SGD_RENV_DEPTO, SGD_RENV_MPIO, SGD_RENV_PAIS, SGD_RENV_OBSERVA ,SGD_RENV_CANTIDAD, SGD_RENV_GUIA)
							VALUES('$usua_doc' ,'$nextval' ,'$empresa_envio' ," .$db->conn->OffsetDate(0,$db->conn->sysTimeStamp)."
									, '$verrad_sal', '$destino', '$telefono', '$mail', '$envio_peso', '$valor_unit', 0, 1, '$nombre_us'
									, '$dir_codigo', '$dependencia', '$dir_tipo', '$verrad_sal', '$no_planilla', '$direccion_us'
									, '$departamento_us' ,'$destino', '$pais_us', '$observaciones',1,'$no_guia' )";
					$rsInsert = $db->query($isql);
                    //$db->conn->debug=true;
					$rsEnviar->MoveNext();
					include "../envios/listaEnvioF.php";
				} 
				$db->conn->CommitTrans();
			}	
			//by skina include "../envios/listaEnvioF.php";
			echo "<b><span class=listado2>Registro de Envio Generado</span> </b><br><br>";
		}	 //FIN else no reg_envio
	}
	else
	{
		echo "<hr><table class=borde_tab><tr class=titulosError><td>NO PUEDE SELECCIONAR VARIOS DOCUMENTOS PARA UN MISMO DESTINO CON CIUDAD Y/O DEPARTAMENTO DIFERENTE</td></tr></table><hr>";
	}
}
?>
</table>
</form>
<?
$encabezado = "krd=$krd&fecha_h=$fechah&dep_sel=$dep_sel&estado_sal=$estado_sal
&estado_sal_max=$estado_sal_max&nomcarpeta=$nomcarpeta";
?>
<center>
<a class=vinculos href='cuerpoEnvioFactura.php?<?=session_name()."=".session_id()."&$encabezado"?>'>Devolver a Listado</a>
</center>
<script>
<?
if($igual_destino=='si')
{	echo "function calcular_precio()
{";
$ruta_raiz = "..";
$no_tipo="true";
include_once "../config.php";
include_once "$ruta_raiz/include/db/ConnectionHandler.php";
if (!isset($db))	$db = new ConnectionHandler("$ruta_raiz");

if (!defined('ADODB_FETCH_ASSOC'))
	{	define('ADODB_FETCH_ASSOC',2);	}
$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;

//	HLP. Creamos el query que trae los valores para envios nacionales o internacionales.
switch ($masiva)
{	case 1:
	case 2:
	{	$var_grupo = 1;
		$campos_valores = " b.SGD_TAR_VALENV1 as VALOR1, b.SGD_TAR_VALENV2 as VALOR2 ";
	}	break;
	case 3:
	{	$var_grupo = 2;
		$campos_valores = " b.SGD_TAR_VALENV1G1 as VALOR1 ";
	}	break;
	case 4:
	{	$var_grupo = 2;
		$campos_valores = " b.SGD_TAR_VALENV2G2 as VALOR1 ";
	}
}
$isql = "SELECT a.SGD_FENV_CODIGO, a.SGD_CLTA_DESCRIP, a.SGD_CLTA_PESDES, a.SGD_CLTA_PESHAST, ".$campos_valores.
			"FROM SGD_CLTA_CLSTARIF a,SGD_TAR_TARIFAS b
			WHERE a.SGD_FENV_CODIGO = b.SGD_FENV_CODIGO
			AND a.SGD_TAR_CODIGO = b.SGD_TAR_CODIGO
			AND a.SGD_CLTA_CODSER = b.SGD_CLTA_CODSER
			AND a.SGD_CLTA_CODSER = ".$var_grupo;
//$db->conn->debug=true;
$rsEnvio = $db->query($isql);
$tmp = 0 ;
echo "\n
var obj_peso = document.getElementById('envio_peso');
if (obj_peso.value != '')
{	if (isNaN(parseInt(obj_peso.value)) || obj_peso.value <= 0)
	{	alert('Digite Correctamente Peso del Envio');
		obj_peso.value = '';
		return false;
	}
	var hallar_rango = false;\n";
while ($rsEnvio && !$rsEnvio->EOF)
{	$tmp+=1;
	if ($masiva==1 or $masiva==2)
	{	$valor_local = $rsEnvio->fields["VALOR1"];
		$valor_fuera = $rsEnvio->fields["VALOR2"];
	}
	else
	{	$valor_local = $rsEnvio->fields["VALOR1"];
		$valor_fuera = $rsEnvio->fields["VALOR1"];
	}

	$rango = $rsEnvio->fields["SGD_CLTA_DESCRIP"];
	$fenvio =$rsEnvio->fields["SGD_FENV_CODIGO"];
	echo "\nif (document.forma.elements['empresa_envio'].value==$fenvio && document.getElementById('envio_peso').value>=".$rsEnvio->fields["SGD_CLTA_PESDES"]." &&  document.getElementById('envio_peso').value<=".$rsEnvio->fields["SGD_CLTA_PESHAST"].") \n
			{	hallar_rango = true;
				document.getElementById('valor_gr').value = '$rango';
				dp_especial='$dependencia';
				if (document.forma.elements['destino'].value=='$depe_municipio' || (dp_especial=='840' && (document.forma.elements['destino'].value=='FLORIDABLANCA' || document.forma.elements['destino'].value=='GIRON (SAN JUAN DE)' || document.forma.elements['destino'].value=='PIEDECUESTA')))
				{	valor = $valor_local + 0; }
				else
				{
					valor = $valor_fuera +0 ;

				}
			}";
	$rsEnvio->MoveNext();
}
?>
if (hallar_rango)
{	document.getElementById('valor_unit').value = valor ;
}
else
{
	alert('Rango y peso especificado no esta configurado,\nComuniquese con el administrador del sistema.');
}}}
<?
}
else echo "function calcular_precio() {}";
?>
</script>
</body>
</html>
