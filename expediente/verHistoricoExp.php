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
/** Modulo de Expedientes o Carpetas Virtuales
  * Modificacion Variables
  *@autor Jairo Losada 2009/06
  *Licencia GNU/GPL 
  */
foreach ($_GET as $key => $valor)   ${$key} = $valor;
foreach ($_POST as $key => $valor)   ${$key} = $valor;

$krd = $_SESSION["krd"];
$dependencia = $_SESSION["dependencia"];
$usua_doc = $_SESSION["usua_doc"];
$codusuario = $_SESSION["codusuario"];
$tip3Nombre=$_SESSION["tip3Nombre"];
$tip3desc = $_SESSION["tip3desc"];
$tip3img =$_SESSION["tip3img"];
$tpNumRad = $_SESSION["tpNumRad"];
$tpPerRad = $_SESSION["tpPerRad"];
$tpDescRad = $_SESSION["tpDescRad"];
$tip3Nombre = $_SESSION["tip3Nombre"];
$tpDepeRad = $_SESSION["tpDepeRad"];
$usuaPermExpediente = $_SESSION["usuaPermExpediente"];

$ruta_raiz = ".."; 	include_once "$ruta_raiz/include/db/ConnectionHandler.php";
$db = new ConnectionHandler($ruta_raiz);
/** PAGINA QUE DESPLIEGA EL HISTORICO DE DE UN EXPEDIENTE
	* Esta pagina necesita que llegue el Numero de expediente en la variable $numeroExpediente
	* @version ORFEO 3.5
	* @autor JAIRO LOSADA - SUPERSERVICIOS
	* @fecha Marzo de 2006
	* @licencia GPL. Software Libre.
	* @param $numeroExpediente Integer Numero de Expediente
	*
	**/

/** TRAER DTOS DE EXPEDIENTE
	* @param $trdExp objecto Objeto que trae funciones del expediente
	* @param $tSub  int Almacena Codigo de la Subserie.
  * @param $codSerie int Almacena Codigo de la Serie Documental.
	* @param $descFldExp String Guarda Descripcion del estado del Flujo del Expediente Actual.
	* @param $expTerminos Int   Guarda los terminos o Dias Habiles del proceso Actual.
	* @param $expFechaCreacion date Fecha de Creacion del expediete.
	* 
	**/
	include_once ("$ruta_raiz/include/tx/Expediente.php");
	error_reporting(0);
	$trdExp = new Expediente($db);
	$mrdCodigo = $trdExp->consultaTipoExpediente($numeroExpediente);
	$trdExpediente= $trdExp->descSerie." / ".$trdExp->descSubSerie;
	$descPExpediente = $trdExp->descTipoExp;
	$codSerie = $trdExp->codigoSerie;
	$cosSub = $trdExp->codigoSubSerie;
	$tdoc = $trdExp->codigoTipoDoc;
	$codigoTipoExp = $trdExp->codigoTipoExp;
	$descFldExp = $trdExp->descFldExp;
	$codigoFldExp = $trdExp->codigoFldExp;
  $expTerminos = $trdExp->expTerminos;
	$expFechaCrea = $trdExp->expFechaCrea;
	$expTerminosP = $trdExp->expTerminosP;
	$descTipoExp = $trdExp->descTipoExp;
	$no_tipo = false;
	
	include_once "$ruta_raiz/tx/diasHabiles.php";
	$a = new FechaHabil($db);
	$tReal = $a->diasHabiles($expFechaCrea,date("Y-m-d"));
?>
<html>
<head>

<title>HISTORICO EXPEDIENTE <?=$numeroExpediente?></title>
        <link href="<?= $ruta_raiz . $ESTILOS_PATH2 ?>bootstrap.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="<?= $ruta_raiz . $_SESSION['ESTILOS_PATH_ORFEO'] ?>">
</head>
<body>
    
<center>
     <div id="titulo" style="width: 95%;" align="center">Historico del expediente <?=$numeroExpediente?> "<?=$descTipoExp?></div>
</center>    
<table width="95%" border="1" cellpadding="0" cellspacing="0" align="center">
<!--  <tr bgcolor="#006699">
    <td class="titulos4" colspan="6" ><center>Historico del expediente <?=$numeroExpediente?> "<?=$descTipoExp?>"  </center></td>
	 </tr>-->
</table>

<?php
	require_once("$ruta_raiz/class_control/Transaccion.php");
	require_once("$ruta_raiz/class_control/Dependencia.php");
	require_once("$ruta_raiz/class_control/usuario.php");
	error_reporting(0);
	$trans = new Transaccion($db);
	$objDep = new Dependencia($db);
	$objUs = new Usuario($db);
	$isql = "select USUA_NOMB from usuario where depe_codi=$dependencia and usua_codi=$codusuario";
	$rs = $db->query($isql);	      	   
	$usuario_actual = $rs->fields["USUA_NOMB"];
//include_once "$ruta_raiz/flujoGrafico.php";
?>
<center>
<table  width="95%"  align="center"  border="1" cellpadding="0" cellspacing="5" class="borde_tab"  >
  <tr   >
    <td width=25% class="listado1" height="24">Estado actual</td>
    <td  width=25% class="listado2" height="24" align="left"><?=$descFldExp?></td>
    <td width=25% class="listado1" height="24">Días esperados para este estado</td>
    <td  width=25% class="listado2" height="24"><?=$expTerminosP?> Dias Hábiles</td>
  </tr>
    <tr  class='etextomenu' >
    <td  class="listado1" height="24">Días hábiles de proceso</td>
    <td  class="listado2" height="24"><?=$tReal?></td>
    <td  class="listado1" height="24">Días hábiles legales </td> 
    <td  class="listado2" height="24"><?=$expTerminos?></td>
  </tr>
 </table>
</center>
 <table width="95%" border="1" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td height="25" class="titulos4">Flujo histórico del expediente ---- Fecha de inicio de proceso <?=$expFechaCrea?></td>
  </tr>
</table>
<table  width="95%" align="center" border="1" cellpadding="0" cellspacing="1" class="borde_tab" >
  <tr   align="center">
    <th width=100 class="listado1" height="24">Dependencia</th>
    <th  width=100 class="listado1" height="24">Fecha</th>
     <th  width=100 class="listado1" height="24">Transacción</th>  
    <th  width=100 class="listado1" height="24" >Usuario</th>
		<th  width=100 class="listado1" height="24" >Radicado</th>
    <th  width=200 height="24" class="listado1">Comentario</th>
	<?
		/** FLUJO GRAFICO DE LOS ESTADOS POR EL CUAL PASA EL EXPEDIENTE
			*/
 	$isql = "select 
					fe.SGD_FEXP_DESCRIP
					,fe.SGD_FEXP_TERMINOS
					,fe.SGD_FEXP_CODIGO
					,fe.SGD_FEXP_ORDEN
			from SGD_FEXP_FLUJOEXPEDIENTES fe
		 where 
			fe.SGD_PEXP_CODIGO ='$codigoTipoExp'
			order by fe.SGD_FEXP_ORDEN  ";  
	$rs = $db->query($isql);
	$terminosTotales = 0;
if($rs)
{
	while(!$rs->EOF)
	{
		$etapaFlujo = $rs->fields["SGD_FEXP_DESCRIP"];
		$etapaFlujoTerminos = $rs->fields["SGD_FEXP_TERMINOS"];
		$terminosTotales = $terminosTotales + $etapaFlujoTerminos;
		$codFlujo = $rs->fields["SGD_FEXP_CODIGO"];
		$codOrden = $rs->fields["SGD_FEXP_ORDEN"];
		$flujoCodigo[$codFlujo] = $codOrden;
		$flujoTerminosReal[$codFlujo] = $terminosTotales;
		?>
		<th  width=300 height="24" class="listado1"><?=$etapaFlujo?> (<?=$etapaFlujoTerminos?> / <?=$flujoTerminosReal[$codFlujo]?> Dias)</th>
		<?
		$rs->MoveNext();
	}
}
	?>
  </tr>
  <?
  $sqlFecha = $db->conn->SQLDate("d-m-Y H:i A","he.SGD_HFLD_FECH");
	$sqlFecha = $db->conn->SQLDate("Y-m-d","he.SGD_HFLD_FECH");
 	$isql = "select $sqlFecha as HIST_FECH
			, he.DEPE_CODI
			, he.USUA_CODI
			, he.RADI_NUME_RADI
			, he.SGD_HFLD_OBSERVA as HIST_OBSERVA 
			, he.USUA_DOC
			, he.SGD_TTR_CODIGO
			, he.RADI_NUME_RADI
			, he.SGD_FEXP_CODIGO
			, $sqlFecha as FECHA
			from SGD_HFLD_HISTFLUJODOC he
		 where 
			he.SGD_EXP_NUMERO ='$numeroExpediente'
			order by he.SGD_HFLD_FECH desc ";  

	$i=1;
	$rs = $db->query($isql);
if($rs)
{
    while(!$rs->EOF)
	 {
		$usua_doc_dest = "";
		$usua_doc_hist = "";
		$usua_nomb_historico = "";
		$usua_destino = "";
		$numdata =  trim($rs->fields["CARP_CODI"]);
		if($data =="") $rs1->fields["USUA_NOMB"];
	   		$data = "NULL";
		$numerot = $rs->fields["NUM"];
		$usua_doc_hist = $rs->fields["USUA_DOC"];
		$usua_codi_dest = $rs->fields["USUA_CODI_DEST"];
		$usua_dest=intval(substr($usua_codi_dest,3,3));
		$depe_dest=intval(substr($usua_codi_dest,0,3));
		$usua_codi = $rs->fields["USUA_CODI"];
		$depe_codi = $rs->fields["DEPE_CODI"];
		$codTransac = $rs->fields["SGD_TTR_CODIGO"];
		$descTransaccion = $rs->fields["SGD_TTR_DESCRIP"];
    if(!$codTransac) $codTransac = "0";
		$trans->Transaccion_codigo($codTransac);
		$objUs->usuarioDocto($usua_doc_hist);
		$objDep->Dependencia_codigo($depe_codi);

		error_reporting(0);
		if($carpeta==$numdata)
			{
			$imagen="usuarios.gif";
			}
		else
			{
			$imagen="usuarios.gif";
			}
		if($i==1)
			{
		?>
  <tr class='tpar'> <?  
		    $i=1;
			}
			 ?>
    <td class="listado2" >
	<?=$objDep->getDepe_nomb()?></td>
    <td class="listado2">
	<?
			$expFechaHist = $rs->fields["HIST_FECH"];
			echo $expFechaHist;
	?>
 </td>
<td class="listado2"  >
  <?=$trans->getDescripcion()?>
</td>
<td class="listado2"  >
   <?=$objUs->get_usua_nomb()?>
</td>
<td class="listado2"  >
   <?=$rs->fields["RADI_NUME_RADI"]?>
</td>
		<?
		 /**
			 *  Campo qque se limino de forma Temporal USUARIO - DESTINO 
			 * <td class="celdaGris"  >
			 * <?=$usua_destino?> </td> 
			 */
		?>
		<td class="listado2" width="200"><?=$rs->fields["HIST_OBSERVA"]?></td>
	<? 
			$flujoCodigoActual = $flujoCodigo[$rs->fields["SGD_FEXP_CODIGO"]];
			for($i=0;$i<=$flujoCodigoActual-1;$i++)
			{
					if($flujoCodigoActual-1==$i)
						{
								$classMostrar="listado1";
							//$fondoImg = "$ruta_raiz/imagenes/internas/moverA.gif";
						}else
						{
							  $classMostrar="titulosError";
								$fondoImg = "";
						}
				?>
						<td class="<?=$classMostrar?>" width="100" background="<?=$fondoImg?>" align="top">
						<?
								if($flujoCodigoActual-1==$i)
								{
								 $tReal = $a->diasHabiles($expFechaCrea,$rs->fields["FECHA"]);
								 echo "$tReal Dias";
								}
						?>
						</td>
				<?
			}
	?>
  </tr>
  <?
	$rs->MoveNext();
  	}
}
  // Finaliza Historicos
	?>
</table>

</body>
</html>
